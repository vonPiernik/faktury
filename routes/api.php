<?php

use Illuminate\Http\Request;

use App\Invoice;

use App\Item;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});




// get invoices
Route::get('invoices/first', function() {
    return Invoice::with("items")->orderBy('created_at','desc')->first();
});
//put invoices in db

Route::resource('invoices', 'InvoiceController' );


// Route::get('invoices/{id}', function($id) {
//     return Invoice::with("items")->find($id);
// });
 
// Route::get('invoices', function() {
//     return Invoice::with('items')->orderBy('created_at','desc')->get();
// });