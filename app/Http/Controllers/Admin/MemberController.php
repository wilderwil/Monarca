<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.members.index')->only('index');
        $this->middleware('can:admin.members.edit')->only('edit', 'update');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.members.index');
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {

        return view('admin.member.edit', compact(['member']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {

        return redirect()->route('admin.members.edit', $member)->with('info', 'Se Asignaron los roles  correctamente');
    }
}