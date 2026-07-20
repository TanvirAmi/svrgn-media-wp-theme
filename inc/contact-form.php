<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Handles the Contact page form (#contactForm) via admin-ajax.
 * The front-end JS in assets/js/contact.js should POST to svrgnContact.ajaxUrl
 * with action=svrgn_contact_submit and the svrgnContact.nonce.
 */
function svrgn_handle_contact_submit() {
	check_ajax_referer( 'svrgn_contact_form', 'nonce' );

	$full_name = isset( $_POST['fullName'] ) ? sanitize_text_field( wp_unslash( $_POST['fullName'] ) ) : '';
	$email     = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$brand     = isset( $_POST['brand'] ) ? sanitize_text_field( wp_unslash( $_POST['brand'] ) ) : '';
	$website   = isset( $_POST['website'] ) ? esc_url_raw( wp_unslash( $_POST['website'] ) ) : '';
	$spend     = isset( $_POST['spend'] ) ? sanitize_text_field( wp_unslash( $_POST['spend'] ) ) : '';
	$message   = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

	if ( empty( $full_name ) || empty( $email ) || empty( $brand ) || empty( $message ) || ! is_email( $email ) ) {
		wp_send_json_error( array( 'message' => 'Please fill in all required fields with a valid email.' ) );
	}

	$to      = get_option( 'admin_email' );
	$subject = sprintf( 'New inquiry from %s (%s)', $brand, $full_name );

	$body  = "New contact form submission from svrgnmedia.com\n\n";
	$body .= "Name: {$full_name}\n";
	$body .= "Email: {$email}\n";
	$body .= "Brand: {$brand}\n";
	$body .= "Website: {$website}\n";
	$body .= "Monthly Ad Spend: {$spend}\n\n";
	$body .= "Message:\n{$message}\n";

	$headers = array( 'Content-Type: text/plain; charset=UTF-8', "Reply-To: {$full_name} <{$email}>" );

	$sent = wp_mail( $to, $subject, $body, $headers );

	if ( $sent ) {
		wp_send_json_success( array( 'message' => 'Message received.' ) );
	} else {
		wp_send_json_error( array( 'message' => 'Something went wrong sending your message. Please email us directly.' ) );
	}
}
add_action( 'wp_ajax_svrgn_contact_submit', 'svrgn_handle_contact_submit' );
add_action( 'wp_ajax_nopriv_svrgn_contact_submit', 'svrgn_handle_contact_submit' );
