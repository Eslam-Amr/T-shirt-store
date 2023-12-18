<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Designer extends Authenticatable
{
    use HasFactory;
    protected $table='users';
static function boot(){
    parent::boot();
    static::addGlobalScope('designer',function(Builder $bulder){
        $bulder->where('role','designer');
    });
}
}
