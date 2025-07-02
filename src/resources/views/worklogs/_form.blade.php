@csrf
{{-- ตรวจสอบและแสดงข้อผิดพลาด --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="mb-3">
    <label for="type" class="form-label">ประเภทงาน</label>
    <select name="type" id="type" class="form-select" required>
        <option value="Development" @selected(old('type', $worklog->type ?? '') == 'Development')>Development</option>
        <option value="Test" @selected(old('type', $worklog->type ?? '') == 'Test')>Test</option>
        <option value="Document" @selected(old('type', $worklog->type ?? '') == 'Document')>Document</option>
    </select>
</div>

<div class="mb-3">
    <label for="task_name" class="form-label">ชื่องาน</label>
    <input type="text" name="task_name" id="task_name" class="form-control" value="{{ old('task_name', $worklog->task_name ?? '') }}" required>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="start_time" class="form-label">เวลาเริ่ม</label>
        <input type="datetime-local" name="start_time" id="start_time" class="form-control" value="{{ old('start_time', isset($worklog->start_time) ? $worklog->start_time->format('Y-m-d\TH:i') : '') }}" required>
    </div>
    <div class="col-md-6 mb-3">
        <label for="end_time" class="form-label">เวลาสิ้นสุด</label>
        <input type="datetime-local" name="end_time" id="end_time" class="form-control" value="{{ old('end_time', isset($worklog->end_time) ? $worklog->end_time->format('Y-m-d\TH:i') : '') }}">
    </div>
</div>

<div class="mb-3">
    <label for="status" class="form-label">สถานะ</label>
    <select name="status" id="status" class="form-select" required>
        <option value="ดำเนินการ" @selected(old('status', $worklog->status ?? '') == 'ดำเนินการ')>ดำเนินการ</option>
        <option value="เสร็จสิ้น" @selected(old('status', $worklog->status ?? '') == 'เสร็จสิ้น')>เสร็จสิ้น</option>
        <option value="ยกเลิก" @selected(old('status', $worklog->status ?? '') == 'ยกเลิก')>ยกเลิก</option>
    </select>
</div>

<button type="submit" class="btn btn-primary">{{ $buttonText ?? 'บันทึก' }}</button>
<a href="{{ route('worklogs.index') }}" class="btn btn-secondary">ยกเลิก</a>