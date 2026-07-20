<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/* -----------------------------------------------------------
 * Register the Service CPT
 * --------------------------------------------------------- */
function svrgn_register_service_cpt() {
	$labels = array(
		'name'               => 'Services',
		'singular_name'      => 'Service',
		'add_new_item'       => 'Add New Service',
		'edit_item'          => 'Edit Service',
		'new_item'           => 'New Service',
		'view_item'          => 'View Service',
		'search_items'       => 'Search Services',
		'not_found'          => 'No services found',
		'menu_name'          => 'Services',
	);

	register_post_type( 'service', array(
		'labels'        => $labels,
		'public'        => true,
		'has_archive'   => false, // listing is handled by the Services page template
		'rewrite'       => array( 'slug' => 'services' ),
		'menu_icon'     => 'dashicons-hammer',
		'supports'      => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
		'show_in_rest'  => true,
	) );
}
add_action( 'init', 'svrgn_register_service_cpt' );

/* -----------------------------------------------------------
 * Meta box: Service details
 * Field key: _case_tag      -> e.g. "Strategy — Diagnosis"
 * Field key: _case_includes -> one "includes" chip per line, e.g.
 *                               Account Audits
 *                               Funnel Mapping
 *                               Growth Roadmaps
 * --------------------------------------------------------- */
function svrgn_service_metabox() {
	add_meta_box(
		'svrgn_service_details',
		'Service Details',
		'svrgn_service_metabox_html',
		'service',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'svrgn_service_metabox' );

function svrgn_service_metabox_html( $post ) {
	wp_nonce_field( 'svrgn_service_save', 'svrgn_service_nonce' );
	$tag      = get_post_meta( $post->ID, '_case_tag', true );
	$includes = get_post_meta( $post->ID, '_case_includes', true );
	?>
	<p>
		<label for="svrgn_case_tag"><strong>Tag</strong> <span style="font-weight:normal;">(shown as the small pill above the title, e.g. "Strategy — Diagnosis")</span></label><br>
		<input type="text" id="svrgn_case_tag" name="svrgn_case_tag" value="<?php echo esc_attr( $tag ); ?>" style="width:100%;max-width:520px;">
	</p>
	<p>
		<label for="svrgn_case_includes"><strong>Includes</strong> <span style="font-weight:normal;">(one item per line, e.g. "Account Audits")</span></label><br>
		<textarea id="svrgn_case_includes" name="svrgn_case_includes" rows="4" style="width:100%;max-width:520px;"><?php echo esc_textarea( $includes ); ?></textarea>
	</p>
	<p style="color:#666;">
		Use the <strong>Excerpt</strong> box for the card description (case-desc) and the <strong>Featured Image</strong> for the card thumbnail. Use <strong>Page Attributes &rarr; Order</strong> to control display order.
	</p>
	<?php
}

function svrgn_save_service_meta( $post_id ) {
	if ( ! isset( $_POST['svrgn_service_nonce'] ) || ! wp_verify_nonce( $_POST['svrgn_service_nonce'], 'svrgn_service_save' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['svrgn_case_tag'] ) ) {
		update_post_meta( $post_id, '_case_tag', sanitize_text_field( $_POST['svrgn_case_tag'] ) );
	}
	if ( isset( $_POST['svrgn_case_includes'] ) ) {
		update_post_meta( $post_id, '_case_includes', sanitize_textarea_field( $_POST['svrgn_case_includes'] ) );
	}
}
add_action( 'save_post_service', 'svrgn_save_service_meta' );
