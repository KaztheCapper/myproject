<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = ["name"];
    public function appointments(){

        return $this->hasMany(Appointment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
        

    }



    public function addAppointment(Appointment $appointment)
    {
        return $this->appointments()->save($appointment);
    }
}
