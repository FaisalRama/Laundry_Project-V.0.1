<?php

namespace App\Http\Controllers;

use App\Models\todomember;
use App\Http\Requests\StoretodomemberRequest;
use App\Http\Requests\UpdatetodomemberRequest;

class TodomemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('to_do_list_on_project.crud.member.index', [
            'todomember' => todomember::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoretodomemberRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoretodomemberRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\todomember  $todomember
     * @return \Illuminate\Http\Response
     */
    public function show(todomember $todomember)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\todomember  $todomember
     * @return \Illuminate\Http\Response
     */
    public function edit(todomember $todomember)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatetodomemberRequest  $request
     * @param  \App\Models\todomember  $todomember
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatetodomemberRequest $request, todomember $todomember)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\todomember  $todomember
     * @return \Illuminate\Http\Response
     */
    public function destroy(todomember $todomember)
    {
        //
    }
}
