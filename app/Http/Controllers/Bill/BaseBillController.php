<?php

namespace App\Http\Controllers\Bill;

use App\Models\Bill;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\BillRequest;
use App\Http\Controllers\Controller;

class BaseBillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getList()
    {
        return response()->json([
            'bills' => Bill::with('user', 'shoppings')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BillRequest $request)
    {
        $bill = new Bill($request->all());

        return response()->json([
            'saved' => $bill->save(),
            'bill' => $bill->load('user', 'shoppings')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {
        return response()->json([
            'bills' => $bill->load('user', 'shoppings.product')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $bill)
    {
        return response()->json([
            'deleted' => $bill->delete()
        ]);
    }
}
