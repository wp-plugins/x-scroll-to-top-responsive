<?php
/*
Plugin Name:X-Scroll To Top - Responsive
Plugin URI: 
Description: This plugin will add a scroll to top button on footer center.
Author: Md. Jahidul Islam
Author URI: https://www.elance.com/s/edit/jahid07/ 
Version: 2.0
Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : PLUGIN AUTHOR EMAIL)

This program is free software; you can redistribute it and/or modify
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

/*Adding Latest jQuery from Wordpress*/
function x_scroll_to_top_latest_jquery() {
	wp_enqueue_script('jquery');
}
add_action('init', 'x_scroll_to_top_latest_jquery');


/*Some Set-up*/
define('X_PLUGIN_URL', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );

wp_enqueue_script('x-jquery-easing', X_PLUGIN_URL.'js/jquery.easing.min.js', array('jquery'));

wp_enqueue_script('x-jquery-main-scroll-up', X_PLUGIN_URL.'js/jquery.scrollUp.min.js', array('jquery'));
wp_enqueue_script('x-jquery-active', X_PLUGIN_URL.'js/active.js', array('jquery'));
wp_enqueue_style( 'wp-color-picker' );
wp_enqueue_script( 'my-script-handle', plugins_url('js/my-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true );



wp_enqueue_style('x-scroll-plugin-css', X_PLUGIN_URL.'css/custom.css');
wp_enqueue_style('x-scroll-plugin-fontello-css', X_PLUGIN_URL.'css/fontello.css');

//Register color picker script


//register a sub menu
function x_scroll_option() {
	add_submenu_page( 'options-general.php' , 'Scroll_to_top', 'X scroll option' , 'manage_options' , __FILE__ . '_scroll' , 'x_display_submenu_main_options');
	
	}
	
	register_activation_hook( __FILE__, 'x_activate' );

function x_activate() {
	
	add_option('x_scroll_color','#1e73be');
	add_option('x_scroll_size','25px');
	add_option('x_field_bg','rgba(221, 51, 51, 0)');
	add_option('x_scroll_position','50%');
}

	
// Action & Filter Hooks

add_action('admin_menu', 'x_scroll_option');
add_action( 'admin_init', 'register_x_scroll_settings' );
add_action('wp_head', 'x_add_head');

//Register function
function register_x_scroll_settings() {
	//register our settings
	register_setting( 'x-settings-group', 'x_scroll_color' );
	register_setting( 'x-settings-group', 'x_scroll_size' );
	register_setting( 'x-settings-group', 'x_field_bg' );
	register_setting( 'x-settings-group', 'x_scroll_position' );
}


//Work with variable

function x_add_head() {
	
	$color = get_option('x_scroll_color');
	$textSize = get_option('x_scroll_size');
	$backgroundField = get_option('x_field_bg');
	$ScrollPosition = get_option('x_scroll_position');
	
	 echo "
	
	<style type='text/css'>		
			a#scrollUp {
				font-size:$textSize;	
				bottom: 20px;
				right:$ScrollPosition;
				color:$color;
				background:$backgroundField;
				padding: 6px 2px 4px 2px;
				border-radius: 5px;
			}
	</style>	
	
	";	


}

//display setting page

function x_display_submenu_main_options(){
	?>
		<div style="width: 90%;" class="wrap">
			<?php screen_icon(); ?>
			<h2 class="x">X Scroll TO top Option Page</h2>
			<form action="options.php" method="post">
			<?php settings_fields( 'x-settings-group' ); ?>
					<tr valign="top">
					  <th scope="row">
						<h3>Icon Color</h3>
						<p>Click In the box and select your scroll Icon Color</p>
					  </th>
					  <td>						
						<label for="x_scroll_color"><input type="text" class="x_scroll_color x-scroll-color-field" id="x_scroll_color" name="x_scroll_color" value="<?php echo get_option('x_scroll_color'); ?>"/></label>						
					  </td>
					</tr>
					<tr valign="top">
					  <th scope="row">
						<h3>Scroll to top background color</h3>
						<p>Click In the box and select your scroll background color</p>
					  </th>
					  <td>
						<label for="x_field_bg"><input type="text" class="x_field_bg x-scroll-color-field" id="x_field_bg" name="x_field_bg" value="<?php echo get_option('x_field_bg'); ?>"/> </label>
					  </td>
					</tr>
					
					<tr valign="top">
					  <th scope="row">
						<h3>Icon Size</h3>
						<p>Put your Icon Size In the box Default value 30px</p>
					  </th>
					  <td>
						<label for="x_scroll_size"><input type="text" class="x_scroll_size" id="x_scroll_size" name="x_scroll_size" value="<?php echo get_option('x_scroll_size'); ?>"/></label>
					  </td>
					</tr>
					
					<tr valign="top">
					  <th scope="row">
						<h3>Scroll Position</h3>
						<p>Put your scroll up button position In the box with % and appear it will from left side  Default value 50% it will be show bottom centred of the page if you add 2% it will be show bottom right side of the page.</p>
					  </th>
					  <td>
						<label for="x_scroll_position"><input type="text" class="x_scroll_position" id="x_scroll_position" name="x_scroll_position" value="<?php echo get_option('x_scroll_position'); ?>"/></label>
					  </td>
					</tr>
					
					
					
					
				<?php submit_button(); ?>
				
				<div class="xauthor_link">
					<button><a target="blank" href="https://www.elance.com/s/edit/jahid07/">Hire Me!</a></button>
				</div>
			</form>
		</div>
<?php
}


?>
