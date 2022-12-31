<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class xtreamAPI extends Controller
{
    //
    function getPlayer(Request $request) 
    {
        $requestUrl = $request->fullUrl();
        $query = $request->all();
        
        // Get mapping
        $maps = json_decode(file_get_contents(storage_path() . "/settings.json"), true);

        $params = "";
        foreach($query as $param => $val) {
            //echo "$param = $val<br>";
            if ($params == "") {
                $params = "?";
            } else {
                $params .= "&";
            }
            
            $key = "username";
            if ($param == $key) {
                if( isset( $maps[$val] ) ){
                    $valUsr = $val;
                    $mapUsr = $maps[$val];
                    $params .= $key;
                    $params .= "=";
                    $params .= $mapUsr;
                } else {
                    return response()->json(['error' => 'Unauthenticated!'], 401);
                }
            } else {
                $key = "password";
                if ($param == $key) {
                    if( isset( $maps[$val] ) ){
                        $valPw = $val;
                        $mapPw = $maps[$val];
                        $params .= $key;
                        $params .= "=";
                        $params .= $mapPw;
                    } else {
                        return response()->json(['error' => 'Unauthenticated!'], 401);
                    } 
                } else {    
                $params .= $param;
                $params .= "=";
                $params .= $val;
                }
            }
        }
        
        $path = $maps["path"] . $params;
        $response = Http::get($path);
/*
        $json = json_decode($response);
        foreach($json AS $key => $value) {
            //
            if ($key == "user_info") {
                $json->user_info->username = $valUsr;
                $json->user_info->password = $valPw;
                //echo "Mapped Response: $valUsr <br>";
                //echo "Mapped Response: $valPw <br>";
            } 
        }
        $jsonResponse = json_encode($json);
        //echo "JSON: $jsonResponse<br>";
        return response()->json($json);
*/
        return $response;
    }
}
