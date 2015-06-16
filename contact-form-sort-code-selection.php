<?php
/*
Plugin Name: Contact Form Selection Plugin
Plugin URI: http://example.com
Description: Simple WordPress Contact Form selection so sort code will be added on post and page , dependent on contact form 7
Version: 1.0
Author: Commercepundit
Author URI: http://www.commercepundit.com/
*/
    //
    // the plugin code will go here..
    //

/* BEllow code done by CP developer */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {
//if (class_exists( 'Contact Form 7' ) ){

add_action( 'add_meta_boxes', 'cfscs_contact_add_meta_insert_id' );
add_action('init', 'cfscs_contact_add_js');
function cfscs_contact_add_js ()
{
    
    wp_register_script( 'contact-form-sort-code-selection', plugins_url( 'contact-form-sort-code-selection/contact-form-sort-code-selection.js' , dirname(__FILE__) ));
    wp_enqueue_script( 'contact-form-sort-code-selection' );

}
function cfscs_contact_add_meta_insert_id()
{
    add_meta_box( 
        'cfscs_contact_insert_id',
        __( 'Contact Form Selection: Insert Contact Form Sort Code', 'contact_text' ),
        'cfscs_contact_insert_id',
        'post' 
    );
    add_meta_box(
        'cfscs_contact_insert_id',
        __( 'Contact Form Selection : Insert Contact Form Sort Code ', 'contact_text' ), 
        'cfscs_contact_insert_id',
        'page'
    );    
}
function cfscs_contact_insert_id() {
    
 wp_nonce_field( plugin_basename( __FILE__ ), 'cfscs_noncename' );
  
  echo '<label for="cfscs_add_form">';
       _e("Insert Contact Form :", 'contact_text' );
  echo '</label> ';
  
  global $wpdb; 
  $table_name1 = $wpdb->prefix . "posts";
  
  $sql = "SELECT ID, post_title FROM " . $table_name1. " where post_type = 'wpcf7_contact_form' and post_status = 'publish';";
  
  $myrows = $wpdb->get_results( $sql );
  echo '<form name = "contact_adder">';
  echo '<select name = "contacta" id = "contacta">';
  
  foreach ($myrows as $myrow)
  {   
   
    echo '<option value="' . $myrow->ID  .  '">' . $myrow->post_title  .  '</option>';        
      
  }
  
   echo '</select>';
   echo '<input type = "button" id = "contact_select" name = "contact_select" onclick = "cfscs_add(this) ;" value = "Add to post"><br />';
    
}
    
}    

?>
