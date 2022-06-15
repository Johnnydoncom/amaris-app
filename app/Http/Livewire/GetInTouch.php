<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class GetInTouch extends Component
{
    public $name, $email, $phone, $subject, $message;
    public $cta, $pageTitle, $currentUrl, $showForm=false;

    public function mount()
    {
        $this->currentUrl = url()->current();
    }

    public function render()
    {
        return view('livewire.get-in-touch');
    }

    public function send(){
        $this->validate([
           'name' => 'required',
           'email' => 'required',
           'message' => 'required',
           'subject' => 'required'
        ]);

        $mailData = [
            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
            'phone' => $this->phone,
            'page_url' => $this->currentUrl
        ];

        Mail::to('moriouly@gmail.com')->send(new \App\Mail\GetInTouch($mailData));
        $this->reset([
            'name',
            'email',
            'subject',
            'phone',
            'message'
        ]);
        session()->flash('success', 'Message Sent');
    }
}
