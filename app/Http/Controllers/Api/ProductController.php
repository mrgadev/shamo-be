<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

use function Livewire\of;

class ProductController extends Controller
{
    public function all(Request $request) {
        $id = $request->input('id');
        $limit = $request->input('limit');
        $name = $request->input('name');
        $description = $request->input('description');
        
        $tags = $request->input('tags');
        $categories = $request->input('categories');
        $price_from = $request->input('price_from');
        $price_to = $request->input('price_to');

        // ambil data berdasarkan param
        if($id) {
            $product = Product::with(['product_category', 'galleries'])->find($id);
            if($product) {
                return ResponseFormatter::success(
                    $product,
                    'Data produk berhasil diambil'
                ); 
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data produk tidak ada',
                    404
                );
            }
        }

        $product = Product::with(['product_category','galleries']);
        //  Filter data dari params
        if($name) {
            $product->where('name', 'like', '%'.$name.'%');
        }

        
        if($description) {
            $product->where('description', 'like', '%'.$description.'%');
        }

        if($tags) {
            $product->where('tags', 'like', '%'.$tags.'%');
        }

        if($price_from) {
            $product->where('price', '>=', $price_from);
        }

        if($price_to) {
            $product->where('price', '<=', $price_to);
        }

        if($categories) {
            $product->where('product_categories_id', $categories);
        }

        return ResponseFormatter::success(
            $product->paginate($limit), // paginatenya diambil dari parameter filter
            'Data produk berhasil diambil'
        );
    }
}
