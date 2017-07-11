<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillImage extends Model
{
    protected $fillable = ['bill_id', 'filename'];

    public function bill()
    {
        return $this->belongsTo('App\Bill');
    }
}
