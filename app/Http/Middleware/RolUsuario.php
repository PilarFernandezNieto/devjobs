<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RolUsuario
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) // En Kernel.php
    {

        if($request->user()->rol === 1){ // Configurar en Kernel.php (como rol.reclutador)
            // En caso de no ser recruiter
            return redirect()->route('home');
        }
        return $next($request);
    }
}
