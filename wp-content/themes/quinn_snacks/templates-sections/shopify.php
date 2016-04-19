<?
/*
Template Name: Shopify
*/
?>


<? get_header(); ?>


<div id="stylesheet">

<?
		$stylesheet = get_stylesheet_uri();
		$print_stylesheet = file_get_contents($stylesheet);

		echo '<style type="text/css">';
		echo $print_stylesheet;
		echo '</style>';
?>

</div>

<? get_footer(); ?>
