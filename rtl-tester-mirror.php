<?php if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * WebMan RTL Tester Mirror
 *
 * @package    WebMan RTL Tester Mirror
 * @copyright  WebMan Design, Oliver Juhas
 * @license    GPL-3.0, http://www.gnu.org/licenses/gpl-3.0.html
 *
 * @since    1.0
 * @version  1.0
 *
 * @link  http://www.webmandesign.eu
 *
 * Plugin Name:        WebMan RTL Tester Mirror
 * Plugin URI:         http://www.webmandesign.eu/
 * Description:        Makes it easy for non-RTL language speaker to test the RTL website layout by mirroring it with CSS transform so it looks like LTR. Works great with RTL Tester plugin.
 * Version:            1.0
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
 * @version  1.0
 */
function wm_rtl_mirror_styles() {

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
					border-left: #21759b solid 10px;
					border-right: #21759b solid 10px;
				}';

		// Display notice

			$styles .= 'html::after, body::after {
					content: "' . esc_attr__( 'Mirrored RTL', 'rtl-tester-mirror' ) . '";
					position: fixed;
					display: inline-block;
					left: 10px;
					top: 360px;
					padding: 5px 10px;
					font-size: 10px;
					font-family: sans-serif;
					text-transform: uppercase;
					background: #21759b;
					color: #fff;
					white-space: nowrap;
					z-index: 9999999;
					transform: scaleX(-1) rotate(90deg);
					transform-origin: 0 50%;
				}';

			$styles .= 'html::after {
					left: auto;
					right: 10px;
					transform: scaleX(-1) rotate(-90deg);
					transform-origin: 100% 50%;
				}';

		// WP toolbar fix

			$styles .= '#wpadminbar { margin-top: -32px; }';
			$styles .= '.wp-admin #wpadminbar { margin-top: 0; }';


	// Output

		echo '<style type="text/css" media="screen">' . $styles . '</style>';

} // /wm_rtl_mirror_styles

add_action( 'wp_head',            'wm_rtl_mirror_styles', 9999 );
add_action( 'admin_print_styles', 'wm_rtl_mirror_styles', 9999 );
