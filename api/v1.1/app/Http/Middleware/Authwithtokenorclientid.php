<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use App\Http\Controllers\CommonController;

class Authwithtokenorclientid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $api_token      = $request->input('api_token');
        $rest           = $request->get("rest");
        if($rest)
        {
            if($api_token == "")
            {
                $api_token  = $this->getBearerToken($request->header('authorization'));
            }
            if ($api_token && $api_token!='') 
            {
                $auth_token = DB::table('auth_token')->where(['token' => trim($api_token)]);
                if(isset($auth_token->first()->user_id) && $auth_token->first()->user_id>0)
                {
                    $user_exist = DB::table('users')->where(['user_id' => trim($auth_token->first()->user_id)]);
                    $user       = $user_exist->first();
                    return $next($request);
                }
            }
            else
            {
                $verify_client  = CommonController::verify_client();
                if(!$verify_client)
                {
                    return response()->json(["code"=>401,"message"=>"UnAuthorised","description"=>"UnAuthorised"],401);
                }
                else
                {
                    return $next($request);
                }
            }
            return response()->json(["code"=>401,"message"=>"UnAuthorised","description"=>"UnAuthorised"],401);
        }
        else
        {
            return $next($request);
        }
    }


    /**
    * get access token from header
    * */
    public function getBearerToken($headers='') 
    {
        // HEADER: Get the access token from the header
        if (!empty($headers)) 
        {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches))
            {
                return $matches[1];
            }
        }
        return null;
    }
}
