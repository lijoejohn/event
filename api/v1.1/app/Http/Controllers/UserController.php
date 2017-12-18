<?php
/**
	* UserController.php
	*
	* A Class file for user related actions
	*
	* PHP version 5.6 +
	*
	* @category   User
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
use Validator;
use App\Http\Controllers\CommonController;

/**
	* A Class file for user related actions
	*
	* @category   User
	* @package    App\Http\Controllers
	* @version    Git: 1.1
	* @author     Lijo E John <lijoejohn@gmail.com>
*/
class UserController extends Controller
{
	
	/**
		* UserController::get_all_user_list
		*
		* Action to handle the user listing. This function is using to get all the active registred users by passing a valid user token .
		* @category   User
		* @package    App\Http\Controllers
		* @version    Git: 1.1
		* @author     Lijo E John <lijoejohn@gmail.com>
		* @param null
		* @return string json data , on a valid access a successful response with all the active registred users and on unauthorised access response with error message.
		* 
	*/
    public function get_all_user_list() 
    {
		$api_token  	= CommonController::get_token();
		
		$user_exist 	= DB::table('auth_token')->select('user_id')->where(['token' => trim($api_token),'status' =>1,'type'=>1]);

		if(isset($user_exist->first()->user_id) && $user_exist->first()->user_id>0)
		{
			$user_id    = $user_exist->first()->user_id;
			
			$user = DB::table('users')->select("user_id",DB::raw("CONCAT(first_name, ' ', last_name) as user_name"))->where('users.status', 1)->where('user_id','<>', $user_id)->get();
			
			return response()->json(["status"=>1,"results"=>["users"=>$user]],200); 

		}
		else
		{
			$msg    = 'Invalid token';
            $status = 0;
			return response()->json(["status"=>0,'message' => $msg,"results"=>["users"=>array()]],200); 
		}
    }

	/**
		* UserController::get_all_invites_list
		*
		* Action to handle the invites listing. This function is using to get all the active registred invites by passing a valid user token and event_id.
		* @category   User
		* @package    App\Http\Controllers
		* @version    Git: 1.1
		* @author     Lijo E John <lijoejohn@gmail.com>
		* @param Request $request
		* @return string json data , on a valid access a successful response with all the active registred invites and on unauthorised access response with error message.
		* 
	*/
    public function get_all_invites_list(Request $request) 
    {
		$api_token  	= CommonController::get_token();
		
		$user_exist 	= DB::table('auth_token')->select('user_id')->where(['token' => trim($api_token),'status' =>1,'type'=>1]);

		if(isset($user_exist->first()->user_id) && $user_exist->first()->user_id>0)
		{
			$event_id  	= $request->input('event_id');
			$user_id    = $user_exist->first()->user_id;
			$user 		= DB::table('users')->select("users.user_id","users.user_name","users.created_on",DB::raw("CONCAT(first_name, ' ', last_name) as name"))->where('users.status', 1)->where('events_invites.event_id', $event_id)->join('events_invites', 'events_invites.user_id', '=', 'users.user_id')->groupBy('users.user_id')->get();
			return response()->json(["status"=>1,"results"=>["users"=>$user]],200); 

		}
		else
		{
			$msg    = 'Invalid token';
            $status = 0;
			return response()->json(["status"=>0,'message' => $msg,"results"=>["users"=>array()]],200); 
		}
    }	
	
	/**
		* UserController::add_event
		*
		* Action to handle the creation of event. This function is using to add a new event by passing a valid user token .
		* @category   User
		* @package    App\Http\Controllers
		* @version    Git: 1.1
		* @author     Lijo E John <lijoejohn@gmail.com>
		* @param Request $request
		* @return string json data , on a valid access a successful response with all the active events and on unauthorised access response with error message.
		* 
	*/
    public function add_event(Request $request) 
    {
		$api_token  	= CommonController::get_token();
		$user_exist 	= DB::table('auth_token')->select('user_id')->where(['token' => trim($api_token),'status' =>1,'type'=>1]);

		if(isset($user_exist->first()->user_id) && $user_exist->first()->user_id>0)
		{
			$user_id    = $user_exist->first()->user_id;
			
			$event_name     	= substr(strip_tags($request->input('event_name')), 0, 60);
			$event_time      	= strip_tags($request->input('event_date'));
			$event_lat      	= $request->input('lat');
			$event_long      	= $request->input('lng');
			$event_address  	= strip_tags($request->input('formatted_address'));
			$event_type      	= ($request->input('event_type')==1?1:2);
			$checked_users      = $request->input('checked_users');
			
			$rules          = array('event_name'  => 'required','event_date' => 'required','lat'  => 'required','lng' => 'required','formatted_address'  => 'required','event_type' => 'required');
			$validator      = Validator::make($request->all(),$rules);
			$error_array    = array();
			if ($validator->fails())
			{
				$errors = $validator->errors();
				foreach($rules as $key => $value)
				{
					if($errors->has($key))
					{
						$error_array[$key]  = $errors->first($key);
					}
				}
				$msg    = "Validation error";
				$status = 0;
				return response()->json(['status'=>$status,'message' => $msg, 'error_array' => $error_array, "error_index"=>1]);
			}
		
			$event_pkey = DB::table('events')->insertGetId(['event_name' => $event_name, 'event_time' => $event_time,'event_lat' =>$event_lat, 'event_long' => $event_long, 'event_address' => $event_address, 'type' => $event_type,'created_by'=>$user_id]);
			if(isset($checked_users) && count($checked_users) >0)
			{
				$dataSet = [];
				foreach ($checked_users as $user)
				{
					$dataSet[] = [
						'event_id'  => $event_pkey,
						'user_id'    => $user
					];
				}
				DB::table('events_invites')->insert($dataSet);
			}
			$data 		= DB::table('events')->select("users.user_name as host_name","events.event_id","event_name as event_title","event_time as event_time",DB::raw("CONCAT(event_address) as event_location"))->where('events_invites.user_id', trim($user_id))->orWhere('events.type', '1')->orWhere('events.created_by',trim($user_id))->leftJoin('events_invites', 'events_invites.event_id', '=', 'events.event_id')->join('users', 'users.user_id', '=', 'events.created_by')->orderBy('event_time', 'asc')->groupBy('events.event_id')->get();
			$msg    	= 'Success';
			$status 	= 1;
			return response()->json(['status'=>$status,'message' => $msg,"results"=>$data]); 
		}
		else
		{
			$msg    = 'Invalid token';
            $status = 0;
			return response()->json(["status"=>0,'message' => $msg,"results"=>["users"=>array()]],200); 
		}
    }
	
	/**
		* UserController::register_user
		*
		* Action to handle the user registration. This function is using to add users to the database by passing a valid client id.
		* @category   User
		* @package    App\Http\Controllers
		* @version    Git: 1.1
		* @author     Lijo E John <lijoejohn@gmail.com>
		* @param obejct $request
		* @return string json data , on a valid access a successful response with the user details and on unauthorised access response with error message.
		* 
	*/
	public function register_user(Request $request) 
    {
        $status     = 0;
        $msg        = "";
        $data       = array();

		$first_name     = strip_tags($request->input('first_name'));
		$last_name      = strip_tags($request->input('last_name'));
		
		$rules          = array('first_name'  => 'required','last_name' => 'required');
		$validator      = Validator::make($request->all(),$rules);
		$error_array    = array();
		if ($validator->fails())
		{
			$errors = $validator->errors();
			foreach($rules as $key => $value)
			{
				if($errors->has($key))
				{
					$error_array[$key]  = $errors->first($key);
				}
			}
			$msg    = "Validation error";
			return response()->json(['status'=>$status,'message' => $msg, 'error_array' => $error_array, "error_index"=>1]);
		}

		$email          		= strtolower($request->input('email'));
		$password       		= $request->input('password');
		$password_confirmation  = $request->input('password_confirmation');

		$rules          = array('email'  => 'required|email','password' => 'required|confirmed', 'password_confirmation'  => 'required');
		$validator      = Validator::make($request->all(),$rules);
		$error_array    = array();
		if ($validator->fails())
		{
			$errors = $validator->errors();
			foreach($rules as $key => $value)
			{
				if($errors->has($key))
				{
					$error_array[$key]  = $errors->first($key);
				}
			}
			$msg    = "Validation error";
			return response()->json(['status'=>$status,'message' => $msg, 'error_array' => $error_array, "error_index"=>1]);
		}

        $user = DB::select('select user_id from users where lower(email)=:email and (status=1 or status=2)', ['email' =>$email]);

        if(isset($user[0]) && isset($user[0]->user_id) && $user[0]->user_id >0)
        {
			$msg                    = "Email already exists";
			$error_array['email']   = "Email already exists";
			return response()->json(['status'=>$status,'message' => $msg, 'error_array' => $error_array, "error_index"=>2],200);
        }
     

        $password_hash  = password_hash(hash('sha512', $password, true), PASSWORD_DEFAULT);
        $password_hash  = password_hash($password, PASSWORD_DEFAULT);
        $token          = $this->getRandomStringMD5(10);

        DB::table('users')->insert(['user_name' => $email, 'password' => $password_hash,'first_name' =>$first_name, 'last_name' => $last_name, 'email' => $email, 'password' => $password_hash,'created_on'=>date('Y-m-d H:i:s'),'status'=>1]);
        $user_exist         = DB::table('users')->select('user_id','status','first_name','last_name')->where(['email' =>$email,'status'=>1]);
        DB::table('auth_token')->insert(['user_id' => $user_exist->first()->user_id, 'token' => $token,'status' =>1,'created'=>date('Y-m-d H:i:s'),'type'=>1]);

        $status = 1;
        $msg    = "Registration Success";
        
		$data 	= $user_exist->first();
		$data->token = $token;
		$data->user_name = $data->first_name." ".$data->last_name;
        return response()->json(['status'=>$status,'message' => $msg,"data"=>$data]);
    }
	
	/**
		* UserController::get_dashboard_data
		*
		* Action to handle the dashboard listing. This function is using to get the active upcoming events by passing a valid client id or user token.
		* @category   User
		* @package    App\Http\Controllers
		* @version    Git: 1.1
		* @author     Lijo E John <lijoejohn@gmail.com>
		* @param obejct $request
		* @return string json data , on a valid access a successful response with the active upcoming events and on unauthorised access response with error message.
		* 
	*/
	public function get_dashboard_data(Request $request) 
    {
        $msg        = '';
        $status     = 0;
        $data 		= array();
		
        $api_token  = CommonController::get_token();

        if(isset($api_token) && $api_token!='')
        {
            $user_exist = DB::table('auth_token')->select('user_id')->where(['token' => trim($api_token),'status' =>1,'type'=>1]);
            if(isset($user_exist->first()->user_id) && $user_exist->first()->user_id>0)
            {
                $data 		= array();
                $user_id    = $user_exist->first()->user_id;
  
				$data 		= DB::table('events')->select("users.user_name as host_name","events.event_id","event_name as event_title","event_time as event_time",DB::raw("CONCAT(event_address) as event_location"))->where('events_invites.user_id', trim($user_id))->orWhere('events.created_by',trim($user_id))->orWhere('events.type', '1')->leftJoin('events_invites', 'events_invites.event_id', '=', 'events.event_id')->join('users', 'users.user_id', '=', 'events.created_by')->orderBy('event_time', 'asc')->groupBy('events.event_id')->get();
                $status 	= 1;
            }
            else
            {
                $data 		= DB::table('events')->select("users.user_name as host_name","events.event_id","event_name as event_title","event_time as event_time",DB::raw("CONCAT(event_address) as event_location"))->Where('events.type', '1')->leftJoin('events_invites', 'events_invites.event_id', '=', 'events.event_id')->join('users', 'users.user_id', '=', 'events.created_by')->orderBy('event_time', 'asc')->groupBy('events.event_id')->get();
                $status 	= 1;
            }
        }
        else
        {
            $data 		= DB::table('events')->select("users.user_name as host_name","events.event_id","event_name as event_title","event_time as event_time",DB::raw("CONCAT(event_address) as event_location"))->Where('events.type', '1')->leftJoin('events_invites', 'events_invites.event_id', '=', 'events.event_id')->join('users', 'users.user_id', '=', 'events.created_by')->orderBy('event_time', 'asc')->groupBy('events.event_id')->get();
            $status 	= 1;
        }
		
		return response()->json(['status'=>$status,'message' => $msg,"results"=>$data]);    
    }

}
