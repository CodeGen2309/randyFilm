<?

function sendMessage($message) {
  $file     = file_get_contents('../tokens.json');
  $tokens   = json_decode($file, true);
  // $neiroURL = $tokens['n8nTest'];
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


// $raw = file_get_contents('php://input');
// $data = json_decode($raw);
?>