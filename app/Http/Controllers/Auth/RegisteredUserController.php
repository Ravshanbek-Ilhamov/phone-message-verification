<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VarificationCode;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        $code = rand(10000,99999);
        VarificationCode::create([
            'user_id' => auth()->user()->id,
            'code' => $code,
        ]);
        $token = " eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE3MzQxNTgxMjcsImlhdCI6MTczMTU2NjEyNywicm9sZSI6InRlc3QiLCJzaWduIjoiNWE0ZDQxODUwMWU4MzlmMWZlNDIyNzRiOTYyNzczZjk5YzM2NzI5YWJkNDhkYzllMDk4YTlkOGE2ZGU4OTRjMSIsInN1YiI6Ijg5MjQifQ.059e4pHCK34qiaMqJIMBE9srV2_SBYAVmlEGb-zY-WM";
      
        $data = [
            'mobile_number' => $user->phone_number,
            'message' => 'Tqsdiqlash kodi:' . $code,
            'from'=> 4546,
            'callback_url' =>  'http://127.0.0.1/8000/dashboard'
        ];

        $response = Http::withToken($token)->post('notify.eskiz.uz/api/message/sms/send-batch',$data);        
        return redirect(route('code.verification', absolute: false));
    }
}
