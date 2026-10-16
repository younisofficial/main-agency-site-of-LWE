<?php

/*
 * Admin panel to read contact form messages: https://your-site.com/admin
 * Set the password in .env:  ADMIN_PASSWORD=your-strong-password
 * If ADMIN_PASSWORD is empty, the admin panel stays locked.
 */
return [
    'password' => env('ADMIN_PASSWORD'),
];
