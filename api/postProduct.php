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

$postdata = file_get_contents("php://input");
$request  = json_decode($postdata);

@$UserID      = $request->UserID;
@$ProductName = $request->ProductName;
@$Species     = $request->Species;
@$Detail      = $request->Detail;
@$Price       = $request->Price;
@$Quantity    = $request->Quantity;
@$HarvestDay  = $request->HarvestDay;
@$Address     = $request->Address;
@$SubDistrict = $request->SubDistrict;
@$District    = $request->District;
@$Province    = $request->Province;
@$Zipcode     = $request->Zipcode;
@$Latitude    = $request->Latitude;
@$Longitude   = $request->Longitude;
/*=================================
=            Condition            =
=================================*/
@$UserType = $request->UserType;

if ($UserType == 'buyer') {
    $table = 'tb_buying';
    // check ID
    try {
        $stmt = $conn->prepare("SELECT Max(substr(RequestID,-6))+1 AS MaxID FROM $table");
        $stmt->execute();

        $result = $stmt->fetchAll();
        if ($result[0]['MaxID'] == '') {
            $RequestID = "B000001";
        } else {
            $RequestID = "B" . sprintf("%06d", $result[0]['MaxID']);
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} elseif ($UserType == 'farmer') {
    $table = 'tb_selling';
    // check ID
    try {
        $stmt = $conn->prepare("SELECT Max(substr(RequestID,-6))+1 AS MaxID FROM $table");
        $stmt->execute();

        $result = $stmt->fetchAll();
        if ($result[0]['MaxID'] == '') {
            $RequestID = "S000001";
        } else {
            $RequestID = "S" . sprintf("%06d", $result[0]['MaxID']);
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
/*=====  End of Condition  ======*/

/*=================================
=      INSERT BUYER PRODUCT      =
=================================*/

// insert data
try {
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("INSERT INTO $table (RequestID,UserID,ProductName,Species,Detail,Price,Quantity,HarvestDay,Address,SubDistrict,District,Province,Zipcode,Latitude,Longitude,AcceptCondition,CreateDate)
                        VALUES (:RequestID,:UserID,:ProductName,:Species,:Detail,:Price,:Quantity,:HarvestDay,:Address,:SubDistrict,:District,:Province,:Zipcode,:Latitude,:Longitude,:AcceptCondition,:CreateDate)");

// Go Insert
    $stmt->execute(array(
        'RequestID'       => $RequestID,
        'UserID'          => $UserID,
        'ProductName'     => $ProductName,
        'Species'         => $Species,
        'Detail'          => $Detail,
        'Price'           => $Price,
        'Quantity'        => $Quantity,
        'HarvestDay'      => $HarvestDay,
        'Address'         => $Address,
        'SubDistrict'     => $SubDistrict,
        'District'        => $District,
        'Province'        => $Province,
        'Zipcode'         => $Zipcode,
        'Latitude'        => $Latitude,
        'Longitude'       => $Longitude,
        'AcceptCondition' => true,
        'CreateDate'      => date("Y-m-d H:i:s"),
    ));
    $res['message'] = "Insert";
    echo json_encode($res, JSON_PRETTY_PRINT);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

/*=====  End of Condition  ======*/
