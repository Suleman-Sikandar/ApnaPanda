<?php
namespace App\Services\Admin;

use App\Models\TblProduct;
use App\Models\TblProductCategory;
use App\Models\TblVendorModel;
use App\Models\TblImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    // List all products
    public function index()
    {
        $products = TblProduct::with(['vendor', 'category'])
            ->orderBy('id', 'ASC')
            ->get();

        $vendors    = TblVendorModel::with('users')->get();
        $categories = TblProductCategory::all();

        return view('admin.product.listing', compact('products', 'vendors', 'categories'));
    }


    // Store a new product
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name'              => 'required|string|max:150',
                'vendor_id'         => 'required|integer',
                'category_id'       => 'required|integer',
                'price'             => 'required|numeric|min:0',
                'discount_percent'  => 'nullable|numeric|min:0|max:100',
                'stock_quantity'    => 'nullable|integer|min:0',
                'SKU'               => 'nullable|string|max:100|unique:tbl_products,SKU',
                'description'       => 'nullable|string',
                'status'            => 'required|in:active,out_of_stock,pending_review,banned',
                'has_free_delivery' => 'nullable|boolean',
                'delivery_charge'   => 'nullable|numeric|min:0',
                'rating'            => 'nullable|numeric|min:0|max:5',
                'review_count'      => 'nullable|integer|min:0',
                'images.*'          => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            // AUTO CALCULATE DISCOUNT AMOUNT
            $price = $request->price;
            $discountPercent = $request->discount_percent ?? 0;
            $discountAmount = ($price * $discountPercent) / 100;

            // If free delivery selected → charge = 0
            $deliveryCharge = $request->has_free_delivery == 1 
                ? 0 
                : ($request->delivery_charge ?? 0);

            // Final product data
            $productData = array_merge($validated, [
                'discount_percent' => $discountPercent,
                'discount_amount'  => $discountAmount,
                'delivery_charge'  => $deliveryCharge,
                'has_free_delivery'=> $request->has_free_delivery ?? 0,
                'rating'           => $request->rating ?? 0,
                'review_count'     => $request->review_count ?? 0,
            ]);

            $product = TblProduct::create($productData);

            // Handle Image Upload
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('products', 'public');
                    TblImage::create([
                        'product_id' => $product->id,
                        'image_path' => $path,
                    ]);
                }
            }

            return response()->json([
                'status'  => true,
                'success' => 'Product created successfully!',
                'data'    => $product,
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error'  => $e->getMessage(),
            ], 500);
        }
    }



    // Edit product
    public function edit($id)
    {
        try {
            $product = TblProduct::with('images')->findOrFail($id);

            return response()->json([
                'status' => true,
                'data'   => $product,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error'  => 'Record not found.',
            ], 404);
        }
    }



    // Update product
    public function update(Request $request, $id)
    {
        try {
            $product = TblProduct::findOrFail($id);

            $validated = $request->validate([
                'name'              => 'required|string|max:150',
                'vendor_id'         => 'required|integer',
                'category_id'       => 'required|integer',
                'price'             => 'required|numeric|min:0',
                'discount_percent'  => 'nullable|numeric|min:0|max:100',
                'stock_quantity'    => 'nullable|integer|min:0',
                'SKU'               => 'nullable|string|max:100|unique:tbl_products,SKU,' . $id,
                'description'       => 'nullable|string',
                'status'            => 'required|in:active,out_of_stock,pending_review,banned',
                'has_free_delivery' => 'nullable|boolean',
                'delivery_charge'   => 'nullable|numeric|min:0',
                'rating'            => 'nullable|numeric|min:0|max:5',
                'review_count'      => 'nullable|integer|min:0',
                'images.*'          => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            // AUTO CALCULATE DISCOUNT AMOUNT
            $price = $request->price;
            $discountPercent = $request->discount_percent ?? 0;
            $discountAmount = ($price * $discountPercent) / 100;

            // Delivery logic
            $deliveryCharge = $request->has_free_delivery == 1
                ? 0
                : ($request->delivery_charge ?? 0);

            $updateData = array_merge($validated, [
                'discount_percent' => $discountPercent,
                'discount_amount'  => $discountAmount,
                'delivery_charge'  => $deliveryCharge,
                'has_free_delivery'=> $request->has_free_delivery ?? 0,
                'rating'           => $request->rating ?? 0,
                'review_count'     => $request->review_count ?? 0,
            ]);

            $product->update($updateData);

            // Handle New Images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('products', 'public');
                    TblImage::create([
                        'product_id' => $product->id,
                        'image_path' => $path,
                    ]);
                }
            }

            return response()->json([
                'status'  => true,
                'success' => 'Product updated successfully!',
                'data'    => $product,
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error'  => $e->getMessage(),
            ], 500);
        }
    }



    // Delete product
    public function destroy($id)
    {
        try {
            $product = TblProduct::findOrFail($id);
            $product->delete();

            return response()->json([
                'status'  => true,
                'success' => 'Product deleted successfully!',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error'  => 'Unable to delete record.',
            ], 500);
        }
    }


    // View product
    public function show($id)
    {
        $product = TblProduct::find($id);
        return view('admin.product.view_product', compact('product'));
    }


    // Delete Product Image
    public function deleteImage($id)
    {
        try {
            $image = TblImage::findOrFail($id);

            if (Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }

            $image->delete();

            return response()->json([
                'status'  => true,
                'success' => 'Image deleted successfully!',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error'  => 'Unable to delete image.',
            ], 500);
        }
    }


    // Status management
    public function active($id)
    {
        TblProduct::findOrFail($id)->update(['status' => 'active']);
        return back()->with('success', 'Product marked as active successfully!');
    }

    public function outOfStock($id)
    {
        TblProduct::findOrFail($id)->update(['status' => 'out_of_stock']);
        return back()->with('success', 'Product marked as out of stock successfully!');
    }

    public function pending($id)
    {
        TblProduct::findOrFail($id)->update(['status' => 'pending_review']);
        return back()->with('success', 'Product marked as pending review successfully!');
    }



    // Ban product
    public function ban($id)
    {
        $product = TblProduct::findOrFail($id);
        return view('admin.product.ban_reason', compact('product'));
    }

    public function banUpdate(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string',
        ]);

        $product = TblProduct::with('vendor.users')->findOrFail($id);

        $product->update([
            'status'           => 'banned',
            'rejection_reason' => $request->rejection_reason,
        ]);

        $vendorEmail = $product->vendor->users->email;

        sendEmail(
            $vendorEmail,
            "Product Banned: " . $product->name,
            "Your product has been banned. Reason: " . $request->rejection_reason,
            [
                'heading' => 'Product Banned 🚫',
                'footer'  => 'Please contact support for more information.',
            ]
        );

        return redirect()->route('admin.products.detail', $id)
                         ->with('success', 'Product banned successfully!');
    }
}
