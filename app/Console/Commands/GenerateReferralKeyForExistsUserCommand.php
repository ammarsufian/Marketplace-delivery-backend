<?php

namespace App\Console\Commands;

use App\Domains\Authentication\Models\User;
use Illuminate\Console\Command;

class GenerateReferralKeyForExistsUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:referral-key';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Referral Key for all users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        User::whereNull('referral_key')->map(function ($user) {
            return $user->update(['referral_key' => mt_rand(00001, 999998) . base64_encode($user->id)]);
        });
        return 0;
    }
}
