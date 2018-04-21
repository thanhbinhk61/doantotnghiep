<?php

namespace App\Jobs\Mail;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class Send extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $data;

    protected $to;

    protected $view;

    protected $subject;

    public function __construct(array $data, $to, $view, $subject)
    {
        $this->data = $data;
        $this->to = $to;
        $this->view = $view;
        $this->subject = $subject;

    }

    public function handle()
    {
        $data = $this->data;
        $to = $this->to;
        $view = $this->view;
        $subject = $this->subject;
        Mail::send("frontend.mail.{$view}", ['data' => $data], function ($m) use ($to, $subject) {
            $m->from('info@umzila.vn', "[Umzila] - {$subject}");

            $m->to($to,'Umzila')->subject($subject);
        });
    }
}
