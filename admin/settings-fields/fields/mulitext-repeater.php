<?php
/**
 * @package     Cooalliance 
 * @author      Ibrahim
 */

if( !defined( 'WPINC' ) ) {
    die;
}

class Multitext_Repeter{

	private $args;

    function __construct( array $args ) {

        $this->args = $args;
    }

    public function get_field() {
        $this->field_markup();
    }

    private function args_maping() {

        $default = array(
            'class'           => '',
            'wrap_class'      => '',
            'inline'          => false,
            'id'              => '',
            'name'            => '',
            'required'        => '',
            'label'           => '',
            'placeholder_1'   => '',
            'placeholder_2'   => '',
            'placeholder_3'   => ''
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
 
        $getvalue = !empty( $optData[$name] ) ? $optData[$name] : '';

        $values = json_decode( $getvalue, true );
        $encodeValues = json_encode( $getvalue );

        
        $class  = ( !empty( $attr['class'] ) ) ? $attr['class'] : 'field-'.$name;
        $id     = ( !empty( $attr['id'] ) ) ? $attr['id'] : 'field_'.$name;
        $inline = !empty( $attr['inline'] ) ? ' label-inline' : ' label-block';

        echo '<div class="wsf-single-field wsf-multitext-repeater'.esc_attr( $attr['wrap_class'].esc_attr( $inline ) ).'" data-name="'.$optName.'['.$name.']"><h4>'.esc_html( $attr['label'] ).'</h4>';

        ?>
        
        <div class="items-preview">
            <table class="wp-list-table widefat fixed striped posts">
                <thead>
                    <tr>
                        <th><?php esc_html_e( 'No', 'coronaupdate' ); ?></th>
                        <th><?php esc_html_e( 'Title', 'coronaupdate' ); ?></th>
                        <th><?php esc_html_e( 'Url', 'coronaupdate' ); ?></th>
                        <th><?php esc_html_e( 'Icon', 'coronaupdate' ); ?></th>
                        <th><?php esc_html_e( 'Remove', 'coronaupdate' ); ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                if( !empty( $values ) ) {
                    foreach( $values as $key => $value ) {

                        echo '<tr>
                            <th scope="row">Quick Nav:- '.esc_html( $key+1 ).'</th>
                            <td>'.esc_html( $value[0] ).'</td>
                            <td>'.esc_html( $value[1] ).'</td>
                            <td><i class="'.esc_html( $value[2] ).'"></i></td>
                            <td><span data-index="'.esc_attr( $key ).'" class="item-remove" >X</span></td>
                        </tr>';
                        

                    }
                }
                ?>
                </tbody>
            </table>
        </div>

        <div class="items-form">
            <input type="text" class="input" placeholder="<?php echo esc_attr( $attr['placeholder_1'] ) ?>">
            <input type="text" class="input" placeholder="<?php echo esc_attr( $attr['placeholder_2'] ) ?>" >
            <select class="fontawesome input">
                <?php 
                $icons = coronaupdate_fa_icons();
                foreach( $icons as $key => $icon ) {
                    echo '<option value="'.esc_attr( $key ).'">'.esc_html( $icon ).'</option>';
                }
                ?>
            </select>
                
        </div>
        <input type="hidden" class="push-val" name="<?php echo $optName.'['.$name.']' ?>" value='<?php echo esc_html( $getvalue ) ; ?>'/>
        <button class="add-items"><?php esc_html_e( 'Add Items', 'coronaupdate' ); ?></button>

        <?php

        echo '</div>';

    }

}