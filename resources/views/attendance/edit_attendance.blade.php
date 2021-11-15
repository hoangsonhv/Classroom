@extends('layout')
@push('title')
    <title>Sửa bảng điểm danh</title>
@section('main')
<div class="content">
    <div class="page-inner">
        <form action="{{ url('save-attendance',['id'=>$attendances->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-md-10 col-lg-4" style="margin: auto">
                <div class="form-group">
                    <label>Họ Và Tên</label>
                    <br>
                    <select name="id_student" style="width: 100%;height: 44px;border-radius: 5px">
                        @foreach($students as $student)
                            <option hidden value="{{ $attendances->id_student }}">{{ $attendances->student->name }}</option>
                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Môn Học</label>
                    <br>
                    <select name="id_subject" style="width: 100%;height: 44px;border-radius: 5px">
                        @foreach($subjects as $subject)
                            <option hidden value="{{ $attendances->id_subject }}">{{ $attendances->subject->name }}</option>
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Ca Học</label>
                    <br>
                    <select name="id_shift" style="width: 100%;height: 44px;border-radius: 5px">
                        @foreach($shifts as $shift)
                            <option hidden value="{{ $attendances->id_shift }}">
                                @if($attendances->shift->name == 'ca-sang')
                                    Ca Sáng
                                @elseif($attendances->shift->name == 'ca-chieu')
                                    Ca Chiều
                                @elseif($attendances->shift->name == 'ca-toi')
                                    Ca Tối
                                @endif
                            </option>
                            <option value="{{ $shift->id }}">
                                @if($shift->name == 'ca-sang')
                                    Ca Sáng
                                @elseif($shift->name == 'ca-chieu')
                                    Ca Chiều
                                @elseif($shift->name == 'ca-toi')
                                    Ca Tối
                                @endif
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Ngày</label>
                    <input name="date" value="{{ $attendances->date }}" type="date" class="form-control" style="width: 100%;border-color: black;" required>
                </div>
                <div class="form-group">
                    <a href="{{ url('save-student',['id'=>$attendances->id]) }}">
                        <button class="btn btn-danger" style="width:100%" type="submit">Cập nhật</button>
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

