<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Contracts\View\View;

class SubscriberController extends Controller
{
    public function __invoke(): View
    {
        $subscribers = Subscriber::latest()->get();
        return view('subscribers.index', compact('subscribers'));
    }
}
