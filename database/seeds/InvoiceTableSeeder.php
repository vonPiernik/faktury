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
        for($i=1; $i<=25; $i++){
	        $title = "Faktura dla Przedszkola nr".$i;
	        Invoice::create(['user_id'=>$i%2, 'title' => $title]);
    	}
    }
}
