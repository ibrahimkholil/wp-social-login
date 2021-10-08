<?php
/**
 * @package     Cooalliance 
 * @author      Ibrahim
 */

if( !defined( 'WPINC' ) ) {
    die;
}

class Select{

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
            'condition'     => '',
            'id'            => '',
            'name'          => '',
            'label'         => '',
            'options'       => ''
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
        $conditionClass = !empty( $attr['condition'] ) ? ' fold' : '';

        echo '<div class="wsf-single-field wsf-select '.esc_attr( $attr['wrap_class'].$inline.$conditionClass  ).'">
        <h4>'.esc_html( $attr['label'] ).'</h4>
        <select id="'.esc_attr( $id ).'" class="'.esc_attr( $class ).'" name="'.$optName.'['.$name .']'.'" >';
        if( !empty( $attr['options'] ) ) {
            foreach( $attr['options'] as $key => $val) {
                echo '<option value="'.esc_attr( $key ).'" '.selected( $key, $value , false  ).'>'.esc_html( $val ).'</option>';
            }
        }
        echo '</select>
        </div>';

    }


}
