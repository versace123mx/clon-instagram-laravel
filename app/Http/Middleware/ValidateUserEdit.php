<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ValidateUserEdit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request,Closure $next): Response
    {

        //dd($request->user()->id,Auth::user()->id);
        //var_dump($request->user()->id);
        //var_dump(Auth::user()->id);
        //var_dump(Auth::user()->username);
        //var_dump($request->user);
        
        if(Auth::user()->username !== $request->user){
            return redirect()->route('index_muro',Auth::user());
        }
        return $next($request);
    }
}
