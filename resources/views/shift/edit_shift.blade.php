@extends('layout')
@section('main')
<div class="content">
    <div class="page-inner">
        <form action="{{ url('save-shift',['id'=>$shift->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-md-10 col-lg-10" style="margin: auto">
                <div class="form-group">
                    <label>Tên Ca Học</label>
                    <select name="name" style="width: 100%;border: none">
                        <option hidden>@if($shift->name == 'ca-sang') Ca Sáng @elseif($shift->name == 'ca-chieu') Ca Chiều @else Ca Tối @endif</option>
                        <option value="ca-sang">Ca Sáng</option>
                        <option value="ca-chieu">Ca Chiều</option>
                        <option value="ca-toi">Ca Tối</option>
                    </select>
{{--                    <input name="name" value="@if($shift->name == 'ca-sang') Ca Sáng @elseif($shift->name == 'ca-chieu') Ca Chiều @else Ca Tối @endif" type="text" class="form-control" required>--}}
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
