<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ClassArm;
use Illuminate\Support\Facades\Validator;

// ClassArmController

class ClassArmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Add Pagination here latter
        $arms = ClassArm::all();

        return view('dashboard.class_arm', ["arms" =>  $arms]);
    }

    // display the create the modal

    public function create()
    {
        session(["create_modal" => true]);

        return redirect(route('class_arm'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Add more validation here
        $validator = Validator::make($request->all(), [
            "arm_name" => "required",
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Field cannot be empty');
        }

        ClassArm::create($request->all());

        return back()->with("success", "Class Arm added successfully");
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $query = ClassArm::where("id", $id);

        if ($query->exists()) {
            $class_arm = $query->first();
            // flash a paramter into session which will be used to automatically trigger a modal for editing purpose
            session(["edit_modal" => true]);
            // Retrieve all arms too to render table again
            // Add Pagination latter
            $arms = ClassArm::all();

            return view("dashboard.class_arm", ["class_arm" => $class_arm, "arms" => $arms]);
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
        $validator = Validator::make($request->only("arm_name"), [
            "arm_name" => "required",
        ]);

        if ($validator->fails()) {
            return back()->with("error", "Error occured while updating class arm");
        }

        $query = ClassArm::where('id', $id);

        if ($query->exists()) {
            // check where
            $query->update($request->only("arm_name"));
            // delete edit modal trigger parameter from session
            // session()->forget("edit_modal");
            return redirect(route('class_arm'))->with("success", "class arm updated succesfully");
        }

        return back()->with("error", "Error occured while updating class arm");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $query = ClassArm::where('id', $id);
        if ($query->exists()) {
            $query->delete();
            return back()->with('success', 'Class Arm deleted successfully');
        }
        return back()->with('error', 'Error occured while deleting class arm');
    }
}
