<?php
/**
 * @package     Cooalliance 
 * @author      Ibrahim
 */
if( !defined( 'WPINC' ) ) {
    die;
}

class Image_Upload{

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

        echo '<div class="wsf-single-field wsf-image-uploader '.esc_attr( $attr['wrap_class'].esc_attr( $inline ) ).'">
        <label>'.esc_html( $attr['label'] ).'</label>
        <input id="'.esc_attr( $id ).'" class="wsf_background_image '.esc_attr( $class ).'" type="text" name="'.$optName.'['.$name.']" value="'.esc_attr( $value ).'" />
        <input type="button" class="wsf_image_button button-primary" value="Insert Media" />

        </div>';

    }

}