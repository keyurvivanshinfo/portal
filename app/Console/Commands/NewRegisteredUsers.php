<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

use Carbon\Carbon;

use App\Mail\SendAllUserDataMail;
use App\Models\User;

class NewRegisteredUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:new-registered-users';

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
        $today = Carbon::now();
        $users = User::where('created_at', '>=', $today->subHours(24))->get();
        $emailObj = new SendAllUserDataMail($users);
        Mail::to(env('ADMIN_EMAIL_ADDRESS', 'keyur.sanghani2003@gmail.com'))->send($emailObj);
    }
}
