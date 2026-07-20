<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Shared plumbing for the SVRGN section widgets (Insight, System, Work,
 * Projects, Results, Fit, Engage, Different, Contact). Each widget defines
 * a $fields map of key => [label, type] and a defaults() array; this base
 * class turns that into the admin form + save/sanitize logic automatically,
 * so every widget file only has to contain its field list and its
 * front-end widget() markup.
 *
 * Supported field types: text, url, textarea, image.
 * "textarea" fields that represent repeatable lists (e.g. brand names,
 * bullet items) are read one-item-per-line — see SVRGN_Fields_Widget::lines().
 */

function svrgn_widget_admin_assets( $hook ) {
	if ( ! in_array( $hook, array( 'widgets.php', 'customize.php' ), true ) ) return;
	wp_enqueue_media();
	wp_enqueue_script( 'svrgn-admin-widgets', SVRGN_URI . '/assets/js/admin-widgets.js', array(), SVRGN_VER, true );
}
add_action( 'admin_enqueue_scripts', 'svrgn_widget_admin_assets' );

function svrgn_widget_row( $type, $id, $name, $label, $value ) {
	echo '<p><label for="' . esc_attr( $id ) . '">' . esc_html( $label ) . '</label>';
	switch ( $type ) {
		case 'textarea':
			echo '<textarea class="widefat" rows="4" id="' . esc_attr( $id ) . '" name="' . esc_attr( $name ) . '">' . esc_textarea( $value ) . '</textarea>';
			break;
		case 'image':
			echo '<div class="svrgn-image-field">';
			echo '<input type="hidden" class="svrgn-image-url" id="' . esc_attr( $id ) . '" name="' . esc_attr( $name ) . '" value="' . esc_attr( $value ) . '">';
			echo '<div class="svrgn-image-preview" style="margin:6px 0;">' . ( $value ? '<img src="' . esc_url( $value ) . '" style="max-width:100%;height:auto;display:block;">' : '' ) . '</div>';
			echo '<button type="button" class="button svrgn-image-select">Choose Image</button> ';
			echo '<button type="button" class="button svrgn-image-remove" style="' . ( $value ? '' : 'display:none;' ) . '">Remove</button>';
			echo '</div>';
			break;
		case 'url':
			echo '<input class="widefat" type="url" id="' . esc_attr( $id ) . '" name="' . esc_attr( $name ) . '" value="' . esc_attr( $value ) . '">';
			break;
		default:
			echo '<input class="widefat" type="text" id="' . esc_attr( $id ) . '" name="' . esc_attr( $name ) . '" value="' . esc_attr( $value ) . '">';
	}
	echo '</p>';
}

function svrgn_widget_sanitize( $type, $value ) {
	switch ( $type ) {
		case 'textarea': return sanitize_textarea_field( $value );
		case 'image':
		case 'url': return esc_url_raw( $value );
		default: return sanitize_text_field( $value );
	}
}

abstract class SVRGN_Fields_Widget extends WP_Widget {

	/** @var array key => [ label, type ] */
	protected $fields = array();

	protected function defaults() {
		return array();
	}

	public function form( $instance ) {
		$d = wp_parse_args( (array) $instance, $this->defaults() );
		foreach ( $this->fields as $key => $meta ) {
			$value = isset( $d[ $key ] ) ? $d[ $key ] : '';
			svrgn_widget_row( $meta[1], $this->get_field_id( $key ), $this->get_field_name( $key ), $meta[0], $value );
		}
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		foreach ( array_keys( $this->fields ) as $key ) {
			if ( ! isset( $new_instance[ $key ] ) ) continue;
			$instance[ $key ] = svrgn_widget_sanitize( $this->fields[ $key ][1], $new_instance[ $key ] );
		}
		return $instance;
	}

	/** Splits a textarea value into a clean array, one entry per line. */
	protected function lines( $text ) {
		return array_values( array_filter( array_map( 'trim', explode( "\n", (string) $text ) ) ) );
	}
}
