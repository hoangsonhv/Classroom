@extends('layout')
@push('title')
    <title>Chi tiết học sinh {{ $students->name }}</title>
@endpush

@section('main')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="{{url('/')}}">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <span>Chi tiết học sinh <span style="color: blue;text-transform: uppercase">{{ $students->name }}</span></span>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class=" align-items-center">
                                <h4 class="card-title" style="text-align: center;color: blue;text-transform: uppercase">BẢNG HỌC PHÍ THÁNG {{ $months }}</h4>
                                <div class="fillter">
                                    <form action="" method="get">
                                        <select name="thang" style="padding: 5px">
                                            <option hidden>-- Chọn tháng--</option>
                                            <option value="January">Tháng 1</option>
                                            <option value="February">Tháng 2</option>
                                            <option value="March">Tháng 3</option>
                                            <option value="April">Tháng 4</option>
                                            <option value="May">Tháng 5</option>
                                            <option value="June">Tháng 6</option>
                                            <option value="July">Tháng 7</option>
                                            <option value="August">Tháng 8</option>
                                            <option value="September">Tháng 9</option>
                                            <option value="October">Tháng 10</option>
                                            <option value="November">Tháng 11</option>
                                            <option value="December">Tháng 12</option>
                                        </select>
                                        <button class="btn btn-danger" type="submit" style="padding: 4px 15px;margin-bottom: 2px">Tìm</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body abc" style="display: flex">
                            @if($attendances1->first() != null)
                                <div class="col-md-6">
                                    <h2 style="text-transform: uppercase ;text-align: center;font-size: 18px">Các Môn Đã Học</h2>
                                    <div class="table-responsive">

                                        @foreach($attendances1 as $atten)
                                            @php
                                                $attens = \App\Models\Attendance::with(['Shift','Subject','Student'])
                                                    ->where('id_student',$atten->id_student)
                                                    ->where('id_subject',$atten->id_subject)
                                                     ->whereBetween('date',[$startday,$endday])
                                                    ->groupBy('date')
                                                    ->get();
                                                $attens2 = \App\Models\Attendance::with(['Shift','Subject','Student'])
                                                    ->where('id_student',$atten->id_student)
                                                     ->whereBetween('date',[$startday,$endday])
                                                    ->count('id_subject');
                                            @endphp
                                            <table class="display table-bordered table  table-hover" style="border-top: 1px solid black;">
                                                <thead style="text-align: center">
                                                <tr>
                                                    <th class="col-4" style="color: blue">{{ $atten->subject->name }}</th>
                                                    <th class="col-4" style="color: blue">Số ca học</th>
                                                </tr>
                                                </thead>
                                                <tbody style="text-align: center">
                                                @foreach($attens as $at)
                                                    @php
                                                        $attens1 = \App\Models\Attendance::with(['Shift','Subject','Student'])
                                                        ->where('id_student',$at->id_student)
                                                        ->where('id_subject',$at->id_subject)
                                                        ->where('date',$at->date)
                                                        ->count('id_subject');
                                                    @endphp
                                                    <tr>
                                                        <td class="col-4">{{ $at->date }}</td>
                                                        <td class="col-4"> {{ $attens1 }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-6" >
                                    <div>
                                        <h2 style="text-transform: uppercase ;text-align: center;font-size: 18px">Học phí</h2>
                                    </div>
                                    <div>
                                        <div class="col-md-12 tuition">
                                            <h3 style="margin: 0 auto;text-align: center;padding: 5%"><span style="color: red">Tổng số ca học:</span> <span style="color: blue">{{ $attens2 }}</span></h3>
                                        </div>
                                        <div class="col-md-12 tuition">
                                            <h3 style="margin: 0 auto;text-overflow: clip;text-align: center;padding: 5% "><span style="color: red">Học phí tháng {{ $months }}:</span><span style="color: blue"> {{ number_format($attens2 * 100000) }} đ</span></h3>
                                        </div>
                                        <div class="col-md-12" style="display: flex;padding: 0">
                                            <div class="col-md-6" style="padding-left: 0;padding-right: 5px">
                                                <a href="{{ url("pdf") }}" target="_blank"><button class="btn btn-danger" style="width: 100%">IN HỌC PHÍ</button></a>
                                            </div>
                                            <div class="col-md-6" style="padding-right: 0;padding-left: 5px">
                                                <form action="{{ url("tuitions",['id'=>session()->get('id_st')]) }}" method="post">
                                                    @csrf
                                                    @if($tutions1->first())
                                                        @php
                                                            $arr = [];
                                                            $currentmonth = session()->get('month');
                                                        @endphp
                                                        @foreach($tutions1 as $tuition)
                                                            @php
                                                                $arr[] = $tuition->date;
                                                            @endphp
                                                        @endforeach
                                                        @if( in_array($currentmonth->startOfMonth()->toDateString(),$arr))
                                                            <button  class="btn btn-primary" type="button" style="width: 100%">ĐÃ NỘP HỌC PHÍ</button>
                                                        @else
                                                            <button onclick="return confirm('Xác nhận học sinh đã nộp học phí')" class="btn btn-danger" type="submit" style="width: 100%">XÁC NHẬN NỘP HỌC PHÍ</button>
                                                        @endif
                                                    @else
                                                        <button onclick="return confirm('Xác nhận học sinh đã nộp học phí')" class="btn btn-danger" type="submit" style="width: 100%">XÁC NHẬN ĐÃ NỘP HỌC PHÍ</button>
                                                    @endif
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <p style="text-align: center;margin:auto;font-size: 18px">Học sinh chưa học buổi nào</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class=" align-items-center">
                                <h4 class="card-title" style="text-align: center;color: blue;text-transform: uppercase">DANH SÁCH CÁC MÔN & NGÀY ĐÃ HỌC</h4>
                            </div>
                        </div>
                        <div class="card-body abc">
                            <div class="col-md-12">

                                @if($attendances->first() != null)
                                    <h2 style="text-transform: uppercase ;text-align: center;font-size: 18px">Các Môn Đã Học</h2>
                                    <div class="table-responsive">
                                        @foreach($attendances as $atten)
                                            @php
                                                $attens = \App\Models\Attendance::with(['Shift','Subject','Student'])
                                                    ->where('id_student',$atten->id_student)
                                                    ->where('id_subject',$atten->id_subject)
                                                    ->groupBy('date')
                                                    ->get();
                                            @endphp
                                            <table class="display table-bordered table table-hover" style="border-top: 1px solid black;">
                                                <thead style="text-align: center">
                                                <tr>
                                                    <th class="col-4" style="color: blue">{{ $atten->subject->name }}</th>
                                                    <th class="col-4" style="color: blue">Số ca học</th>
                                                </tr>
                                                </thead>
                                                <tbody style="text-align: center">
                                                @foreach($attens as $at)
                                                    @php
                                                        $attens1 = \App\Models\Attendance::with(['Shift','Subject','Student'])
                                                        ->where('id_student',$at->id_student)
                                                        ->where('id_subject',$at->id_subject)
                                                        ->where('date',$at->date)
                                                        ->count('id_subject');
                                                    @endphp
                                                    <tr>
                                                        <td class="col-4">{{ $at->date }}</td>
                                                        <td class="col-4"> {{ $attens1 }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        @endforeach
                                    </div>
                                @else
                                    <p style="text-align: center;margin:auto;font-size: 18px">Học sinh chưa học buổi nào</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
