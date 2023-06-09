<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstallmentsController extends Controller
{
    public function index()
    {

        return view('installment.index');
    }
    public function pending()
    {

        return view('installment.pending');
    }
}