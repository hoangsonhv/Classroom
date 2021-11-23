<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

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

//    public function login()
//    {
//        if (Auth::guard('auth')->check()) {
//            return redirect("/");
//        } else {
//            return redirect()->back();
//        }
//    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect("/");
        }
        return redirect()->back()->with('danger', 'Vui lòng kiểm tra lại Email hoặc Mật khẩu');
    }

}

