<?php

/**
 * Returns current year
 *
 * @uses [year]
 */
add_shortcode( 'year', 'crb_shortcode_year' );
function crb_shortcode_year() {
	return date( 'Y' );
}

add_shortcode( 'cols', 'crb_shortcode_cols' );
function crb_shortcode_cols( $atts, $content ) {
	ob_start();
	?>
	<div class="cols">
		<?php echo crb_content( $content ); ?>
	</div>
	<?php
	$html = ob_get_clean();

	return $html;
}

add_shortcode( 'cols-nowrap', 'crb_shortcode_cols_nowrap' );
function crb_shortcode_cols_nowrap( $atts, $content ) {
	ob_start();
	?>
	<div class="cols cols-nowrap">
		<?php echo crb_content( $content ); ?>
	</div>
	<?php
	$html = ob_get_clean();

	return $html;
}

add_shortcode( 'cols-reverse', 'crb_shortcode_cols_reverse' );
function crb_shortcode_cols_reverse( $atts, $content ) {
	ob_start();
	?>
	<div class="cols cols-reverse">
		<?php echo crb_content( $content ); ?>
	</div>
	<?php
	$html = ob_get_clean();

	return $html;
}

add_shortcode( 'col', 'crb_shortcode_col' );
function crb_shortcode_col( $atts, $content ) {
	ob_start();
	?>
	<div class="col">
		<?php echo crb_content( $content ); ?>
	</div>
	<?php
	$html = ob_get_clean();

	return $html;
}

add_shortcode( 'col-wide', 'crb_shortcode_col_wide' );
function crb_shortcode_col_wide( $atts, $content ) {
	ob_start();
	?>
	<div class="col col-wide">
		<?php echo crb_content( $content ); ?>
	</div>
	<?php
	$html = ob_get_clean();

	return $html;
}
