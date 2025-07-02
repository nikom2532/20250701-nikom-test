@extends('layouts.app')
@section('title', 'รายงานประจำวัน')

@section('content')
    <h1>รายงานผลการปฏิบัติงานประจำวัน</h1>
    <hr>
    {{-- ฟอร์มเลือกวันที่ --}}
    <div class="card mb-4">
        <div class="card-body">
             <form action="{{ route('reports.daily') }}" method="GET" class="row g-3 align-items-center">
                <div class="col-auto">
                    <label for="date" class="form-label">เลือกวันที่</label>
                </div>
                <div class="col-auto">
                    <input type="date" name="date" id="date" class="form-control" value="{{ $searchDate }}">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">ดูรายงาน</button>
                </div>
            </form>
        </div>
    </div>

    <h3>รายงานของวันที่: {{ \Carbon\Carbon::parse($searchDate)->format('d F Y') }}</h3>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>เวลาเริ่ม</th>
                <th>เวลาสิ้นสุด</th>
                <th>ประเภท</th>
                <th>ชื่องาน</th>
                <th>สถานะ</th>
            </tr>
        </thead>
        <tbody>
            @forelse($logs as $log)
            <tr>
                <td>{{ $log->start_time->format('H:i') }}</td>
                <td>{{ $log->end_time ? $log->end_time->format('H:i') : '-' }}</td>
                <td>{{ $log->type }}</td>
                <td>{{ $log->task_name }}</td>
                <td>{{ $log->status }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">ไม่พบข้อมูลสำหรับวันที่เลือก</td>
            </tr>
            @endforelse
        </tbody>
    </table>
@endsection