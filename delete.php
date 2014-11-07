<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>sample</title>
</head>
<body>
<p>

<?php

$debug = True;

if( $debug )
{
	error_reporting(E_ALL);
	ini_set('display_errors','On');

	echo 'Current script owner: ' . get_current_user();

	echo "<pre>";
	echo "\$_POST\n";
	print_r($_POST);
	echo "</pre>";

	echo "<pre>";
	echo "\$_FILES\n";
	print_r($_FILES);
	echo "</pre>";
}

			$connection = new MongoClient;

			$grid = $connection->selectDB( 'test8' )->getGridFS();

			// remove
			$result = $grid->delete( new MongoId( $_POST["id"] ) );


?>

<a href="index.php">top</a>
</body>
</html>

