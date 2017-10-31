<?php

namespace App\Http\Controllers;

use DB;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $user_id)
    {
        $input = $request->all();

        if(isset($input['fields'])){
            return Product::where('user_id', $user_id)
                                    ->select(DB::raw($input['fields']))
                                    ->orderBy('created_at','desc')
                                    ->get();
        } else {
             return Product::where('user_id', $user_id)
                                    ->orderBy('created_at','desc')
                                    ->get();           
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputArr = $request->all();
        $input = (object) $inputArr;
        $product = Product::updateOrCreate(
            [ 'id' => $input->id],
            $inputArr
        );

        return Product::find($product->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($user_id, $id)
    {
        return Product::where('user_id', $user_id)->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id, $id)
    {
        $inputArr = $request->all();
        $input = (object) $inputArr;
        $product = Product::updateOrCreate(
            [ 'id' => $input->id],
            $inputArr
        );

        return Product::find($product->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id,$id)
    {
        $invoice = Product::find($id)->delete();

        return $id;
    }
}
