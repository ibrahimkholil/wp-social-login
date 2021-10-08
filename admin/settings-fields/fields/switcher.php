<?php
/**
 * @package     Cooalliance 
 * @author      Ibrahim
 */

 
if( !defined( 'WPINC' ) ) {
    die;
}

class Switcher{

	private $args;

    function __construct( array $args ) {

        $this->args = $args;
    }

    public function get_field() {
        $this->field_markup();
    }

    private function args_maping() {

        $default = array(
            'class'         => '',
            'wrap_class'    => '',
            'inline'        => false,
            'id'            => '',
            'name'          => '',
            'required'      => '',
            'label'         => ''
        );

        $attr = wp_parse_args( $this->args, $default );

        return $attr;

    }

    private function field_markup() {

        $attr  = $this->args_maping();

        $name = $attr['name'];

        $optName = $optData = '';

        $options = apply_filters( 'cooalliance_get_settings_opt', '' );

        if( is_array( $options ) ) {
            $optName = $options['option_name'];
            $optData = $options['option_data'];
        }
 
        $value = !empty( $optData[$name] ) ? $optData[$name] : '';

        
        $class  = ( !empty( $attr['class'] ) ) ? $attr['class'] : 'field-'.$name;
        $id     = ( !empty( $attr['id'] ) ) ? $attr['id'] : 'field_'.$name;
        $inline = !empty( $attr['inline'] ) ? ' label-inline' : ' label-block';

        ?>
        <div class="wsf-single-field wsf-switcher <?php echo esc_attr( $attr['wrap_class'].esc_attr( $inline ) ); ?>">
        <?php 
        if( !empty( $attr['label'] ) ) {
            echo '<h4>'.esc_html( $attr['label'] ).'</h4>';
        }
        ?>
        <div class="onoffswitch">
            
            <input <?php echo checked( $value, 'on', false ); ?> type="checkbox" name="<?php echo esc_attr( $optName.'['.$name.']' ); ?>" class="onoffswitch-checkbox" id="<?php echo esc_attr( $id ); ?>">
            <label class="onoffswitch-label" for="<?php echo esc_attr( $id ); ?>">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
            </label>
        </div>
        </div>
        <?php

    }

}