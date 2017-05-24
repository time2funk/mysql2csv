<?php
if (isset($_GET['export'])) {
    require_once('config.php');
    ini_set('display_errors', 1);
    ini_set('memory_limit', '456M');
    //phpinfo();

    // $DB_Server = "localhost";
    // $DB_Username = "test";
    // $DB_Password = "test"; 
    // $DB_DBName = "xdor"; 
    $DB_TBLName = "keywords";  
    $filename = $DB_TBLName."_tbl";

    //create MySQL connection   
    $sql = "Select * from $DB_TBLName";
    $connect = $db;
    // $connect = @mysqli_connect($DB_Server, $DB_Username, $DB_Password, $DB_DBName) or die("Couldn't connect to MySQL:<br>" . mysql_error() . "<br>" . mysql_errno());  


    $result = @mysqli_query($connect, $sql) or die("Couldn't execute query:<br>" . mysqli_error(). "<br>" . mysqli_errno());    
///////////////////////////////////////////////////

if (!$result) die('Couldn\'t fetch records');
$num_fields = mysqli_num_fields($result);
$headers = array();

for ($i = 0; $i < $num_fields; $i++) {
    $headers[] = mysqli_fetch_field_direct($result,$i)->name;
}

$fp = fopen('php://output', 'w');

if ($fp && $result) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="'.$filename.'.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');
    fputcsv($fp, $headers);
    while ($row = $result->fetch_array(MYSQLI_NUM)) {
        fputcsv($fp, array_values($row));
    }
    die;
}

///////////////////////////////////////////////////
    // $file_ending = "csv";

    // //header info for browser
    // header("Content-Type: application/xls");    
    // header("Content-Disposition: attachment; filename=$filename.xls");  
    // header("Pragma: no-cache"); 
    // header("Expires: 0");

    // //define separator (defines columns in excel & tabs in word)
    // $sep = "\t"; //tabbed character
    // //start of printing column names as names of MySQL fields

    // for ($i = 0; $i < mysqli_num_fields($result); $i++) {
    //     echo mysqli_fetch_field_direct($result,$i)->name . "\t";
    // }

    // print("\n");

    // //end of printing column names  
    // //start while loop to get data

    //     while($row = mysqli_fetch_row($result))
    //     {
    //         $schema_insert = "";
    //         for($j=0; $j<mysqli_num_fields($result);$j++)
    //         {
    //             if(!isset($row[$j]))
    //                 $schema_insert .= "NULL".$sep;
    //             elseif ($row[$j] != "")
    //                 $schema_insert .= "$row[$j]".$sep;
    //             else
    //                 $schema_insert .= "".$sep;
    //         }
    //         $schema_insert = str_replace($sep."$", "", $schema_insert);
    //         $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
    //         $schema_insert .= "\t";
    //         print(trim($schema_insert));
    //         print "\n";
    //     }   
    //     echo "done";
}
?>