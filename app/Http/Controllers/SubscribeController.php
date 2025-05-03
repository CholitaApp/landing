<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $subscriber = new Subscriber();
        $subscriber->email = $request->input('email');
        try {
            $subscriber->saveOrFail();
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Subscription failed!'], 500);
        }

        return redirect()->back()->with(['success' => 'Subscription successful!'], 200);
    }
}
