<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Schedule;
use App\Models\Shift;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Tuition;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use MongoDB\Driver\Exception\Exception;
use Barryvdh\DomPDF\PDF;

class StudentController extends Controller
{
    //Danh sách HS

    public function ListStudent(){
        $students = Student::all();
        $subjects = Subject::all();
        return view('student/list_student',[
            'students'=>$students,
            'subjects'=>$subjects,
        ]);
    }

    public function AddStudent(Request $request){
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'phone_parent' => 'required',
            'note' => 'required',
            'link' => 'required',
            'id_subject' => 'required',
        ]);
        try {
            Student::create([
                'name'=>$request->name,
                'address'=>$request->address,
                'phone'=>$request->phone,
                'phone_parent'=>$request->phone_parent,
                'link'=>$request->link,
                'note'=>$request->note,
                'id_subject'=>$request->id_subject,
            ]);

        } catch (\Exception $e) {
            return back()->with('error',"Lỗi khi thêm mới");
        }
        return back()->with('success',"Thêm thành công !");
    }

    public function deleteStudent($id){
        try {
            Student::findOrFail($id)->delete();
        }catch (\Exception $e){
            return back()->with('error',"Không thể xóa.!");
        }
        return back()->with('success',"Xóa thành công.!");
    }

    public function editStudent($id){
        $student = Student::findOrFail($id);
        $subject = Subject::all();
        return view('student/edit_student', [
            'student'=>$student,
            'subject'=>$subject,
        ]);
    }

    public function saveStudent(Request $request,$id){
        $request->validate([
            'name' => 'required',
            'note' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'phone_parent' => 'required',
            'link' => 'required',
            'id_subject' => 'required',
        ]);
        try{
            $student = Student::findOrFail($id);
            $student->update([
                'name'=>$request->name,
                'note'=>$request->note,
                'address'=>$request->address,
                'phone'=>$request->phone,
                'link'=>$request->link,
                'phone_parent'=>$request->phone_parent,
                'id_subject'=>$request->id_subject,
            ]);
        }catch(\Exception $e){
            return back()->with('error',"Lỗi khi cập nhật");
        }
        return redirect("list-student")->with('success',"Cập nhật thành công");
    }

//

    //Danh sách Học phí

    public function TuitionStudent(Request $request){
        $currentmonth = new Carbon($request->thang);
        if ($request->thang){
            $months = $currentmonth->month;
            $startday = $currentmonth->startOfMonth()->toDateString();
            $endday = $currentmonth->endOfMonth()->toDateString();
        }else{
            $months = Carbon::now()->month;
            $startday = Carbon::now()->startOfMonth()->toDateString();
            $endday = Carbon::now()->endOfMonth()->toDateString();
        }
        $attendance = Attendance::with(['Shift','Subject','Student'])->groupBy('date')->get();
        $attendance1 = Attendance::with(['Shift','Subject','Student'])
            ->whereBetween('date',[$startday,$endday])
            ->groupBy('id_student')->get();
        $list_student = [];
        $list_student1 = [];
        foreach ($attendance as $atten){
            $list_student[] = $atten->id_student;
        }
        foreach ($attendance1 as $atten1){
            $list_student1[] = $atten1->id_student;
        }
        $students = Student::whereIn('id',$list_student)->get();
        $students1 = Student::whereIn('id',$list_student1)->get();
        $subjects = Subject::all();
        return view('student/list_student_tuition',[
            'students'=>$students,
            'students1'=>$students1,
            'subjects'=>$subjects,
            'months'=>$months,
            'startday'=>$startday,
            'endday'=>$endday,
            'attendance'=>$attendance,
            'attendance1'=>$attendance1,

        ]);
    }

    //Chi tiết học sinh + học phí

    public function DetailStudent($id,Request $request){
//        $months = Carbon::now()->month;
        $currentmonth = new Carbon($request->thang);
//        dd($request);
        if ($request->thang){
            $months = $currentmonth->month;
            $startday = $currentmonth->startOfMonth()->toDateString();
            $endday = $currentmonth->endOfMonth()->toDateString();
        }else{
            $months = Carbon::now()->month;
            $startday = Carbon::now()->startOfMonth()->toDateString();
            $endday = Carbon::now()->endOfMonth()->toDateString();
        }
        $tutions1 = Tuition::where('id_student',$id)->select('date')->get();

        $students = Student::findOrFail($id);
        $attendances = Attendance::with(['Shift','Subject','Student'])
            ->where('id_student',$students->id)
            ->groupBy('id_subject')
            ->get();

        $attendances1 = Attendance::with(['Shift','Subject','Student'])
            ->where('id_student',$students->id)
            ->whereBetween('date',[$startday,$endday])
            ->groupBy('id_subject')
            ->get();
        session(['id_st'=>$id]);
        session(['month'=>$currentmonth]);

        return view("student/detail_student",[
            'students'=>$students,
            'attendances'=>$attendances,
            'attendances1'=>$attendances1,
            'months'=>$months,
            'startday'=>$startday,
            'endday'=>$endday,
            'tutions1'=>$tutions1,

        ]);
    }
//    END STUDENT

}
