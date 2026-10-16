@extends('admin.layout')
@section('title', 'Login')

@section('body')
    <div class="login">
        <img src="/images/growmiotech-logo.svg" alt="{{ config('agency.name') }}" style="height:38px;width:auto;display:block;margin-bottom:20px">
        <h1 style="margin-top:0">Admin login</h1>
        <p style="margin-top:0">Log in to see the messages from your website.</p>

        @unless ($hasAdmin)
            <p class="note">
                No admin account yet. Open the Terminal in your project folder and run:<br><br>
                <code>php artisan admin:create</code><br><br>
                It will ask for your name, email and password. Then log in here.
            </p>
        @endunless

        <form method="POST" action="{{ url('/admin/login') }}">
            @csrf
            <div class="field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="username" autofocus required>
                @error('email')<p class="error">{{ $message }}</p>@enderror
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" autocomplete="current-password" required>
                @error('password')<p class="error">{{ $message }}</p>@enderror
            </div>
            <label style="display:flex;gap:8px;align-items:center;font-weight:500">
                <input type="checkbox" name="remember" value="1"> Keep me logged in
            </label>
            <button type="submit" class="btn btn-primary" style="width:100%;margin-top:16px">Log in</button>
        </form>
        <p style="margin:18px 0 0;text-align:center"><a href="/">← Back to website</a></p>
    </div>
@endsection
