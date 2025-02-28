<?php

namespace App\Jobs;

use App\Mail\SendMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $name;
    public $email;
    public $des;

    /**
     * Create a new job instance.
     */
    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->des = $data['des'];
        // echo "<pre>";
        // print_r($this->email);
        // exit;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
      
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'des' => $this->des,
        ];
        //   echo "<pre>";
        // print_r($data);
        // exit;
        Mail::to($this->email)->send(new SendMail($data));
    }
}
