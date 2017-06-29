<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'user_id', 'bill_name', 'due_date', 'amount', 'pic_url','payment_option', 'status'
    ];
}
