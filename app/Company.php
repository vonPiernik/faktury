<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * Get owner of this company
     */
    public function owner()
    {
        return $this->belongsTo('App\User');
    }
}
