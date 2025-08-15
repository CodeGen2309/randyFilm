<?
require_once 'dbinterface.php';


$locale = $_GET['locale'];
$conn = new Dbinterface();

$res = $conn -> dbSelect('films', "locale = '$locale'");
$randomID = mt_rand(0, count($res) - 1);
$randomFilm = json_encode($res[$randomID], JSON_UNESCAPED_UNICODE);

print($randomFilm);
?>