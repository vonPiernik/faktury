<?php

use Illuminate\Database\Seeder;

use App\Invoice;

class InvoiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('invoices')->delete();


        // generuje 25 faktur na różnych klientów
        for($i=1; $i<=25; $i++){

            $nr = rand(1,30);

	        $customer = "Przedszkole nr".$nr;

	        Invoice::create(['user_id'=>$i%2, 'customer' => $customer]);
    	}
    }
}
