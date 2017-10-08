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
        $invoices = Invoice::orderBy('created_at','desc')->paginate(15);

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
        $input = $request -> all();

        $customer = $input['customer'];
        $invoice = Invoice::create([
            
            'user_id' => Auth::user()->id,
            'customer' => $customer,

        ]);
        $items = $input['items_amount'];
        
        for($i = 0; $i <= $items; $i++){
            Item::create([
                
                'invoice_id' => $invoice->id,
                'name' => $input['name_'.$i],
                'amount' => $input['amount_'.$i],
                'unit' => $input['unit_'.$i],
                'price' => $input['price_'.$i],
                'vat' => $input['vat_'.$i],
                'vat_value' => $input['vat_value_'.$i],
                'net_value' => $input['net_value_'.$i],
                'gross_value' => $input['gross_value_'.$i],

            ]);
        }

        return redirect()->route('faktury.show',$invoice->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $faktury)
    {
        // change variable name, it looks better :p
        $invoice = $faktury;

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
