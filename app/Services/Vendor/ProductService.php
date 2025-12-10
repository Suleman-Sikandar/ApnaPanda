<?php
namespace App\Services\Vendor;

use App\Models\TblProduct;
use App\Models\TblProductCategory;
use App\Models\TblImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function index()
    {
        $userId = Auth::id();
        $products = TblProduct::with(['category', 'vendor.users', 'images'])
                    ->where('vendor_id', $userId)
                    ->latest()
                    ->get();
        
        $categories = TblProductCategory::all();
        
        return view('vendor.product.listing', [
            'pageTitle' => 'Products',
            'subTitle'  => 'Manage Your Products',
            'products'  => $products,
            'categories'=> $categories
        ]);
    }

    public function store($request)
    {
        try {
            $userId = Auth::id();

            $validate = $request->validate([
                'name'              => 'required|string|max:150',
                'category_id'       => 'required|integer',
                'price'             => 'required|numeric|min:0',
                'discount_percent'  => 'nullable|numeric|min:0|max:100',
                'stock_quantity'    => 'nullable|integer|min:0',
                'SKU'               => 'nullable|string|max:100|unique:tbl_products,SKU',
                'rating'            => 'nullable|numeric|min:0|max:5',
                'review_count'      => 'nullable|integer|min:0',
                'has_free_delivery' => 'nullable|boolean',
                'delivery_charge'   => 'nullable|numeric|min:0',
                'images.*'          => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            // Set vendor ID
            $validate['vendor_id'] = $userId;

            // Set default status
            $validate['status'] = 'pending_review';

            // Calculate Discount Amount
            $discountPercent = $validate['discount_percent'] ?? 0;
            $price = $validate['price'];
            $validate['discount_amount'] = $price * ($discountPercent / 100);

            // Create Product
            $product = TblProduct::create($validate);

            // Images Upload
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
                'success' => true,
                'message' => 'Product added successfully and is pending review.'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json([
                'success' => false,
                'errors'  => $e->errors()
            ], 422);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Failed to add product: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $product = TblProduct::with('images')
                        ->where('id', $id)
                        ->where('vendor_id', Auth::id())
                        ->firstOrFail();
            
            return response()->json([
                'success' => true,
                'product' => $product
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Product not found.'
            ], 404);
        }
    }

    public function update($request, $id)
    {
        try {
            $product = TblProduct::where('id', $id)
                        ->where('vendor_id', Auth::id())
                        ->firstOrFail();

            $validate = $request->validate([
                'name'              => 'required|string|max:150',
                'category_id'       => 'required|integer',
                'price'             => 'required|numeric|min:0',
                'discount_percent'  => 'nullable|numeric|min:0|max:100',
                'stock_quantity'    => 'nullable|integer|min:0',
                'SKU'               => 'nullable|string|max:100|unique:tbl_products,SKU,' . $id,
                'rating'            => 'nullable|numeric|min:0|max:5',
                'review_count'      => 'nullable|integer|min:0',
                'has_free_delivery' => 'nullable|boolean',
                'delivery_charge'   => 'nullable|numeric|min:0',
                'images.*'          => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            // Recalculate discount amount
            $discountPercent = $validate['discount_percent'] ?? $product->discount_percent ?? 0;
            $price = $validate['price'];
            $validate['discount_amount'] = $price * ($discountPercent / 100);

            // Update product
            $product->update($validate);

            // Upload new images
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
                'success' => true,
                'message' => 'Product updated successfully.'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json([
                'success' => false,
                'errors'  => $e->errors()
            ], 422);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Failed to update product: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $product = TblProduct::where('id', $id)
                        ->where('vendor_id', Auth::id())
                        ->firstOrFail();

            // Delete images
            $images = TblImage::where('product_id', $id)->get();

            foreach ($images as $image) {

                if (Storage::disk('public')->exists($image->image_path)) {
                    Storage::disk('public')->delete($image->image_path);
                }

                $image->delete();
            }

            $product->delete();

            return response()->json([
                'success' => true,
                'message' => 'Product deleted successfully.'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete product.'
            ], 500);
        }
    }

    public function deleteImage($id)
    {
        try {
            $image = TblImage::findOrFail($id);

            // ownership check
            $product = TblProduct::where('id', $image->product_id)
                        ->where('vendor_id', Auth::id())
                        ->first();

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized.'
                ], 403);
            }

            // delete actual image
            if (Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }

            $image->delete();

            return response()->json([
                'success' => true,
                'message' => 'Image deleted successfully.'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Unable to delete image.'
            ]);
        }
    }
}
