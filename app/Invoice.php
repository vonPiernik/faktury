<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

use Auth;

class Invoice extends Model
{

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer', 'user_id', 'draft','net_value', 'gross_value'
    ];



	/*

		Returns only invoices that belongs to current user

	*/
	protected static function boot()
    {
        parent::boot();
        if(Auth::id()){
            static::addGlobalScope('belongsToCurrentUser', function (Builder $builder) {
                    $builder->where('user_id', Auth::id());
            });
        }
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

    /**
     * Get buyer belonging to this invoice
     */
    public function buyer()
    {
        return $this->hasOne('App\Buer');
    }


    /**
     * Get company belonging to this invoice
     */
    public function company()
    {
        return $this->hasOne('App\Company');
    }
}
