<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        // Check if user is authenticated
        if (!$user) {
            return redirect('/login')->with('error', 'Please log in first.');
        }

        // Check if user is an admin (using email-based check)
        // You can customize the admin check logic here
        $adminEmails = [
            'admin@cedarmind.com',
            'test1@example.com', // For testing with seeded user
        ];
        $adminPasswords = [
            'Admin@123', // For testing with seeded user
        ];
        if (!in_array($user->email, $adminEmails)) {
            return redirect('/')->with('error', 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}
