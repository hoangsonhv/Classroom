<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\Student;

class WebController extends Controller
{
    public function Home(){
        $student = Student::all();
        $subject = Subject::all();
        return view('home',[
            'student'=>$student,
            'subject'=>$subject,
        ]);
    }

}

