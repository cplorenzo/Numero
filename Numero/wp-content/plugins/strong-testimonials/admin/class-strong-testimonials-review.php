<?php

class Strong_Testimonials_Review {

	private $value;
	private $messages;
	private $link = 'https://wordpress.org/support/plugin/%s/reviews/#new-post';
	private $slug = 'strong-testimonials';

	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );
	}

	public function init() {
		if ( ! is_admin() ) {
			return;
		}

		$this->messages = array(
			'notice'  => esc_html__( "Hi there! Stoked to see you're using Strong Testimonials for a few days now - hope you like it! And if you do, please consider rating it. It would mean the world to us.  Keep on rocking!", 'strong-testimonials' ),
			'rate'    => esc_html__( 'Rate the plugin', 'strong-testimonials' ),
			'rated'   => esc_html__( 'Remind me later', 'strong-testimonials' ),
			'no_rate' => __( 'Don\'t show again', 'strong-testimonials' ),
		);

		if ( isset( $args['messages'] ) ) {
			$this->messages = wp_parse_args( $args['messages'], $this->messages );
		}

		$this->value = $this->value();

		if ( $this->check() ) {
			add_action( 'admin_notices', array( $this, 'five_star_wp_rate_notice' ) );
			add_action( 'wp_ajax_strong-testimonials_review', array( $this, 'ajax' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
			add_action( 'admin_print_footer_scripts', array( $this, 'ajax_script' ) );
		}

		add_filter( 'st_uninstall_db_options', array( $this, 'uninstall_options' ) );
	}

	private function check() {

		if ( ! current_user_can( 'manage_options' ) ) {
			return false;
		}

		return( time() > $this->value );
	}

	private function value() {

		$value = get_option( 'strong-testimonials-rate-time', false );
		if ( $value ) {
			return $value;
		}

		$value = time() + DAY_IN_SECONDS;
		update_option( 'strong-testimonials-rate-time', $value );

		return $value;
	}

	public function five_star_wp_rate_notice() {

		$url = sprintf( $this->link, $this->slug );

		?>
		<div id="<?php echo esc_attr( $this->slug ); ?>-strong-testimonials-review-notice" class="notice notice-success is-dismissible" style="margin-top:30px;">
			<p><?php echo sprintf( esc_html( $this->messages['notice'] ), esc_attr( $this->value ) ); ?></p>
			<p class="actions">
				<a id="strong-testimonials-rate" href="<?php echo esc_url( $url ); ?>" target="_blank" class="button button-primary strong-testimonials-review-button">
					<?php echo esc_html( $this->messages['rate'] ); ?>
				</a>
				<a id="strong-testimonials-later" href="#" style="margin-left:10px" class="strong-testimonials-review-button"><?php echo esc_html( $this->messages['rated'] ); ?></a>
				<a id="strong-testimonials-no-rate" href="#" style="margin-left:10px" class="strong-testimonials-review-button"><?php echo esc_html( $this->messages['no_rate'] ); ?></a>
			</p>
		</div>
		<?php
	}

	public function ajax() {

		check_ajax_referer( 'strong-testimonials-review', 'security' );

		if ( ! isset( $_POST['check'] ) ) {
			wp_die( 'ok' );
		}

		$time = get_option( 'strong-testimonials-rate-time' );

		if ( 'strong-testimonials-rate' === $_POST['check'] ) {
			$time = time() + YEAR_IN_SECONDS * 1;
		} elseif ( 'strong-testimonials-later' === array( 'check' ) ) {
			$time = time() + WEEK_IN_SECONDS;
		} elseif ( 'strong-testimonials-no-rate' === $_POST['check'] ) {
			$time = time() + YEAR_IN_SECONDS * 1;
		}

		update_option( 'strong-testimonials-rate-time', $time );
		wp_die( 'ok' );
	}

	public function enqueue() {
		wp_enqueue_script( 'jquery' );
	}

	public function ajax_script() {

		$ajax_nonce = wp_create_nonce( 'strong-testimonials-review' );

		?>

		<script type="text/javascript">
			jQuery( document ).ready( function( $ ){

				$( '.strong-testimonials-review-button' ).on('click', function( evt ){
					var href = $(this).attr('href'),
						id = $(this).attr('id');

					if ( 'strong-testimonials-rate' != id ) {
						evt.preventDefault();
					}

					var data = {
						action: 'strong-testimonials_review',
						security: '<?php echo $ajax_nonce; ?>',
						check: id
					};

					if ( 'strong-testimonials-rated' === id ) {
						data['strong-testimonials-review'] = 1;
					}

					$.post( '<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>', data, function( response ) {
						$( '#<?php echo esc_attr( $this->slug ); ?>-strong-testimonials-review-notice' ).slideUp( 'fast', function() {
							$( this ).remove();
						} );
					});

				} );

			});
		</script>

		<?php
	}

	/**
	 * @param $options
	 *
	 * @return mixed
	 *
	 * @since 2.51.6
	 */
	public function uninstall_options( $options ) {

		$options[] = 'strong-testimonials-rate-time';

		return $options;
	}
}

new Strong_Testimonials_Review();