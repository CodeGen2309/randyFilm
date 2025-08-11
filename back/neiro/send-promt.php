<?
function sendRequest($message) {
  $file     = file_get_contents('../tokens.local');
  $token    = json_decode($file, true);

  // $neiroURL = $token['n8nProd'];
  $neiroURL = $token['n8nTest'];

  $crlReq = curl_init();
  $crlBody = json_encode(
    ['message' => $message, 'ip' => $_SERVER['REMOTE_ADDR']]
  );

  curl_setopt_array(
    $crlReq, 
    [
      CURLOPT_URL => $neiroURL,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
      CURLOPT_POST => true,
      CURLOPT_POSTFIELDS => $crlBody
    ]
  );

  $crlRes = curl_exec($crlReq);
  curl_close($crlReq);

  $arResult = [
    'body' => $crlBody,
    'response' => $crlRes,
  ];

  return $arResult;
}


$res = sendRequest('Посоветуй крутой фильм');

?>

<pre style = "max-width: 100%;">
  <? print_r($res) ?>
</pre>