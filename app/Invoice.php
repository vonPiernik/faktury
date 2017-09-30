<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

use Auth;

class Invoice extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer', 'user_id'
    ];



	/*

		Returns only invoices that belongs to current user

	*/
	protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('belongsToCurrentUser', function (Builder $builder) {
            $builder->where('user_id', Auth::user()->id);
        });
    }


    /**
     * Get owner of this invoice
     */
    public function owner()
    {
        return $this->belongsTo('App\User');
    }


    /**
     * Get items belonging to this invoice
     */
    public function items()
    {
        return $this->hasMany('App\Item');
    }
}
