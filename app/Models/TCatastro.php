<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TCatastro extends Model
{
    protected $table='catastro';
	protected $primaryKey='idCat';
	public $incrementing=false;
	public $timestamps=false;

    protected $fillable = [
        'fechaEnc',
        'nombreEnc',
        'ficha',
        'u1',
        'u2',
        'u3',
        'u4',
        'u5',
        'u6',
        'd1',
        'd2',
        'd3',
        'd4',
        'd5',
        'd6',
        'd7',
        'd8',
        'd9',
        'd10',
        'd11',
        'd12',
        't1',
        't2',
        't3',
        't4',
        't5',
        't6',
        't7',
        't8',
        't9',
        't10',
        't11',
        't12',
        't13',
        'c1',
        'c2',
        'c3',
        'c4',
        'c5',
        'c6',
        'c7',
        'c8',
        'ci1',
        'ci2',
        'ci3',
        'ci4',
        'frontis',
        'agua',
        'alc',
        'ubicacion',
        'obs',
        'fr',
        'fa',

    ];
}
