<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Patient;
use App\User;



class PatientsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, User $user)
    {
        

      $patient = new Patient($request->all());
        $patient->user_id = Auth::user()->id;
        $patient->save();



        return back();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = \DB::table('patients')->where('user_id', Auth::user()->id )->get();
       // $patients = Patient::all();
        return view('patients.index', compact('patients'));
    }



}