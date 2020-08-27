<?php
/*-----------------------------------------------------------------------------------*/

	/* This file contains custom control classes for the theme customizer */
	/* WARNING: Do not change anything in here or things will quickly break */

/*-----------------------------------------------------------------------------------*/

	if ( ! class_exists( 'WP_Customize_Control' ) )
		return NULL;

	class Pryanik_Textarea_Custom_Control extends WP_Customize_Control{
		public function render_content() {
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea class="large-text" cols="20" rows="5" <?php $this->link(); ?>>
					<?php echo esc_textarea( $this->value() ); ?>
				</textarea>
			</label>
			<?php
		}
	}

	class Pryanik_Site_Layout_Picker_Custom_Control extends WP_Customize_Control{
		public function render_content() {
			$name = '_customize-radio-' . $this->id;
			?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<?php 
						foreach ( $this->choices as $value => $label ) : ?>
							<label class="layout_radio">
								<img src="<?php echo PRYANIK_INC_URI . 'img/' . esc_attr( $value ) . '.png' ?>" alt="<?php echo esc_html( $label ); ?>" /><br/>
								<input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
								<?php echo esc_html( $label ); ?>
							</label>
					<?php endforeach; ?>
				</label>
			<?php
	   }
	}

	class Pryanik_Customize_Slider_Control extends WP_Customize_Control {

		public $type = 'slider';

		public function enqueue() {
			wp_enqueue_script( 'jquery-ui-core' );
			wp_enqueue_script( 'jquery-ui-slider' );
		}

		public function render_content() { ?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<input style="width: 13%; margin-right: 3%; float: left; text-align: center;" type="text" id="input_<?php echo esc_attr($this->id); ?>" value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?>/>
			</label>
			<div style="width: 80%; margin-top: 6px; float: left;" id="slider_<?php echo esc_attr($this->id); ?>" class="control_slider"
					data-min="<?php echo esc_attr($this->choices['min']); ?>"
					data-max="<?php echo esc_attr($this->choices['max']); ?>"
					data-step="<?php echo esc_attr($this->choices['step']); ?>"
					data-value="<?php echo esc_attr($this->value()); ?>"
					data-input-id="<?php echo esc_attr($this->id); ?>"></div>
			<script>
				jQuery(document).ready(function($) {
					$( "#slider_<?php echo esc_attr($this->id); ?>" ).slider({
						value: <?php echo esc_attr($this->value()); ?>,
						min: <?php echo esc_attr($this->choices['min']); ?>,
						max: <?php echo esc_attr($this->choices['max']); ?>,
						step: <?php echo esc_attr($this->choices['step']); ?>,
						slide: function( event, ui ) {
							$( "#input_<?php echo esc_attr($this->id); ?>" ).val(ui.value).keyup();
						}
					});
					$( "#input_<?php echo esc_attr($this->id); ?>" ).val( $( "#slider_<?php echo esc_attr($this->id); ?>" ).slider( "value" ) );
				});
			</script>
			<?php
		}
	}
?>