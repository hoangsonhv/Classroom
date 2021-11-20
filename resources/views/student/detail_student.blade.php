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
                                <h4 class="card-title" style="text-align: center;color: blue;text-transform: uppercase">BẢNG HỌC PHÍ {{ $students->name }}</h4>
                            </div>
                        </div>
                        <div class="card-body abc" style="display: flex">
                            <div class="col-md-6">
                                <h2 style="text-transform: uppercase ;text-align: center;font-size: 18px">Các Môn Đã Học</h2>
                                <div class="table-responsive">
                                    @foreach($attendances as $atten)
                                        @php
                                            $attens = \App\Models\Attendance::with(['Shift','Subject','Student'])
                                                ->where('id_student',$atten->id_student)
                                                ->where('id_subject',$atten->id_subject)
                                                ->groupBy('date')
                                                ->get();
                                            $attens2 = \App\Models\Attendance::with(['Shift','Subject','Student'])
                                                ->where('id_student',$atten->id_student)
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
                                        <h3 style="margin: 0 auto;text-overflow: clip;text-align: center;padding: 5% "><span style="color: red">Học phí tháng {{ $months }}:</span><span style="color: blue"> {{ number_format($attens2 * 1000000) }} đ</span></h3>
                                    </div>
                                    <div class="col-md-12" style="padding: 0">
                                        <a href="{{ url("pdf") }}"><button class="btn btn-danger" style="width: 100%">IN HỌC PHÍ</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
