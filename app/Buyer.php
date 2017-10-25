<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{

    protected $fillable = [
    	'invoice_id',
        'name',
        'adress',
        'nip',
        'code',
    ];


    /**
     * Get owner of this buyer
     */
    public function owner()
    {
        return $this->belongsTo('App\Invoice');
    }
}
