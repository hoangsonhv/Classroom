<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Shift;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function ListSchedule(){
        $schedules = Schedule::with(['Shift','Subject'])->get();
//        $id_student = [];
//        foreach ($schedules as $schedu){
//            $id_student[] = $schedu->id_student;
//        }
        $students = Student::all();
        $subjects = Subject::all();
        $shifts = Shift::all();
        return view('schedule/list_schedule',[
            'schedules'=>$schedules,
            'students'=>$students,
            'subjects'=>$subjects,
            'shifts'=>$shifts,
//            'id_student'=>$id_student,
        ]);
    }

    public function AddSchedule(Request $request){
//        dd($request->id_student);
        $request->validate([
            'rank' => 'required',
            'id_shift' => 'required',
            'id_subject' => 'required',
            'id_student' => 'required',
        ]);
        try {
            Schedule::create([
                'rank'=>$request->rank,
                'id_shift'=>$request->id_shift,
                'id_subject'=>$request->id_subject,
                'id_student'=>$request->id_student,
            ]);

        } catch (\Exception $e) {
            return back()->with('error',"Lỗi khi thêm mới");
        }

        return back()->with('success',"Thêm thành công !");
    }

    public function deleteSchedule($id){
        try {
            Schedule::findOrFail($id)->delete();
        }catch (\Exception $e){
            return back()->with('error',"Không thể xóa.!");
        }
        return back()->with('success',"Xóa thành công.!");
    }

    public function editSchedule($id){
        $schedule = Schedule::findOrFail($id);
        $students = Student::all();
        $subjects = Subject::all();
        $shifts = Shift::all();
//        $studen = Student::whereIn('id',$schedule->id_student)->get();
//        $list_name = [];
//        foreach ($studen as $stu){
//            $list_name[] = $stu->name;
//        }
//        dd($list_name);
        return view('schedule/edit_schedule', [
            'schedule'=>$schedule,
            'students'=>$students,
            'subjects'=>$subjects,
            'shifts'=>$shifts,
//            'list_name'=>$list_name,
        ]);
    }

    public function saveSchedule(Request $request,$id){
        $request->validate([
            'rank' => 'required',
            'id_shift' => 'required',
            'id_subject' => 'required',
            'id_student' => 'required',
        ]);
        try{
            $schedule = Schedule::findOrFail($id);
            $schedule->update([
                'rank'=>$request->rank,
                'id_shift'=>$request->id_shift,
                'id_subject'=>$request->id_subject,
                'id_student'=>$request->id_student,
            ]);
        }catch(\Exception $e){
            return back()->with('error',"Lỗi khi cập nhật");
        }
        return redirect("list-schedule")->with('success',"Cập nhật thành công");
    }
}
