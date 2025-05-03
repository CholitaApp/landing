<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Tenants\Subscriber;
use Illuminate\Contracts\View\View;

class SubscriberController extends Controller
{
    public function __invoke(): View
    {
        $subscribers = Subscriber::latest()->get();
        return view('subscribers.index', compact('subscribers'));
    }
}
