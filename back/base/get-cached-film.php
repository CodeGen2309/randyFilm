<?
require_once 'dbinterface.php';


$locale = $_GET['locale'];
$conn = new Dbinterface();

$res = $conn -> dbSelect('films', "locale = '$locale'");

if (count($res) == 0) {
  $res = $conn -> dbSelect('films', "locale = 'en'");
}

$randomID = mt_rand(0, count($res) - 1);
$randomFilm = json_encode($res[$randomID], JSON_UNESCAPED_UNICODE);

print_r($randomFilm);
?>