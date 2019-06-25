<?php
/**
 * Abstract Widget Class
 *
 * @class    FT_Widget
 * @extends  WP_Widget
 * @version  1.0.0
 * @package  FlashToolkit/Abstracts
 * @category Widgets
 * @author   ThemeGrill
 */
abstract class FT_Widget extends WP_Widget {

	/**
	 * CSS class.
	 *
	 * @var string
	 */
	public $widget_cssclass;

	/**
	 * Widget description.
	 *
	 * @var string
	 */
	public $widget_description;

	/**
	 * Widget ID.
	 *
	 * @var string
	 */
	public $widget_id;

	/**
	 * Widget name.
	 *
	 * @var string
	 */
	public $widget_name;

	/**
	 * Widget Settings.
	 *
	 * @var array
	 */
	public $settings = array();

	/**
	 * Widget Control Options.
	 *
	 * @var array
	 */
	public $control_ops = array();

	/**
	 * Constructor.
	 */
	public function __construct() {

		$widget_ops = array(
			'classname'   => $this->widget_cssclass,
			'description' => $this->widget_description,
			'customize_selective_refresh' => true,
		);

		parent::__construct( $this->widget_id, $this->widget_name, $widget_ops, $this->control_ops );

		add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	}

	/**
	 * Get cached widget.
	 *
	 * @param  array $args
	 * @return bool true if the widget is cached otherwise false
	 */
	public function get_cached_widget( $args ) {
		$cache = wp_cache_get( apply_filters( 'flash_toolkit_cached_widget_id', $this->widget_id ), 'widget' );

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return true;
		}

		return false;
	}

	/**
	 * Cache the widget.
	 *
	 * @param  array  $args
	 * @param  string $content
	 * @return string the content that was cached
	 */
	public function cache_widget( $args, $content ) {
		$cache = wp_cache_get( apply_filters( 'flash_toolkit_cached_widget_id', $this->widget_id ), 'widget' );

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		$cache[ $args['widget_id'] ] = $content;

		wp_cache_set( apply_filters( 'flash_toolkit_cached_widget_id', $this->widget_id ), $cache, 'widget' );

		return $content;
	}

	/**
	 * Flush the cache.
	 */
	public function flush_widget_cache() {
		wp_cache_delete( apply_filters( 'flash_toolkit_cached_widget_id', $this->widget_id ), 'widget' );
	}

	/**
	 * Output the html at the start of a widget.
	 *
	 * @param  array $args
	 * @return string
	 */
	public function widget_start( $args, $instance ) {
		echo $args['before_widget'];

		if ( $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
	}

	/**
	 * Output the html at the end of a widget.
	 *
	 * @param  array $args
	 * @return string
	 */
	public function widget_end( $args ) {
		echo $args['after_widget'];
	}

	/**
	 * Updates a particular instance of a widget.
	 *
	 * @see    WP_Widget->update
	 * @param  array $new_instance
	 * @param  array $old_instance
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		if ( empty( $this->settings ) ) {
			return $instance;
		}

		// Loop settings and get values to save.
		foreach ( $this->settings as $key => $setting ) {
			if ( ! isset( $setting['type'] ) ) {
				continue;
			}

			// Format the value based on settings type.
			switch ( $setting['type'] ) {
				case 'number' :
					$instance[ $key ] = absint( $new_instance[ $key ] );

					if ( isset( $setting['min'] ) && '' !== $setting['min'] ) {
						$instance[ $key ] = max( $instance[ $key ], $setting['min'] );
					}

					if ( isset( $setting['max'] ) && '' !== $setting['max'] ) {
						$instance[ $key ] = min( $instance[ $key ], $setting['max'] );
					}
				break;
				case 'textarea' :
					if ( current_user_can( 'unfiltered_html' ) ) {
						$instance[ $key ] = $new_instance[ $key ];
					} else {
						$instance[ $key ] = wp_kses( trim( wp_unslash( $new_instance[ $key ] ) ), wp_kses_allowed_html( 'post' ) );
					}
				break;
				case 'checkbox' :
					$instance[ $key ] = empty( $new_instance[ $key ] ) ? 0 : 1;
				break;
				case 'datetimepicker' :
					if( !empty( $new_instance[ $key ] ) ) {
						$sanitized_date   = DateTime::createFromFormat( "Y-m-d H:i", $new_instance[ $key ] );
						$instance[ $key ] = $sanitized_date->format("Y-m-d H:i");
					}
				break;
				case 'repeater' :
					$instance[ $key ] = isset( $new_instance[ $key ] ) ? $new_instance[ $key ] : '';
				break;
				default:
					$instance[ $key ] = isset( $new_instance[ $key ] ) ? flash_clean( $new_instance[ $key ] ) : '';
				break;
			}

			/**
			 * Sanitize the value of a setting.
			 */
			$instance[ $key ] = apply_filters( 'flash_toolkit_widget_settings_sanitize_option', $instance[ $key ], $new_instance, $key, $setting );
		}

		$this->flush_widget_cache();

		return $instance;
	}

	/**
	 * Outputs the settings update form.
	 *
	 * @see   WP_Widget->form
	 * @param array $instance
	 */
	public function form( $instance ) {

		if ( empty( $this->settings ) ) {
			return;
		}

		$group_name_array = array(); ?>

		<div class="flash-tab-title-container">
		<?php $groupcount = 1;

		foreach ( $this->settings as $key => $setting ) {

			$group_name = isset( $setting['group'] ) ? $setting['group'] : __( 'General', 'flash-toolkit' );

			if ( ! in_array( $group_name, $group_name_array )) {
				$group_name_array[] = $group_name;

				if( $group_name_array[0] != '' ) { ?>
					<a class="flash-tab-title <?php echo ($groupcount == 1 ? ' active' : '' ); ?>" href="#flash-tab-<?php echo esc_attr( $groupcount ); ?>">
					<?php echo esc_html( $group_name ); ?>
					</a>
				<?php
				}
				$groupcount++;
			}
		} ?>

		</div><!-- .flash-tab-title-container -->
		<div class="flash-toolkit-tab-content-container">
		<?php $groupcount = 1;

		foreach ( $group_name_array as $group ) { ?>
			<div class="flash-toolkit-tab" id="flash-tab-<?php echo esc_attr( $groupcount ); ?>">
			<?php foreach ( $this->settings as $key => $setting ) {
				$current_setting_group = isset( $setting['group'] ) ? $setting['group'] : __( 'General', 'flash-toolkit' );
				if ( $current_setting_group == $group || empty( $group_name_array ) ) {
					$class       = isset( $setting['class'] ) ? $setting['class'] : '';
					$value       = isset( $instance[ $key ] ) ? $instance[ $key ] : $setting['std'];
					$field_width = isset( $setting['field_width'] ) ? $setting['field_width'] : 'col-full';

					switch ( $setting['type'] ) {

						case 'text' :
							?>
							<p class="ft-widget-col <?php echo esc_attr( $field_width ); ?>">
								<label for="<?php echo $this->get_field_id( $key ); ?>"><?php echo $setting['label']; ?></label>
								<input class="widefat <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo $this->get_field_name( $key ); ?>" type="text" value="<?php echo esc_attr( $value ); ?>" />
							</p>
							<?php
						break;

						case 'number' :
							?>
							<p class="ft-widget-col <?php echo esc_attr( $field_width ); ?>">
								<label for="<?php echo $this->get_field_id( $key ); ?>"><?php echo $setting['label']; ?></label>
								<input class="widefat <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo $this->get_field_name( $key ); ?>" type="number" step="<?php echo esc_attr( $setting['step'] ); ?>" min="<?php echo esc_attr( $setting['min'] ); ?>" max="<?php echo esc_attr( $setting['max'] ); ?>" value="<?php echo esc_attr( $value ); ?>" />
							</p>
							<?php
						break;

						case 'datetimepicker' :
							?>
							<p>
								<label for="<?php echo $this->get_field_id( $key ); ?>"><?php echo $setting['label']; ?></label>
								<input class="widefat flash-datetime-picker <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo $this->get_field_name( $key ); ?>" type="text" value="<?php echo esc_attr( $value ); ?>" />
							</p>
							<?php
						break;

						case 'select' :
							?>
							<p class="ft-widget-col <?php echo esc_attr( $field_width ); ?>">
								<label for="<?php echo $this->get_field_id( $key ); ?>"><?php echo $setting['label']; ?></label>
								<select class="widefat <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo $this->get_field_name( $key ); ?>">
									<?php foreach ( $setting['options'] as $option_key => $option_value ) : ?>
										<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $value ); ?>><?php echo esc_html( $option_value ); ?></option>
									<?php endforeach; ?>
								</select>
							</p>
							<?php
						break;

						case 'select_pages' :
						case 'select_categories' :
							?>
							<p class="ft-widget-col <?php echo esc_attr( $field_width ); ?>">
								<label for="<?php echo $this->get_field_id( $key ); ?>"><?php echo $setting['label']; ?></label>
								<?php
									$args = array(
										'id'       => $this->get_field_id( $key ),
										'name'     => $this->get_field_name( $key ),
										'class'    => 'widefat ' . esc_attr( $class ),
										'selected' => $value,
									);

									if ( isset( $setting['args'] ) ) {
										$args = wp_parse_args( $setting['args'], $args );
									}

									// Display dropdown based on settings type.
									if ( 'select_pages' === $setting['type'] ) {
										wp_dropdown_pages( $args );
									} elseif ( 'select_categories' === $setting['type'] ) {
										wp_dropdown_categories( $args );
									}
								?>
							</p>
							<?php
						break;

						case 'textarea' :
							?>
							<p>
								<label for="<?php echo $this->get_field_id( $key ); ?>"><?php echo $setting['label']; ?></label>
								<textarea class="widefat <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo $this->get_field_name( $key ); ?>" cols="20" rows="3"><?php echo esc_textarea( $value ); ?></textarea>
								<?php if ( isset( $setting['desc'] ) ) : ?>
									<small><?php echo esc_html( $setting['desc'] ); ?></small>
								<?php endif; ?>
							</p>
							<?php
						break;

						case 'checkbox' :
							?>
							<p class="ft-widget-col <?php echo esc_attr( $field_width ); ?>">
								<input class="checkbox <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" type="checkbox" value="1" <?php checked( $value, 1 ); ?> />
								<label for="<?php echo $this->get_field_id( $key ); ?>"><?php echo $setting['label']; ?></label>
							</p>
							<?php
						break;

						case 'image' :
							?>
							<div id="tg-widget-image-uploader" class="flash-media <?php echo esc_attr( $class ); ?>">
								<p><label for="<?php echo $this->get_field_id( $key ); ?>"><?php echo esc_html( $setting['label'] ); ?></label></p>
								<div class="media-uploader" id="<?php echo $this->get_field_id( $key ); ?>">
									<div class="tg-media-preview">
										<button class="tg-media-remove dashicons dashicons-no-alt">
											<span class="screen-reader-text"><?php esc_html_e( 'Remove media', 'flash-toolkit' ) ?></span>
										</button>
										<?php if ( $value != '' ) : ?>
											<img class="tg-media-preview-default" src="<?php echo esc_url( $value ); ?>" />
										<?php endif; ?>
									</div>
									<p>
										<input type="text" class="widefat tg-media-input" id="<?php echo $this->get_field_id( $key ); ?>" name="<?php echo $this->get_field_name( $key ); ?>" value="<?php echo esc_url( $value ); ?>" style="margin-top:5px;" />
										<button class="tg-image-upload button button-secondary button-large" id="<?php echo $this->get_field_id( $key ); ?>" data-choose="<?php esc_attr_e( 'Choose an image', 'flash-toolkit' ); ?>" data-update="<?php esc_attr_e( 'Use image', 'flash-toolkit' ); ?>" style="width:100%;margin-top:6px;margin-right:30px;"><?php esc_html_e( 'Select an Image', 'flash-toolkit' ); ?></button>
									</p>
								</div>
							</div>
							<?php
						break;

						case 'radio-image' :
            					?>
            					<p class="flash-radio-image">
            						<label for="<?php echo $this->get_field_id( $key ); ?>"><?php echo $setting['label']; ?></label>
            						<span class="flash-radio-image-options">
        							<?php foreach ( $setting['options'] as $option_key => $option_image ) : ?>
        								<label>
	        								<input type="radio" <?php checked( $option_key, $value ); ?> id="<?php echo $this->get_field_id( $option_key ); ?>" name="<?php echo $this->get_field_name( $key ); ?>" value="<?php echo esc_attr( $option_key ); ?>"/>
	        								<img src="<?php echo esc_url( $option_image ); ?>" />
        								</label>
        							<?php endforeach; ?>
        							</span>
            					</p>
            					<?php
            				break;

						case 'icon_picker' :
							?>
							<div id="tg-widget-icon-picker" class="flash-icon <?php echo esc_attr( $class ); ?>">
								<p><label for="<?php echo $this->get_field_id( $key ); ?>"><?php echo esc_html( $setting['label'] ); ?></label></p>
								<select class="widefat flash-enhanced-select-icons" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo $this->get_field_name( $key ); ?>" data-placeholder="<?php esc_attr_e( 'Choose icons&hellip;', 'flash-toolkit' ); ?>" title="<?php esc_attr_e( 'Icon', 'flash-toolkit' ) ?>" style="width: 100%">
									<option value=""></option>
									<?php foreach ( $setting['options'] as $option_key => $option_value ) : ?>
										<option value="<?php echo esc_attr( $option_key ); ?>" data-icon="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $value ); ?>><?php echo esc_html( $option_value ); ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<?php
						break;

						case 'font_picker' :
							?>
							<p class="ft-widget-col <?php echo esc_attr( $field_width ); ?>">
								<label for="<?php echo $this->get_field_id( $key ); ?>"><?php echo esc_html( $setting['label'] ); ?></label>
								<select class="widefat flash-enhanced-select-fonts <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo $this->get_field_name( $key ); ?>" data-placeholder="<?php esc_attr_e( 'Choose fonts&hellip;', 'flash-toolkit' ); ?>" title="<?php esc_attr_e( 'Font', 'flash-toolkit' ) ?>" style="width: 100%">
									<option value=""></option>
									<?php foreach ( $setting['options'] as $option_key => $option_value ) : ?>
										<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $value ); ?>><?php echo esc_html( $option_value ); ?></option>
									<?php endforeach; ?>
								</select>
							</p>
							<?php
						break;

						case 'select2' :
							?>
							<p class="ft-widget-col <?php echo esc_attr( $field_width ); ?>">
								<label for="<?php echo $this->get_field_id( $key ); ?>"><?php echo esc_html( $setting['label'] ); ?></label>
								<select class="widefat flash-enhanced-select <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo $this->get_field_name( $key ); ?>" data-placeholder="<?php esc_attr_e( 'Choose', 'flash-toolkit' ); ?>" style="width: 100%">
									<option value=""></option>
									<?php foreach ( $setting['options'] as $option_key => $option_value ) : ?>
										<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $value ); ?>><?php echo esc_html( $option_value ); ?></option>
									<?php endforeach; ?>
								</select>
							</p>
							<?php
						break;

						case 'repeater' :
							include( dirname( __FILE__ ) . '/views/html-admin-tmpl-repeater.php' );
						break;

						// Default: run an action.
						default :
							do_action( 'flash_toolkit_widget_field_' . $setting['type'], $key, $value, $setting, $instance );
						break;
					} //End switch().
				}
			} ?>
			</div><!-- tab closed -->
			<?php $groupcount++;
		} ?>
	 	</div><!-- .flash-toolkit-tab-content-container -->
		<?php
	}

	/**
	 * Output the repeater field settings update form.
	 *
	 * @param string $settings
	 * @param array  $instance
	 */
	public function output_repeater_field( $settings = array(), $instance, $setting_key, $field_key, $setting_std ) {
		if ( empty( $settings ) ) {
			return;
		}

		foreach ( $settings as $key => $setting ) {
			$class = isset( $setting['class'] ) ? $setting['class'] : '';
			$field = isset( $setting_std[ $field_key ][ $key ] ) ? $setting_std[ $field_key ][ $key ] : $setting['std'];
			$value = isset( $instance[ $setting_key ][ $field_key ][ $key ] ) ? $instance[ $setting_key ][ $field_key ][ $key ] : $field;

			// Modified fields.
			$field_id   = $this->get_field_id( $setting_key ) . '-' . $field_key . '-' . $key;
			$field_name = $this->get_field_name( $setting_key ) . '[' . $field_key . '][' . $key . ']';

			switch ( $setting['type'] ) {
				case 'text' :
					?>
					<p>
						<label for="<?php echo $field_id; ?>"><?php echo $setting['label']; ?></label>
						<input class="widefat <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $field_id ); ?>" name="<?php echo $field_name; ?>" type="text" value="<?php echo esc_attr( $value ); ?>" />
					</p>
					<?php
				break;
				case 'number' :
					?>
					<p>
						<label for="<?php echo $field_id; ?>"><?php echo $setting['label']; ?></label>
						<input class="widefat <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $field_id ); ?>" name="<?php echo $field_name; ?>" type="number" step="<?php echo esc_attr( $setting['step'] ); ?>" min="<?php echo esc_attr( $setting['min'] ); ?>" max="<?php echo esc_attr( $setting['max'] ); ?>" value="<?php echo esc_attr( $value ); ?>" />
					</p>
					<?php
				break;
				case 'select' :
					?>
					<p>
						<label for="<?php echo $field_id; ?>"><?php echo $setting['label']; ?></label>
						<select class="widefat <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $field_id ); ?>" name="<?php echo $field_name; ?>">
							<?php foreach ( $setting['options'] as $option_key => $option_value ) : ?>
								<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $value ); ?>><?php echo esc_html( $option_value ); ?></option>
							<?php endforeach; ?>
						</select>
					</p>
					<?php
				break;
				case 'select_pages' :
				case 'select_categories' :
					?>
					<p>
						<label for="<?php echo $field_id; ?>"><?php echo $setting['label']; ?></label>
						<?php
							$args = array(
								'id'       => $field_id,
								'name'     => $field_name,
								'class'    => 'widefat ' . esc_attr( $class ),
								'selected' => $value,
							);

							if ( isset( $setting['args'] ) ) {
								$args = wp_parse_args( $setting['args'], $args );
							}

							// Display dropdown based on settings type.
							if ( 'select_pages' === $setting['type'] ) {
								wp_dropdown_pages( $args );
							} elseif ( 'select_categories' === $setting['type'] ) {
								wp_dropdown_categories( $args );
							}
						?>
					</p>
					<?php
				break;
				case 'textarea' :
					?>
					<p>
						<label for="<?php echo $field_id; ?>"><?php echo $setting['label']; ?></label>
						<textarea class="widefat <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $field_id ); ?>" name="<?php echo $field_name; ?>" cols="20" rows="3"><?php echo esc_textarea( $value ); ?></textarea>
						<?php if ( isset( $setting['desc'] ) ) : ?>
							<small><?php echo esc_html( $setting['desc'] ); ?></small>
						<?php endif; ?>
					</p>
					<?php
				break;
				case 'checkbox' :
					?>
					<p>
						<input class="checkbox <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $field_id ); ?>" name="<?php echo $field_name; ?>" type="checkbox" value="1" <?php checked( $value, 1 ); ?> />
						<label for="<?php echo $field_id; ?>"><?php echo $setting['label']; ?></label>
					</p>
					<?php
				break;
				case 'image' :
					?>
					<div id="tg-widget-image-uploader" class="flash-media <?php echo esc_attr( $class ); ?>">
						<p><label for="<?php echo $field_id; ?>"><?php echo esc_html( $setting['label'] ); ?></label></p>
						<div class="media-uploader" id="<?php echo $field_id; ?>">
							<div class="tg-media-preview">
								<button class="tg-media-remove dashicons dashicons-no-alt">
									<span class="screen-reader-text"><?php esc_html_e( 'Remove media', 'flash-toolkit' ) ?></span>
								</button>
								<?php if ( $value != '' ) : ?>
									<img class="tg-media-preview-default" src="<?php echo esc_url( $value ); ?>" />
								<?php endif; ?>
							</div>
							<p>
								<input type="text" class="widefat tg-media-input" id="<?php echo $field_id; ?>" name="<?php echo $field_name; ?>" value="<?php echo esc_url( $value ); ?>" style="margin-top:5px;" />
								<button class="tg-image-upload button button-secondary button-large" id="<?php echo $field_id; ?>" data-choose="<?php esc_attr_e( 'Choose an image', 'flash-toolkit' ); ?>" data-update="<?php esc_attr_e( 'Use image', 'flash-toolkit' ); ?>" style="width:100%;margin-top:6px;margin-right:30px;"><?php esc_html_e( 'Select an Image', 'flash-toolkit' ); ?></button>
							</p>
						</div>
					</div>
					<?php
				break;
				case 'icon_picker' :
					?>
					<div id="tg-widget-icon-picker" class="flash-icon <?php echo esc_attr( $class ); ?>">
						<p><label for="<?php echo $field_id; ?>"><?php echo esc_html( $setting['label'] ); ?></label></p>
						<select class="widefat flash-enhanced-select-icons" id="<?php echo esc_attr( $field_id ); ?>" name="<?php echo $field_name; ?>" data-placeholder="<?php esc_attr_e( 'Choose icons&hellip;', 'flash-toolkit' ); ?>" title="<?php esc_attr_e( 'Icon', 'flash-toolkit' ) ?>" style="width: 100%">
							<option value=""></option>
							<?php foreach ( $setting['options'] as $option_key => $option_value ) : ?>
								<option value="<?php echo esc_attr( $option_key ); ?>" data-icon="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $value ); ?>><?php echo esc_html( $option_value ); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<?php
				break;
			}
		}
	}
}
