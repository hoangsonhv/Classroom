<?php

namespace App\Http\Controllers;

//use Barryvdh\DomPDF\PDF;
use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use PDF;

class pdfController extends Controller
{

    public function index()
    {
        $months = Carbon::now()->month;
        $students = Student::findOrFail(session()->get('id_st'));
        $attendances = Attendance::with(['Shift','Subject','Student'])
            ->where('id_student',$students->id)
            ->groupBy('id_subject')
            ->get();
//        $pdf = \App::make('invoice.pdf');
        $pdf = PDF::loadView('student/invoice', [
            'months'=>$months,
            'students'=>$students,
            'attendances'=>$attendances,
        ]);

        return $pdf->download('invoice.pdf');
    }

}
