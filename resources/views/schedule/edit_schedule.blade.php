@extends('layout')
@push('title')
<title>Sửa thời khóa biểu</title>
<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
@endpush
@section('main')
<div class="content">
    <div class="page-inner">
        <form action="{{ url('save-schedule',['id'=>$schedule->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-md-10 col-lg-10" style="margin: auto">
                <div class="form-group">
                    <label>Thứ</label>
                    <select name="rank" class="form-control">
                        <option hidden value="{{ $schedule->rank }}">
                            @if($schedule->rank == 'monday')
                                Thứ Hai
                            @elseif($schedule->rank == 'tuesday')
                                Thứ Ba
                            @elseif($schedule->rank == 'wednesday')
                                Thứ Tư
                            @elseif($schedule->rank == 'thursday')
                                Thứ Năm
                            @elseif($schedule->rank == 'friday')
                                Thứ Sáu
                            @elseif($schedule->rank == 'saturday')
                                Thứ Bẩy
                            @elseif($schedule->rank == 'sunday')
                                Chủ Nhật
                            @endif
                        </option>
                        <option value="monday">Thứ Hai</option>
                        <option value="tuesday">Thứ Ba</option>
                        <option value="wednesday">Thứ Tư</option>
                        <option value="thursday">Thứ Năm</option>
                        <option value="friday">Thứ Sáu</option>
                        <option value="saturday">Thứ Bẩy</option>
                        <option value="sunday">Chủ Nhật</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Ca</label>
                    <select name="id_shift" class="form-control">
                        @foreach($shifts as $shift)
                            <option hidden value="{{ $schedule->id_shift }}">
                                @if($schedule->shift->name == 'ca-sang')
                                    Ca Sáng
                                @elseif($schedule->shift->name == 'ca-chieu')
                                    Ca Chiều
                                @else
                                    Ca Tối
                                @endif
                            </option>
                            <option value="{{ $shift->id }}">
                                @if($shift->name =='ca-sang')
                                    Ca Sáng
                                @elseif($shift->name == 'ca-chieu')
                                    Ca Chiều
                                @else
                                    Ca Tối
                                @endif
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Môn</label>
                    <select name="id_subject" class="form-control">
                        @foreach($subjects as $subject)
                            <option hidden value="{{ $schedule->id_subject }}"> {{ $schedule->subject->name }} </option>
                            <option value="{{$subject->id}}">
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Danh sách học sinh</label>
                    <select class="js-select2" multiple="multiple" name="id_student[]">
                        @php
                            $studen = \App\Models\Student::whereIn('id',$schedule->id_student)->get();
                            $counts = 1;
                        @endphp
                        @foreach($students as $student)
                            <option value="{{ $student->id }}"
                                @if($counts < 2)
                                    @foreach($studen as $stu)
                                        @if($stu->name == $student->name)
                                        selected
                                        @endif
                                    @endforeach
                                    $counts = 2;
                                @endif>
                                {{ $student->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4" style="margin: auto; margin-top:20px">
                <a href="{{ url('save-shift',['id'=>$shift->id]) }}">
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
