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
        $invoices = Invoice::all();

        return view('faktury.index', compact('invoices'));
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
        $customer = $request->query('customer','Łoś super ktoś');
        $invoice = Invoice::create([
            
            'user_id' => Auth::user()->id,
            'customer' => $customer,

        ]);

        Item::create([
            
            'invoice_id' => $invoice->id,
            'name' => $request->query('name','Jakiś element'),
            'amount' => $request->query('amount', 1),
            'unit' => $request->query('unit','szt.'),
            'price' => $request->query('price', 1),
            'net_value' => $request->query('net_value', 1),
            'gross_value' => $request->query('name', 1),

        ]);

        return redirect()->route('faktury.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::find($id);

        return view('faktury.show', compact('invoice',$invoice));        
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
