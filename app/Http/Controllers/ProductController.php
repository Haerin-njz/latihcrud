<?php

namespace App\Http\Controllers;
use App\Models\Product; 
use Illuminate\Support\Facades\Validator;// Model user

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addProduct(Request $request)
    {
        // Validasi data akun dari request post
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'stock' => 'required|integer',
            'price' => 'required|string',
        ]);
    
        // Respon jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Produk gagal dibuat',
                'errors' => $validator->errors()
            ], 422); 
        } else {
            // Menyimpan data akun
            $product = new Product;
            $product->name = $request->name;
            $product->stock = $request->stock;
            $product->price = $request->price;
            $product->Save();

            // Respon jika pembuatan data akun baru berhasil
            return response()->json([
                'message' => 'Product berhasil ditambahkan',
            ], 201);
        }
    }
}
