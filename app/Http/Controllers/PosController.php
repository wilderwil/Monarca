<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PosController extends Controller
{
    public function index()
    {

        return view('pos.index');
    }
    public function report()
    {

        return view('pos.report');
    }
}
