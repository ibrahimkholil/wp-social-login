<?php
/**
 * @package     Cooalliance 
 * @author      Ibrahim
 */

if( !defined( 'WPINC' ) ) {
    die;
}

class Radio{

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
            'options'       => []
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

        echo '<div class="wsf-single-field wsf-text '.esc_attr( $attr['wrap_class'].esc_attr( $inline ) ).'"><h4>'.esc_html( $attr['label'] ).'</h4>';

        //
        if( !empty( $attr['options'] ) ):
            foreach( $attr['options'] as $key => $val ):
        ?>
        
        <div class="single-radio">
            <label for="<?php echo esc_attr( $key ); ?>"> <?php echo esc_html( $val ); ?> </label>
            <input type="radio" id="<?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $optName.'['.$name .']' ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php checked( $key, $value ); ?>  />
        </div>

        <?php
            endforeach;
        endif;
        echo '</div>';

    }

}