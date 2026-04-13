<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlumniTracer extends Model
{
    protected $primaryKey = 'alumni_tracer_no';
protected $table = 'alumni_tracer';

public function jawaban()
{
    return $this->hasMany(AlumniTracerKuesioner::class, 'alumni_tracer_no', 'alumni_tracer_no');
}
}
