<?php

namespace App\Livewire;

use Livewire\Component;

class RegisterQuotes extends Component
{
    public $currentQuote;

    protected $quotes = [
        "Ready to join the preloved party? Sign up now and become a VIP thrift shopper!",
        "Why did the t-shirt sign up? To be worn and cherished again! Follow its lead – sign up for a second chance at greatness.",
        "Sign up today and be the first to know about exclusive deals and hidden treasures. It's like having a secret map to the land of awesome bargains!",
        "What's the secret to a happy wardrobe? A joyful signup experience! Jump into the world of preloved fashion – sign up and let the good times roll.",
        "Why should you sign up? Because preloved goodies are like a box of chocolates – you never know what you're gonna get, but it's always delightful!",
        "Sign up and be the trendsetter of eco-friendly chic. Your fashion journey starts here – don't miss the sustainable style train!",
        "Knock, knock. Who's there? A world of preloved possibilities! Open the door by signing up and let the fashion adventure begin."
    ];

    public function mount()
    {
        $this->getRandomQuote();
    }

    public function getRandomQuote()
    {
        $this->currentQuote = $this->quotes[array_rand($this->quotes)];
    }

    public function render()
    {
        return view('livewire.register-quotes');
    }
}
