@extends('layout')
@push('title')
    <title>Chỉnh sửa học sinh</title>

@section('main')
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
                    <label>Ghi chú</label>
                    <textarea name="note" cols="129" rows="8">{{ $student->note }}</textarea>
{{--                    <input name="note" type="text" value="{{ $student->note }}" class="form-control" required>--}}
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

