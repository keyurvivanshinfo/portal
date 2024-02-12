<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;


// import model
use App\Models\User;

// import mail
use App\Mail\SendAllUserDataMail;

class SendAllUserDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-all-user-data-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();
        $emailObj = new SendAllUserDataMail($users);
        Mail::to(env('ADMIN_EMAIL_ADDRESS', 'keyur.sanghani2003@gmail.com'))->send($emailObj);
    }
}
