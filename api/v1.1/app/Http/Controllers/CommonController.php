<?php
/**
	* CommonController.php
	*
	* A Class file for common functions
	*
	* PHP version 5.6 +
	*
	* @category   Common
	* @package    App\Http\Controllers
	* @author     Lijo E John <lijoejohn@gmail.com>
	* @license    http://www.php.net/license/3_01.txt  PHP License 3.01
	* @version    Git: 1.1
	* @link       http://pear.php.net/package/PackageName
	* @return void
*/
namespace App\Http\Controllers;
use Request;
/**
	* A Class file for common functions
	*
	* @category   Common
	* @package    App\Http\Controllers
	* @version    Git: 1.1
	* @author     Lijo E John <lijoejohn@gmail.com>
*/
class CommonController
{
	/**
		* CommonController::get_token
		*
		* Function to get the Bearer authorization token from http request header.
		* @category   Common
		* @package    App\Http\Controllers
		* @version    Git: 1.1
		* @author     Lijo E John <lijoejohn@gmail.com>
		* @param mixed null
		* @return string Bearer authentication token
		* 
	*/
    public static function get_token() 
    {
        $headers 	= Request::header('authorization'); 
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
	
	/**
		* CommonController::verify_client
		*
		* Function to verify public http request, each public api will comes with a client_id and client_secret params.
		* @category   Common
		* @package    App\Http\Controllers
		* @version    Git: 1.1
		* @author     Lijo E John <lijoejohn@gmail.com>
		* @param mixed null
		* @return bool
		* 
	*/
    public static function verify_client() 
    {
        $client     = Request::input('client');

        $client_id      = config('app.client_id');
        $client_secret  = config('app.client_secret');
        if($client_id==$client['id'] && $client_secret==$client['secret'])
        {
            return true;
        }   
        else
        {
            return false;
        }
    }
    
}
