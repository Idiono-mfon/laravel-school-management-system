<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SchoolSession;
// use Illuminate\Contracts\Session\Session;

class SessionController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth");
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $schoolSessions = SchoolSession::all();

        return view('dashboard.session', ["schoolSessions" => $schoolSessions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Add Further checks again here
        $this->validate($request, [
            "session_name" => 'required'
        ]);

        SchoolSession::create($request->all());

        // Addd something here also
        return back()->with(['success' => 'Session created succesfully']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function toogleSessionStatus(Request $request, $id)
    {
        // A
        // Check if active session exist
        $query = SchoolSession::where('id', $id);

        if ($query->exists()) {
            $session =  $query->first();
            $status = "";

            if ($session->is_active === 0) {
                // Check whether any previous activated
                if (SchoolSession::where('id', "<>", $id)->where('is_active', 1)->exists()) {
                    return back()->with('error', 'A session is currently active. Kindly disable the session before activating another session');
                }
                $session->is_active = 1;
                $status = "activated";
            } else {
                $session->is_active = 0;
                $status = "disabled";
            }

            $session->save();

            return back()->with('success', "Session is $status succesfully ");
        }

        return back()->with('error', 'Error occured during operation');
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
