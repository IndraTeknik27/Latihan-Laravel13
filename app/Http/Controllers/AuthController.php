<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;

class AuthController extends Controller
{
    //Register
    public function register()
    {
        return view('register');
    }

    public function prosessregiseter(Request $r)
    {
        // Valisi dulu inputan dari form register
        $r->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:3'
        ]);

        // Simpan data user ke database
        User::create([
            'name' => $r->name,
            'email' => $r->email,
            'password' => Hash::make($r->password),
        ]);

        return redirect()->route('login');
    }

    //Proses Login
    public function login()
    {
        return view('login');
    }

    public function prosesslogin(Request $r)
    {
        // Validasi inputan dari form login
        $data = $r->validate([
            'email' => 'required',
            'password' => 'required|min:3'
        ]);

        // Cek apakah email dan password sesuai dengan data di database
        if (Auth::attempt($data)) {
            // Jika sesuai, regenerasi session untuk mencegah session fixation
            $r->session()->regenerate();
            // Jika sesuai, redirect ke halaman dashboard
            return redirect()->route('divisi.index');
        } else {
            // Jika tidak sesuai, redirect kembali ke halaman login dengan pesan error
            return redirect()->back()->withErrors(['email' => 'Email atau password salah']);
        }
    }

    //Proses Logout
    public function logout(Request $r)
    {
        Auth::logout();
        // Invalidasi session dan regenerasi token untuk mencegah CSRF
        $r->session()->invalidate();

        return redirect()->route('login');
    }

    // Lupa Password
    public function forgotPassword()
    {
        return view('forgot-password');
    }

    public function prosessForgotPassword(Request $r)
    {
        // Validasi inputan email
        $r->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
        ]);

        // Cek apakah email terdaftar di database
        $user = User::where('email', $r->email)->first();

        if (!$user) {
            return redirect()->back()
                ->withErrors(['email' => 'Email tidak terdaftar di sistem kami'])
                ->withInput();
        }

        // Generate token random dan simpan ke tabel password_reset_tokens
        $token = Str::random(64);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $r->email],
            [
                'email' => $r->email,
                'token' => Hash::make($token),
                'created_at' => Carbon::now(),
            ]
        );

        // Bangun URL reset password
        $resetUrl = route('reset.password', ['token' => $token, 'email' => $r->email]);

        // Kirim email ke user berisi link reset
        Mail::html(
            "<div style='font-family: Arial, sans-serif; max-width: 600px; margin: auto; padding: 20px;'>
                <h2 style='color: #4f46e5;'>Reset Password</h2>
                <p>Halo <strong>{$user->name}</strong>,</p>
                <p>Kami menerima permintaan untuk reset password akun Anda. Klik tombol di bawah untuk membuat password baru:</p>
                <p style='text-align: center; margin: 30px 0;'>
                    <a href='{$resetUrl}' style='background: linear-gradient(135deg, #4f46e5, #7c3aed); color: white; padding: 12px 30px; text-decoration: none; border-radius: 8px; display: inline-block; font-weight: bold;'>
                        Reset Password Saya
                    </a>
                </p>
                <p>Atau copy-paste link ini ke browser Anda:</p>
                <p style='background: #f3f4f6; padding: 10px; border-radius: 5px; word-break: break-all;'>{$resetUrl}</p>
                <p><strong>Link berlaku selama 60 menit.</strong></p>
                <p>Jika Anda tidak merasa meminta reset password, abaikan email ini.</p>
                <hr style='border: none; border-top: 1px solid #e5e7eb; margin: 20px 0;'>
                <p style='color: #6b7280; font-size: 12px;'>Email ini dikirim otomatis oleh sistem. Mohon tidak membalas.</p>
            </div>",
            function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Reset Password - Sistem Manajemen Divisi');
            }
        );

        // Redirect ke login dengan pesan sukses (tanpa expose link)
        return redirect()->route('login')
            ->with('status', 'Link reset password telah dikirim ke email Anda. Silakan cek inbox atau folder spam.');
    }

    // Tampilkan form reset password
    public function showResetPasswordForm(Request $r, string $token)
    {
        // Cari token yang cocok di database
        $record = DB::table('password_reset_tokens')
            ->where('email', $r->email)
            ->first();

        // Validasi: token harus ada dan cocok
        if (!$record || !Hash::check($token, $record->token)) {
            return redirect()->route('forgot.password')
                ->withErrors(['email' => 'Token reset tidak valid atau sudah kadaluarsa']);
        }

        // Cek apakah token masih berlaku (60 menit)
        $expired = Carbon::parse($record->created_at)->addMinutes(60);
        if (Carbon::now()->greaterThan($expired)) {
            DB::table('password_reset_tokens')->where('email', $r->email)->delete();
            return redirect()->route('forgot.password')
                ->withErrors(['email' => 'Token reset sudah kadaluarsa. Silakan request ulang']);
        }

        return view('reset-password', [
            'token' => $token,
            'email' => $r->email,
        ]);
    }

    // Proses update password baru
    public function prosessResetPassword(Request $r)
    {
        // Validasi input
        $r->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:3|confirmed',
        ], [
            'password.required' => 'Password baru wajib diisi',
            'password.min' => 'Password minimal 3 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        // Cari token di database
        $record = DB::table('password_reset_tokens')
            ->where('email', $r->email)
            ->first();

        if (!$record || !Hash::check($r->token, $record->token)) {
            return redirect()->route('forgot.password')
                ->withErrors(['email' => 'Token tidak valid atau sudah kadaluarsa']);
        }

        // Cek kadaluarsa
        $expired = Carbon::parse($record->created_at)->addMinutes(60);
        if (Carbon::now()->greaterThan($expired)) {
            DB::table('password_reset_tokens')->where('email', $r->email)->delete();
            return redirect()->route('forgot.password')
                ->withErrors(['email' => 'Token sudah kadaluarsa']);
        }

        // Update password user
        $user = User::where('email', $r->email)->first();
        $user->password = Hash::make($r->password);
        $user->save();

        // Hapus token supaya tidak bisa dipakai lagi
        DB::table('password_reset_tokens')->where('email', $r->email)->delete();

        // Redirect ke login dengan pesan sukses
        return redirect()->route('login')
            ->with('status', 'Password berhasil direset! Silakan login dengan password baru Anda.');
    }
}
