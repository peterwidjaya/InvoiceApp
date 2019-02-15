<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product; 

class ProductController extends Controller
{
    public function index()
    {
    	$products = Product::orderBy('created_at','DESC')->get(); //2
    	// CODE DIATAS SAMA DENGAN > select * from `products` order by `created_at` desc 
    	return view('products.index', compact('products')); // 3
    }

    public function create()
    {
        return view('products.create');
    }

     public function save(Request $request)
    {
        //MELAKUKAN VALIDASI DATA YANG DIKIRIM DARI FORM INPUTAN
        $this->validate($request, [
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'price' => 'required|integer',
            'stock' => 'required|integer'
        ]);

        try {
            //MENYIMPAN DATA KEDALAM DATABASE
            $product = Product::create([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock
            ]);
            
            //REDIRECT KEMBALI KE HALAMAN /PRODUCT DENGAN FLASH MESSAGE SUCCESS
            return redirect('/product')->with(['success' => '<strong>' . $product->title . '</strong> Telah disimpan']);
        } catch(\Exception $e) {
       
            return redirect('/product/new')->with(['error' => $e->getMessage()]);
        }
        }
        public function edit($id){
        	$product = Product::find($id);
        	return view('products.edit',compact('product'));
        }

        public function update(Request $request, $id){
        	$product = Product::find($id);
        	$product->update([
        		'title' => $request->title,
        		'description' => $request->description,
        		'price' => $request->price,
        		'stock' => $request->stock
        		]);
        		return redirect('/product')->with(['success' => '<strong>' . $product->title . '</strong> Diperbaharui']);
			}

		public function destroy($id){
		    $product = Product::find($id); 
		    $product->delete(); 
		    return redirect('/product')->with(['success' => '</strong>' . $product->title . '</strong> Dihapus']); // DIARAHKAN KEMBALI KEHALAMAN /product
		}
        
}
