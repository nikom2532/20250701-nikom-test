@extends('layouts.app')

@section('title', 'แก้ไขรายการ')

@section('content')
    <h1>แก้ไขรายการ #{{ $worklog->id }}</h1>
    <hr>
    <form action="{{ route('worklogs.update', $worklog->id) }}" method="POST">
        @method('PUT')
        @include('worklogs._form', ['worklog' => $worklog, 'buttonText' => 'อัปเดตข้อมูล'])
    </form>
@endsection