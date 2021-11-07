@extends('layout')
@section('main')
<div class="content">
    <div class="page-inner">
        <form action="{{ url('save-subject',['id'=>$subject->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-md-10 col-lg-10" style="margin: auto">
                <div class="form-group">
                    <label>Tên Môn Học</label>
                    <input name="name" value="{{ $subject->name }}" type="text" class="form-control" required>
                </div>

            </div>
            <div class="col-md-4" style="margin: auto; margin-top:20px">
                <a href="{{ url('save-student',['id'=>$subject->id]) }}">
                    <button class="btn btn-danger" style="width:100%" type="submit">Cập nhật</button>
                </a>

            </div>
        </form>
    </div>
</div>
@endsection
