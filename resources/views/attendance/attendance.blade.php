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
                        <span>Điểm danh trong ngày</span>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @if($list_attendance->first() != null)
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title" style="color: blue;font-weight: 600">Danh sách học sinh đã điểm danh</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="basic-datatables" class="display table table-striped table-hover table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Họ và Tên</th>
                                                <th>Môn Học</th>
                                                <th>Ca</th>
                                                <th>Ngày</th>
                                                <th style="width: 10%">Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($list_attendance as $list_atten)
                                            <tr>
                                                <td>{{ $list_atten->id }}</td>
                                                <td>{{ $list_atten->student->name }}</td>
                                                <td>{{ $list_atten->subject->name }}</td>
                                                <td>
                                                    @if($list_atten->shift->name == 'ca-sang')
                                                        Ca Sáng
                                                    @elseif($list_atten->shift->name == 'ca-chieu')
                                                        Ca Chiều
                                                    @elseif($list_atten->shift->name == 'ca-toi')
                                                        Ca Tối
                                                    @endif
                                                </td>
                                                <td>{{ $list_atten->date }}</td>
                                                <td>
                                                    <div class="form-button-action">

                                                        <a href="{{ url('delete-attendance',['id'=>$list_atten->id]) }}">
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
                        @endif
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title" style="color: blue;font-weight: 600">Danh sách điểm danh</h4>
                            </div>
                        </div>
                       <div class="card-body">
                           @if($students != null)
                               <div class="table-responsive" style="margin-top: 20px;margin-bottom: 20px">
                                   <table id="add-row" class="display table table-striped table-hover table-bordered" >
                                       <thead>
                                       <tr>
                                           <th>ID HS</th>
                                           <th>Họ và Tên</th>
                                           <th>Môn Học</th>
                                           <th>Ca Học</th>
                                           <th>Số điện thoại</th>
                                           <th>Địa chỉ</th>
                                           <th style="max-width: 150px">Link FB</th>
                                           <th>SĐT Phụ huynh</th>
                                           <th>Ghi chú</th>
                                           <th style="width: 10%">Thao tác</th>
                                       </tr>
                                       </thead>
                                       <tbody>
                                       @foreach ($students as $student)
                                           <tr>
                                               <td>{{ $student->id }}</td>
                                               <td>{{ $student->name }}</td>
                                               <td>{{ session()->get('data_atten')['name'] }}</td>
                                               <td>
                                                   @if(session()->get('data_atten1')['name'] == 'ca-sang')
                                                       Ca Sáng
                                                   @elseif(session()->get('data_atten1')['name'] == 'ca-chieu')
                                                       Ca Chiều
                                                   @elseif(session()->get('data_atten1')['name'] == 'ca-toi')
                                                       Ca Tối
                                                   @endif
                                               </td>
                                               <td>{{ $student->phone }}</td>
                                               <td>{{ $student->address }}</td>
                                               <td style="text-overflow: clip;max-width: 150px;line-height: 1.2"><a href="{{ $student->link }}">{{ $student->link }}</a></td>
                                               <td>{{ $student->phone_parent }}</td>
                                               <td >{{ $student->note }}</td>
                                               <td>
                                                   <form action="{{ url('attendances',['id'=>$student->id]) }}" enctype="multipart/form-data" method="post">
                                                       @csrf
                                                       <a href="{{ url('attendances',['id'=>$student->id]) }}" style="text-decoration: none">
                                                           <button type="submit" data-toggle="tooltip" title="" class="btn btn-link" style="font-weight: 600;color: red">ĐIỂM DANH</button>
                                                       </a>
                                                   </form>
                                               </td>
                                           </tr>
                                       @endforeach
                                       </tbody>
                                   </table>
                               </div>
                           @else
                               <div class="status-atten">
                                   <h3 style="text-align: center;margin-top: 20px">Không có học sinh nào</h3>
                               </div>
                           @endif
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
