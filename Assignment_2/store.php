<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="refresh" content="2;url=http://localhost:8888/clientServerApp/index.php#page-two">
	<title></title>
</head>
<body>
<?php
$file_handle = fopen('data.json', 'a');  // a - append, w - overwrite
if($file_handle) {                       // if file is there
   fwrite(                               // write to file
      $file_handle,                      // specified by $file_handle
      json_encode($_POST).PHP_EOL);      // json-encoded POST data (terminate with end of line)
   fclose($file_handle);                 // close file stream
   echo 'Data submitted successfully. Back to input page after 2 seconds';  // inform of success
// header('Location:done.html');         // or show another html
}
else {
   echo 'Error opening data file.';      // inform of failure
}
?>
</body>
</html>