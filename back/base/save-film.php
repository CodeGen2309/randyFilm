<?
require_once 'dbinterface.php';

$post = file_get_contents('php://input');
$data = json_decode($post);

$db = new Dbinterface();
$res = $db -> saveFilm(
  $data -> locale, $data -> title, 
  $data -> poster, $data -> desc
);

?>



<pre>
  <? var_dump($data); ?>
  <? print_r($res) ?>
</pre>