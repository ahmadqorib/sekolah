<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('admin.login');
    }

    public function validateLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            notice('error', 'Data gagal divalidasi');
            return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
        }
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        try {
            $loginType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
            $login = [
                $loginType => $request->username,
                'password' => $request->password
            ];

            if (Auth::guard()->attempt($login)) {
                notice('success', 'Selamat datang '.auth()->user()->email);
                return redirect()->route('admin.home');
            }else{
                notice('error', 'Username/Pasasword mungkin ada yang salah!');
            }
        }catch(Exception $e) {
            notice('error', 'Mohon maaf, terjadi kesalahan');
        }

        return back();
    }

    public function logout(Request $request)
    {
        Auth::guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 204)
            : redirect()->route('admin.login');
    }
}
