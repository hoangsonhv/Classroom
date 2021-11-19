@extends('layout')
@push('title')
    <title>Chỉnh sửa học sinh</title>
@section('main')
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
<div class="content">
    <div class="page-inner">
        <form action="{{ url('save-student',['id'=>$student->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-md-10 col-lg-10" style="margin: auto">
                <div class="form-group">
                    <label>Họ và tên</label>
                    <input name="name" value="{{ $student->name }}" type="text" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input name="phone" value="{{ $student->phone }}" type="number" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <input name="address" value="{{ $student->address }}" type="text" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Link FB</label>
                    <input name="link" type="text" value="{{ $student->link }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>SĐT phụ huynh</label>
                    <input name="phone_parent" type="number" value="{{ $student->phone_parent }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Môn Học</label>
                    <select class="js-select2" multiple="multiple" name="id_subject[]">
                        @php
                            $subjects = \App\Models\Subject::whereIn('id',$student->id_subject)->get();
                            $counts = 1;
                        @endphp
                        @foreach($subject as $sub)
                            <option value="{{ $sub->id }}"
                                @if($counts < 2)
                                    @foreach($subjects as $stu)
                                        @if($stu->name == $sub->name)
                                            selected
                                        @endif
                                    @endforeach
                                    $counts = 2;
                                @endif>
                                {{ $sub->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Ghi chú</label>
                    <textarea name="note" cols="129" rows="8">{{ $student->note }}</textarea>
                </div>
            </div>
            <div class="col-md-4" style="margin: auto; margin-top:20px">
                <a href="{{ url('save-student',['id'=>$student->id]) }}">
                    <button class="btn btn-danger" style="width:100%" type="submit">Cập nhật</button>
                </a>

            </div>
        </form>
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

