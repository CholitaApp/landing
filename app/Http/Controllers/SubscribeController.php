<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Tenants\Subscriber;
use Http;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class SubscribeController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'recaptcha_token' => 'required',
        ]);

        // Verificar token con Google
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('app.RECAPTCHA_SECRET_KEY'),
            'response' => $request->input('recaptcha_token'),
        ]);

        $data = $response->json();

        if (! ($data['success'] ?? false) || ($data['score'] ?? 0) < 0.5 || ($data['action'] ?? '') !== 'newsletter') {
            return back()->with(['error' => 'Falló la validación reCAPTCHA. Intenta nuevamente.']);
        }

        $subscriber = new Subscriber();
        $subscriber->id = Uuid::uuid4()->toString();
        $subscriber->email = $request->input('email');
        try {
            $subscriber->saveOrFail();
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()], 500);
        }

        return redirect()->back()->with(['success' => 'Subscription successful!'], 200);
    }
}
