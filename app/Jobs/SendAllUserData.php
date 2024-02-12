<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;


// import model
use App\Models\User;

// import mail
use App\Mail\SendAllUserDataMail;

class SendAllUserData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $users = User::all();
        $emailObj = new SendAllUserDataMail($users);
        Mail::to(env('ADMIN_EMAIL_ADDRESS', 'keyur.sanghani2003@gmail.com'))->send($emailObj);

    }
}
