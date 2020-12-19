<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;
    protected $tutor_or_tutee;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $tutor_or_tutee)
    {
        //
        $this->data = $data;
        $this->tutor_or_tutee = $tutor_or_tutee;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->tutor_or_tutee == 1){
            return $this->subject('Appointment Confirmation')
                    ->view('Emails.AppointmentComfirmation')
                    ->with(['data'=>$this->data]);
        }else{
            return $this->subject('New Appointment From Tutoring Site')
                    ->view('Emails.AppointmentComfirmationTutor')
                    ->with(['data'=>$this->data]);
        }

    }
}
