@extends('layout')
@push('title')
    <title>Điểm danh</title>
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
                        <span>Điểm danh trong ngày</span>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title" style="color: blue;font-weight: 600">Danh sách học sinh</h4>
                            </div>
                        </div>
                        @if($students != null)
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover" >
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Họ và Tên</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ</th>
                                        <th style="max-width: 150px">Link FB</th>
                                        <th>SĐT Phụ huynh</th>
                                        <th>Ghi chú</th>
                                        <th style="width: 10%">Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $student->id }}</td>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->phone }}</td>
                                            <td>{{ $student->address }}</td>
                                            <td style="text-overflow: clip;max-width: 150px;line-height: 1.2"><a href="{{ $student->link }}">{{ $student->link }}</a></td>
                                            <td>{{ $student->phone_parent }}</td>
                                            <td style="color: red">{{ $student->note }}</td>
                                            <td>
                                                Điểm danh
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="status-atten">
                                <h3 style="text-align: center;margin-top: 20px">Không có học sinh nào</h3>
                            </div>
                        @endif
                        <hr>
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title" style="color: blue;font-weight: 600">Danh sách học sinh đã điểm danh</h4>
                            </div>
                        </div>
{{--                        <div class="table-responsive" style="margin-top: 15px;margin-bottom: 20px">--}}
{{--                            <table class="display table table-striped table-hover" >--}}
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
{{--                                @foreach ($attendances as $attendance)--}}
{{--                                    <tr>--}}
{{--                                        <td>{{ $attendance->id }}</td>--}}
{{--                                        <td>{{ $attendance->student->name }}</td>--}}
{{--                                        <td>{{ $attendance->subject->name }}</td>--}}
{{--                                        <td>{{ $attendance->shift->name }}</td>--}}
{{--                                        <td>{{ $attendance->date }}</td>--}}
{{--                                        <td>--}}
{{--                                            <div class="form-button-action">--}}
{{--                                                <a href="{{ url('edit-student',['id'=>$attendance->id]) }}">--}}
{{--                                                    <button type="submit" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Sửa">--}}
{{--                                                        <i class="fa fa-edit"></i>--}}
{{--                                                    </button>--}}
{{--                                                </a>--}}
{{--                                                <a href="{{ url('delete-student',['id'=>$attendance->id]) }}">--}}
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
