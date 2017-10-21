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

    public static function insertAll(array $items)
    {
        $now = \Carbon\Carbon::now();
        $items = collect($items)->map(function (array $data) use ($now) {
            return $this->timestamps ? array_merge([
                'created_at' => $now,
                'updated_at' => $now,
            ], $data) : $data;
        })->all();

        return \DB::table(static::table())->insert($items);
    }

    /**
     * Get owner of this invoice
     */
    public function owner()
    {
        return $this->belongsTo('App\Invoice');
    }

}
