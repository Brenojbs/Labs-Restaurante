<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'data'
    ];

}
