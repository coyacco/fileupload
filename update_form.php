<?php

$debug = False;

if( $debug )
{
	error_reporting(E_ALL);
	ini_set('display_errors','On');
}

$connection = new MongoClient;

$grid = $connection->selectDB('test8')->getGridFS();
$data = $grid->findOne( array( '_id' => new MongoId( $_POST["id"] ) ) );

if( $debug )
{
	echo "<pre>";
	var_dump( $_POST );
	echo "</pre>";
	echo "<pre>";
	echo "<hr>";

	var_dump( $grid );
	echo "</pre>";
	echo "<hr>";

	echo "<pre>";
	var_dump( $data );
	echo "</pre>";
	echo "<hr>";

	//echo "<pre>";
	//var_dump( $data->file['upfile'] );
	//echo "</pre>";
	//echo "<hr>";
}

//$image = $images->findOne( array( 'upfile' => $_REQUEST["downfile"] ) );
//$image = $images->findOne( $_REQUEST["downfile"]);
//$image = $images->findOne( $_REQUEST["downfile"]);

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>updata form</title>
</head>
<body>
<form action="update.php" method="POST" enctype="multipart/form-data">
<div>
file：
  <input type="file" name="upfile">
</div>
<div>
title:
  <input type="text" name="uptitle" value="<?php echo $data->file['uptitle']?>">
</div>
<div>
category:
  <select name="upcategory">
  <option value="a">aa</option>
  <option value="b">bb</option>
  <option value="c">cc</option>
  </select>
</div>
<div>
author:
  <input type="text" name="upauthor" value="<?php echo $data->file['upauthor']?>">
</div>
<div>
<input type="hidden" name="id" value="<?php echo $data->file['_id']?>">
<input type="submit" value="OK">
</div>
</form>
</body>
</html>

