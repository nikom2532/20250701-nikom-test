<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WorkLog;
use Carbon\Carbon;

class WorkLogSeeder extends Seeder
{
    public function run(): void
    {
        // ล้างข้อมูลเก่าก่อน
        WorkLog::truncate();

        $taskTypes = ['Development', 'Test', 'Document'];
        $statuses = ['ดำเนินการ', 'เสร็จสิ้น', 'ยกเลิก'];
        $taskNames = ['Fix bug #101', 'Implement feature X', 'Write API documentation', 'Test user login', 'Update project plan'];

        // สร้างข้อมูลย้อนหลัง 5 วัน
        for ($day = 0; $day < 5; $day++) {
            // วันละ 5 รายการ
            for ($i = 0; $i < 5; $i++) {
                $date = Carbon::now()->subDays($day);

                WorkLog::create([
                    'type' => $taskTypes[array_rand($taskTypes)],
                    'task_name' => $taskNames[array_rand($taskNames)] . " on day " . ($day + 1),
                    'start_time' => $date->copy()->setHour(9 + $i)->setMinute(0),
                    'end_time' => $date->copy()->setHour(10 + $i)->setMinute(30),
                    'status' => $statuses[array_rand($statuses)],
                ]);
            }
        }
    }
}