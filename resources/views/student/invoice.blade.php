<!doctype html>
<html>
<head>

    <title>Bảng học phí {{ $students->name }}</title>

    <!-- Fonts and icons -->

    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/atlantis.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        html{
            font-family: DejaVu Sans !important;
        }
        body {
            font-family: DejaVu Sans !important;
        }
    </style>

</head>
<body>
    <div class="card-header">
        <div class=" align-items-center">
            <h4 class="card-title font1" style="text-align: center;color: blue;text-transform: uppercase;">BẢNG HỌC PHÍ {{ $students->name }}</h4>
        </div>
    </div>
    <div class="card-body abc">
        <div class="col-md-6">
            <p style="margin-left: -20px;text-transform: uppercase ;text-align: center;font-size: 18px;font-family: DejaVu Sans !important;">---- Các Môn Đã Học ----</p>
            <div class="table-responsive" style="margin-left: -15px;">
                @foreach($attendances as $atten)
                    @php
                        $attens = \App\Models\Attendance::with(['Shift','Subject','Student'])
                            ->where('id_student',$atten->id_student)
                            ->where('id_subject',$atten->id_subject)
                            ->groupBy('date')
                            ->get();
                        $attens2 = \App\Models\Attendance::with(['Shift','Subject','Student'])
                            ->where('id_student',$atten->id_student)
                            ->count('id_subject');
                    @endphp
                    <table class=" table-bordered" style="border-top: 1px solid black;margin-bottom: 15px">
                        <thead style="text-align: center">
                        <tr>
                            <th class="col-4" style="color: blue;width: 300px;height: 40px">{{ $atten->subject->name }}</th>
                            <th class="col-4" style="color: blue;width: 300px;height: 40px">Số ca học</th>
                        </tr>
                        </thead>
                        <tbody style="text-align: center">
                        @foreach($attens as $at)
                            @php
                                $attens1 = \App\Models\Attendance::with(['Shift','Subject','Student'])
                                ->where('id_student',$at->id_student)
                                ->where('id_subject',$at->id_subject)
                                ->where('date',$at->date)
                                ->count('id_subject');
                            @endphp
                            <tr>
                                <td class="col-4" style="height: 40px">{{ $at->date }}</td>
                                <td class="col-4" style="height: 40px"> {{ $attens1 }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endforeach
            </div>
        </div>
        <div class="col-md-12" style="margin-left: -15px;width: 630px">
            <div>
                <p style="text-transform: uppercase ;text-align: center;margin-left:30px;font-size: 18px;font-family: DejaVu Sans">---- Học phí ----</p>
            </div>
            <div>
                <div class="col-md-12 tuition">
                    <p style="margin: 0 auto;text-align: center;padding: 1%">
                        <span style="color: red;font-family: DejaVu Sans">Tổng số ca học:</span>
                        <span style="color: blue;font-family: DejaVu Sans">{{ $attens2 }}</span>
                    </p>
                </div>
                <div class="col-md-12 tuition">
                    <p style="margin: 0 auto;text-align: center;padding: 1% ">
                        <span style="color: red;font-family: DejaVu Sans">Học phí tháng {{ $months }}:</span>
                        <span style="color: blue;font-family: DejaVu Sans"> {{ number_format($attens2 * 1000000) }} đ</span>
                    </p>
                </div>

            </div>
        </div>
    </div>
</body>
</html>

