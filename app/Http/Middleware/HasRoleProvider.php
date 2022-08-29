<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Domains\Authentication\Models\User;

class HasRoleProvider
{


    protected Request $request;
    protected User $user;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->user = Auth::user();
    }        
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
    
        if (! $this->user::hasRole(User::PROVIDER_ROLE) ) {
            return response()->json([
                'message' => 'You are not authorized to access this resource.',
                'success' => false
            ], 401);
        }
        
        return $next($request);
    }
}
