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

        Invoice::create([
            'user_id'=>1, 
            'customer' => "Klient",
        ]);
    }
}
