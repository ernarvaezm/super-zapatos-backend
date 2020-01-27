<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;
use Illuminate\Foundation\Applicaion;
use Illuminate\Http\Response;

class CORS {

  /**
  * Handle an incoming request.
  *
  * @param \Illuminate\Http\Request $request
  * @param \Closure $next
  * @return mixed
  */
  public function handle($request, Closure $next)
  {
    $headers = [
      'Access-Control-Allow-Origin' => '*',
      'Access-Control-Allow-Methods' => 'GET, POST, PUT, PATCH, DELETE, OPTIONS',
      'Access-Control-Allow-Headers' => 'Accept, Authorization, Content-Type, x-event-id',
    ];

    $response = $next($request);

    // Add headers to request
    foreach ($headers as $key => $value)
    {
      $response->headers->set($key, $value);
    }
    return $response;
    // }
    //  public function handle($request, Closure $next)
    //  {
    //       $response = $next($request);
    //        $response->headers->set('Access-Control-Allow-Origin' , '*');
    //        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE');
    //        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With, Application');
    //
    //     return $response;
    //  }
  }}
