<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\ModelPengguna;

class verifyMail extends Mailable
{
    use Queueable, SerializesModels;
    public $pengguna;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ModelPengguna $pengguna)
    {
        $this->pengguna = $pengguna;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('verifyUser');
    }
}
