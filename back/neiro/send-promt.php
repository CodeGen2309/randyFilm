<?

function sendPromt($message) {
  $file     = file_get_contents('../tokens.json');
  $tokens   = json_decode($file, true);
  // $neiroURL = $token['n8nTest'];
  $neiroURL = $tokens['n8nProd'];

  $crlReq  = curl_init();
  $body     = json_encode([ 'message' => $message, 'ip' => $_SERVER['REMOTE_ADDR'] ]);

  curl_setopt_array( $crlReq, 
    [
      CURLOPT_URL            => $neiroURL,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
      CURLOPT_POST           => true,
      CURLOPT_POSTFIELDS     => $body,
    ]
  );

  $crlRes = curl_exec($crlReq);
  curl_close($crlReq);

  return $crlRes;
}



// $res = sendPromt($_POST['message']);
// print(json_encode($res));
// $data = json_decode($_POST);

$raw = file_get_contents('php://input');
$data = json_decode($raw);
$res = sendPromt($data -> message);
print_r($res)
?>