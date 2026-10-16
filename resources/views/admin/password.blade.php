@extends('admin.layout')
@section('title', 'Change password')

@section('body')
    @include('admin._bar')

    <main class="wrap">
        <h1>Change password</h1>
        <div class="card" style="max-width:440px">
            @if (session('status'))
                <p class="ok">{{ session('status') }}</p>
            @endif
            <form method="POST" action="{{ route('admin.password') }}">
                @csrf
                <div class="field">
                    <label for="current_password">Current password</label>
                    <input id="current_password" type="password" name="current_password" autocomplete="current-password" required>
                    @error('current_password')<p class="error">{{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label for="password">New password <span style="font-weight:400;color:var(--muted)">(at least 8 characters)</span></label>
                    <input id="password" type="password" name="password" autocomplete="new-password" required>
                    @error('password')<p class="error">{{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label for="password_confirmation">New password again</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password" required>
                </div>
                <button type="submit" class="btn btn-primary">Save new password</button>
            </form>
        </div>
    </main>
@endsection
