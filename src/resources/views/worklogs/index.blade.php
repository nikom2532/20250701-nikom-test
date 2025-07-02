@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>รายการปฏิบัติงาน</h1>
        <a href="{{ route('worklogs.create') }}" class="btn btn-primary">เพิ่มรายการใหม่</a>
    </div>

    {{-- ฟอร์มค้นหา --}}
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('worklogs.index') }}" method="GET" class="row g-3 align-items-center">
                <div class="col-auto">
                    <label for="search_date" class="form-label">ค้นหาตามวันที่</label>
                </div>
                <div class="col-auto">
                    <input type="date" name="search_date" id="search_date" class="form-control" value="{{ $search_date ?? '' }}">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-info">ค้นหา</button>
                    <a href="{{ route('worklogs.index') }}" class="btn btn-secondary">ล้างค่า</a>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>ประเภท</th>
                <th>ชื่องาน</th>
                <th>เวลาเริ่ม</th>
                <th>เวลาสิ้นสุด</th>
                <th>สถานะ</th>
                <th>จัดการ</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($worklogs as $log)
                <tr>
                    <td>{{ $log->id }}</td>
                    <td>{{ $log->type }}</td>
                    <td>{{ $log->task_name }}</td>
                    <td>{{ $log->start_time->format('d/m/Y H:i') }}</td>
                    <td>{{ $log->end_time ? $log->end_time->format('d/m/Y H:i') : '-' }}</td>
                    <td>{{ $log->status }}</td>
                    <td>
                        <a href="{{ route('worklogs.edit', $log->id) }}" class="btn btn-sm btn-warning">แก้ไข</a>
                        <form action="{{ route('worklogs.destroy', $log->id) }}" method="POST" class="d-inline" onsubmit="return confirm('คุณแน่ใจว่าต้องการลบรายการนี้?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">ลบ</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">ไม่พบข้อมูล</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- แสดง Pagination Links --}}
    <div class="mt-3">
        {{ $worklogs->appends(request()->query())->links() }}
    </div>
@endsection