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
            $validate = $request->validate([
                'name'        => 'required|string|max:150',
                'vendor_id'   => 'required|integer',
                'category_id' => 'required|integer',
                'price'       => 'required|numeric',
                'status'      => 'required|in:active,out_of_stock,pending_review,banned',
                'images.*'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            $product = TblProduct::create($validate);

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

    // Get product for editing
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

            $validate = $request->validate([
                'name'        => 'required|string|max:150',
                'vendor_id'   => 'required|integer',
                'category_id' => 'required|integer',
                'price'       => 'required|numeric',
                'status'      => 'required|in:active,out_of_stock,pending_review,banned',
                'images.*'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            $product->update($validate);

            // Handle New Image Upload
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

    public function show($id)
    {
        $product=TblProduct::find($id);
        return view('admin.product.view_product', compact('product'));
    }

    // Delete Product Image
    public function deleteImage($id)
    {
        try {
            $image = TblImage::findOrFail($id);
            
            // Delete file from storage
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

    public function active($id)
    {
        $product = TblProduct::findOrFail($id);
        $product->update(['status' => 'active']);
        return redirect()->back()->with('success', 'Product marked as active successfully!');
    }

    public function outOfStock($id)
    {
        $product = TblProduct::findOrFail($id);
        $product->update(['status' => 'out_of_stock']);
        return redirect()->back()->with('success', 'Product marked as out of stock successfully!');
    }

    public function pending($id)
    {
        $product = TblProduct::findOrFail($id);
        $product->update(['status' => 'pending_review']);
        return redirect()->back()->with('success', 'Product marked as pending review successfully!');
    }

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
        
        $product->status = 'banned';
        $product->rejection_reason = $request->rejection_reason;
        $product->save();

        $vendorEmail = $product->vendor->users->email;
        $reason = $request->rejection_reason;
        
        $message = "Your product '{$product->name}' has been banned by the admin.";
        $message .= "\n\nReason: " . $reason;

        sendEmail(
            $vendorEmail,
            "Product Banned: " . $product->name,
            $message,
            [
                'heading' => 'Product Banned 🚫',
                'footer'  => 'Please contact support for more information.',
            ]
        );

        return redirect()->route('admin.products.detail', $id)->with('success', 'Product banned successfully!');
    }
}
