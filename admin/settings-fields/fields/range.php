<?php
/**
 * @package     Cooalliance 
 * @author      Ibrahim
 */

if( !defined( 'WPINC' ) ) {
    die;
}

class Range{

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
            'label'         => '',
            'min'           => '1',
            'max'           => '100'
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

        echo '<div class="wsf-single-field wsf-text '.esc_attr( $attr['wrap_class'].esc_attr( $inline ) ).'">
        <h4>'.esc_html( $attr['label'] ).'</h4>
        <div class="wsf-range" data-max="'.esc_attr( $attr['max'] ).'" data-min="'.esc_attr( $attr['min'] ).'"  data-range="'.esc_html( $value ).'"><input type="hidden" name="'.$optName.'['.$name.']" value="'.esc_html( $value ).'" /><div  class="ui-slider-handle">'.esc_html( $value ).'</div></div>
        </div>';

    }


}
