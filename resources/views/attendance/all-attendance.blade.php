@extends('layout')
@push('title')
    <title>Danh sách điểm danh</title>
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
                        <span>Bảng điểm danh</span>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title" style="color: blue;font-weight: 600">Danh sách các học sinh đã điểm danh</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover table-bordered" >
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Họ và Tên</th>
                                            <th>Môn Học</th>
                                            <th>Ca</th>
                                            <th>Ngày</th>
                                            <th style="width: 10%">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($attendances as $attendance)
                                        <tr>
                                            <td>{{ $attendance->id }}</td>
                                            <td>{{ $attendance->student->name }}</td>
                                            <td>{{ $attendance->subject->name }}</td>
                                            <td>
                                                @if($attendance->shift->name == 'ca-sang')
                                                    Ca Sáng
                                                @elseif($attendance->shift->name == 'ca-chieu')
                                                    Ca Chiều
                                                @elseif($attendance->shift->name == 'ca-toi')
                                                    Ca Tối
                                                @endif
                                            </td>
                                            <td>{{ $attendance->date }}</td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="{{ url('edit-attendance',['id'=>$attendance->id]) }}">
                                                        <button type="submit" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Sửa">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ url('delete-attendance',['id'=>$attendance->id]) }}">
                                                        <button onclick="return confirm('Xóa nhé !')" type="submit" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Xóa">
                                                            <i class="fa fa-times"></i>
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
