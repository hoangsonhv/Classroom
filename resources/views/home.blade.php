@extends('layout')
@push('title')
<title>Trang chủ</title>
@endpush
@section('main')
<div class="content">
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">Lớp Học Toán Cô Phượng</h2>
                    <h5 class="text-white op-7 mb-2">Số 18 - Ngách 15/207 - Xuân Đỉnh - Bắc Từ Liêm - Hà Nội</h5>
                </div>
{{--                <div class="ml-md-auto py-2 py-md-0">--}}
{{--                    <a href="#" class="btn btn-white btn-border btn-round mr-2">Manage</a>--}}
{{--                    <a href="#" class="btn btn-secondary btn-round">Add Customer</a>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-6">
                <div class="card full-height">
                    <div class="card-body" style="text-align: center;display: flex">
                        <div class="col-md-4">
                            <i class="fas fa-user-graduate" style="font-size: 80px"></i>
                        </div>
                        <div class="col-md-8">
                            <div class="card-title">Tổng Số Học Sinh</div>
                            <div class="card-category"><span style="color: red">{{ count($student) }}</span> Học sinh đang theo học</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card full-height">
                    <div class="card-body" style="text-align: center;display: flex">
                        <div class="col-md-4">
                            <i class="fas fa-book-open" style="font-size: 80px"></i>
                        </div>
                        <div class="col-md-8">
                            <div class="card-title">Tổng Số Môn Học</div>
                            <div class="card-category"><span style="color: red">{{ count($subject) }}</span> Môn học đang giảng dạy</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
{{--        <div class="row">--}}
{{--            <div class="col-md-12">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">--}}
{{--                        <div class="d-flex align-items-center">--}}
{{--                            <h4 class="card-title" style="color: blue;font-weight: 600">Danh sách học phí </h4>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="table-responsive">--}}
{{--                            <table id="basic-datatables" class="display table table-striped table-hover table-bordered" >--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th>STT</th>--}}
{{--                                    <th>Họ và Tên</th>--}}
{{--                                    <th>Môn Học</th>--}}
{{--                                    <th>Ca</th>--}}
{{--                                    <th>Ngày</th>--}}
{{--                                    <th style="width: 10%">Thao tác</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                @foreach ($list_attendance as $list_atten)--}}
{{--                                    <tr>--}}
{{--                                        <td>{{ $list_atten->id }}</td>--}}
{{--                                        <td>{{ $list_atten->student->name }}</td>--}}
{{--                                        <td>{{ $list_atten->subject->name }}</td>--}}
{{--                                        <td>--}}
{{--                                            @if($list_atten->shift->name == 'ca-sang')--}}
{{--                                                Ca Sáng--}}
{{--                                            @elseif($list_atten->shift->name == 'ca-chieu')--}}
{{--                                                Ca Chiều--}}
{{--                                            @elseif($list_atten->shift->name == 'ca-toi')--}}
{{--                                                Ca Tối--}}
{{--                                            @endif--}}
{{--                                        </td>--}}
{{--                                        <td>{{ $list_atten->date }}</td>--}}
{{--                                        <td>--}}
{{--                                            <div class="form-button-action">--}}

{{--                                                <a href="{{ url('delete-attendance',['id'=>$list_atten->id]) }}">--}}
{{--                                                    <button onclick="return confirm('Xóa nhé !')" type="submit" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Xóa">--}}
{{--                                                        <i class="fa fa-times"></i>--}}
{{--                                                    </button>--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
</div>
@endsection
