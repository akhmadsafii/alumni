<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Models\Major;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mail;
use App\Mail\MailNotify;

class AuthController extends Controller
{
    public function login()
    {
        session()->put('title', 'Login Aplikasi');
        return view('content.auth.v_login');
    }

    public function register()
    {
        session()->put('title', 'Register Aplikasi');
        $majors = Major::where('status', 1)->get();
        return view('content.auth.v_register', compact('majors'));
    }

    public function verify_login(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt($this->check_credentials($request), $request->filled('remember'))) {
            return response()->json([
                'message' =>  'Login sebagai admin berhasil',
                'status' =>  true,
                'target_url' =>  route('admin.dashboard'),
            ]);
        } else if (Auth::guard('user')->attempt($this->check_credentials($request), $request->filled('remember'))) {
            if (Auth::guard('user')->check()) {
                session()->put('role', 'user');
                session()->put('id', Auth::guard('user')->user()->id);
                session()->put('avatar', Auth::guard('user')->user()->file == null ? asset('asset/img/user4.jpg') : asset(Auth::guard('user')->user()->file));
            }
            return response()->json([
                'message' =>  'Login sebagai Pengguna berhasil',
                'status' =>  true,
                'target_url' =>  route('first_page'),
            ]);
        }

        return response()->json([
            'message' =>  'Anda tidak mempunyai akses untuk login',
            'status' =>  false,
            'target_url' =>  route('auth.login'),
        ]);
    }

    protected function check_credentials(Request $request)
    {
        // dd($request);
        if (filter_var($request->get('username'), FILTER_VALIDATE_EMAIL)) {
            return ['email' => $request->get('username'), 'password' => $request->get('password'), 'status' => 1];
        }
        return ['phone' => $request->get('username'), 'password' => $request->get('password'), 'status' => 1];
    }

    public function logout()
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } elseif (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
        }

        return redirect()->route('auth.login');
    }

    public function verify_register(Request $request)
    {
        // dd($request);
        $customAttributes = [
            'name' => 'Nama Alumni',
            'phone' => 'Telepon Alumni',
            'email' => 'Email Alumni',
            'accept' => 'Syarat dan ketentuan'
        ];

        $max_size = 'max:' . env('CONFIG_MAX_UPLOAD');
        $mimes = 'mimes:' . str_replace('|', ',', env('CONFIG_FORMAT_IMAGE'));
        $rules = [
            'file' => ['image', $mimes, $max_size],
            'name' => ['required'],
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users',
            'accept' => 'required',
        ];

        $messages = [
            'email' => ':attribute tidak valid.',
            'required' => ':attribute harus diisi.',
            'mimes' => 'Format tipe gambar :attribute yang diupload tidak diperbolehkan',
            'max' => 'Ukuran maksimal file ' . env('CONFIG_MAX_UPLOAD') / 1000 . ' MB',
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $customAttributes);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages()->first(),
                'status' => false,
            ], 302);
        } else {
            try
            {
                $data = $request->toArray();
                $password =  str_random(8);
                $body = [
                    'email' => $data['email'],
                    'password' => $password,
                ];
                // dd(''.$request['mail'].'');
                Mail::to($data['email'])->send(new MailNotify($body));


                $data['password'] = $password;
                if (!empty($request->file)) {
                    $data = ImageHelper::upload_asset($request, 'file', 'profile', $data);
                }
                unset($data['accept']);
                User::updateOrCreate(
                    ['id' => $request->id],
                    $data
                );
                return response()->json([
                    'message' => 'Successful created user. Please check your email for a 6-digit pin to verify your email.',
                    'status' => true,
                ], 200);

                // return response()->json(['Great! Successfully send in your mail']);
            }
            catch(Exception $e)
            {
              return response()->json(['Sorry! Please try again latter']);
            }





        }
    }
}
