<?php
/**
 * Template Name: A00846775 Input template for responsive-child
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) { exit; }
?>

<?php
// Variable Definitions

$cwd =  get_stylesheet_directory_uri();
$postName = 'radio-choice-color';
$optionName = 'A00846775_color';

?>

<?php get_header(); ?>

<script>

/* Model */
var colorModels = { "Red": "FF0000", "Orange": "FFA500", "Yellow": "FFFF00", "Green": "008000", "Blue": "0000FF", "Navy": "000080", "Violet": "EE82EE" };
                  
/* Controller */
function initView(){
      
   var form = document.getElementById("color-form");
   var radioButtons = '';

   for (var color in colorModels){
      radioButtons += '<label><input type="radio" name="<?php echo $postName; ?>" id="radio-choice-' + color.toLowerCase() + '" ';
      radioButtons += 'value="' + color.toLowerCase() + '">' + color + '</label>';
   }

   radioButtons += '<div><input value="Submit" type="submit"></div>';

   jQuery(radioButtons).appendTo("#color-form");
   }

jQuery( document ).ready(function() {
    initView();
});

/*php data persist helper function*/

<?php 

   function persist_option($option_name, $option_value) {
      $data = get_option($option_name);
                  
      if(!$data) {
         $deprecated = ' ';
         $autoload   = 'no';
         $data = array($option_value);
         add_option($option_name, json_encode($data), $deprecated, $autoload);
      } else {
         $tempArray = json_decode($data, true);
         array_push($tempArray, $option_value);
         update_option($option_name, json_encode($tempArray));
      }
   }

?>

</script>
<div id="content" class="grid col-620">
<h1>What's your favorite color?</h1>
<form method="POST" id="color-form"></form>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?> 
<?php if(isset($_POST[$postName]) && !empty($_POST[$postName])): ?>
   <?php persist_option($optionName, $_POST); //put options to wp_options table. timestamp as a key and names as value.?> 
   <script> 
     alert("Thanks for submitting your data!");  
   </script>
<?php endif; ?>



    