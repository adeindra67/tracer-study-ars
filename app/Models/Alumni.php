<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $primaryKey = 'alumni_no';
protected $table = 'alumni';

// Relasi: Satu Alumni bisa punya banyak catatan Tracer
public function tracers()
{
    return $this->hasMany(AlumniTracer::class, 'alumni_no', 'alumni_no');
}
}
