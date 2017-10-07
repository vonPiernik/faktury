<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_id',
        'name',
        'amount',
        'unit',
        'price',
        'vat',
        'vat_value',
        'net_value',
        'gross_value'
    ];



    /**
     * Get owner of this invoice
     */
    public function owner()
    {
        return $this->belongsTo('App\Invoice');
    }

}
