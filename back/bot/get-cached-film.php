<?

function setConnection () {
	$conn = new mysqli(
		'localhost',         'u2824440_randyFilm', 
		'jN2aO0sS6efK8pA7',  'u2824440_randyFilm'
	);

	return $conn;
}

// $locale = $_POST['locale'] || 'ru';
$locale    = 'ru';
$conn      = setConnection();

$query   = "SELECT * FROM films WHERE COL2='ru'";
$result  = $conn -> query($query);
$resData = $result -> fetch_all(MYSQLI_ASSOC);

?>



<pre style = "max-width: 100%;">
  <? print_r($resData) ?>
</pre>