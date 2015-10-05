<?php
/**
 * Template Name: A00846555 Input template for responsive-child
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) { exit; }
?>

<?php get_header(); ?>

<div id="content" class="grid col-620">
<h1>What's your favorite color?</h1>

<form  method="POST" id="dataform">

</form>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?> 

<?php if(isset($_POST['A00846775_']) && !empty($_POST['A00846775_'])): ?>
   <?php add_option('A00846775_'.date("ymd-His"), json_encode($_POST)); //put options to wp_options table. timestamp as a key and names as value.?> 
   <script>
      alert("Thanks for submitting your data!");
   </script>
<?php
   endif;
   header("Location: ".TEMPLATEPATH.'/store.php');
?>


