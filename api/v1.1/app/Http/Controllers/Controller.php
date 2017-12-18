<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    //
    /*
    * @getRandomStringMD5
    *
    * Function to get a random string
    * @param string $length
    * @return string md5($result)
    * @usage - 
    */
    function getRandomStringMD5($length) 
    {
        $validCharacters = "ABCDEFGHIJKLMNPQRSTUXYVWZ123456789". strtotime('now');
        $validCharNumber = strlen($validCharacters);
        $result = "";
        for ($i = 0; $i < $length; $i++)
        {
            $index = mt_rand(0, $validCharNumber - 1);
            $result .= $validCharacters[$index];
        }
        return password_hash($result, PASSWORD_DEFAULT);
        //return md5($result);
    }
}
