<?php
/*
Plugin Name:X-Scroll To Top - Responsive
Plugin URI: 
Description: This plugin will add a scroll to top button on footer center.
Author: Md. Jahidul Islam
Author URI: https://www.elance.com/s/edit/jahid07/ 
Version: 1.0
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



wp_enqueue_style('x-scroll-plugin-css', X_PLUGIN_URL.'css/custom.css');

//Register color picker script
add_action('init', 'x_farbtastic_script');
function x_farbtastic_script() {
  wp_enqueue_style( 'farbtastic' );
  wp_enqueue_script( 'farbtastic' );
}

//register a sub menu
function x_scroll_option() {
	add_submenu_page( 'options-general.php' , 'Scroll_to_top', 'X scroll option' , 'manage_options' , __FILE__ . '_scroll' , 'x_display_submenu_main_options');
	
	}
	
	register_activation_hook( __FILE__, 'x_activate' );

function x_activate() {
	
	add_option('x_color','#1518f3');
	add_option('x_size','30px');
}

	
// Action & Filter Hooks

add_action('admin_menu', 'x_scroll_option');
add_action( 'admin_init', 'register_x_scroll_settings' );
add_action('wp_head', 'x_add_head');

//Register function
function register_x_scroll_settings() {
	//register our settings
	register_setting( 'x-settings-group', 'x_color' );
	register_setting( 'x-settings-group', 'x_size' );
}


//Work with variable

function x_add_head() {
	
	$color = get_option('x_color');
	$textSize = get_option('x_size');
	
	 echo "
	
	<style type='text/css'>
		@import url('http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css');
			a#scrollUp {
				font-size:$textSize;	
				bottom: 20px;
				right:50%;
				color:$color;
			}
	</style>
	
	";	


}
//display setting page

function x_display_submenu_main_options(){
	?>
		<div class="wrap">
			<?php screen_icon(); ?>
			<h2 class="x">X Scroll TO top Option Page</h2>
			<form action="options.php" method="post">
			<?php settings_fields( 'x-settings-group' ); ?>
					<tr valign="top">
					  <th scope="row">
						<h3>Icon Color</h3>
					  </th>
					  <td>
						<label for="x_color"><input type="text" class="x_color" id="x_color" name="x_color" value="<?php echo get_option('x_color'); ?>"/> Click In the box and select your scroll Icon Color</label>
						<div id="ilctabscolorpicker"></div>
					  </td>
					</tr>
					
					<tr valign="top">
					  <th scope="row">
						<h3>Icon Size</h3>
					  </th>
					  <td>
						<label for="x_size"><input type="text" class="x_size" id="x_size" name="x_size" value="<?php echo get_option('x_size'); ?>"/>Put your Icon Size In the box Default value 30px</label>
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