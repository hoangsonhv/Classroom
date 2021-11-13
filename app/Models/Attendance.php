<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    public $table = "attendances";

    public $fillable = ['id','date','id_shift','id_subject','id_student'];

//    protected $casts = [
//        'id_student' => 'array'
//    ];

    public function Shift(){
        return $this->belongsTo(Shift::class,'id_shift','id');
    }

    public function Subject(){
        return $this->belongsTo(Subject::class,'id_subject','id');
    }

    public function Student(){
        return $this->belongsTo(Student::class,'id_student','id');
    }
}
