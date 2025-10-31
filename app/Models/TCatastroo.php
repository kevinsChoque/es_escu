<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TCatastroo extends Model
{
    protected $table='catastroo';
	protected $primaryKey='idCao';
	public $incrementing=false;
	public $timestamps=false;

    protected $fillable = [
        'ins',
        'nombreEnc',
        'frontis',
        'obs',
        'fechaEnc',
    ];
}
