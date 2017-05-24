
<?php 
    require_once('config.php');
    // ini_set('upload_max_filesize', '200M');
    // ini_set('post_max_size', '200M');
    // ini_set('memory_limit', '400M');
	
	$file = $_FILES['file']['tmp_name'];
    $DB_TBLName = "test"; 
	
	$connect = mysqli_connect("localhost", "test", "test", "test_db");
    // $connect = $db;

	$handle = fopen($file, "r");
	$c = 0;

	$tmp = fgetcsv($handle);
	var_dump($tmp);
	echo "<br><br>";


	if( $_POST["overwrite"] ){
		$dropsql = "
		DROP TABLE $DB_TBLName
		";
		$createsql = "CREATE TABLE $DB_TBLName(
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `keyword` varchar(500) NOT NULL,
		  `search_volume` int(50) NOT NULL,
		  `difficulty` float NOT NULL,
		  `count_word` int(11) NOT NULL,
		  `theme_key` varchar(128) NOT NULL,
		  `used` varchar(92) NOT NULL,
		  PRIMARY KEY (`id`),
		  UNIQUE KEY `keyword` (`keyword`)
		) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1";

		mysqli_query($connect, "$dropsql");
		mysqli_query($connect, "$createsql");
	}

	$i = 0;
	while( ($filesop = fgetcsv($handle, 1000, ",")) !== false)
	{
		$id = $filesop[0];
		$keyword = $filesop[1];
		$search_volume = $filesop[2];
		$difficulty = $filesop[3];
		$count_word = $filesop[4];
		$theme_key = $filesop[5];
		$used = $filesop[6];

		$sql = "
			INSERT INTO $DB_TBLName 
			(id, keyword, search_volume, difficulty, count_word, theme_key, used) 
			VALUES ('$id', '$keyword', '$search_volume', '$difficulty', '$count_word', '$theme_key', '$used')
			";
		$result = @mysqli_query($connect, $sql) or die("Couldn't execute query:<br>" . mysqli_error($connect). "<br>");    
		$i++;
	}

	if($result){
		echo "<br><p>Your database has imported successfully</p><p>"
		. $i . " rows added</p>";
	}else{
		echo "<br>Sorry! There is some problem.";
	}

?>
