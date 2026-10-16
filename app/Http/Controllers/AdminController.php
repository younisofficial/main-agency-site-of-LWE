<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    public function loginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.messages');
        }

        return view('admin.login', ['hasAdmin' => User::exists()]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withInput($request->only('email'))
                ->withErrors(['email' => 'Email or password is wrong.']);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('admin.messages'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function messages(Request $request)
    {
        $show = $request->query('show') === 'all' ? 'all' : 'new';

        $messages = ContactMessage::query()
            ->when($show === 'new', fn ($q) => $q->whereNull('read_at'))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.messages', [
            'messages' => $messages,
            'show' => $show,
            'newCount' => ContactMessage::whereNull('read_at')->count(),
            'allCount' => ContactMessage::count(),
            'serviceNames' => Service::pluck('title', 'slug'),
        ]);
    }

    public function toggleDone(ContactMessage $message)
    {
        $message->update(['read_at' => $message->read_at ? null : now()]);

        return back();
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();

        return back();
    }

    public function passwordForm()
    {
        return view('admin.password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ], [
            'current_password.current_password' => 'Your current password is wrong.',
        ]);

        $user = $request->user();
        $user->forceFill(['password' => Hash::make($request->input('password'))])->save();

        // Stay logged in on this device after the password changes.
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('admin.password')->with('status', 'Password changed.');
    }
}
