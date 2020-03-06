<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Medium;
use App\Http\Controllers\Controller;

class MediumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mediums=Medium::all();
        return view('admin.mediums.index',compact('mediums'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'medium' => 'required|unique:media,name',
       
        ]);
     $medium = new medium;
     $medium->name= request()->get('medium');
     $medium->save();

            return redirect('/admin/medium')->with('success',"Medium Created Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $medium = Medium::find($id);
        return view('admin.mediums.edit',compact('medium'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = request()->validate([
            'medium' => 'required',
       
        ]);
     $medium = Medium::find($id);
     $medium->name= request()->get('medium');
     $medium->save();

            return redirect('/admin/medium')->with('success',"Medium Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medium = Medium::find($id);
        $medium->delete();
        return redirect('/admin/medium')->with('success',"Medium Deleted Successfully");
        
    }
}

