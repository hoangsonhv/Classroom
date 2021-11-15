<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\Subject;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function ListShift(){
        $shifts = Shift::all();
        return view('shift/list_shift',[
            'shifts'=>$shifts,
        ]);
    }

    public function AddShift(Request $request){
        $request->validate([
            'name' => 'required',
        ],[
            "name.required"=>"Nhập ca học!",
        ]);
        try {
            Shift::create([
                'name'=>$request->name,
            ]);
        } catch (Exeption $e) {
            return back()->with('error',"Lỗi khi thêm mới");
        }

        return back()->with('success',"Thêm thành công !");
    }

    public function deleteShift($id){
        try {
            Shift::findOrFail($id)->delete();
        }catch (\Exception $e){
            return back()->with('error',"Không thể xóa.!");
        }
        return back()->with('success',"Xóa thành công.!");
    }

    public function editShift($id){
        $shift = Shift::findOrFail($id);
        return view('shift/edit_shift', [
            'shift'=>$shift,
        ]);
    }

    public function saveShift(Request $request,$id){
        dd($request);
        $request->validate([
            'name' => 'required',
        ]);
        try{
            $shift = Shift::findOrFail($id);
            $shift->update([
                'name'=>$request->name,
            ]);
        }catch(Exeption $e){
            return back()->with('error',"Lỗi khi cập nhật");
        }
        return redirect("list-shift")->with('success',"Cập nhật thành công");
    }
}
