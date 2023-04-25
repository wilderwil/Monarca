<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstallmentsPendingController extends Controller
{
    public function index()
    {

        return view('installment.pending');
    }

}