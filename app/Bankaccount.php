<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bankaccount extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'institution_name', 'institution_id', 'account_id', 'account_name'
    ];
    
    public function users()
    {
        return $this->belongsTo('App\User');
    }
}
