<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>main</title>
</head>
<body>

<a href="upload8_form.php">upload</a>

<?php

//error_reporting(E_ALL);
//ini_set('display_errors','On');

$connection = new MongoClient;

$grid = $connection->selectDB( 'test8' )->getGridFS();

/* --------------------------------------------------------
//$a = $grid->find()->current();
echo "<pre>";
var_dump( $grid );
echo "</pre>";
echo "<hr>";

$cursor = $grid->find();
echo "<pre>";
var_dump( $cursor );
echo "</pre>";
echo "<hr>";

foreach( $cursor as $doc )
{
//  $uptitle = $doc["uptitle"];
  echo "<pre>";
  var_dump( $doc->file["uptitle"] );
  var_dump( $doc->file["upcategory"] );
  var_dump( $doc->file["upauthor"] );
  var_dump( $doc->file["upfile"] );
  //var_dump( $uptitle );
  echo "</pre>";
  echo "<hr>";
}
-------------------------------------------------------- */

$cursor = $grid->find();
//$cursor = $grid->find( array("upcategory" => "c") );

echo "<table>";

foreach( $cursor as $doc )
{
//  echo "<pre>";
//  var_dump( $doc );
//  echo "</pre>";
echo "<tr>";
  echo "<td>";
  echo "<a href=\"download.php?downfile=".$doc->file["upfile"]."\">";
  echo $doc->file["uptitle"];
  echo "</a>";
  echo "</td>";
  echo "<td>";
  echo $doc->file["upcategory"];
  echo "</td>";
  echo "<td>";
  echo $doc->file["upauthor"];
  echo "</td>";
  echo "<td>";
  echo $doc->file["upfile"];
  echo "</td>";
  echo "<td>";
  echo "<form enctype=multipart/form-data method=POST action=update8_form.php>";
  echo "<input name=id value=\"".$doc->file["_id"]."\" type=hidden>";
  echo "<input name=edit value=edit type=submit>";
  echo "</form>";
  echo "</td>";
  echo "<td>";
  echo "<form enctype=multipart/form-data method=POST action=delete8_form.php>";
  echo "<input name=id value=\"".$doc->file["_id"]."\" type=hidden>";
  echo "<input name=delete value=delete type=submit>";
  echo "</form>";
  echo "</td>";
echo "</tr>";
}

echo "</table>";
?>

</body>
</html>
