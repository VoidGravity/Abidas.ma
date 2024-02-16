<?php

namespace App\Http\Middleware;

use App\Models\RolePermission;
use App\Models\route;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $aloowedRoutes = ['login', 'register'];

        $uri = $request->route()->uri;
        // dd($uri);
        
        // if (in_array($uri, $aloowedRoutes)) {
        //     return $next($request);
        // }
        
        $role_id = session('LoggedUser') ?? '';
        
        // dd($role_id);
        
        if ($role_id) {
            $allowedRoutesMiddle = RolePermission::where('role_id', $role_id)->get();
            $allowedRouteIds = $allowedRoutesMiddle->pluck('route_id');
            $allowedRoutes = route::whereIn('id', $allowedRouteIds)->get();

            // dd($allowedRoutes);
            foreach ($allowedRoutes as $allowedRoute) {
                $allowedUri = $allowedRoute->route;
                // dd($allowedUri);


                if (count(explode('/', $uri)) > 2) {
                    if (strstr($uri, $allowedUri)) {

                        return $next($request);
                    }
                } else {
                    // Check if the current URI matches the allowed URI
                    if ($uri === $allowedUri) {
                        return $next($request);
                    }
                }
            }

            // If the URI is not allowed for the role, redirect to 'Notfound'
            return redirect()->to('login');
        } else {
            // If there is no role_id in the session, redirect to 'Notfound'
            return redirect()->to('login');
        }
    }
    // public function handle(Request $request, Closure $next): Response
    // {
    //     // Define public routes that do not require permission
    //     $publicRoutes = ['/', 'login', 'register', 'products', 'getLogin'];

    //     // Get the URI of the current request
    //     $uri = $request->route()->uri;

    //     // Check if the URI is in the public routes, if so, allow the request to proceed
    //     if (in_array($uri, $publicRoutes)) {
    //         return $next($request);
    //     }

    //     // Get the role_id from the session
    //     $role_id = session('role_id') ?? '';


    //     if ($role_id) {
    //         // Retrieve the allowed routes for the given role_id
    //         $allowedRoutes = RolePermission::where('role_id', $role_id)->get();

    //         foreach ($allowedRoutes as $allowedRoute) {
    //             // Get the allowed URI for each route
    //             $allowedUri = $allowedRoute->uri;
    //             dd($allowedUri);


    //             // Check if the URI has more than two segments
    //             if (count(explode('/', $uri)) > 2) {
    //                 // Check if the allowed URI is present in the current URI
    //                 if (strstr($uri, $allowedUri)) {

    //                     return $next($request);
    //                 }
    //             } else {
    //                 // Check if the current URI matches the allowed URI
    //                 if ($uri === $allowedUri) {
    //                     return $next($request);
    //                 }
    //             }
    //         }

    //         // If the URI is not allowed for the role, redirect to 'Notfound'
    //         return redirect()->to('getLogin');
    //     } else {
    //         // If there is no role_id in the session, redirect to 'Notfound'
    //         return redirect()->to('getLogin');
    //     }
    // }
    // public function handle(Request $request, Closure $next , $role): Response
    // {

    //     if (Auth::check() && Auth::user()->role == $role) {
    //         abort(403, 'You are not authorized to access this page');
    //     }
    //     return $next($request);
    // }
}
