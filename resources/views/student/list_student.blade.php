@extends('layout')
@push('title')
    <title>Danh sách học sinh</title>

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
                        <span>Danh sách học sinh</span>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Danh Sách</h4>
                                <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                                    <i class="fa fa-plus"></i>
                                    Thêm Mới
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal -->
                            <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header no-bd">
                                            <div class="text-modal">
                                                <h5 class="modal-title">
                                                    <span class="fw-mediumbold" style="text-align: center;font-size:18px;margin-left: 20px">
                                                    Thêm Học Sinh</span>
                                                </h5>
                                            </div>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('add-student') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-group-default">
                                                            <label>Họ và tên</label>
                                                            <input name="name" id="addName" type="text" class="form-control" placeholder="Nhập họ tên" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-default">
                                                            <label>Số điện thoại</label>
                                                            <input name="phone" id="addOffice" type="number" class="form-control" placeholder="Nhập SĐT" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Địa chỉ</label>
                                                            <input name="address" id="addOffice" type="text" class="form-control" placeholder="Nhập địa chỉ" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-default" >
                                                            <label>Link FaceBook</label>
                                                            <input name="link" type="text" class="form-control" placeholder="Nhập Link FB">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-default">
                                                            <label>Số điện thoại phụ huynh</label>
                                                            <input name="phone_parent" type="number" class="form-control" placeholder="Nhập SĐT phụ huynh" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Ghi chú</label>
                                                            <textarea name="note"  rows="5" style="width: 100%;border: none"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer no-bd">
                                                    <button type="submit" class="btn btn-primary">Thêm</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover" >
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Họ và Tên</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ</th>
                                        <th>Link FB</th>
                                        <th>Số điện thoại phụ huynh</th>
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
                                            <td><a href="{{ $student->link }}">{{ $student->link }}</a></td>
                                            <td>{{ $student->phone_parent }}</td>
                                            <td style="color: red">{{ $student->note }}</td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="{{ url('edit-student',['id'=>$student->id]) }}">
                                                        <button type="submit" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Sửa">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ url('delete-student',['id'=>$student->id]) }}">
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
