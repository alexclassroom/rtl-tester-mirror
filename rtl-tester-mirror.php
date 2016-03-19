<?php if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * WebMan RTL Tester Mirror
 *
 * @package    WebMan RTL Tester Mirror
 * @copyright  WebMan Design, Oliver Juhas
 * @license    GPL-3.0, http://www.gnu.org/licenses/gpl-3.0.html
 *
 * @link  http://www.webmandesign.eu
 *
 * Plugin Name:        RTL Tester Mirror by WebMan
 * Plugin URI:         http://www.webmandesign.eu/
 * Description:        Makes it easy for non-RTL language speaker to test the RTL website layout by mirroring it with CSS transform so it looks like LTR. Works great with RTL Tester plugin.
 * Version:            1.0.3
 * Author:             WebMan Design, Oliver Juhas
 * Author URI:         http://www.webmandesign.eu/
 * Text Domain:        rtl-tester-mirror
 * Domain Path:        /languages
 * License:            GNU General Public License v3
 * License URI:        http://www.gnu.org/licenses/gpl-3.0.txt
 * Requires at least:  4.3
 * Tested up to:       4.4.2
 */





/**
 * Mirror the RTL site
 *
 * @since    1.0
 * @version  1.0.3
 */
function rtl_tester_mirror_styles() {

	// Requirements check

		if ( ! is_rtl() ) {
			return;
		}


	// Helper variables

		$styles = '';


	// Processing

		// Mirror the site

			$styles .= 'html {
					transform: scaleX(-1);
				}';

		// Display notice

			$styles .= 'html::after {
					content: "' . esc_attr__( 'Mirrored RTL', 'rtl-tester-mirror' ) . '";
					position: fixed;
					display: inline-block;
					left: 50%;
					top: -3px;
					padding: 10px 20px;
					font-size: 12px;
					font-family: sans-serif;
					text-transform: uppercase;
					background: #21759b;
					color: #fff;
					white-space: nowrap;
					z-index: 9999999;
					border-radius: 3px;
					transform: scaleX(-1) translateX(50%);
					transform-origin: 50% 0;
				}';

		// WP toolbar fix

			$styles .= '#wpadminbar { margin-top: -32px; }';
			$styles .= '.wp-admin #wpadminbar { margin-top: 0; }';


	// Output

		echo '<style type="text/css" media="screen">' . $styles . '</style>';

} // /rtl_tester_mirror_styles

add_action( 'wp_head',            'rtl_tester_mirror_styles', 9999 );
add_action( 'admin_print_styles', 'rtl_tester_mirror_styles', 9999 );



/**
 * Load plugin text domain
 *
 * @since    1.0.3
 * @version  1.0.3
 */
function rtl_tester_mirror_load_plugin_textdomain() {

	// Processing

		load_plugin_textdomain( 'rtl-tester-mirror', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );

} // /rtl_tester_mirror_load_plugin_textdomain

add_action( 'plugins_loaded', 'rtl_tester_mirror_load_plugin_textdomain' );
