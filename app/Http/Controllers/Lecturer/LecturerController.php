<?php

namespace App\Http\Controllers\Lecturer;


use App\Http\Controllers\Controller;


class LecturerController extends Controller
{
    public function index()
    {
        return view('lecturer.pages.index');
    }
}
