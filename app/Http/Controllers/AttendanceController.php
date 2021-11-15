<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Schedule;
use App\Models\Shift;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Carbon\Carbon;
use function GuzzleHttp\Promise\all;

class AttendanceController extends Controller
{
    public function allAttendance(){
        $attendances = Attendance::all();
        return view('attendance/all-attendance',[
            'attendances'=>$attendances
        ]);
    }

    public function Attendance(){
        $shifts = Shift::all();
        $subject = Subject::all();
        return view("attendance/list-attendance",[
            'shifts'=>$shifts,
            'subject'=>$subject,
        ]);
    }

    public function ListAttendance(Request $request){
        $students = null;
        $shifts = Shift::where('name',$request->shift)->first();
        $subject = Subject::where('id',$request->subject)->first();
        // danh sách hs điểm danh trong ngày
        $list_attendance = Attendance::with(['Shift','Subject','Student'])
            ->where('date',Carbon::now()->toDateString())
            ->where('id_shift',$shifts->id)
            ->where('id_subject',$subject->id)
            ->get();
        // lấy thứ
        $date = Carbon::parse($request->time);
        $dayName = $date->getTranslatedDayName();

        // lấy id hs
        $schedules = Schedule::with(['Shift','Subject'])
            ->where('rank',$dayName)
            ->where('id_shift',$shifts->id)
            ->where('id_subject',$subject->id)
            ->get();

        $id_student = null;
        if ($schedules->first() != null){
            foreach ($schedules as $schedule){
                $id_student = $schedule->id_student;
            }

        // lấy hs
            $students = Student::whereIn('id',$id_student)->get();
        }
        // lấy data điểm danh
        $data = $request->except("_token");
        session(['data_atten'=>$subject]);
        session(['data_atten1'=>$shifts]);
        session(['data_request'=>$data]);
        return view("attendance/attendance",[
            'students'=>$students,
            'list_attendance'=>$list_attendance,

        ]);
    }

    public function Attendances($id, Request $request){
        $attendances = Attendance::insert([
            'date'=>Carbon::now()->toDateString(),
            'id_shift'=>session()->get('data_atten1')['id'],
            'id_subject'=>session()->get('data_atten')['id'],
            'id_student'=>$id,
        ]);
        return redirect()->back()->with('success','Điểm danh thành công!');
    }

    public function deleteAttendance($id){
        try {
            Attendance::findOrFail($id)->delete();
        }catch (\Exception $e){
            return back()->with('error',"Không thể xóa.!");
        }
        return back()->with('success',"Xóa thành công.!");
    }

    public function editAttendance($id){
        $shifts = Shift::all();
        $subjects = Subject::all();
        $students = Student::all();
        $attendances = Attendance::with(['Shift','Subject','Student'])->findOrFail($id);
        return view("attendance/edit_attendance",[
            'attendances'=>$attendances,
            'shifts'=>$shifts,
            'students'=>$students,
            'subjects'=>$subjects,
        ]);
    }

    public function saveAttendance($id,Request $request){
        try{
            $attendances = Attendance::findOrFail($id);
            $attendances->update([
                'date'=>$request->date,
                'id_shift'=>$request->id_shift,
                'id_subject'=>$request->id_subject,
                'id_student'=>$request->id_student,
            ]);
        }catch(\Exception $e){
            return back()->with('error',"Lỗi khi cập nhật");
        }
        return redirect("all-attendance")->with('success',"Cập nhật thành công");
    }
}
