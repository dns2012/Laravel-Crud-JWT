<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $hiddden = [
        'created_at',
        'updated_at'
    ];
}
