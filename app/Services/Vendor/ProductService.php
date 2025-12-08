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
        
        $data = [
            'pageTitle' => 'Products',
            'subTitle' => 'Manage Your Products',
            'products' => $products,
            'categories' => $categories
        ];
        
        return view('vendor.product.listing')->with($data);
    }

    public function store($request)
    {
        try {
            $userId = Auth::id();
            
            $validate = $request->validate([
                'name'           => 'required|string|max:150',
                'category_id'    => 'required|integer',
                'price'          => 'required|numeric',
                'stock_quantity' => 'nullable|integer|min:0',
                'SKU'            => 'nullable|string|max:100|unique:tbl_products,SKU',
                'images.*'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
            
            $validate['vendor_id'] = $userId;
            $validate['status'] = 'pending_review';
            
            $product = TblProduct::create($validate);
            
            // Handle Image Upload (Same as Admin)
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
                'errors' => $e->errors()
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
            $userId = Auth::id();
            $product = TblProduct::with('images')
                        ->where('id', $id)
                        ->where('vendor_id', $userId)
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
            $userId = Auth::id();
            $product = TblProduct::where('id', $id)
                        ->where('vendor_id', $userId)
                        ->firstOrFail();
            
            $validate = $request->validate([
                'name'           => 'required|string|max:150',
                'category_id'    => 'required|integer',
                'price'          => 'required|numeric',
                'stock_quantity' => 'nullable|integer|min:0',
                'SKU'            => 'nullable|string|max:100|unique:tbl_products,SKU,' . $id,
                'images.*'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
            
            $product->update($validate);
            
            // Handle New Image Upload (Same as Admin)
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
                'errors' => $e->errors()
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
            $userId = Auth::id();
            $product = TblProduct::where('id', $id)
                        ->where('vendor_id', $userId)
                        ->firstOrFail();
            
            $images = TblImage::where('product_id', $product->id)->get();
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
                'message' => 'Failed to delete product: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteImage($id)
    {
        try {
            $image = TblImage::findOrFail($id);
            
            // Verify the image belongs to a product owned by this vendor
            $product = TblProduct::where('id', $image->product_id)
                        ->where('vendor_id', Auth::id())
                        ->first();
            
            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized access.'
                ], 403);
            }
            
            // Delete file from storage
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
            ], 500);
        }
    }
}