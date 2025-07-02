<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home() {
        // return view('welcome');
        return 'Hello World';
    }

    public function about() {
        return 'เกี่ยวกับเรา (จาก Controller)';
    }
}
