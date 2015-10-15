<?php
/**
 * Template Name: A00846775 Retrieve Template for responsive-child
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) { exit; }
?>

<?php

  /* Models */

  $color_array = array( "red" => 0, "orange" => 0, "yellow" => 0, "green" => 0, "blue" => 0, "navy" => 0, "violet" => 0 );
  $color_degree = array( "red" => 0, "orange" => 0, "yellow" => 0, "green" => 0, "blue" => 0, "navy" => 0, "violet" => 0 );
  $total_submit_count = 0;

  /* Controller */

  $sql = "SELECT * FROM wp_options WHERE option_name LIKE 'A00846775_color'";
  $option = $wpdb->get_results($sql);
  $data = $option[0]->option_value;
  $data = json_decode($data, true);

  if (is_array($data)) {         
      foreach ($data as $key => $value) // iterate through assoc array
      {
          $color = $data[$key]['radio-choice-color'];
          $color_array[$color]++;
          $total_submit_count++;
      }
  }
  

  foreach ($color_array as $color_array_key => $color_array_value){ // turn submitted color counts to angles for a pie chart. 
      converNumToDegree($color_array_key, $color_array_value);
  }

   /* helper function */

  function converNumToDegree($color_key, $color_count){
      global $total_submit_count, $color_degree;
      $degree = 360/$total_submit_count * $color_count;
      $color_degree[$color_key] = $degree;
  }

?>

<?php get_header(); ?>

<div id="content" class="grid col-620">
<h1>Survey Result</h1>
    
<canvas id="piechart1" ></canvas>
<script src="<?php echo get_stylesheet_directory_uri().'/piechart.js'; ?>"></script>
<script>
    piechart(
  "piechart1", 
      ["red", "orange", "yellow", "green", "blue", "navy", "violet"], 
      [<? echo implode(",", $color_degree); ?>],
      [<? echo implode(",", $color_array); ?>],
      <? echo $total_submit_count; ?>
    );
</script>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>



    