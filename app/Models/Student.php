<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public $table = "students";

    public $fillable = ['id','name','phone','address','link','phone_parent','note','id_subject'];

    protected $casts = [
        'id_subject' => 'array'
    ];

}

