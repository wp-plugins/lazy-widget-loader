<?php
/**
 * lwl-widget-css.php
* 
 * Copyright 2010, 2011 kento (Karim Rahimpur) www.itthinx.com
 * 
 * This code is released under the GNU General Public License.
 * See COPYRIGHT.txt and LICENSE.txt.
 * 
 * This code is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * This header and all notices must be kept intact.
 * 
 * @author Karim Rahimpur
 * @package lazy-widget-loader
 * @since lazy-widget-loader 1.0.0
 */
?>
<?php
// bootstrap WordPress
if ( !defined( 'ABSPATH' ) ) {
	$wp_load = 'wp-load.php';
	$max_depth = 100; // prevent death by depth
	while ( !file_exists( $wp_load ) && ( $max_depth > 0 ) ) {
		$wp_load = '../' . $wp_load;
		$max_depth--;
	}
	if ( file_exists( $wp_load ) ) {
		require_once $wp_load;		
	}
}
if ( defined( 'ABSPATH' ) ) {
	header('Content-type: text/css');
	$settings = LWL_get_settings();
	if ( !empty( $settings ) ) {
		foreach ( $settings as $id => $values ) {
			if ( isset( $settings[$id]['use'] ) && $settings[$id]['use'] ) {
				$width = 0;
				$min_width = 0;
				$height = 0;
				$min_height = 0;
				$throbber = false;
				if ( isset( $settings[$id]['throbber'] ) ) {
					$throbber = true;
				}
				if ( isset( $settings[$id]['width'] ) ) {
					$width = intval( $settings[$id]['width'] );
				}
				if ( isset( $settings[$id]['height'] ) ) {
					$height = intval( $settings[$id]['height'] );
				}
				if ( isset( $settings[$id]['min-width'] ) ) {
					$min_width = intval( $settings[$id]['min-width'] );
				}
				if ( isset( $settings[$id]['min-height'] ) ) {
					$min_height = intval( $settings[$id]['min-height'] );
				}
				if ( $throbber ) {
					$min_height = max( array( LWL_THROBBER_HEIGHT, $min_height ) );
				}
				if ( $throbber || ( $min_width > 0 ) || ( $min_height > 0 ) || ( $width > 0 ) || ( $height > 0 ) ) {
					if ( $throbber ) {
						echo "#lwl-container-$id {";
						echo 'background: url(../images/throbber.gif) transparent center center no-repeat;';
						if ( $min_height > 0 ) {
							echo "min-height: $min_height"."px;";
						}
						echo '}' . "\n";
					}
					echo "#lwl-widget-$id {";
					if ( $min_width > 0 ) {
						echo "min-width: $min_width"."px;";
					}
					if ( $min_height > 0 ) {
						echo "min-height: $min_height"."px;";
					}
					if ( $width > 0 ) {
						echo "width: $width"."px;";
					}
					if ( $height > 0 ) {
						echo "height: $height"."px;";
					}
					echo '}' . "\n";
				}
			}
		}
	}
}
?>