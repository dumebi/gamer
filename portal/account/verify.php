<?php
/**
 * Verify SimplePay transaction
 */

$private_key = 'test_pr_7a81426828ee4e75913aba6838f253c3';

// Retrieve data returned in payment gateway callback
$token = $_POST["token"];
$user = '';
if (isset($_SESSION["list_manager"])){
$user = $_SESSION['list_manager'];
}
elseif(isset($_SESSION['google_name'])){
	$user = $_SESSION['google_name'];
}
elseif(isset($_SESSION['FBID'])){      
       $user = $_SESSION['FULLNAME'];
}
$amount = $_POST["amount"];


$data = array (
    'token' => $token
);
$data_string = json_encode($data); 

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://checkout.simplepay.ng/v1/payments/verify/');
curl_setopt($ch, CURLOPT_USERPWD, $private_key . ':');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string)
));

$curl_response = curl_exec($ch);
$curl_response = preg_split("/\r\n\r\n/",$curl_response);
$response_content = $curl_response[1];
$json_response = json_decode(chop($response_content), TRUE);

$response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);

if ($response_code == '200') {
    // even is http status code is 200 we still need to check transaction had issues or not
    if ($json_response['response_code'] == '20000'){
		$insertCard = mysqli_query($conn, "insert into payment (user, amount, pay_date) values ('$user','$amount',now())") or die(mysqli_error($conn));
        header('Location: success.html');
    }else{
        header('Location: failed.html');
    }
} else {
    header('Location: failed.html');
}
?>
