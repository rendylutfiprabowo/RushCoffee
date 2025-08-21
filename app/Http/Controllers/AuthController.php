<?php
// app/Http/Controllers/AuthController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function autentic(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required',
        ]);

        // Mendapatkan sesi login_attempts dan blocked_until
        $attempts = session()->get('login_attempts', 0);
        $blockedUntil = session()->get('blocked_until', now());

        // Cek apakah akun diblokir sementara
        if ($attempts >= 3 && now()->lessThan($blockedUntil)) {
            return redirect('/login')->with('status', 'failed')
                ->with('message', 'Akun diblokir sementara. Coba lagi setelah ' . $blockedUntil->diffForHumans());
        }

        // Cek kredensial dengan Auth::attempt (menggunakan bcrypt)
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role_id == 1) {
                return redirect('/pemesanan');
            } elseif ($user->role_id == 2) {
                return redirect('/pemesanan');
            } else {
                return redirect('/'); // default
            }
        }



        // Jika gagal, tambahkan login_attempts
        session()->put('login_attempts', $attempts + 1);

        // Blokir jika percobaan mencapai 3 kali
        if (session()->get('login_attempts') >= 3) {
            session()->put('blocked_until', now()->addSeconds(30));
            $message = 'Akun diblokir sementara selama 30 detik';
        } else {
            $message = 'Kata sandi atau username salah';
        }

        // Catat log ke file log.txt
        $this->writeLog($request, $message);

        return redirect('/login')->with('status', 'failed')->with('message', $message);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // Fungsi untuk menulis log
    private function writeLog(Request $request, $message)
    {
        $logEntry = [
            'timestamp' => now(),
            'username' => $request->input('username'),
            'message' => $message,
            'ip_address' => $request->ip(),
        ];
        $logData = json_encode($logEntry) . PHP_EOL;

        file_put_contents(storage_path('logs/log.txt'), $logData, FILE_APPEND);
    }
}
