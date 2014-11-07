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

$IsFileUploaded = False;
if( $_FILES["upfile"]["error"] == UPLOAD_ERR_OK )
{
	$IsFileUploaded = True;
}

if( $debug )
{
	var_dump( $IsFileUploaded );
}

if( True )
{
if( $IsFileUploaded )
{
	if( is_uploaded_file($_FILES["upfile"]["tmp_name"] ) )
	{
		if( move_uploaded_file( $_FILES["upfile"]["tmp_name"], "files/" . $_FILES["upfile"]["name"] ) )
		{
			chmod( "files/" . $_FILES["upfile"]["name"], 0644 );
			echo $_FILES["upfile"]["name"] . "をアップロードしました。";

			//// //// //// //// //// //// //// ////
			$connection = new MongoClient;
			$grid = $connection->selectDB( 'test8' )->getGridFS();

			// remove
			$grid->delete( new MongoId( $_POST["id"] ) );

			// add
			$id = $grid->storeFile( "files/" . $_FILES["upfile"]["name"],
						array(
							"upfile"     => $_FILES["upfile"]["name"],
							"uptype"     => $_FILES["upfile"]["type"],
							"uptitle"    => $_POST["uptitle"],
							"upcategory" => $_POST["upcategory"],
							"upauthor"   => $_POST["upauthor"],
							) );
		}
		else
		{
			echo "ファイルをアップロードできません。";
		}
	}
	else
	{
		echo "ファイルが選択されていません。";
	}
}
else
{
	$connection = new MongoClient;
	$grid = $connection->selectDB( 'test8' )->getGridFS();

	$grid->update( array( "_id" => new MongoId( $_POST["id"] ) ), array( '$set' => array( 
							"uptitle"    => $_POST["uptitle"],
							"upcategory" => $_POST["upcategory"],
							"upauthor"   => $_POST["upauthor"],
							) ) );
	echo "update completed.";
}
}


?>

<a href="main8.php">top</a>
</body>
</html>

