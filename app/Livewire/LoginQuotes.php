<?php

namespace App\Livewire;

use Livewire\Component;

class LoginQuotes extends Component
{
    public $currentQuote;

    protected $quotes = [
        "Unlock the treasure trove of preloved wonders – log in now and let the bargain hunt begin! Your next favorite item is just a click away.",
        "Join the preloved party! Logging in is like getting an exclusive invite to the coolest thrift store in town. Don't miss out on the fun – sign in and shop till you drop!",
        "Why did the user log in? To discover amazing preloved finds and unleash their inner bargain ninja! Be a savvy shopper – login and conquer the deals.",
        "Logging in is the key to a world of secondhand splendor. Your next 'must-have' is waiting – don't keep it waiting too long!",
        "What's the secret to a happy day? Logging in and scoring preloved treasures, of course! Get ready for smiles and great deals – click that login button now!",
        "Why did the fashionista log in? To stay fabulous on a budget! Join the style squad – login and strut into savings!",
        "Knock, knock. Who's there? A world of preloved wonders! Open the door by logging in and let the shopping adventure begin."
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
        return view('livewire.login-quotes');
    }
}
