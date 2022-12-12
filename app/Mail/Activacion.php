<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class Activacion extends Mailable
{
    use Queueable, SerializesModels;

    public $subjet = "Activación de Cuenta";

    public $tenant;

    public function __construct($tenant)
    {
        $this->tenant = $tenant;
    }

    public function build()
    {
        return $this->view('LandingPage.correo.activacion');
    }
}
