<?php
//Load the parent theme css file
// Create a helper function for easy SDK access.
function ecttb_fs() {
    global $ecttb_fs;

    if ( ! isset( $ecttb_fs ) ) {
        // Include Freemius SDK.
        require_once dirname(__FILE__) . '/freemius/start.php';

        $ecttb_fs = fs_dynamic_init( array(
            'id'                  => '1445',
            'slug'                => 'ee-child-theme-themify-base',
            'type'                => 'theme',
            'public_key'          => 'pk_eb035f6ed2f72e3111f73e3e186c1',
            'is_premium'          => false,
            'has_addons'          => false,
            'has_paid_plans'      => false,
            'is_org_compliant'    => false,
            'menu'                => array(
                'first-path'     => 'themes.php',
                'support'        => false,
            ),
        ) );
    }

    return $ecttb_fs;
}

// Init Freemius.
ecttb_fs();
// Signal that SDK was initiated.
do_action( 'ecttb_fs_loaded' );

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