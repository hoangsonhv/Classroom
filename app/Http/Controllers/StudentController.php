<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Schedule;
use App\Models\Shift;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use MongoDB\Driver\Exception\Exception;
use Barryvdh\DomPDF\PDF;

class StudentController extends Controller
{
    //    STUDENT

    public function ListStudent(){
        $students = Student::all();
        $subjects = Subject::all();
        return view('student/list_student',[
            'students'=>$students,
            'subjects'=>$subjects,
        ]);
    }

    public function AddStudent(Request $request){
//        dd($request);
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
//        dd($subject);
        return view('student/edit_student', [
            'student'=>$student,
            'subject'=>$subject,
        ]);
    }

    public function saveStudent(Request $request,$id){
//        dd($request);
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

    public function DetailStudent($id){
        $months = Carbon::now()->month;
        $students = Student::findOrFail($id);
        $attendances = Attendance::with(['Shift','Subject','Student'])
            ->where('id_student',$students->id)
            ->groupBy('id_subject')
            ->get();
//        dd($attendances);
        session([
            'id_st'=>$id,
//            'data_month'=>$months,
//            'data_students'=>$students,
//            'data_$attendances'=>$attendances,
        ]);

        return view("student/detail_student",[
            'students'=>$students,
            'attendances'=>$attendances,
            'months'=>$months,
        ]);
    }
//    END STUDENT

}
