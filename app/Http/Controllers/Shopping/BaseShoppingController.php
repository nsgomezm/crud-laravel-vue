<?php

namespace App\Http\Controllers\Shopping;

use App\Models\Product;
use App\Models\Shopping;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShoppingRequest;

class BaseShoppingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Product $product, ShoppingRequest $request)
    {
        if($product->stock < $request->amount){
            return response()->json([
                'saved' => false,
                'message' => "No hay productos disponibles. Cantidad disponible $product->stock"
            ]);
        }

        $product->stock = $product->stock - $request->amount;
        $product->update();

        $shopping = new Shopping($request->toArray());

        return response()->json([
            'saved' => $shopping->save(),
            'shopping' => $shopping->load('product')
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Product $product, Shopping $shopping,  Request $request)
    {
        $product->stock = ( $product->stock + $shopping->amount) - $request->amount;

        if($product->stock < 0){
            return response()->json([
                'saved' => false,
                'message' => "No hay productos disponibles. Cantidad disponible $product->stock"
            ]);
        }

        $product->update();

        return response()->json([
            'saved' => $shopping->update($request->all()),
            'shopping' => $shopping

        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Shopping $shopping)
    {
        $product->stock = $product->stock + $shopping->amount;
        $product->update();

        return response()->json([
            'deleted' => $shopping->delete()
        ]);
    }
}
