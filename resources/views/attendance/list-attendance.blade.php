@extends('layout')
@push('title')
    <title>Điểm danh</title>
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
                        <span>Điểm danh</span>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title" style="color: blue;font-weight: 600">Chọn ngày và ca học</h4>
                            </div>
                        </div>
                        <div class="container" style="padding: 0">
                            <div class="search-attendance">
                                <div class="row">
                                    <form action="{{ url('list-attendance') }}" method="get" enctype="multipart/form-data" style="margin: auto">
                                        @csrf
                                        <div class="form-group">
                                            <label style="width: 75px;">Chọn Ngày : </label>
                                            <input type="date" style="height: 40px;width: 155px" name="time" required>
                                        </div>
                                        <div class="form-group">
                                            <label style="width: 75px">Chọn Ca : </label>
                                            <select name="shift" required style="height: 40px;width: 155px">
                                                @foreach($shifts as $shift)
                                                    <option hidden>-- Chọn Ca --</option>
                                                    <option value="{{ $shift->name }}">
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
                                            <label style="width: 75px;">Chọn Môn : </label>
                                            <select name="subject" required style="height: 40px;width: 155px">
                                                @foreach($subject as $sub)
                                                    <option hidden>-- Chọn Môn --</option>
                                                    <option value="{{ $sub->id }}">
                                                       {{ $sub->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-danger" style="height: 40px;width: 100%" type="submit">Tìm Kiếm</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
