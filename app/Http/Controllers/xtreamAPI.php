<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class xtreamAPI extends Controller
{
    //
    function getPlayer(Request $request) 
    {
        $requestUrl = $request->fullUrl();
        $query = $request->all();
        $params = "";
        foreach($query as $param => $val) {
            echo "$param = $val<br>";
            if ($params == "") {
                $params = "?";
            } else {
                $params .= "&";
            }
            
            $key = "username";
            if ($param == $key) {
                $params .= $key;
                $params .= "=";
                $params .= $val;
            } else {
                $key = "password";
                if ($param == $key) {
                    $params .= $key;
                    $params .= "=";
                    $params .= $val;
                }
            }
        }
        
        //$response = Http::get('https://line.4k-feast.com/player_api.php');
        return ["request"=>$params];
    }
}
