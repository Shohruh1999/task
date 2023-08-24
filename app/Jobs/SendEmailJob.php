<?php

namespace App\Jobs;

use App\Mail\ApplicationCreated;
use App\Models\Application;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected Application $application;
    public function __construct(Application $application)
    {
        $this->application = $application;
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $maneger = User::first();
        Mail::to($maneger)->send(new ApplicationCreated($this->application));
        // $emial = new ApplicationCreated();
        // Mail::to($this->application)->email;
        //
    }
}
