<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;

class Invoice extends Model
{
	/*

		Returns only invoices that belongs to current user

	*/
	public function scopeBelongToCurrentUser($query){
		return $query->where('user_id', Auth::user()->id );
	}
}
