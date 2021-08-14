<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Term;
use Illuminate\Http\Request;
use App\Models\SchoolSession;
use App\Http\Controllers\Controller;

class TermController extends Controller
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
        $schoolSessions = SchoolSession::latest()->get();

        $terms = Term::with(['session'])->latest()->get();

        return view('dashboard.term', [
            'terms' => $terms,
            'schoolSessions' => $schoolSessions
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Add Morev Validation
        $this->validate($request, [
            "term" => 'required',
            "session" => 'required'
        ]);

        // Create term
        Term::create([
            'session_id' => $request->input('session'),
            'term_name' => $request->input('term'),
        ]);

        // Add something here
        return back()->with(["success" => "Term created successfully"]);
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
     * Toggle term status the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function toogleTermStatus(Request $request, $id)
    {
        //
        $query = Term::with('session')->where('id', $id);

        $status = "";

        if ($query->exists()) {

            $term = $query->first();

            // check whether the session term is activated
            if ($term->session->is_active === 0) {
                return back()->with("error", "Kindly enable the session related to this term before initiating this operation");
            }

            if ($term->is_active === 0) {
                // check whether any term is already activated
                if (Term::where("id", "<>", $id)->where("is_active", 1)->exists()) {
                    return back()->with("error", "A term is currently active. Kindly disable the term before activating another session");
                }

                $term->is_active = 1;
                $status = "activated";
            } else {
                // Disable session
                $term->is_active = 0;
                $status = "deactivated";
            }

            $term->save();

            return back()->with("success", "Term is $status successfully");
        }
        return back()->with('error', "Error occured during operation");
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
