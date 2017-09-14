<?php
// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400'); // cache for 1 day
}
// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    }

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    }
}
header('Content-Type: application/json');
date_default_timezone_set("Asia/Bangkok");

// include Connection file
include_once "../_connect.php";
// Point to where you downloaded the phar
include('httpful.phar');

$postdata = file_get_contents("php://input");
$request  = json_decode($postdata);

@$Phone = $request->Phone;
@$PWD = $request->PWD;

/*=================================
=      Passing to login API       =
=================================*/
$uri = "http://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?Method=Check_Login&Phone=" . $username . "&PWD=" . $password . "";
$response = \Httpful\Request::post($uri)
  ->contentType("text/html; charset=utf-8")
  ->send();

if ($response == "True") {
  echo 'Login status '. $response;
} else {
  echo 'Login status '. $response;
}

/*=====  End of Condition  ======*/
