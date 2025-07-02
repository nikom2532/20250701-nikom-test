<?php

use App\Http\Controllers\WorkLogController;

// สร้าง Routes สำหรับ CRUD (index, create, store, edit, update, destroy) อัตโนมัติ
Route::resource('worklogs', WorkLogController::class);

// Routes สำหรับหน้ารายงาน
Route::get('reports/daily', [WorkLogController::class, 'dailyReport'])->name('reports.daily');
Route::get('reports/monthly', [WorkLogController::class, 'monthlySummary'])->name('reports.monthly');