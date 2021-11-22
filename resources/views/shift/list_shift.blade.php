@extends('layout')
@push('title')
<title>Danh sách ca học</title>
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
                        <span>Danh sách Ca Học</span>
                    </li>

                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Danh Sách</h4>
                                <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal2">
                                    <i class="fa fa-plus"></i>
                                    Thêm Mới
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal -->
                            <div class="modal fade" id="addRowModal2" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header no-bd">
                                            <div class="text-modal">
                                                <h5 class="modal-title">
                                                    <span class="fw-mediumbold" style="text-align: center;font-size:18px">
                                                    Thêm Ca Học</span>
                                                </h5>
                                            </div>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('add-shift') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Tên Ca Học</label>
{{--                                                            <input name="name" type="text" class="form-control" placeholder="Nhập tên" required>--}}
                                                            <select name="name" style="width: 100%;border: none">
                                                                <option hidden>--Chọn ca--</option>
                                                                <option value="ca-sang">Ca Sáng</option>
                                                                <option value="ca-chieu">Ca Chiều</option>
                                                                <option value="ca-toi">Ca Tối</option>
                                                            </select>
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
                                <table id="add-row" class="display table table-bordered table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Ca Học</th>
                                            <th style="width: 10%">Thao tác</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($shifts as $shift)
                                            <tr>
                                                <td>{{ $shift->id }}</td>
                                                <td>
                                                    @if($shift->name == 'ca-sang')
                                                        Ca Sáng
                                                    @elseif($shift->name == 'ca-chieu')
                                                        Ca Chiều
                                                    @else
                                                        Ca Tối
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="form-button-action">
{{--                                                        <a href="{{ url('edit-shift',['id'=>$shift->id]) }}">--}}
{{--                                                            <button type="submit" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Sửa">--}}
{{--                                                                <i class="fa fa-edit"></i>--}}
{{--                                                            </button>--}}
{{--                                                        </a>--}}

                                                        <a href="{{ url('delete-shift',['id'=>$shift->id]) }}">
                                                            <button style="margin-top: 4px" onclick="return confirm('Xóa nhé !')" type="submit" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Xóa">
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
