<?php

namespace App\Http\Controllers;

use App\Models\WorkLog;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class WorkLogController extends Controller
{
    /**
     * Display a listing of the resource.
     * (C. แสดงรายการที่บันทึก และค้นหาตามวันที่)
     */
    public function index(Request $request)
    {
        $query = WorkLog::query();

        // ตรวจสอบว่ามีการส่งค่า `search_date` มาหรือไม่
        if ($request->filled('search_date')) {
            $query->whereDate('start_time', $request->search_date);
        }

        $worklogs = $query->orderBy('start_time', 'desc')->paginate(10);

        // ส่งข้อมูลไปยัง view
        return view('worklogs.index', [
            'worklogs' => $worklogs,
            'search_date' => $request->search_date // ส่งค่าที่ค้นหา กลับไปแสดงในฟอร์ม
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('worklogs.create');
    }

    /**
     * Store a newly created resource in storage.
     * (A. บันทึกรายการ)
     */
    public function store(Request $request)
    {
        // ตรวจสอบความถูกต้องของข้อมูล (Validation)
        $validated = $request->validate([
            'type' => 'required|in:Development,Test,Document',
            'task_name' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
            'status' => 'required|in:ดำเนินการ,เสร็จสิ้น,ยกเลิก',
        ]);

        WorkLog::create($validated);

        return redirect()->route('worklogs.index')
                         ->with('success', 'บันทึกข้อมูลการปฏิบัติงานสำเร็จ');
    }

    /**
     * Display the specified resource.
     */
    public function show(WorkLog $worklog)
    {
        // $worklog จะถูกดึงข้อมูลมาอัตโนมัติจาก ID ที่ส่งมาใน URL
        return view('worklogs.show', ['worklog' => $worklog]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WorkLog $worklog)
    {
        return view('worklogs.edit', ['worklog' => $worklog]);
    }

    /**
     * Update the specified resource in storage.
     * (B. ปรับปรุงข้อมูล)
     */
    public function update(Request $request, WorkLog $worklog)
    {
        // ตรวจสอบความถูกต้องของข้อมูล
        $validated = $request->validate([
            'type' => 'required|in:Development,Test,Document',
            'task_name' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
            'status' => 'required|in:ดำเนินการ,เสร็จสิ้น,ยกเลิก',
        ]);

        $worklog->update($validated);

        return redirect()->route('worklogs.index')
                         ->with('success', 'ปรับปรุงข้อมูลสำเร็จ');
    }

    /**
     * Remove the specified resource from storage.
     * (B. ลบข้อมูล)
     */
    public function destroy(WorkLog $worklog)
    {
        $worklog->delete();

        return redirect()->route('worklogs.index')
                         ->with('success', 'ลบข้อมูลสำเร็จ');
    }

    /**
     * (D1. แสดงรายงานผลการปฎิบัติงานประจำวัน)
     */
    public function dailyReport(Request $request)
    {
        $searchDate = $request->input('date', Carbon::today()->toDateString());
        
        $logs = WorkLog::whereDate('start_time', $searchDate)
                        ->orderBy('start_time', 'asc')
                        ->get();

        return view('reports.daily', compact('logs', 'searchDate'));
    }

    /**
     * (D2. แสดงรายงานสรุปจำนวนสถานะการทำงานรายเดือน)
     */
    public function monthlySummary(Request $request)
    {
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);

        $summary = WorkLog::query()
            ->whereYear('start_time', $year)
            ->whereMonth('start_time', $month)
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();
        
        return view('reports.monthly', compact('summary', 'month', 'year'));
    }
}