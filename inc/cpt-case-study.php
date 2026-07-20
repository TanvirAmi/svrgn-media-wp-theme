<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/* -----------------------------------------------------------
 * Register the Case Study CPT
 * --------------------------------------------------------- */
function svrgn_register_case_study_cpt() {
	$labels = array(
		'name'               => 'Case Studies',
		'singular_name'      => 'Case Study',
		'add_new_item'       => 'Add New Case Study',
		'edit_item'          => 'Edit Case Study',
		'new_item'           => 'New Case Study',
		'view_item'          => 'View Case Study',
		'search_items'       => 'Search Case Studies',
		'not_found'          => 'No case studies found',
		'menu_name'          => 'Case Studies',
	);

	register_post_type( 'case_study', array(
		'labels'        => $labels,
		'public'        => true,
		'has_archive'   => false, // listing is handled by the Case Studies page template
		'rewrite'       => array( 'slug' => 'case-studies' ),
		'menu_icon'     => 'dashicons-portfolio',
		'supports'      => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
		'show_in_rest'  => true,
	) );
}
add_action( 'init', 'svrgn_register_case_study_cpt' );

/* -----------------------------------------------------------
 * Meta box: Case Study details (tag + client meta)
 * Field key: _case_tag  ->  e.g. "Creative — Paid Media" (shown as the case-tag pill)
 * The client-facing excerpt (case-desc) uses the native Excerpt field.
 * The date shown on the card (case-date) uses the native Published date.
 * The thumbnail (case-img) uses the native Featured Image.
 * The ordering (case-index, "01 / 06") is calculated automatically from
 * the loop position — use the Page Attributes "Order" box to control it.
 * --------------------------------------------------------- */
function svrgn_case_study_metabox() {
	add_meta_box(
		'svrgn_case_study_details',
		'Case Study Details',
		'svrgn_case_study_metabox_html',
		'case_study',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'svrgn_case_study_metabox' );

function svrgn_case_study_metabox_html( $post ) {
	wp_nonce_field( 'svrgn_case_study_save', 'svrgn_case_study_nonce' );
	$tag    = get_post_meta( $post->ID, '_case_tag', true );
	$result = get_post_meta( $post->ID, '_case_result', true );
	?>
	<p>
		<label for="svrgn_case_tag"><strong>Tag</strong> <span style="font-weight:normal;">(shown as the small pill above the title, e.g. "Creative — Paid Media")</span></label><br>
		<input type="text" id="svrgn_case_tag" name="svrgn_case_tag" value="<?php echo esc_attr( $tag ); ?>" style="width:100%;max-width:520px;">
	</p>
	<p>
		<label for="svrgn_case_result"><strong>Result headline</strong> <span style="font-weight:normal;">(short outcome line, e.g. "10x blended ROAS across Meta" — used on the homepage Results highlight cards)</span></label><br>
		<input type="text" id="svrgn_case_result" name="svrgn_case_result" value="<?php echo esc_attr( $result ); ?>" style="width:100%;max-width:520px;">
	</p>
	<p style="color:#666;">
		Use the <strong>Excerpt</strong> box for the card description (case-desc), the <strong>Featured Image</strong> for the card thumbnail, and the published <strong>Date</strong> for the date shown on the card. Use <strong>Page Attributes &rarr; Order</strong> to control display order (lower numbers show first).
	</p>
	<?php
}

function svrgn_save_case_study_meta( $post_id ) {
	if ( ! isset( $_POST['svrgn_case_study_nonce'] ) || ! wp_verify_nonce( $_POST['svrgn_case_study_nonce'], 'svrgn_case_study_save' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['svrgn_case_tag'] ) ) {
		update_post_meta( $post_id, '_case_tag', sanitize_text_field( $_POST['svrgn_case_tag'] ) );
	}
	if ( isset( $_POST['svrgn_case_result'] ) ) {
		update_post_meta( $post_id, '_case_result', sanitize_text_field( $_POST['svrgn_case_result'] ) );
	}
}
add_action( 'save_post_case_study', 'svrgn_save_case_study_meta' );
