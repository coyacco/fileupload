<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>sample</title>
</head>
<body>
<p>

<?php

error_reporting(E_ALL);
ini_set('display_errors','On');

echo 'Current script owner: ' . get_current_user();

echo "<pre>";
print_r($_POST);
echo "</pre>";

echo "<pre>";
print_r($_FILES);
echo "</pre>";

if( is_uploaded_file($_FILES["upfile"]["tmp_name"] ) )
{
  if( move_uploaded_file( $_FILES["upfile"]["tmp_name"], "files/" . $_FILES["upfile"]["name"] ) )
  {
    chmod( "files/" . $_FILES["upfile"]["name"], 0644 );
    echo $_FILES["upfile"]["name"] . "をアップロードしました。";
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


//// //// //// //// //// //// //// ////

$connection = new MongoClient;

$grid = $connection->selectDB( 'test8' )->getGridFS();

$id = $grid->storeFile( "files/" . $_FILES["upfile"]["name"],
			array(
				"upfile"     => $_FILES["upfile"]["name"],
				"uptype"     => $_FILES["upfile"]["type"],
				"uptitle"    => $_POST["uptitle"],
				"upcategory" => $_POST["upcategory"],
				"upauthor"   => $_POST["upauthor"],
				) );

?>

<a href="main8.php">top</a>
</body>
</html>

