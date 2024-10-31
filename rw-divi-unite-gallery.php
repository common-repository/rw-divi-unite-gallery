<?php
/*
Plugin Name: RW Divi Unite Gallery
Description: RW Divi Unite Gallery provides Unite Gallery Custom Module for Divi theme and visual page builder by elegantthemes.
Version: 1.0
Author: ahmed17
Author URI: http://www.reloadweb.co.uk/
Text Domain: rw-divi-unite-gallery
Domain Path: /languages
License: GPL2

Copyright 2017 Reload Web
	This program uses Unite Gallery jquery library which is under MIT Liecence. The MIT License (MIT)
	Copyright (c) 2015 Max Valiano | http://unitegallery.net
	
	Permission is hereby granted, free of charge, to any person
	obtaining a copy of this software and associated documentation
	files (the "Software"), to deal in the Software without
	restriction, including without limitation the rights to use,
	copy, modify, merge, publish, distribute, sublicense, and/or sell
	copies of the Software, and to permit persons to whom the
	Software is furnished to do so, subject to the following
	conditions:
	
	The above copyright notice and this permission notice shall be
	included in all copies or substantial portions of the Software.
	
	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
	EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
	OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
	NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
	HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
	WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
	FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
	OTHER DEALINGS IN THE SOFTWARE.

	The rest of program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
// Create a helper function for easy SDK access.
function rdug_fs() {
    global $rdug_fs;

    if ( ! isset( $rdug_fs ) ) {
        // Include Freemius SDK.
        require_once dirname(__FILE__) . '/freemius/start.php';

        $rdug_fs = fs_dynamic_init( array(
            'id'                  => '1255',
            'slug'                => 'rw-divi-unite-gallery',
            'type'                => 'plugin',
            'public_key'          => 'pk_006e1cf3c84120b90c63de7da1c0f',
            'is_premium'          => false,
            'has_addons'          => false,
            'has_paid_plans'      => false,
            'menu'                => array(
                'first-path'     => 'plugins.php',
                'account'        => false,
                'contact'        => false,
            ),
        ) );
    }

    return $rdug_fs;
}

// Init Freemius.
rdug_fs();
// Signal that SDK was initiated.
do_action( 'rdug_fs_loaded' );
define( 'RDUG_VERSION', '1.0');
define( 'RDUG_URL', plugins_url( '', __FILE__ ));
define( 'RDUG_PATH', plugin_dir_path( __FILE__ ));
define( 'RDUG_UG_PATH', RDUG_PATH.'unitegallery/');
define( 'RDUG_UG_URL', RDUG_URL . '/unitegallery/' );
define( 'RDUG_TD', 'rw-divi-unite-gallery');


require_once( RDUG_PATH . 'custom-modules/divi-unite-gallery.php' );

add_action( 'init', 'rdug_load_textdomain' );
/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 */
function rdug_load_textdomain() {
  load_plugin_textdomain( RDUG_TD, false, basename( dirname( __FILE__ ) ) . '/languages' ); 
}

function rdug_register_assets(){
	 wp_register_script( 'unitegallery', RDUG_UG_URL . 'js/unitegallery.min.js', array( 'jquery' ), false, true  );
	
     wp_register_script( 'unitegallery-tiles-theme', RDUG_UG_URL . 'themes/tiles/ug-theme-tiles.js', array( 'unitegallery' ), false, true  );
	 wp_register_script( 'unitegallery-default-theme', RDUG_UG_URL . 'themes/default/ug-theme-default.js', array( 'unitegallery' ), false, true  );
	 wp_register_script( 'unitegallery-compact-theme', RDUG_UG_URL . 'themes/compact/ug-theme-compact.js', array( 'unitegallery' ), false, true  );
	 wp_register_script( 'unitegallery-tiles-theme', RDUG_UG_URL . 'themes/tiles/ug-theme-tiles.js', array( 'unitegallery' ), false, true  );
	 wp_register_script( 'unitegallery-tilesgrid-theme', RDUG_UG_URL . 'themes/tilesgrid/ug-theme-tilesgrid.js', array( 'unitegallery' ), false, true  );
	  wp_register_script( 'unitegallery-carousel-theme', RDUG_UG_URL . 'themes/carousel/ug-theme-carousel.js', array( 'unitegallery' ), false, true  );
	  wp_register_script( 'unitegallery-compact-theme', RDUG_UG_URL . 'themes/compact/ug-theme-compact.js', array( 'unitegallery' ), false, true  );
	  wp_register_script( 'unitegallery-grid-theme', RDUG_UG_URL . 'themes/grid/ug-theme-grid.js', array( 'unitegallery' ), false, true  );
	  wp_register_script( 'unitegallery-slider-theme', RDUG_UG_URL . 'themes/slider/ug-theme-slider.js', array( 'unitegallery' ), false, true  );
	  

	wp_register_style( 'unitegallery', RDUG_UG_URL . 'css/unite-gallery.css', array(), false, 'all' );
	wp_register_style( 'unitegallery-default-skin', RDUG_UG_URL . 'themes/default/ug-theme-default.css', array('unitegallery'), false, 'all' );
	wp_register_style( 'unitegallery-alexis-skin', RDUG_UG_URL . 'skins/alexis/alexis.css', array('unitegallery'), false, 'all' );
	
	
}
add_action( 'wp_enqueue_scripts', 'rdug_register_assets', 99 );

function rdug_enqueue_ug_assets( $gal_theme = 'default' ,  $gal_skin = 'default', $inline_js = '' ) {
	 wp_enqueue_script( 'unitegallery' );
	 
	 wp_enqueue_script( 'unitegallery-'.$gal_theme.'-theme' );
	 wp_add_inline_script( 'unitegallery-'.$gal_theme.'-theme',  $inline_js, $position = 'after' );

	wp_enqueue_style( 'unitegallery' );
	wp_enqueue_style( 'unitegallery-'.$gal_skin.'-skin' );
}

