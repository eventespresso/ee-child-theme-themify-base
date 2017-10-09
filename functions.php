<?php
//Load the parent theme css file
add_action( 'wp_enqueue_scripts', 'themify_theme_enqueue_styles' );
function themify_theme_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

function themify_ee_venue_city_state( $VNU_ID = 0, $echo = TRUE ) {
	EE_Registry::instance()->load_helper( 'Venue_View' );
	$venue = EEH_Venue_View::get_venue( $VNU_ID );
	$city = ( $venue->city() != 'Unknown' ? $venue->city() : '' );
	$state = ( $venue->state_name() != 'Unknown' ? $venue->state_name() : '' );
	if ( $echo ) {
		echo '<div class="ee_city_state">' . 
		$city . 
		'&nbsp;<span class="ee_state">' . 
		$state . 
		'</span></div>';
		return '';
	}
	return $city . $state;
}