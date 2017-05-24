<!DOCTYPE html>
<html lang="en">
<head>
	<title>Keywords from|to DB - XDOR</title>
	<meta charset="utf-8">
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
	<style >
		form#csv-form input{display: inline-block;}
		span#p_title{color: red; text-transform: uppercase; font-size: 25px;}
	</style>

	<?php 
	include("head.php");
	include("left_sidebar.php");
	echo ' <div class="content">';

	// $_POST = array();
	ini_set('display_errors', 1);
    ini_set('memory_limit', '456M'); 
    // ini_set('upload_max_filesize', '200M');
    // ini_set('post_max_size', '200M');
    // ini_set('memory_limit', '400M');
    require_once('config.php');
	?>
	
	<h3>Export / Import DB for <span id='p_title'>keywords</span></h3>
	<hr>
	
	<label for='file'>Export CSV File</label>
	<a href="db_keys_export.php?export=true"><button type="button" >download</button></a><br><hr>

	<form id='csv-form' name="import" method="post" enctype="multipart/form-data">
		<label for='file'>Import CSV File</label>
		<input id='file' name="file" type="file">
		<label for='overwrite'>Overwrite</label>
		<input id='overwrite' name="overwrite"  type="checkbox">
        <input type="submit" name="import" value="import" />
	</form>
	<hr>

<?php

	// if(isset($_POST["export"]))
	// {
	// 	echo "export...";
	// 	include 'db_keys_export.php';
	// }
	if(isset($_POST["import"]))
	{
		echo "importing...";
		include 'db_keys_import.php';
	}
?>

 	<?php	include("footer.php"); ?>
</body>
</html>