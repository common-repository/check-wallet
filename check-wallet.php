<?php
/*
Plugin Name: Check Wallet
Description: Check the balance of your Bitcoin wallet
Version: 1.5
Author: Tomek
Author URI: http://wp-learning-net
*/

load_plugin_textdomain( 'check-wallet', '', dirname( plugin_basename( __FILE__ ) ) . '/lang' );

function check_wallet_shortcode( $atts, $content = null ) {
	$form = '<div class="check-wallet"><center><form action="'.plugins_url('check-wallet/go.php').'" method="get" target="_blank">
			<input type="text" name="address" placeholder="'.__('Bitcoin address here', 'check-wallet').'">
			 <select name="processor">
	 			<option value="0">'.__('Select one', 'check-wallet').'</option>
				<option value="1">Blockchain</option>
				<option value="2">FaucetSystem</option>
				<option value="3">Microwallet</option>
				<option value="4">SoChain</option>
				<option value="5">FaucetHub</option>
				</select>
			 <input type="submit" value="'.__('Check now', 'check-wallet').'">
			 </form><
			 <br><center><a href="https://blockchain.info/hu/wallet/#/" target="_blank">'.__('There is no Bitcoin address?','check-wallet').'</a></center>/div>';
	return $form;
}

function check_wallet_widget() {
	register_widget('WP_Widget_Check_Wallet');
}

class WP_Widget_Check_Wallet extends WP_Widget {
	function WP_Widget_Check_Wallet() {
		$widget_ops = array( 'classname' => 'widget_featured_entries', 'description' => __('Check the balance of your Bitcoin wallet', 'check-wallet') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'check-wallet-widget' );
		$this->WP_Widget( 'check-wallet-widget', __('Wallet', 'check-wallet'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
?>
<form action="<?php echo plugins_url('check-wallet/go.php'); ?>" method="get" target="_blank">
<input type="text" name="address" placeholder="<?php _e('Bitcoin address here', 'check-wallet') ?>">
<select name="processor">
			<option value="0"><?php _e('Select one', 'check-wallet') ?></option>
			<option value="1">Blockchain</option>
			<option value="2">FaucetSystem</option>
			<option value="3">Microwallet</option>
			<option value="4">SoChain</option>
			<option value="5">FaucetHub</option>
</select>
<input type="submit" value="<?php _e('Check now', 'check-wallet') ?>" />
</form>
<br><center><a href="https://blockchain.info/hu/wallet/#/" target="_blank"><?php _e('There is no Bitcoin address?','check-wallet') ?></a></center>
 <?php
			echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __('Wallet', 'check-wallet'));
		$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
	<?php
	}
}

add_shortcode('check-wallet','check_wallet_shortcode');
add_action('widgets_init','check_wallet_widget');
?>