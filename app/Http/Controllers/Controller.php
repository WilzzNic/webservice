<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Auth;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function grantIfRole(string $role){
      $user = Auth::user();
      if(unserialize($user->roles) !== $role){
        //then throw exception
        throw new AccessDeniedHttpException(Auth::user()->name . ', bukan admin');
        // return response()->json(['error' => Au0th::user()->name . 'not an admin'], 403);
      }
    } 
}
