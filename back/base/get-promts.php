<?
  require_once 'dbinterface.php';

  $conn = new Dbinterface();

  $res = $conn -> dbSelect( 'promts',  "locale = '{$_GET['locale']}'" );
  $data = json_encode($res[0], JSON_UNESCAPED_UNICODE);
  print_r($data)
?>