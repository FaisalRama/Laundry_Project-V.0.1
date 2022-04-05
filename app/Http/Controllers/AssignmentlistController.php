<?php

namespace App\Http\Controllers;

use App\Models\assignmentlist;
use App\Http\Requests\StoreassignmentlistRequest;
use App\Http\Requests\UpdateassignmentlistRequest;

class AssignmentlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('assignment_list.index', [
            'assignment_list' => assignmentlist::all()
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
     * @param  \App\Http\Requests\StoreassignmentlistRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreassignmentlistRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\assignmentlist  $assignmentlist
     * @return \Illuminate\Http\Response
     */
    public function show(assignmentlist $assignmentlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\assignmentlist  $assignmentlist
     * @return \Illuminate\Http\Response
     */
    public function edit(assignmentlist $assignmentlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateassignmentlistRequest  $request
     * @param  \App\Models\assignmentlist  $assignmentlist
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateassignmentlistRequest $request, assignmentlist $assignmentlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\assignmentlist  $assignmentlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(assignmentlist $assignmentlist)
    {
        //
    }
}
