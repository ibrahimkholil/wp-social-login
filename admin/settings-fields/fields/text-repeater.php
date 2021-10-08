<?php
/**
 * @package     Cooalliance 
 * @author      Ibrahim
 */

if( !defined( 'WPINC' ) ) {
    die;
}

class Text_Repeter{

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
            'label'         => '',
            'placeholder'   => ''
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

        echo '<div class="wsf-single-field wsf-repeater'.esc_attr( $attr['wrap_class'].esc_attr( $inline ) ).'"><h4>'.esc_html( $attr['label'] ).'</h4>';
            if( !empty(  $value ) ) {
                foreach( $value as $val ) {

                    echo '<div class="text-repeater text-repeater-default">
                        <input type="text" name="'.$optName.'['.$name.'][]" value="'.esc_attr( $val ).'" placeholder="'.esc_attr( $attr['placeholder'] ).'" />
                        <span class="add-field">+</span>
                        <span class="remove-field">-</span>
                    </div>';

                }
                    
            } else {
                echo '<div class="text-repeater">
                        <input type="text" name="'.$optName.'['.$name.'][]" />
                        <span class="add-field">+</span>
                        <span class="remove-field">-</span>
                    </div>';
            }

        echo '</div>';

    }

}