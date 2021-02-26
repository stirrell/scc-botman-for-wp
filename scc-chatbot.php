<?php
/*
 Plugin Name: WordPress ChatBot Web Widget
 Plugin URI: https://github.com/stirrell/scc-botman-for-wp
 Description: A WordPress plugin to add the Web Widget for BotMan to a site.
 Author: Scott Tirrell
 Author URI: https://second-cup-of-coffee.com
 Version: 0.1
 Text Domain: scc
 License: GPLv2 or later
 License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

define( 'SCC_CHATBOT_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'SCC_CHATBOT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

include SCC_CHATBOT_PLUGIN_PATH . 'inc/admin-functions.php';

/**
 * Load the JavaScript and CSS for the BotMan web widget.
 */
function scc_enqueue_pulse_chatbot() {
	$css_path = plugins_url( 'dist/css/style.css', __FILE__ );
	$js_path  = plugins_url( 'dist/js/chat-min.js', __FILE__ );

	// Add Versioning based on latest file modified date
	$css_ver = date( "ymd-Gis", filemtime( plugin_dir_path( __FILE__ ) . 'dist/css/styles.css' ) );
	$js_ver  = date( "ymd-Gis", filemtime( plugin_dir_path( __FILE__ ) . 'dist/js/chat-min.js' ) );

	wp_enqueue_style( 'scc-chatbot', $css_path, array(), $css_ver );
	wp_enqueue_script( 'scc-chatbot', $js_path, array( 'jquery' ), $js_ver, true );
	wp_enqueue_script( 'scc-chatbot-widget', plugins_url( 'dist/js/widget-min.js', __FILE__ ), array( 'scc-chatbot' ), null, true );
}

add_action( 'wp_enqueue_scripts', 'scc_enqueue_pulse_chatbot' );

/**
 * Add the options set by the user for the Chatbot.
 */
function scc_chatbot_add_widget_code() {
	$scc_chat_server                  = get_option( 'scc_chat_server' );
	$scc_chat_placeholder_text        = get_option( 'scc_chat_placeholder_text', 'Send a message...' );
	$scc_chat_header_background_color = get_option( 'scc_chat_header_background_color', '#408591' );
	$scc_chat_about_text              = get_option( 'scc_chat_about_text', 'Powered by BotMan' );

	// If any required info is missing, bail out.
	if ( empty( $scc_chat_server ) ) {
		return;
	}

	?>
    <script>
        var botmanWidget = {
            frameEndpoint  : '<?php echo SCC_CHATBOT_PLUGIN_URL; ?>/chatbot-iframe.php',
            chatServer     : '<?php echo $scc_chat_server; ?>',
            title          : '<?php echo get_option( 'scc_chat_title' ); ?>',
            introMessage   : '<?php echo get_option( 'scc_chat_intro_message' ); ?>',
            bubbleAvatarUrl: '<?php echo get_option( 'scc_chat_button_image' ); ?>',
            placeholderText: '<?php echo $scc_chat_placeholder_text; ?>',
            mainColor      : '<?php echo $scc_chat_header_background_color ?>',
            aboutText      : '<?php echo $scc_chat_about_text; ?>',
            timeFormat     : 'h:MM'
        };
    </script>
<?php }

add_action( 'wp_footer', 'scc_chatbot_add_widget_code' );
