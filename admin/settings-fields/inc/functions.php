<?php
/**
 *
 * @package     Cooalliance 
 * @author      Ibrahim
 *
 *
 */

defined('ABSPATH') or die("Cheating........Uh!!"); 

// Text Field
function cooalliance_text_field( array $args ) {

	$obj = new Text( $args );
	$obj->get_field();

}
// Textarea Field
function cooalliance_textarea_field( array $args ) {

	$obj = new Textarea( $args );
	$obj->get_field();

}
// Hidden Field
function cooalliance_hidden_field( array $args ) {

	$obj = new Hidden( $args );
	$obj->get_field();

}
// Checkbox Field
function cooalliance_checkbox_field( array $args ) {
	$obj = new Checkbox( $args );
	$obj->get_field();
}
// Radio Field
function cooalliance_radio_field( array $args ) {
	$obj = new Radio( $args );
	$obj->get_field();
}

// drug and drop Field
function cooalliance_drugdrop_field( array $args ) {
	$obj = new Drug_Drop( $args );
	$obj->get_field();
}
// Group Field
function cooalliance_group_field( array $args ) {
	$obj = new Group( $args );
	$obj->get_field();
}
// Text Repeter Field
function cooalliance_textrepeter_field( array $args ) {
	$obj = new Text_Repeter( $args );
	$obj->get_field();
}
// Image Upload Field
function cooalliance_imageupload_field( array $args ) {
	$obj = new Image_Upload( $args );
	$obj->get_field();

}
// Select Field
function cooalliance_select_field( array $args ) {
	$obj = new Select( $args );
	$obj->get_field();

}

// Select multitext repeter field
function cooalliance_multitext_field( array $args ) {
	$obj = new Multitext_Repeter( $args );
	$obj->get_field();

}
// Switcher field
function cooalliance_switcher_field( array $args ) {
	$obj = new Switcher( $args );
	$obj->get_field();

}