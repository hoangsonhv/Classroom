<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{

//    SUBJECT

    public function ListSubject(){
        $subjects = Subject::all();
        return view('subject/list_subject',[
            'subjects'=>$subjects,
        ]);
    }

    public function AddSubject(Request $request){
        $request->validate([
            'name' => 'required',
        ],[
            "name.required"=>"Nhập tên môn học!",
        ]);
        try {
            Subject::create([
                'name'=>$request->name,
                'price'=>$request->price,
            ]);
        } catch (\Exception $e) {
            return back()->with('error',"Lỗi khi thêm mới");
        }

        return back()->with('success',"Thêm thành công !");
    }

    public function deleteSubject($id){
        try {
            Subject::findOrFail($id)->delete();
        }catch (\Exception $e){
            return back()->with('error',"Không thể xóa.!");
        }
        return back()->with('success',"Xóa thành công.!");
    }

    public function editSubject($id){
        $subject = Subject::findOrFail($id);
        return view('subject/edit_subject', [
            'subject'=>$subject,
        ]);
    }

    public function saveSubject(Request $request,$id){
        $request->validate([
            'name' => 'required',
        ]);
        try{
            $subject = Subject::findOrFail($id);
            $subject->update([
                'name'=>$request->name,
                'price'=>$request->price,
            ]);
        }catch(\Exception $e){
            return back()->with('error',"Lỗi khi cập nhật");
        }
        return redirect("list-subject")->with('success',"Cập nhật thành công");
    }

//    END SUBJECT

}
