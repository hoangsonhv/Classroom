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
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Danh Sách Các Buổi Học</h4>
                            </div>
                        </div>
                        <div class="card-body">
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
                                            <th class="col-4" style="color: blue">Ca Học</th>
                                            <th class="col-4" style="color: blue">Số buổi</th>
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
                                                <td class="col-4">
                                                    @if($at->shift->name == 'ca-sang')
                                                        Ca Sáng
                                                    @elseif($at->shift->name == 'ca-chieu')
                                                        Ca Chiều
                                                    @elseif($at->shift->name == 'ca-toi')
                                                        Ca Tối
                                                    @endif
                                                </td>
                                                <td class="col-4"> {{ $attens1 }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>

                                    </table>

                                @endforeach
                                    <div class="col-md-2" style="margin: auto;padding: 10px;background-color: whitesmoke">
                                       <h3 style="padding-left: 5px;margin: 0"><span style="color: red">Tổng số buổi học:</span> <span style="color: blue">{{ $attens2 }}</span></h3>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
