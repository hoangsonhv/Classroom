<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Shift;
use App\Models\Student;
use Illuminate\Http\Request;
use MongoDB\Driver\Exception\Exception;

class StudentController extends Controller
{
    //    STUDENT

    public function ListStudent(){
        $students = Student::all();
        return view('student/list_student',[
            'students'=>$students,
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
        ]);
        try {
            Student::create([
                'name'=>$request->name,
                'address'=>$request->address,
                'phone'=>$request->phone,
                'phone_parent'=>$request->phone_parent,
                'link'=>$request->link,
                'note'=>$request->note,
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

        $schedules = Schedule::whereIn('id_student',["4","6"])->get();
        dd($schedules);
        return view('student/edit_student', [
            'student'=>$student,
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
            ]);
        }catch(\Exception $e){
            return back()->with('error',"Lỗi khi cập nhật");
        }
        return redirect("list-student")->with('success',"Cập nhật thành công");
    }

//    END STUDENT

}
