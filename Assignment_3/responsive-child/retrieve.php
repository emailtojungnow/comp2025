
<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) { exit; }

/**
 * Template Name: A00846775 Retrieve template for responsive-child.
 */
?>
<?php get_header(); ?>

<div id="content" class="grid col-620">
<h1>User Data</h1>

<!-- <script src="piechart.js"></script> wordpress doesn't know cwd. use get_styleseet_directory_uri-->

<?php $data = json_decode(get_option($option->option_name), TRUE); ?>
<canvas id="piechart1" width="100" height="100"></canvas>
<script src="<?php echo get_stylesheet_directory_uri().'/piechart.js'; ?>"></script>
<script>
    var chartId = "piechart1";
    var colours = ["#f00", "#0f0", "#00f"];
    var angles = [120, 120, 120];
    var counts = [2, 2, 2];
    //var angles =  [<?php echo $data['angle1'].','.$data['angle2'].','.$data['angle3']; ?>];
    piechart(chartId, colours, angles, counts);
</script>

<?php
$sql = "SELECT * FROM wp_options WHERE option_name LIKE 'A00846775%' ORDER BY option_name";
$options = $wpdb->get_results($sql);
foreach ($options as $option) {
    echo '<p><b>'.$option->option_name.'</b> = '
         .esc_attr($option->option_value).'</p>'.PHP_EOL;
}
?>



</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>