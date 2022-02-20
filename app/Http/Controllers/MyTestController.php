<?php

namespace App\Http\Controllers;

use App\Models\MyTest;
use App\Http\Requests\StoreMyTestRequest;
use App\Http\Requests\UpdateMyTestRequest;

class MyTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreMyTestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMyTestRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MyTest  $myTest
     * @return \Illuminate\Http\Response
     */
    public function show(MyTest $myTest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MyTest  $myTest
     * @return \Illuminate\Http\Response
     */
    public function edit(MyTest $myTest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMyTestRequest  $request
     * @param  \App\Models\MyTest  $myTest
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMyTestRequest $request, MyTest $myTest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MyTest  $myTest
     * @return \Illuminate\Http\Response
     */
    public function destroy(MyTest $myTest)
    {
        //
    }
}
