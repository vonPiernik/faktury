<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Invoice;

use App\Item;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Invoice::with('items')->orderBy('created_at','desc')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('faktury.create');
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
        // return $inputObj->id;
        $invoice = Invoice::updateOrCreate(
            [ 'id' => $input->id],
            $inputArr
        );
        $inputItemsIds = array_map(function($singleItem) {
            return $singleItem['id'];
        }, $inputArr['items']);


        Item::where('invoice_id', $invoice->id)->whereNotIn('id', $inputItemsIds)->delete();

        foreach($inputArr['items'] as &$k){
            $k['invoice_id'] = $invoice->id;
            Item::updateOrCreate(
                [ 'id' => $k['id'] ],
                $k
            );
        }

        return Invoice::with(array('items'=>function($query){
            $query->select('id','invoice_id');
        }))->select('id')->find($invoice->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Invoice::with("items")->find($id);      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, $id)
    {
        $inputArr = $request->all();
        $input = (object) $inputArr;
        // return $inputObj->id;
        $invoice = Invoice::updateOrCreate(
            [ 'id' => $input->id],
            $inputArr
        );
        $inputItemsIds = array_map(function($singleItem) {
            return $singleItem['id'];
        }, $inputArr['items']);


        Item::where('invoice_id', $invoice->id)->whereNotIn('id', $inputItemsIds)->delete();

        foreach($inputArr['items'] as &$k){
            $k['invoice_id'] = $invoice->id;
            Item::updateOrCreate(
                [ 'id' => $k['id'] ],
                $k
            );
        }

        return Invoice::with(array('items'=>function($query){
            $query->select('id','invoice_id');
        }))->select('id')->find($invoice->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invoice = Invoice::find($id);
        foreach($invoice->items as $item){
            $item->delete();
        }
        $invoice->delete();

        return $invoice->id;
    }
}
