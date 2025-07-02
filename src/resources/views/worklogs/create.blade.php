@extends('layouts.app')

@section('title', 'เพิ่มรายการใหม่')

@section('content')
    <h1>เพิ่มรายการปฏิบัติงาน</h1>
    <hr>
    <form action="{{ route('worklogs.store') }}" method="POST">
        @include('worklogs._form', ['buttonText' => 'บันทึกข้อมูล'])
    </form>
@endsection