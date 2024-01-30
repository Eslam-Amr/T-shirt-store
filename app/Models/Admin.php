<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    // use HasFactory;
    use HasApiTokens, HasFactory, Notifiable,HasUuids;
    // protected $keyType = 'string';
    // public $incrementing = false;


    protected $table='users';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'id';

protected static function boot(){
    parent::boot();
    static::addGlobalScope('admin',function(Builder $bulder){
        $bulder->where('role','admin');
    });
}
}
