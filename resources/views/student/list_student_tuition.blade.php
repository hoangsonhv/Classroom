@extends('layout')
@push('title')
    <title>Danh sách học phí tháng {{ $months }}</title>
@endpush
@push('link')
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container--default .select2-selection--multiple{
            border: none;
            padding-left: 0;
        }
        .select2-container--default.select2-container--focus .select2-selection--multiple{
            border: none;
        }
    </style>
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
                        <span>Danh sách học phí</span>
                    </li>
                </ul>
            </div>

{{--            danh sách đóng học phí tron tháng--}}

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <div class="col-md-6">
                                    <h4 class="card-title">DANH SÁCH HỌC SINH ĐÓNG HỌC PHÍ THÁNG {{ $months }}</h4>
                                </div>
                                <div class="col-md-6" style="text-align: right">
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
                        <div class="card-body">
                            <div class="table-responsive">
                                @if($students1->first())
                                    <table id="add-row" class="display table-bordered table table-striped table-hover" >
                                        <thead>
                                        <tr style="text-align: center">
                                            <th>Họ và Tên</th>
                                            <th>Số điện thoại</th>
                                            <th>Link FB</th>
                                            <th>SĐT Phụ huynh</th>
                                            <th>Trạng thái</th>
                                            <th style="width: 10%">Chi tiết</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $total = 0;
                                            $total1 = 0;
                                        @endphp
                                        @foreach ($students1 as $student)
                                            @php
                                                $tuition = \App\Models\Tuition::where('id_student',$student->id)->get();
                                                $attens2 = \App\Models\Attendance::with(['Shift','Subject','Student'])
                                                        ->where('id_student',$student->id)
                                                         ->whereBetween('date',[$startday,$endday])
                                                        ->count('id_subject');
                                                $total = $total +  $attens2 * 100000 ;
                                                $arr = [];
                                                foreach($tuition as $tuit){
                                                    $arr[] = $tuit->date;
                                                }
                                            @endphp
                                            <tr style="text-align: center">
                                                <td style="line-height: 1.2"><a href="{{ url("detail-student",['id'=>$student->id]) }}" style="text-decoration: none">{{ $student->name }}</a></td>
                                                <td>{{ $student->phone }}</td>
                                                <td style="line-height: 1.2;max-width: 150px;text-overflow: clip;"><a href="{{ $student->link }}">{{ $student->link }}</a></td>
                                                <td>{{ $student->phone_parent }}</td>
                                                <td>
                                                    @if(in_array($startday,$arr))
                                                        @php
                                                            $total1 = $total1 +  $attens2 * 100000 ;
                                                        @endphp
                                                        <span style="color: blue"> Đã nộp học phí tháng {{ $months }}</span>
                                                    @else
                                                        Chưa nộp học phí tháng {{ $months }}
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="{{ url("detail-student",['id'=>$student->id]) }}">
                                                            <button type="submit" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Chi tiết">
                                                                <i class="fas fa-info-circle"></i>
                                                            </button>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td style="text-align: center;font-size: 18px" colspan="6">Tổng số tiền ước tính: <span style="color: red">{{ number_format($total) }}</span> đ. &emsp; Tổng số tiền đã nộp: <span style="color: red">{{ number_format($total1) }}</span> đ. &emsp;Tổng số tiền chưa nộp: <span style="color: red">{{ number_format($total  - $total1) }}</span> đ</td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                @else
                                    <p style="text-align: center;font-size: 18px">Không có học sinh nào !</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

{{--            danh sách chưa đóng học phí--}}

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title" style="text-transform: uppercase">Danh Sách Học Sinh Chưa Đóng Học Phí</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table id="basic-datatables" class="display table-bordered table table-striped table-hover" >
                                    <thead>
                                    <tr style="text-align: center">
                                        <th>Họ và Tên</th>
                                        <th>Số điện thoại</th>
                                        <th>Link FB</th>
                                        <th>SĐT phụ huynh</th>
                                        <th>Tháng chưa nộp học phí</th>
                                        <th style="width: 10%">Chi tiết</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($students as $student1)
                                        @php
                                            $attendance = \App\Models\Attendance::with(['Shift','Subject','Student'])->where('id_student',$student1->id)->get();
                                            $list_month = [];
                                            foreach ($attendance as $attend){
                                                $tuitions = \App\Models\Tuition::where('date',\Illuminate\Support\Carbon::parse($attend->date)->startOfMonth()->toDateString())
                                                ->where('id_student',$attend->id_student)->first();
                                                if ($tuitions == null){
                                                    if (!in_array( \Illuminate\Support\Carbon::parse($attend->date)->month,$list_month)){
                                                        $list_month[] = \Illuminate\Support\Carbon::parse($attend->date)->month;
                                                    }
                                                }
                                            }
                                        @endphp

                                        <tr style="text-align: center">
                                            <td style="line-height: 1.2"><a href="{{ url("detail-student",['id'=>$student1->id]) }}" style="text-decoration: none">{{ $student1->name }}</a></td>
                                            <td>{{ $student1->phone }}</td>
                                            <td style="line-height: 1.2;max-width: 150px;text-overflow: clip;"><a href="{{ $student1->link }}">{{ $student1->link }}</a></td>
                                            <td>{{ $student1->phone_parent }}</td>
                                            <td>
                                                {{ implode(' , ',$list_month) }}
                                            </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="{{ url("detail-student",['id'=>$student1->id]) }}">
                                                        <button type="submit" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Chi tiết">
                                                            <i class="fas fa-info-circle"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    {{--    <script src="{{asset("https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js")}}"></script>--}}
    <script src="{{asset("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js")}}" ></script>
    <script src="{{asset("https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js")}}"></script>
    <script>
        $(".js-select2").select2({
            closeOnSelect : false,
            placeholder : "Placeholder",
            allowHtml: true,
            allowClear: true,
            tags: true // создает новые опции на лету
        });
        $('.icons_select2').select2({
            width: "100%",
            templateSelection: iformat,
            templateResult: iformat,
            allowHtml: true,
            placeholder: "Placeholder",
            dropdownParent: $( '.select-icon' ),//обавили класс
            allowClear: true,
            multiple: false
        });
        function iformat(icon, badge,) {
            var originalOption = icon.element;
            var originalOptionBadge = $(originalOption).data('badge');

            return $('<span><i class="fa ' + $(originalOption).data('icon') + '"></i> ' + icon.text + '<span class="badge">' + originalOptionBadge + '</span></span>');
        }
    </script>

@endpush
