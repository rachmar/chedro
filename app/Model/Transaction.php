<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function users()
   	{
    	return $this->belongsToMany('App\User', 'transaction_roles', 'transaction_id', 'user_id');
    }
  
}
