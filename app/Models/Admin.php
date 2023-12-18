<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;
    protected $table='users';
static function boot(){
    parent::boot();
    static::addGlobalScope('admin',function(Builder $bulder){
        $bulder->where('role','admin');
    });
}
}
