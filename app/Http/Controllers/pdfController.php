<?php

namespace App\Http\Controllers;

//use Barryvdh\DomPDF\PDF;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Tuition;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use PDF;

class pdfController extends Controller
{
    // In hóa đơn
    public function index(Request $request)
    {
//        $months = Carbon::now()->month;
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
//        $startday = Carbon::now()->startOfMonth()->toDateString();
//        $endday = Carbon::now()->endOfMonth()->toDateString();
        $students = Student::findOrFail(session()->get('id_st'));
        $attendances = Attendance::with(['Shift','Subject','Student'])
            ->where('id_student',$students->id)
            ->whereBetween('date',[$startday,$endday])
            ->groupBy('id_subject')
            ->get();
//        $pdf = \App::make('invoice.pdf');
        $pdf = PDF::loadView('student/invoice', [
            'months'=>$months,
            'students'=>$students,
            'attendances'=>$attendances,
        ]);

        return $pdf->stream('invoice.pdf');
    }

    // Xác nhận đóng học phí
    public function AddTuition($id,Request $request){
//        $months = Carbon::now()->month;
        $currentmonth = session()->get('month');
        if (session()->get('month')){
            $months = $currentmonth->month;
        }else{
            $months = Carbon::now()->month;
        }
//        dd($months);
        $tutions = Tuition::where('id_student',$id)->get();
//        dd($tutions);
        $counts = 0;
        $arr = [];
        if ($tutions->first()){
            foreach ($tutions as $tuition){
                $arr[] = $tuition->date;
            }
            if (in_array($currentmonth->startOfMonth()->toDateString(),$arr)){
                return redirect()->back()->with("success","Đã thanh toán học phí trong tháng");
            }else{
                if (session()->get('month')){
                    Tuition::create([
                        'date'=>$currentmonth->startOfMonth()->toDateString(),
                        'id_student'=>session()->get('id_st'),
                    ]);
                    return redirect()->back()->with("success","Xác nhận nộp học phí thành công!");
                }else{
                    Tuition::create([
                        'date'=>Carbon::now()->toDateString(),
                        'id_student'=>session()->get('id_st'),
                    ]);
                    return redirect()->back()->with("success","Xác nhận nộp học phí thành công!");
                }
            }
        }else{
            if (session()->get('month')){
                Tuition::create([
                    'date'=>$currentmonth->startOfMonth()->toDateString(),
                    'id_student'=>session()->get('id_st'),
                ]);
                return redirect()->back()->with("success","Xác nhận nộp học phí thành công!");
            }else{
                Tuition::create([
                    'date'=>Carbon::now()->toDateString(),
                    'id_student'=>session()->get('id_st'),
                ]);
                return redirect()->back()->with("success","Xác nhận nộp học phí thành công!");
            }
        }
    }

}
