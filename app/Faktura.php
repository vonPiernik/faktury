<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faktura extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'faktury';

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'Y-m-d';

}
