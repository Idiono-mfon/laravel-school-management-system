<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\SchoolClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SchoolClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $classes = SchoolClass::all();

        return view('dashboard.class', ['classes' => $classes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        session(["create_modal" => true]);

        return redirect(route('classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Add More Validation Here

        $validator = Validator::make($request->all(), [
            "class_name" => "required",
            "class_arm" => "required|exists:class_arms,id",
        ]);

        if ($validator->fails()) {
            return back()->with("error", "Error occured during operation");
        }

        SchoolClass::create([
            "class_name" => $request->input('class_name'),
            "class_arm_id" => $request->input("class_arm")
        ]);

        return back()->with("success", "Class created successfully");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $query = SchoolClass::where("id", $id);
        if ($query->exists()) {
            $class = $query->first();

            session(["edit_modal" => true]);

            // SchoolClas::with('')
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
