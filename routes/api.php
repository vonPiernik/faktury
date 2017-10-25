<?php

use Illuminate\Http\Request;

use App\Invoice;

use App\Item;

use App\User;

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

$routes = array(
    'invoices' => 'InvoiceController',
    'products' => 'ProductController',
    'customers' => 'CustomerController',
);

foreach ($routes as $key => $controller)
{
	if($key == 'invoices'){
	    Route::get("users/{user_id}/$key/deleted", array('uses' => "$controller@trash"));

	    Route::put("users/{user_id}/$key/{id}/restore", array('uses' => "$controller@restore"));
	}
	
    Route::resource("users/{user_id}/$key", $controller);
}


// Route::get('invoices/{id}', function($id) {
//     return Invoice::with("items")->find($id);
// });
 
// Route::get('invoices', function() {
//     return Invoice::with('items')->orderBy('created_at','desc')->get();
// });