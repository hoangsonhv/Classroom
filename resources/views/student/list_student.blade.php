@extends('layout')
@push('title')
    <title>Danh sách học sinh</title>
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
                                                            <label>Môn Học</label>
                                                            @if($subjects->first() != null)
                                                                <select class="js-select2" multiple="multiple" name="id_subject[]" data-placeholder="Chọn môn học">
                                                                    @foreach($subjects as $subject)
                                                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            @else
                                                                <span class="form-control">Chưa có môn học nào</span>
                                                            @endif
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
                                        <th>Họ và Tên</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ</th>
                                        <th>Link FB</th>
                                        <th>SĐT Phụ huynh</th>
                                        <th style="min-width: 85px">Các Môn Theo Học</th>
                                        <th>Ghi chú</th>
                                        <th style="width: 10%">Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($students as $student)
                                        @php
                                            $subject = \App\Models\Subject::whereIn('id',$student->id_subject)->get();
                                            $list_name = [];
                                            foreach($subject as $sub){
                                                $list_name[] = $sub->name;
                                            }
                                        @endphp
                                        <tr>
                                            <td style="line-height: 1.2"><a href="{{ url("detail-student",['id'=>$student->id]) }}" style="text-decoration: none">{{ $student->name }}</a></td>
                                            <td>{{ $student->phone }}</td>
                                            <td>{{ $student->address }}</td>
                                            <td style="line-height: 1.2;max-width: 150px;text-overflow: clip;"><a href="{{ $student->link }}">{{ $student->link }}</a></td>
                                            <td>{{ $student->phone_parent }}</td>
                                            <td>{!! implode($list_name, " <br>" ) !!}</td>
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
