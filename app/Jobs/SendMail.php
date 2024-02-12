<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


use App\Mail\resetPasswordMail;
use Illuminate\Support\Facades\Mail;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

     protected $email,$maildata;
    public function __construct($email,$maildata)
    {
        $this->email= $email;
        $this->maildata=$maildata;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $mailobj = new resetPasswordMail($this->maildata);
        Mail::to($this->email)->send($mailobj);
    }
}
