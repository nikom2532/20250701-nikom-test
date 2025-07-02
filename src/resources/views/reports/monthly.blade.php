@extends('layouts.app')
@section('title', 'รายงานสรุปรายเดือน')

@section('content')
    <h1>รายงานสรุปจำนวนสถานะรายเดือน</h1>
    <hr>
    {{-- ฟอร์มเลือกเดือน/ปี --}}
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('reports.monthly') }}" method="GET" class="row g-3 align-items-center">
                <div class="col-auto">
                    <label for="month" class="form-label">เดือน</label>
                    <select name="month" id="month" class="form-select">
                        @for ($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}" @selected($month == $m)>{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-auto">
                    <label for="year" class="form-label">ปี</label>
                    <input type="number" name="year" id="year" class="form-control" value="{{ $year }}" min="2020" max="2099">
                </div>
                <div class="col-auto mt-4">
                    <button type="submit" class="btn btn-primary">ดูรายงาน</button>
                </div>
            </form>
        </div>
    </div>

    <h3>สรุปของเดือน {{ str_pad($month, 2, '0', STR_PAD_LEFT) }}/{{ $year }}</h3>
    <table class="table table-bordered w-50">
        <thead class="table-light">
            <tr>
                <th>สถานะ</th>
                <th>จำนวนรายการ</th>
            </tr>
        </thead>
        <tbody>
            @forelse($summary as $item)
            <tr>
                <td>{{ $item->status }}</td>
                <td>{{ $item->total }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="2" class="text-center">ไม่พบข้อมูลสำหรับเดือนที่เลือก</td>
            </tr>
            @endforelse
        </tbody>
    </table>
@endsection