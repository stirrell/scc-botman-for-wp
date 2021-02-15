<?php
/**
 * Create the settings page for the BotMan widget.
 */
function scc_chatbot_add_settings_page() {
	add_options_page( 'BotMan Widget Options',
		'BotMan Widget Options',
		'manage_options',
		'scc-chatbot-options',
		'scc_chatbot_render_plugin_settings_page' );
}

if ( is_admin() ) {
	add_action( 'admin_menu', 'scc_chatbot_add_settings_page' );
	add_action( 'admin_init', 'scc_chatbot_register_settings' );
}

/**
 * Display the settings page for the BotMan widget.
 */
function scc_chatbot_render_plugin_settings_page() { ?>
	<div class="wrap">
		<h1>BotMan Widget Settings</h1>
		<form method="post" action="options.php">
			<?php settings_fields( 'scc-chatbot-options-group' ); ?>
			<h2>Chatbot Settings</h2>
			<table class="form-table" role="presentation">
				<tbody>
				<tr>
					<th scope="row"><label for="scc_chat_title">Chat Box Title:</label></th>
					<td>
						<input name="scc_chat_title" type="text" id="scc_chat_title" class="large-text" value="<?php echo esc_attr( get_option('scc_chat_title') ); ?>" />
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="scc_chat_intro_message">Introduction Message:</label></th>
					<td>
						<textarea name="scc_chat_intro_message" type="text" id="scc_chat_intro_message" class="large-text"><?php
							echo esc_attr( get_option('scc_chat_intro_message') );
						?></textarea>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="scc_chat_server">Chat Server:</label></th>
					<td>
						<input name="scc_chat_server" type="text" id="scc_chat_server" class="large-text" value="<?php echo esc_attr( get_option('scc_chat_server') ); ?>" />
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="scc_chat_button_image">Chat Button Image URL:</label></th>
					<td>
						<input name="scc_chat_button_image" type="text" id="scc_chat_button_image" class="large-text" value="<?php echo esc_attr( get_option('scc_chat_button_image') ); ?>" />
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="scc_chat_header_background_color">Header Background Color:</label></th>
					<td>
						<input name="scc_chat_header_background_color" type="color" id="scc_chat_header_background_color" value="<?php echo esc_attr( get_option('scc_chat_header_background_color') ); ?>" />
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="scc_chat_placeholder_text">Placeholder Text:</label></th>
					<td>
						<input name="scc_chat_placeholder_text" type="text" id="scc_chat_placeholder_text" class="large-text" value="<?php echo esc_attr( get_option('scc_chat_placeholder_text') ); ?>" />
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="scc_chat_about_text">Bottom Text:</label></th>
					<td>
						<input name="scc_chat_about_text" type="text" id="scc_chat_about_text" class="large-text" value="<?php echo esc_attr( get_option('scc_chat_about_text') ); ?>" />
					</td>
				</tr>
				</tbody>
			</table>
			<?php submit_button(); ?>
		</form>
	</div>
<?php }

/**
 * Register the settings used for the BotMan widget plugin.
 */
function scc_chatbot_register_settings() {
	register_setting( 'scc-chatbot-options-group', 'scc_chat_title' );
	register_setting( 'scc-chatbot-options-group', 'scc_chat_server' );
	register_setting( 'scc-chatbot-options-group', 'scc_chat_intro_message' );
	register_setting( 'scc-chatbot-options-group', 'scc_chat_button_image' );
	register_setting( 'scc-chatbot-options-group', 'scc_chat_header_background_color' );
	register_setting( 'scc-chatbot-options-group', 'scc_chat_placeholder_text' );
	register_setting( 'scc-chatbot-options-group', 'scc_chat_about_text' );
}