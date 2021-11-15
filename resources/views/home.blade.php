@extends('layout')
@push('title')
<title>Trang chủ</title>
@endpush
@section('main')
<div class="content">
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">Lớp Học Toán Cô Phượng</h2>
                    <h5 class="text-white op-7 mb-2">Số 18 - Ngách 15/207 - Xuân Đỉnh - Bắc Từ Liêm - Hà Nội</h5>
                </div>
{{--                <div class="ml-md-auto py-2 py-md-0">--}}
{{--                    <a href="#" class="btn btn-white btn-border btn-round mr-2">Manage</a>--}}
{{--                    <a href="#" class="btn btn-secondary btn-round">Add Customer</a>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-6">
                <div class="card full-height">
                    <div class="card-body" style="text-align: center;display: flex">
                        <div class="col-md-4">
                            <i class="fas fa-user-graduate" style="font-size: 80px"></i>
                        </div>
                        <div class="col-md-8">
                            <div class="card-title">Tổng Số Học Sinh</div>
                            <div class="card-category">200 Học sinh đang theo học</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card full-height">
                    <div class="card-body" style="text-align: center;display: flex">
                        <div class="col-md-4">
                            <i class="fas fa-book-open" style="font-size: 80px"></i>
                        </div>
                        <div class="col-md-8">
                            <div class="card-title">Tổng Số Môn Học</div>
                            <div class="card-category">3 Môn học đang giảng dạy</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">User Statistics</div>
                            <div class="card-tools">
                                <a href="#" class="btn btn-info btn-border btn-round btn-sm mr-2">
                                    <span class="btn-label">
                                        <i class="fa fa-pencil"></i>
                                    </span>
                                    Export
                                </a>
                                <a href="#" class="btn btn-info btn-border btn-round btn-sm">
                                    <span class="btn-label">
                                        <i class="fa fa-print"></i>
                                    </span>
                                    Print
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="min-height: 375px">
                            <canvas id="statisticsChart"></canvas>
                        </div>
                        <div id="myChartLegend"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
