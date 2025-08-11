<?

$data = array(
	'name'  => 'Маффин',
	'price' => 100.0
);		
 
$ch = curl_init('http://176.194.115.56:3000/get-cached-film/ru');
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
// curl_setopt($ch, CURLOPT_POST, 1);
// curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE)); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);


$res = curl_exec($ch);
curl_close($ch);
 
$res = json_encode($res, JSON_UNESCAPED_UNICODE);
print_r($res);


?>