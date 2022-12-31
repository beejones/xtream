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
                    $map = $maps[$val];
                    $params .= $key;
                    $params .= "=";
                    $params .= $map;
                } else {
                    return response()->json(['error' => 'Unauthenticated.'], 401);
                }
            } else {
                $key = "password";
                if ($param == $key) {
                    if( isset( $maps[$val] ) ){
                        $map = $maps[$val];
                        $params .= $key;
                        $params .= "=";
                        $params .= "56F738";
                    } else {
                        return response()->json(['error' => 'Unauthenticated.'], 401);
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
        return $response;
    }
}
