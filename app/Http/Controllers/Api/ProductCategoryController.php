<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function all(Request $request) {
        $id = $request->input('id');
        $limit = $request->input('limit');
        $name = $request->input('name');
        $show_product = $request->input('show_product');

        // ambil data berdasarkan param
        if($id) {
            $category = ProductCategory::with('products')->find($id);
            if($category) {
                return ResponseFormatter::success(
                    $category,
                    'Data kategori berhasil diambil'
                ); 
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data kategori tidak ada',
                    404
                );
            }
        }

        $category = ProductCategory::query();
        //  Filter data dari params
        if($name) {
            $category->where('name', 'like', '%'.$name.'%');
        }

        if($show_product) {
            $category->with('products');
        }

        return ResponseFormatter::success(
            $category->paginate($limit), // paginatenya diambil dari parameter filter
            'Data kategori berhasil diambil'
        );
    }
}
