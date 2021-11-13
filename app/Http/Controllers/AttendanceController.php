<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Schedule;
use App\Models\Shift;
use App\Models\Student;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    //
    public function Attendance(){
//        dd($request);
        $shifts = Shift::all();
        $attendances = Attendance::with(['Shift','Subject','Student'])
            ->get();
        return view("attendance/list-attendance",[
            'shifts'=>$shifts,
            'attendances'=>$attendances,
        ]);
    }

    public function ListAttendance(Request $request){
        $students = null;
        $shifts = Shift::where('name',$request->shift)->first();
//        dd($shifts->id);
//        lấy thứ
        $date = Carbon::parse($request->time);
        $dayName = $date->getTranslatedDayName();
//        lấy id hs
        $schedules = Schedule::with(['Shift','Subject'])
            ->where('rank',$dayName)
            ->where('id_shift',$shifts->id)
            ->get();
//        dd($schedules);
        $id_student = null;
        if ($schedules->first() != null){
            foreach ($schedules as $schedule){
                $id_student = $schedule->id_student;
            }

//        lấy hs
            $students = Student::whereIn('id',$id_student)->get();
        }

        return view("attendance/attendance",[
            'students'=>$students,
        ]);
    }
}
