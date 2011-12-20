<?php
	
	// Add RSS links to <head> section
	automatic_feed_links();   
	
	// Load jQuery
	if ( !function_exists(core_mods) ) {
		function core_mods() {
			if ( !is_admin() ) {
				wp_deregister_script('jquery');
				wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"), false);
				wp_enqueue_script('jquery');
			}
		}
		core_mods();
	}

	// Clean up the <head>
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');
	
	// Add thumbnail support
	
	add_theme_support( 'post-thumbnails' );
	
	// Remove paragraph filter from design post type	
		
		function design_remove_plugin_filters() {
	
		global $wp_filter;
		global $wp;
		if ($wp->query_vars["post_type"] == 'pplan_designs') {
			remove_all_filters('the_content', 'wpautop');
			add_filter('the_content', 'do_shortcode');
		}
	}   
	
	add_action('wp','design_remove_plugin_filters');
	
	// Register menus
	
	add_action( 'init', 'register_my_menu' );

	function register_my_menu() {
		register_nav_menu( 'top-navigation', __( 'Top Navigation' ) );
	}
	
	// Clean up default pagination
	function show_posts_nav() {
   	global $wp_query;
   	return ($wp_query->max_num_pages > 1);
	}
	
	// Edit user profile fields
	function extra_contact_info($contactmethods) {
		unset($contactmethods['aim']);
		unset($contactmethods['yim']);
		unset($contactmethods['jabber']);
		$contactmethods['pplan_user_title'] = 'Title <span class="description">(optionally used in theme)</span>';
		$contactmethods['pplan_user_phone'] = 'Phone # <span class="description">(optionally used in theme)</span>';
	 
		return $contactmethods;
	}
	add_filter('user_contactmethods', 'extra_contact_info');
	
	// Remove 'Protected' from password-protected posts & pages
	add_filter('protected_title_format', 'blank');
	function blank($title) {
		   return '%s';
	}
	
	// Change password-protected posts & pages text
	add_filter( 'the_password_form', 'custom_password_form' );
	function custom_password_form() {
	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$o = '<form class="protected-post-form" action="' . get_option('siteurl') . '/wp-pass.php" method="post">
	' . __( "This page is password protected. Please enter your password below." ) . '
	<label for="' . $label . '">' . __( "" ) . ' </label><input name="post_password" id="' . $label . '" type="password" size="20" /><input type="submit" class="submit" name="Submit" value="' . esc_attr__( "Log In" ) . '" />
	</form>
	';
	return $o;
	}
	
	// Add button shortcode

	function add_button($atts) {
		extract(shortcode_atts(array(
			'link' => 'http://',
			'text' => 'Button',
			'class' => '',
		), $atts));
		return '<p><a class="button '.$class.'" href="'.$link.'">'.$text.'</a></p>';
	}
	add_shortcode('button', 'add_button');
	
	// Remove Admin menu items that are not necessary
	function remove_menus () {
	global $menu;
		$restricted = array(__('Posts'), __('Pages'), __('Links'));
		end ($menu);
		while (prev($menu)){
			$value = explode(' ',$menu[key($menu)][0]);
			if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
		}
	}
	add_action('admin_menu', 'remove_menus');

	// Remove irrelevant dashboard items
	add_action('admin_init', 'rw_remove_dashboard_widgets');
	function rw_remove_dashboard_widgets() {
 	remove_meta_box('dashboard_right_now', 'dashboard', 'normal');   // right now
 	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); // recent comments
 	remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');  // incoming links
 	remove_meta_box('dashboard_plugins', 'dashboard', 'normal');   // plugins
 	remove_meta_box('dashboard_quick_press', 'dashboard', 'normal');  // quick press
 	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'normal');  // recent drafts
 	remove_meta_box('dashboard_primary', 'dashboard', 'normal');   // wordpress blog
 	remove_meta_box('dashboard_secondary', 'dashboard', 'normal');   // other wordpress news
	}

	// Remove irrelevant quick dropdown items
	function custom_favorite_actions($actions) {
  	unset($actions['post-new.php']);
  	unset($actions['edit.php?post_status=draft']);
  	return $actions;
	}
	
	// Edit Admin footer
	function modify_footer_admin () {
  	echo 'Project Plan Version 1 created by <a href="http://joshualyn.ch">Joshua Lynch</a>. ';
  	echo 'Powered by <a href="http://WordPress.org">WordPress</a>.';
	}

	add_filter('admin_footer_text', 'modify_footer_admin');
	
	function new_excerpt_more($more) {
    global $post;
	return '&hellip;';
	}
	add_filter('excerpt_more', 'new_excerpt_more');
	
	// custom excerpt length
	function custom_excerpt_length($length) {
		return 20;
	}
	add_filter('excerpt_length', 'custom_excerpt_length');
	
	// Remove URL from comment form
	
	add_filter('comment_form_default_fields', 'remove_url');

	function remove_url($val) {
		$val['url'] = '';
		return $val;
	}
	
	// Create custom taxonomy
	
	add_action( 'init', 'create_my_taxonomies', 0 );

	function create_my_taxonomies() {
	register_taxonomy( 'client', array( 'post' ), array(
															'public' => true,
															'rewrite' => array( 'slug' => 'client', 'with_front' => false ),
															'query_var' => true,
															'labels' => array(
																				'name' => __( 'Client' ),
																				'singular_name' => __( 'Client' ),
																				'search_items' => __( 'Search Clients' ),
																				'popular_items' => __( 'Most Selected Clients' ),
																				'all_items' => __( 'All Clients' ),
																				'parent_item' => __( 'Parent Client' ),
																				'parent_item_colon' => __( 'Parent Client:' ),
																				'edit_item' => __( 'Edit Client' ),
																				'update_item' => __( 'Update Client' ),
																				'add_new_item' => __( 'Add New Client' ),
																				'new_item_name' => __( 'New Client Name' ),
																			),
														)
	);
	
	register_taxonomy( 'project_id', array( 'post' ), array(
															'public' => true,
															'rewrite' => array( 'slug' => 'project-id', 'with_front' => false ),
															'query_var' => true,
															'labels' => array(
																				'name' => __( 'Project ID' ),
																				'singular_name' => __( 'Project ID' ),
																				'search_items' => __( 'Search Project IDs' ),
																				'popular_items' => __( 'Popular Project IDs' ),
																				'all_items' => __( 'All Project IDs' ),
																				'parent_item' => __( 'Parent Project ID' ),
																				'parent_item_colon' => __( 'Parent Project ID:' ),
																				'edit_item' => __( 'Edit Project ID' ),
																				'update_item' => __( 'Update Project ID' ),
																				'add_new_item' => __( 'Add New Project ID' ),
																				'new_item_name' => __( 'New Project ID' ),
																			),
														)
	);
	
	register_taxonomy( 'docs_set', array( 'post' ), array(
															'public' => true,
															'rewrite' => array( 'slug' => 'doc-set', 'with_front' => false ),
															'query_var' => true,
															'labels' => array(
																				'name' => __( 'Document Sets' ),
																				'singular_name' => __( 'Document Set' ),
																				'search_items' => __( 'Search Document Sets' ),
																				'popular_items' => __( 'Popular Document Sets' ),
																				'all_items' => __( 'All Document Sets' ),
																				'parent_item' => __( 'Parent Document Set' ),
																				'parent_item_colon' => __( 'Parent Document Set:' ),
																				'edit_item' => __( 'Edit Document Set' ),
																				'update_item' => __( 'Update Document Set' ),
																				'add_new_item' => __( 'Add New Document Set' ),
																				'new_item_name' => __( 'New Document Set' ),
																			),
														)
	);
	
	}
	
	
	// Create custom post types
	
	add_action( 'init', 'create_my_post_types' );

	function create_my_post_types() {
		register_post_type( 'pplan_projects',
			array(
				'public' => true,
				'show_ui' => true,
				'publicly_queryable' => true,
				'exclude_from_search' => true,
				'query_var' => true,
				'menu_position' => 10,
				'supports' => array( 
									'title', 
									'editor', 
									'revisions', 
									'custom-fields', 
									'author',
									),
				'taxonomies' => array( 'client', 'project_id', 'docs_set' ),
				'rewrite' => array( 'slug' => 'project', 'with_front' => true ),
				'labels' => array(
					'name' => __( 'Projects' ),
					'singular_name' => __( 'Project' ),
					'add_new' => __( 'Add Project' ),
					'add_new_item' => __( 'Add New Project' ),
					'edit' => __( 'Edit' ),
					'edit_item' => __( 'Edit Project' ),
					'new_item' => __( 'New Project' ),
					'view' => __( 'View' ),
					'view_item' => __( 'View Project' ),
					'search_items' => __( 'Search Projects' ),
					'not_found' => __( 'No Projects Found' ),
					'not_found_in_trash' => __( 'No Projects Found in Trash' ),
					'parent' => __( 'Parent Project' ),
				),
			)
		);

		register_post_type( 'pplan_milestones',
			array(
				'public' => true,
				'show_ui' => true,
				'publicly_queryable' => true,
				'exclude_from_search' => true,
				'query_var' => true,
				'menu_position' => 15,
				'supports' => array( 
									'title',
									'editor',
									'excerpt', 
									'revisions',  
									'author',
									'custom-fields',
									'page-attributes',
									'comments',
									),
				'taxonomies' => array( 'project_id' ),
				'rewrite' => array( 'slug' => 'milestone', 'with_front' => true ),
				'labels' => array(
					'name' => __( 'Milestones' ),
					'singular_name' => __( 'Milestone' ),
					'add_new' => __( 'Add Milestone' ),
					'add_new_item' => __( 'Add New Milestone' ),
					'edit' => __( 'Edit' ),
					'edit_item' => __( 'Edit Milestone' ),
					'new_item' => __( 'New Milestone' ),
					'view' => __( 'View' ),
					'view_item' => __( 'View Milestone' ),
					'search_items' => __( 'Search Milestones' ),
					'not_found' => __( 'No Milestones Found' ),
					'not_found_in_trash' => __( 'No Milestones Found in Trash' ),
					'parent' => __( 'Parent Milestone' ),
				),
			)
		);
		
		register_post_type( 'pplan_designs',
			array(
				'public' => true,
				'show_ui' => true,
				'publicly_queryable' => true,
				'exclude_from_search' => true,
				'query_var' => true,
				'menu_position' => 20,
				'supports' => array( 
									'title',
									'editor',   
									'revisions',  
									'author',
									'custom-fields',
									'page-attributes',
									'comments',
									),
				'taxonomies' => array( 'project_id' ),
				'rewrite' => array( 'slug' => 'design', 'with_front' => true ),
				'labels' => array(
					'name' => __( 'Designs' ),
					'singular_name' => __( 'Design' ),
					'add_new' => __( 'Add Design' ),
					'add_new_item' => __( 'Add New Design' ),
					'edit' => __( 'Edit' ),
					'edit_item' => __( 'Edit Design' ),
					'new_item' => __( 'New Design' ),
					'view' => __( 'View' ),
					'view_item' => __( 'View Design' ),
					'search_items' => __( 'Search Designs' ),
					'not_found' => __( 'No Designs Found' ),
					'not_found_in_trash' => __( 'No Designs Found in Trash' ),
					'parent' => __( 'Parent Design' ),
				),
			)
		);
	
	register_post_type( 'pplan_docs',
			array(
				'public' => true,
				'show_ui' => true,
				'publicly_queryable' => true,
				'exclude_from_search' => true,
				'query_var' => true,
				'hierarchical' => true,
				'menu_position' => 20,
				'supports' => array( 
									'title',
									'editor',   
									'revisions',  
									'author',
									'custom-fields',
									'page-attributes'
									),
				'taxonomies' => array( 'docs_set', 'client' ),
				'rewrite' => array( 'slug' => 'docs', 'with_front' => true ),
				'labels' => array(
					'name' => __( 'Documents' ),
					'singular_name' => __( 'Document' ),
					'add_new' => __( 'Add Document' ),
					'add_new_item' => __( 'Add New Document' ),
					'edit' => __( 'Edit' ),
					'edit_item' => __( 'Edit Document' ),
					'new_item' => __( 'New Document' ),
					'view' => __( 'View' ),
					'view_item' => __( 'View Document' ),
					'search_items' => __( 'Search Documents' ),
					'not_found' => __( 'No Documents Found' ),
					'not_found_in_trash' => __( 'No Documents Found in Trash' ),
					'parent' => __( 'Parent Document' ),
				),
			)
		);
	}
	
	
	// Enable theme options page script
	include 'adminpage.class.php';
	
	include 'theme-options.php';
	
	// Enable post options script
	include 'uielement.class.php';
	
	include 'project-fields.php';
	
	include 'milestone-fields.php';
	
	include 'design-fields.php';
	

// Include plugins 
 
require_once dirname( __FILE__ ) . '/plugin-activation/class-tgm-plugin-activation.php';
 
add_action( 'tgmpa_register', 'pplan_register_required_plugins' );

function pplan_register_required_plugins() {
 
    $plugins = array(
        // include local plugin
        array(
            'name'     => 'Custom Post Permalinks', // The plugin name
            'slug'     => 'custom-permalinks-plugin', // The plugin slug (typically the folder name)
            'source'   => get_stylesheet_directory() . '/plugin-activation/plugins/custom-permalinks-plugin.zip', // The plugin source
            'required' => true,
        ),
        // include plugins from WP repository
        array(
            'name' => 'Custom Taxonomy Columns',
            'slug' => 'custom-taxonomy-columns',
			'required' => true,
        ),
		
		array(
            'name' => 'Gravatar Signup',
            'slug' => 'gravatar-signup',
        ),
		
		array(
            'name' => 'Subscribe to Comments',
            'slug' => 'subscribe-to-comments',
        ),
    );
 
    $theme_text_domain = 'project-plan';

    $config = array(
        'domain'       => $theme_text_domain,
        'menu'         => 'install-project-plan-plugins', // Menu slug
    );
 
    tgmpa( $plugins, $config );
 
}
?>