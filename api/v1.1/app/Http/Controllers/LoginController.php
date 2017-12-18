<?php
/**
	* LoginController.php
	*
	* A Class file for Login and authentication related functions
	*
	* PHP version 5.6 +
	*
	* @category   Login
	* @package    App\Http\Controllers
	* @author     Lijo E John <lijoejohn@gmail.com>
	* @license    http://www.php.net/license/3_01.txt  PHP License 3.01
	* @version    Git: 1.1
	* @link       http://pear.php.net/package/PackageName
	* @return void
*/
 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Hash;
use App\Common;

/**
	* A Class file for Login and authentication related functions
	*
	* @category   Login
	* @package    App\Http\Controllers
	* @version    Git: 1.1
	* @author     Lijo E John <lijoejohn@gmail.com>
*/
class LoginController extends Controller
{
	/**
		* LoginController::construct
		*
		* Registering middleware for logout action, logout action only can access using a valid login token.
		* @category   Login
		* @package    App\Http\Controllers
		* @version    Git: 1.1
		* @author     Lijo E John <lijoejohn@gmail.com>
		* @param null
		* @return object
		* 
	*/
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['logout']]);
    }
	
	/**
		* LoginController::logout
		*
		* Action to handle the logout. We have to make the active user token as inactive on the logout action.
		* @category   Login
		* @package    App\Http\Controllers
		* @version    Git: 1.1
		* @author     Lijo E John <lijoejohn@gmail.com>
		* @param mixed null
		* @return string json data
		* 
	*/
    public function logout()
    {
        $api_token  = CommonController::get_token();
        if (isset($api_token) && $api_token!='')
        {
            DB::table('auth_token')->where(['token' => trim($api_token),'status' =>1,'type'=>1])->delete();
        }
        return response()->json(['status'=>1,'message' => "You have successfully logged out"]);
    }
	
	/**
		* LoginController::auth
		*
		* Action to handle the authentication. This function will be used by the rute with 2 type of input data , either by passing a valid user token or by passing user name and password.
		* @category   Login
		* @package    App\Http\Controllers
		* @version    Git: 1.1
		* @author     Lijo E John <lijoejohn@gmail.com>
		* @param obejct $request
		* @return string json data , on a valid access a successful response and on unauthorised access response with error message.
		* 
	*/
    public function auth(Request $request) 
    {
        $msg        = '';
        $status     = 0;
        $user       = array();
		
        $api_token  = CommonController::get_token();

		$email      = strtolower($request->input('email'));
		$password   = $request->input('password');
	
		//Email and password based authentication
		//On clicking login button
        if($email && trim($email)!='')
        {
            $user_exist = DB::table('users')->select('user_id','first_name','last_name','status','password')->where('email','like', trim($email))->where('status','<>',3);
            
			$user = array();
            if ($user_exist->count() > 0 && trim($email)!='') 
            {
                $user       = ['user_id' =>$user_exist->first()->user_id,'user_name' =>$user_exist->first()->first_name." ".$user_exist->first()->last_name];
				
                if (Hash::check($password, $user_exist->first()->password)) 
                {
                    if ($user_exist->first()->status == 2) 
                    {
                        $msg    = 'Your account is disabled';
                        $status = 0;
                    } 
                    else if ($user_exist->first()->status == 3) 
                    {
                        $msg    = 'Your account is deleted';
                        $status = 0;
                    }
                    else
                    {
                        $token          = $this->getRandomStringMD5(25);
                        DB::table('auth_token')->insert(['user_id' => $user['user_id'], 'token' => $token,'status' =>1,'created'=>date('Y-m-d H:i:s'),'type'=>1]);
                        $user['token']        = $token;
                        $msg    = 'Login success';
                        $status = 1;
                    }
                } 
                else 
                {
                    $msg    = 'Invalid username or password';
                    $status = 0;
                }
            } 
            else 
            {
                $status = 0;
                $msg    = 'Invalid username or password';
            }
        }
		//api_token based authentication
		//On each page load
        else if(isset($api_token) && $api_token!='')
        {
            $auth_token = DB::table('auth_token')->where(['token' => trim($api_token),'status' =>1,'type'=>1]);
            if(isset($auth_token->first()->user_id) && $auth_token->first()->user_id>0)
            {
                $user_exist = DB::table('users')->select('user_id','email','status','first_name','last_name')->where(['user_id' => trim($auth_token->first()->user_id)]);
                $user       = $user_exist->first();
                $user->user_name  = $user->first_name." ".$user->last_name;
                $msg        = 'Login success';
                $status     = 1;
                
            }
            else
            {
                $msg    = 'Invalid token';
                $status = 0;
            }
        }
        else
        {
            $status = 0;
            $msg    = 'Invalid username or password';
        }
        return response()->json(['status'=>$status,'message' => $msg,"data"=>$user]); 
    }
    
}

