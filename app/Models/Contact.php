<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [ 'firstName', 'lastName', 'email', 'phone', 'birthday' ];
    protected $with = ['addresses'];
    
    public function addresses()
    {
        return $this->hasMany('App\Models\Address');
    }
}
