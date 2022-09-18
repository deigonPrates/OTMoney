<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class SimulationSendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $simulatins;
    /**
     * Create a new message instance.
     *
     * @param $simulations
     */
    public function __construct($simulations)
    {
        $this->simulatins = $simulations;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject(env('APP_NAME'). ' - Simulação da conversão');
        $this->to(Auth::user()->email);
        return $this->view('mail.simulate',[
            'simulations' => $this->simulatins
        ]);
    }
}
