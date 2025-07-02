<!doctype html>
<html lang="th">
<head>
    <meta charset="utf--8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'ระบบบันทึกผลการปฏิบัติงาน')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('worklogs.index') }}">WorkLog</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">รายงาน</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('reports.daily') }}">รายงานประจำวัน</a></li>
                            <li><a class="dropdown-item" href="{{ route('reports.monthly') }}">รายงานสรุปรายเดือน</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mt-4">
        {{-- แสดงข้อความแจ้งเตือน Success --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>