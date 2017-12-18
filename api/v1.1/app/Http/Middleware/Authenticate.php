<?php 

namespace App\Http\Middleware;
use Closure;
use DB;
class Authenticate
{

    public function handle($request, Closure $next)
    {

        //var_dump($request->header());
        //print_r($request->headers->all());
        //echo $api_token     = $request->header('authorization');exit;
        $api_token          = $request->input('api_token');
        if($api_token == "")
        {
            $api_token  = $this->getBearerToken($request->header('authorization'));
        }
        if ($api_token) 
        {
            $auth_token = DB::table('auth_token')->where(['token' => trim($api_token)]);
            if(isset($auth_token->first()->user_id) && $auth_token->first()->user_id>0)
            {
                $user_exist = DB::table('users')->where(['user_id' => trim($auth_token->first()->user_id)]);
                $user       = $user_exist->first();
                return $next($request);
            }
            else
            {
                return response()->json(['status'=>401,'message' => "Unauthorized"],401);
            }

        }
        return response()->json(['status'=>401,'message' => "Unauthorized"],401);
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