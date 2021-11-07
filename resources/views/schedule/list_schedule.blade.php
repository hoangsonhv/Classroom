@extends('layout')
@push('title')
<title>Thời khóa biểu</title>
<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />

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
                        <span>Thời khóa biểu</span>
                    </li>

                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Thời khóa biểu</h4>
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
                                                    Thêm Mới</span>
                                                </h5>
                                            </div>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('add-schedule') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-group-default">
                                                            <label>Thứ</label>
                                                            <input name="rank" type="text" class="form-control" placeholder="Nhập thứ" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-group-default">
                                                            <label>Ca</label>
                                                            <select name="id_shift" class="form-control">
                                                                @foreach($shifts as $shift)
                                                                    <option value="{{$shift->id}}">
                                                                        {{ $shift->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-group-default">
                                                            <label>Môn</label>
                                                            <select name="id_subject" class="form-control">
                                                                @foreach($subjects as $subject)
                                                                    <option value="{{$subject->id}}">
                                                                        {{ $subject->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Danh sách học sinh</label>
                                                            <select class="js-select2" multiple="multiple" name="id_student[]">
                                                                @foreach($students as $student)
                                                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                                                                @endforeach
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
                                <table id="add-row" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Ngày - Thứ</th>
                                            <th>Ca Học</th>
                                            <th>Môn Học</th>
                                            <th>DS Học Sinh</th>
                                            <th style="width: 10%">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($schedules as $schedule)
                                            @php
                                                $studen = \App\Models\Student::whereIn('id',$schedule->id_student)->get();
                                            @endphp
{{--                                            @dd($studen->first()->name)--}}
                                            <tr>
                                                <td>{{ $schedule->id }}</td>
                                                <td>{{ $schedule->rank }}</td>
                                                <td>{{ $schedule->shift->name }}</td>
                                                <td>{{ $schedule->subject->name }}</td>
                                                <td>
                                                    @foreach($studen as $stu)
                                                        {{ $stu->name }} &emsp;
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="{{ url('edit-shift',['id'=>$schedule->id]) }}">
                                                            <button type="submit" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Sửa">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                        </a>

                                                        <a href="{{ url('delete-shift',['id'=>$schedule->id]) }}">
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
@push('js')
    <script src="{{asset("https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js")}}"></script>
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
