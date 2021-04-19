<?php


class Aal_Widget extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 
			'classname' => 'aal_widget',
			'description' => 'Auto Affiliate Links',
		);
		parent::__construct( 'Aal_Widget', 'Auto Affiliate Links', $widget_ops );
	}


	public function widget( $args, $instance ) {
		// outputs the content of the widget
		
		echo $args['before_widget'];
			if ( ! empty( $instance['title'] ) ) {
				echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
			}
		echo '<ul class="aal_widget_holder"></ul>';
		
		if(!get_option('aal_apikey')) {
		?>
			This widget works only with <a href="https://autoaffiliatelinks.com">Auto Affiliate Links PRO</a>. To activate it you need to get <a href="https://autoaffiliatelinks.com/wp-login.php?action=register">your API key</a>.
			
			
		<?php
		} 
			
		echo $args['after_widget'];
	
	
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = '';
		}
		
		
		if(!get_option('aal_apikey')) {
		?>
			This widget works only with <a href="https://autoaffiliatelinks.com">Auto Affiliate Links PRO</a>. To activate it you need to get <a href="https://autoaffiliatelinks.com/wp-login.php?action=register">your API key</a>.
			
			
		<?php
		} 
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
}


//add_action( 'widgets_init', function(){
//	register_widget( 'Aal_Widget' );
//});

add_action( 'widgets_init', 'aal_register_widget' );

function aal_register_widget() {

	register_widget( 'Aal_Widget' );

}