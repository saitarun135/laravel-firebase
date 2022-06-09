<?php

namespace App\Http\Middleware;

use App\Services\FirebaseService;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Firebase
{
    public function __construct(FirebaseService $database){
        $this->database = $database;
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
        try{
            $verifiedIdToken = $this->database->authConnect()->verifyIdToken($request->bearerToken());
            return $next($request);
        }catch(Exception $e){
            throw new Exception('un quthorized');
        }
    //     if($verifiedIdToken)
    //         return $next($request);
    //     else
    //    return response()->json(['no access']);
    }
}
