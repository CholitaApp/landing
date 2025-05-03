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
            'recaptcha_token' => 'required',
        ]);

        // Verificar token con Google
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $request->input('recaptcha_token'),
        ]);

        $data = $response->json();

        if (! ($data['success'] ?? false) || ($data['score'] ?? 0) < 0.5 || ($data['action'] ?? '') !== 'newsletter') {
            return back()->withErrors(['recaptcha' => 'Falló la validación reCAPTCHA. Intenta nuevamente.']);
        }

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
