<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/* -----------------------------------------------------------
 * Register the Project CPT
 * Distinct from Case Study: Projects are the lightweight cards in the
 * homepage "Selected Work" gallery. Case Studies are the full write-ups
 * (their own listing page + single template). Keeping them separate
 * means you can feature a project on the homepage without needing a
 * full case study written yet, and vice versa.
 * --------------------------------------------------------- */
function svrgn_register_project_cpt() {
	$labels = array(
		'name'               => 'Projects',
		'singular_name'      => 'Project',
		'add_new_item'       => 'Add New Project',
		'edit_item'          => 'Edit Project',
		'new_item'           => 'New Project',
		'view_item'          => 'View Project',
		'search_items'       => 'Search Projects',
		'not_found'          => 'No projects found',
		'menu_name'          => 'Projects',
	);

	register_post_type( 'project', array(
		'labels'        => $labels,
		'public'        => true,
		'has_archive'   => false, // shown via the homepage gallery / SVRGN Project widget
		'rewrite'       => array( 'slug' => 'projects' ),
		'menu_icon'     => 'dashicons-images-alt2',
		'supports'      => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
		'show_in_rest'  => true,
	) );
}
add_action( 'init', 'svrgn_register_project_cpt' );

/* -----------------------------------------------------------
 * Meta box: Project details
 * Field key: _case_tag -> e.g. "Eyewear" (shown as the project-tag pill)
 * Excerpt = card description, Featured Image = card thumbnail,
 * Page Attributes -> Order = display order in the gallery.
 * --------------------------------------------------------- */
function svrgn_project_metabox() {
	add_meta_box(
		'svrgn_project_details',
		'Project Details',
		'svrgn_project_metabox_html',
		'project',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'svrgn_project_metabox' );

function svrgn_project_metabox_html( $post ) {
	wp_nonce_field( 'svrgn_project_save', 'svrgn_project_nonce' );
	$tag = get_post_meta( $post->ID, '_case_tag', true );
	?>
	<p>
		<label for="svrgn_case_tag"><strong>Tag</strong> <span style="font-weight:normal;">(shown as the small pill above the title, e.g. "Eyewear")</span></label><br>
		<input type="text" id="svrgn_case_tag" name="svrgn_case_tag" value="<?php echo esc_attr( $tag ); ?>" style="width:100%;max-width:520px;">
	</p>
	<p style="color:#666;">
		Use the <strong>Excerpt</strong> box for the card description, the <strong>Featured Image</strong> for the card thumbnail, and <strong>Page Attributes &rarr; Order</strong> to control display order in the "Selected Work" gallery (lower numbers show first).
	</p>
	<?php
}

function svrgn_save_project_meta( $post_id ) {
	if ( ! isset( $_POST['svrgn_project_nonce'] ) || ! wp_verify_nonce( $_POST['svrgn_project_nonce'], 'svrgn_project_save' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['svrgn_case_tag'] ) ) {
		update_post_meta( $post_id, '_case_tag', sanitize_text_field( $_POST['svrgn_case_tag'] ) );
	}
}
add_action( 'save_post_project', 'svrgn_save_project_meta' );
