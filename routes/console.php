<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

/*
 * Create (or reset) the admin login for /admin.
 *   php artisan admin:create                          (it asks for email and password)
 *   php artisan admin:create you@example.com YourPassword123
 */
Artisan::command('admin:create {email?} {password?} {--name=Admin}', function () {
    $name = $this->option('name');
    $email = $this->argument('email') ?: $this->ask('Email (used to log in)');
    if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $this->error('That is not a valid email.');

        return 1;
    }
    $password = $this->argument('password') ?: $this->secret('Password (at least 8 characters)');
    if (strlen((string) $password) < 8) {
        $this->error('Password must be at least 8 characters.');

        return 1;
    }

    $user = \App\Models\User::where('email', strtolower($email))->first() ?? new \App\Models\User;
    $user->forceFill(['email' => strtolower($email), 'name' => $name, 'password' => \Illuminate\Support\Facades\Hash::make($password)])->save();

    $this->info("Done. Log in at ".url('/admin/login')." with {$email}");
})->purpose('Create or reset the admin login for the website');
