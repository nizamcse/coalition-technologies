<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProducts(){
        $data = file_get_contents('public/products.json');
        $products = json_decode($data, true);
        $total = 0;
        foreach ($products['products'] as $product){
            $total += $product['total_price'];
        }

        return view('products')->with([
            'products'  => $products['products'],
            'total'  => $total,
        ]);
    }

    public function getProduct($id){
        $data = file_get_contents('public/products.json');
        $products = json_decode($data, true);
        $product = $products["products"][$id];
        return $product;
    }


    public function store(Request $request){


        $product = [
            'name'  => $request->input('name'),
            'quantity'  => $request->input('quantity'),
            'price_per_qty' => $request->input('price_per_qty'),
            'total_price'   => $request->input('quantity')*$request->input('price_per_qty')
        ];

        $data = file_get_contents('public/products.json');
        $products = json_decode($data, true);

        $products['products'][] = $product;
        $products['products'] = array_values($products['products']);
        file_put_contents("public/products.json", json_encode($products));

        $message = [
            'status' => true,
            'text' => 'Successfully created this information'
        ];

        return redirect()->back()->with('message', $message);
    }

    public function update(Request $request, $id){
        $data = file_get_contents('public/products.json');
        $products = json_decode($data, true);
        unset($products["products"][$id]);

        $product = [
            'name'  => $request->input('name'),
            'quantity'  => $request->input('quantity'),
            'price_per_qty' => $request->input('price_per_qty'),
            'total_price'   => $request->input('quantity')*$request->input('price_per_qty')
        ];
        $products["products"][$id] = $product;

        $products['products'] = array_values($products['products']);
        file_put_contents("public/products.json", json_encode($products));

        $message = [
            'status' => true,
            'text' => 'Successfully updated this information'
        ];

        return redirect()->back()->with('message', $message);
    }

    public function delete($id){
        $data = file_get_contents('public/products.json');
        $products = json_decode($data, true);
        unset($products["products"][$id]);

        $products['products'] = array_values($products['products']);
        file_put_contents("public/products.json", json_encode($products));

        $message = [
            'status' => true,
            'text' => 'Successfully deleted this information'
        ];

        return redirect()->back()->with('message', $message);
    }
}
