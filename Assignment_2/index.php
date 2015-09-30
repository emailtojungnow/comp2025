<!-- Comp 2025 Assignment 2 : Jung Kim - index2.html - multipage tryout -->

<!DOCTYPE html>
<html>
<head>
	<title>2025 Assignment 2</title>

	<meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">

	<style type="text/css">
	 	html { height: 100%; }
        body { height: 100%; margin: 0px; padding: 0px; }
        #piechart1 { height: 50%; width: 50%; display: block; margin-right: auto; margin-left: auto; }
	</style>

	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
	<script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
   	<script src="piechart.js"></script>


	<script>

	$(document).one("pagecreate", initView);
	//$.mobile.document.on( "click", "#bt", initView);

	/* Model */

	var colorModels = { "Red": "FF0000", "Orange": "FFA500", "Yellow": "FFFF00", "Green": "008000", "Blue": "0000FF", "Navy": "000080", "Violet": "EE82EE" };
							

	/* Controller */
	function initView(){
 	 	
	 	var form = document.getElementById("color-form");
	 	var radioButtons = '';

	 	for (var color in colorModels){
	 		radioButtons += '<label><input type="radio" name="radio-choice-color" id="radio-choice-' + color.toLowerCase() + '" ';
	 		radioButtons += 'value="' + color.toLowerCase() + '">' + color + '</label>';
	 	}

	 	radioButtons += '<div><input value="Submit" type="submit"></div>';

	 	$(radioButtons).appendTo("#color-form").enhanceWithin();
 	}

	</script>
</head>

<body>

<!-- Start of first landing page -->
<div id="page-one" data-role="page">

	<div data-role="header">
		<h1>Which color is your favorite?</h1>
	</div><!-- /header -->

	<div role="main" class="ui-content">

		<form id="color-form" action="store.php" method="post" data-ajax="false"></form>

	</div><!-- /content -->

	<div data-role="footer">
		<h4>Input Page</h4>
	</div><!-- /footer -->
</div><!-- /page -->

<!-- Start of second survey result page -->

<!-- php section -->

<?php

  /* helper function */

  function converNumToDegree($color_key, $color_count){
      global $total_submit_count, $color_degree;
      $degree = 360/$total_submit_count * $color_count;
      $color_degree[$color_key] = $degree;
  }

  /* Models */

  $color_array = array( "red" => 0, "orange" => 0, "yellow" => 0, "green" => 0, "blue" => 0, "navy" => 0, "violet" => 0 );
  $color_degree = array( "red" => 0, "orange" => 0, "yellow" => 0, "green" => 0, "blue" => 0, "navy" => 0, "violet" => 0 );
  $total_submit_count = 0;

  /* Controller */

  $file = fopen('data.json', "r")           // open file
          or exit('Data not found.');       // or give err msg and exit

  while(!feof($file))                       // while eof not reached
  {
      $line = fgets($file);                 // get one line
      $data = json_decode($line, TRUE);     // json-decode it, $assoc
      if (is_array($data)) {                // if decoded data is an array
          foreach ($data as $key => $value) // iterate through assoc array
          {
              $color_array[$value]++;
              $total_submit_count++;
          }
      }
  }

  foreach ($color_array as $color_array_key => $color_array_value){ // turn submitted color counts to angles for a pie chart. 
      converNumToDegree($color_array_key, $color_array_value);
  }

  fclose($file);                            // close file handle

?>

<div id="page-two" data-role="page" >

	<div data-role="header">
		<h1>Survey Result</h1>
	</div><!-- /header -->

	<div role="main" class="ui-content">
		
		<canvas id="piechart1" ></canvas>

	  	<script>
	       	piechart(
	 			"piechart1", 
        		["red", "orange", "yellow", "green", "blue", "navy", "violet"], 
        		[<? echo implode(",", $color_degree); ?>],
        		[<? echo implode(",", $color_array); ?>]
	       	);
	  	</script>

	  	<div>
	  		<a href="#page-one" id="anchor-to-page-one" data-role="button">Back to Survey Page</a>
	  	</div>

	</div><!-- /content -->

	<div data-role="footer">
		<h4>Result Page</h4>
	</div><!-- /footer -->
</div><!-- /page -->

</body>
</html>