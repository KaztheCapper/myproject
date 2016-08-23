<?php

namespace App\Http\Controllers;


use App\Patient;
Use App\Appointment;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Http\Requests;

class AppointmentsController extends Controller
{

    public $flashErrors = '';

    public function storeResult(Request $request, Patient $patient)
    {

        $this->validate($request, [
            'Date' =>'required|date_format:"d/m/Y"',
            'result' =>'required|integer|min:0|max:10000',


        ]);
        $appointment = new Appointment;

        $appointment->date = $request->Date;
        $appointment->result = $request->result;

        $patient->appointments()->save($appointment);






        return back();


    }

    public function checkDates(Patient $patient){
        $latestAppointment = $patient->appointments->last();
        //  $latestDate1 = $latestAppointment->Date;
        //  echo $latestDate1;

        if ( !isset($latestAppointment->Date) || empty($latestAppointment->Date)){ return; }
        $latestDate = strtotime( str_replace('/', '-', $latestAppointment->Date) );
        $minusWeek = strtotime('-1 week');


        if ($latestDate < $minusWeek) {
            //flash('Warning: Patient has not submitted blood result in over a week', 'warning');
            $this->flashErrors .= "Warning: Patient has not submitted blood result in over a week<br />";
        }





    }

    public function checkBlood(Patient $patient){
        $appointmentCount = $patient->appointments->count() -2;
        $appointment = $patient->appointments->get($appointmentCount);

        $latestAppointment = $patient->appointments->last();

         if ( !isset($latestAppointment->Result) || empty($latestAppointment->Result)){ return back(); }
        if ( !isset($appointment->Result) || empty($appointment->Result)){ return back(); }

        if($appointment->Result< $latestAppointment->Result) {

            $this->flashErrors .= "Warning: Blood result greater than last.<br />";

        }

    }
    public function edit(Appointment $appointment)
    {
        return view('appointments.edit', compact('appointment'));

    }
    public function update(Request $request, Appointment $appointment)
    {
        $appointment->update($request->all());

        return back();



    }

    public function show(Patient $patient)
    {
        //$patient = Patient::with('appointments')->get();
        //return $patient[1];
        $this->checkDates($patient);
        $this->checkBlood($patient);
        if( $this->flashErrors!='')
        {
            flash($this->flashErrors,'danger');
        }

        return view('patients.show', compact('patient'));
    }





}