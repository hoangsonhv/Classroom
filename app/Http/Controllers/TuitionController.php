<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;

class TuitionController extends Controller
{
    public function ListTuition(){
        $students = Student::where('id',1)->first();
        $attendances = Attendance::get()
            ->groupBy('id_subject')->pluck('date','id_subject');

        dd($attendances);
    }
}
