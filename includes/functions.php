<?php
/**
Enqueue Files
**/
function wpdev_topbars_enqueue() {
    wp_enqueue_script('wpdev-topbars-js', WPDEVBAR_BASE_URI . 'assets/wpdev-top-bar.js', array('jquery'), WPDEVBAR_BASE_VERSION, true);
}
add_action('wp_enqueue_scripts', 'wpdev_topbars_enqueue');

/**
Add Bars Post Type
**/
if ( ! function_exists('wpdev_topbars') ) {

// Register Custom Post Type
function wpdev_topbars() {

	$labels = array(
		'name'                  => _x( 'Top Bars', 'Post Type General Name', 'wpdevbar' ),
		'singular_name'         => _x( 'Top Bar', 'Post Type Singular Name', 'wpdevbar' ),
		'menu_name'             => __( 'Top Bars', 'wpdevbar' ),
		'name_admin_bar'        => __( 'Top Bar', 'wpdevbar' ),
		'archives'              => __( 'Bar Archives', 'wpdevbar' ),
		'attributes'            => __( 'Bar Attributes', 'wpdevbar' ),
		'parent_item_colon'     => __( 'Parent Bar:', 'wpdevbar' ),
		'all_items'             => __( 'All Bars', 'wpdevbar' ),
		'add_new_item'          => __( 'Add New Bar', 'wpdevbar' ),
		'add_new'               => __( 'Add New', 'wpdevbar' ),
		'new_item'              => __( 'New Bar', 'wpdevbar' ),
		'edit_item'             => __( 'Edit Bars', 'wpdevbar' ),
		'update_item'           => __( 'Update Bar', 'wpdevbar' ),
		'view_item'             => __( 'View Bar', 'wpdevbar' ),
		'view_items'            => __( 'View Bars', 'wpdevbar' ),
		'search_items'          => __( 'Search Bars', 'wpdevbar' ),
		'not_found'             => __( 'Not found', 'wpdevbar' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'wpdevbar' ),
		'featured_image'        => __( 'Featured Image', 'wpdevbar' ),
		'set_featured_image'    => __( 'Set featured image', 'wpdevbar' ),
		'remove_featured_image' => __( 'Remove featured image', 'wpdevbar' ),
		'use_featured_image'    => __( 'Use as featured image', 'wpdevbar' ),
		'insert_into_item'      => __( 'Insert into bar', 'wpdevbar' ),
		'uploaded_to_this_item' => __( 'Uploaded to this bar', 'wpdevbar' ),
		'items_list'            => __( 'Bars list', 'wpdevbar' ),
		'items_list_navigation' => __( 'Bars list navigation', 'wpdevbar' ),
		'filter_items_list'     => __( 'Filter bars list', 'wpdevbar' ),
	);
	$args = array(
		'label'                 => __( 'Top Bar', 'wpdevbar' ),
		'description'           => __( 'A top bar for displaying anything you\'d like.', 'wpdevbar' ),
		'labels'                => $labels,
		'supports'              => array( 'title', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 100,
		'menu_icon'             => 'dashicons-minus',
		'show_in_admin_bar'     => false,
		'show_in_nav_menus'     => false,
		'can_export'            => false,
		'has_archive'           => false,		
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'topbar', $args );

}
add_action( 'init', 'wpdev_topbars', 0 );
}

/**
Top Bars Meta Box
**/
function wpdev_topbar_add_meta_box() {
	add_meta_box(
		'wpdev_topbar-top-bar',
		__( 'Top Bar', 'wpdev_topbar' ),
		'wpdev_topbar_html',
		'topbar',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'wpdev_topbar_add_meta_box' );

function wpdev_topbar_html( $post) {
	wp_nonce_field( '_wpdev_topbar_nonce', 'wpdev_topbar_nonce' ); ?>

	<p>
		<label for="wpdev_topbar_bar_text"><?php _e( 'Bar Text', 'wpdev_topbar' ); ?></label><br>
		<input type="text" name="wpdev_topbar_bar_text" id="wpdev_topbar_bar_text" placeholder="Default: Your messages goes here." value="<?php echo get_post_meta($post->ID, 'wpdev_topbar_bar_text', true); ?>">
	</p>	<p>
		<label for="wpdev_topbar_text_color"><?php _e( 'Text Color', 'wpdev_topbar' ); ?></label><br>
		<input type="text" name="wpdev_topbar_text_color" placeholder="Default: #666" id="wpdev_topbar_text_color" value="<?php echo get_post_meta($post->ID, 'wpdev_topbar_text_color', true); ?>">
	</p>	<p>
		<label for="wpdev_topbar_bar_color"><?php _e( 'Bar Color', 'wpdev_topbar' ); ?></label><br>
		<input type="text" name="wpdev_topbar_bar_color" placeholder="Default: #fff" id="wpdev_topbar_bar_color" value="<?php echo get_post_meta($post->ID, 'wpdev_topbar_bar_color', true); ?>">
	</p>	<p>
		<input type="checkbox" name="wpdev_topbar_enable_button" id="wpdev_topbar_enable_button" value="enable-button" <?php echo ( get_post_meta($post->ID, 'wpdev_topbar_enable_button', true) === 'enable-button' ) ? 'checked' : ''; ?>>
		<label for="wpdev_topbar_enable_button"><?php _e( 'Enable button', 'wpdev_topbar' ); ?></label>	</p>	<p>
		<label for="wpdev_topbar_button_text"><?php _e( 'Button Text', 'wpdev_topbar' ); ?></label><br>
		<input type="text" name="wpdev_topbar_button_text" placeholder="Default: Go" id="wpdev_topbar_button_text" value="<?php echo get_post_meta($post->ID, 'wpdev_topbar_button_text', true); ?>">
	</p>	<p>
        <label for="wpdev_topbar_button_url"><?php _e( 'Button URL', 'wpdev_topbar' ); ?></label><br>
		<input type="text" name="wpdev_topbar_button_url" placeholder="Default: /" id="wpdev_topbar_button_url" value="<?php echo get_post_meta($post->ID, 'wpdev_topbar_button_url', true); ?>">
    </p>    <p>    
		<label for="wpdev_topbar_button_text_color"><?php _e( 'Button Text Color', 'wpdev_topbar' ); ?></label><br>
		<input type="text" name="wpdev_topbar_button_text_color" placeholder="Default: #fff" id="wpdev_topbar_button_text_color" value="<?php echo get_post_meta($post->ID, 'wpdev_topbar_button_text_color', true); ?>">
	</p>	<p>
		<label for="wpdev_topbar_button_color"><?php _e( 'Button Color', 'wpdev_topbar' ); ?></label><br>
		<input type="text" name="wpdev_topbar_button_color" placeholder="Default: #cc0000" id="wpdev_topbar_button_color" value="<?php echo get_post_meta($post->ID, 'wpdev_topbar_button_color', true); ?>">
	</p>	<p>

		<input type="checkbox" name="wpdev_topbar_enable_cookies" id="wpdev_topbar_enable_cookies" value="enable-cookies" <?php echo ( get_post_meta($post->ID, 'wpdev_topbar_enable_cookies', true) === 'enable-cookies' ) ? 'checked' : ''; ?>>
		<label for="wpdev_topbar_enable_cookies"><?php _e( 'Enable cookies', 'wpdev_topbar' ); ?></label>	</p>	<p>
		<label for="wpdev_topbar_cookie_expires_in_"><?php _e( 'Cookie expires in...', 'wpdev_topbar' ); ?></label><br>
		<input type="text" name="wpdev_topbar_cookie_expires_in_" placeholder="Default: 3" id="wpdev_topbar_cookie_expires_in_" value="<?php echo get_post_meta($post->ID, 'wpdev_topbar_cookie_expires_in_', true); ?>"><span> days</span>
	</p>
    <p>
		<input type="checkbox" name="wpdev_topbar_enable_pollback" id="wpdev_topbar_enable_pollback" value="enable-pollback" <?php echo ( get_post_meta($post->ID, 'wpdev_topbar_enable_pollback', true) === 'enable-pollback' ) ? 'checked' : ''; ?>>
		<label for="wpdev_topbar_enable_pollback"><?php _e( 'Enable Poll Back Support', 'wpdev_topbar' ); ?></label>
    </p><?php
}

function wpdev_topbar_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['wpdev_topbar_nonce'] ) || ! wp_verify_nonce( $_POST['wpdev_topbar_nonce'], '_wpdev_topbar_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['wpdev_topbar_bar_text'] ) )
		update_post_meta( $post_id, 'wpdev_topbar_bar_text', esc_attr( $_POST['wpdev_topbar_bar_text'] ) );
	if ( isset( $_POST['wpdev_topbar_text_color'] ) )
		update_post_meta( $post_id, 'wpdev_topbar_text_color', esc_attr( $_POST['wpdev_topbar_text_color'] ) );
	if ( isset( $_POST['wpdev_topbar_bar_color'] ) )
		update_post_meta( $post_id, 'wpdev_topbar_bar_color', esc_attr( $_POST['wpdev_topbar_bar_color'] ) );
	if ( isset( $_POST['wpdev_topbar_enable_button'] ) )
		update_post_meta( $post_id, 'wpdev_topbar_enable_button', esc_attr( $_POST['wpdev_topbar_enable_button'] ) );
	else
		update_post_meta( $post_id, 'wpdev_topbar_enable_button', null );
	if ( isset( $_POST['wpdev_topbar_button_text'] ) )
		update_post_meta( $post_id, 'wpdev_topbar_button_text', esc_attr( $_POST['wpdev_topbar_button_text'] ) );
    if ( isset( $_POST['wpdev_topbar_button_url'] ) )
		update_post_meta( $post_id, 'wpdev_topbar_button_url', esc_attr( $_POST['wpdev_topbar_button_url'] ) );
	if ( isset( $_POST['wpdev_topbar_button_text_color'] ) )
		update_post_meta( $post_id, 'wpdev_topbar_button_text_color', esc_attr( $_POST['wpdev_topbar_button_text_color'] ) );
	if ( isset( $_POST['wpdev_topbar_button_color'] ) )
		update_post_meta( $post_id, 'wpdev_topbar_button_color', esc_attr( $_POST['wpdev_topbar_button_color'] ) );
	if ( isset( $_POST['wpdev_topbar_enable_cookies'] ) )
		update_post_meta( $post_id, 'wpdev_topbar_enable_cookies', esc_attr( $_POST['wpdev_topbar_enable_cookies'] ) );
	else
		update_post_meta( $post_id, 'wpdev_topbar_enable_cookies', null );
	if ( isset( $_POST['wpdev_topbar_cookie_expires_in_'] ) )
		update_post_meta( $post_id, 'wpdev_topbar_cookie_expires_in_', esc_attr( $_POST['wpdev_topbar_cookie_expires_in_'] ) );
    if ( isset( $_POST['wpdev_topbar_enable_pollback'] ) )
		update_post_meta( $post_id, 'wpdev_topbar_enable_pollback', esc_attr( $_POST['wpdev_topbar_enable_pollback'] ) );
	else
		update_post_meta( $post_id, 'wpdev_topbar_enable_pollback', null );
}
add_action( 'save_post', 'wpdev_topbar_save' );

/**
Admin CSS
**/
function wpdev_topbar_admin_css() {
    $css = '
    <style type="text/css">
    div#wpdev_topbar-top-bar h2 {
        background: #666;
        color: #fff;
    }

    div#wpdev_topbar-top-bar input[type=text] {
        width: 100%;
    }

    div#wpdev_topbar-top-bar label {
        color: #666;
        font-weight: bold;
    }
    </style>
    ';
    
    echo $css;
}
add_action('admin_head', 'wpdev_topbar_admin_css');

/**
Output Code
**/
function wpdev_topbar_header() {
    // WP_Query arguments
    $args = array(
        'post_type'              => array( 'topbar' ),
        'post_status'            => array( 'publish' ),
        'nopaging'               => false,
        'posts_per_page'         => '1',
        'ignore_sticky_posts'    => true,
    );

    // The Query
    $topbar = new WP_Query( $args );

    // The Loop
    if ( $topbar->have_posts() ) {
        while ( $topbar->have_posts() ) {
            $topbar->the_post();
            // Creation variables
            $js_bartext = get_post_meta(get_the_ID(), 'wpdev_topbar_bar_text', true);
            $js_enablebtn = get_post_meta(get_the_ID(), 'wpdev_topbar_enable_button', true);
            $js_enableback = get_post_meta(get_the_ID(), 'wpdev_topbar_enable_pollback', true);
            $js_btntext = get_post_meta(get_the_ID(), 'wpdev_topbar_button_text', true);
            $js_btnurl = get_post_meta(get_the_ID(), 'wpdev_topbar_button_url', true);
            $js_enablecookies = get_post_meta(get_the_ID(), 'wpdev_topbar_enable_cookies', true);
            $js_cookies = get_post_meta(get_the_ID(), 'wpdev_topbar_cookie_expires_in_', true);
            
            $css_textcolor = get_post_meta(get_the_ID(), 'wpdev_topbar_text_color', true);
            $css_barcolor = get_post_meta(get_the_ID(), 'wpdev_topbar_bar_color', true);
            $css_btntextcolor = get_post_meta(get_the_ID(), 'wpdev_topbar_button_text_color', true);
            $css_btncolor = get_post_meta(get_the_ID(), 'wpdev_topbar_button_color', true);
            
            // Variable Checks
            if(!empty($js_bartext)) {
                $bartext = $js_bartext;
            } else {
                $bartext = 'Please enter a message for this bar in the settings.';
            }
            
            if(!empty($js_enablebtn)) {
                if(!empty($js_btnurl)) {
                    $btnurl = $js_btnurl;
                } else {
                    $btnurl = '/';
                }
                
                if(!empty($js_enableback)) {
                    global $wp;
                    $enableback = '?back=' . home_url(add_query_arg(array(),$wp->request));
                } else {
                    $enableback = '';
                }
                
                if(!empty($js_btntext)) {
                    $btntext = '<a href="' . $btnurl . $enableback . '" id="wpdev-top-bar-link" target="_blank">' . $js_btntext . '</a>';
                } else {
                    $btntext = '<a href="' . $btnurl . $enableback . '" id="wpdev-top-bar-link" target="_blank">Go</a>';
                }
            }
            
            if(!empty($js_enablecookies)) {
                if(!empty($js_cookies)) {
                    $cookieso = '
                    var checkCookie = Cookies.get(\'topbar-' . get_the_ID() . '\');
                    if(checkCookie != 1) {';
                    $cookiesx = '
                    }';
                    $cookiess = 'Cookies.set(\'topbar-' . get_the_ID() . '\', \'1\', { expires: ' . $js_cookies . ' });';
                } else {
                    $cookieso = '
                    var checkCookie = Cookies.get(\'topbar-' . get_the_ID() . '\');
                    if(checkCookie != 1) {';
                    $cookiesx = '
                    }';
                    $cookiess = 'Cookies.set(\'topbar-' . get_the_ID() . '\', \'1\', { expires: ' . $js_cookies . ' });';
                }
            } else {
                $cookieso = '';
                $cookiesx = '';
                $cookiess = '';
            }
            
            if(!empty($css_textcolor)) {
                $textcolor = $css_textcolor;
            } else {
                $textcolor = '#666';
            }
            
            if(!empty($css_barcolor)) {
                $barcolor = $css_barcolor;
            } else {
                $barcolor = '#fff';
            }
            
            if(!empty($js_enablebtn)) {
                if(!empty($css_btntextcolor)) {
                    $btntextcolor = $css_btntextcolor;
                } else {
                    $btntextcolor = '#fff';
                }
                
                if(!empty($css_btncolor)) {
                    $btncolor = $css_btncolor;
                } else {
                    $btncolor = '#cc0000';
                }
                
                
                $btncss = '
                a#wpdev-top-bar-link {
                    font-weight: bold;
                    text-transform: uppercase;
                    font-size: 14px;
                    background: ' . $btncolor . ';
                    color: ' . $btntextcolor . ';
                    padding: 5px 10px;
                    margin: 5px;
                    display: inline-block;
                }

                a#wpdev-top-bar-link:hover {
                    opacity: 0.8;
                }';
            } else {
                $btncss = '
                a#wpdev-top-bar-link {
                    font-weight: bold;
                    text-transform: uppercase;
                    font-size: 14px;
                    background: #cc0000;
                    color: #fff;
                    padding: 5px 10px;
                    margin-left: 10px;
                }

                a#wpdev-top-bar-link:hover {
                    opacity: 0.8;
                }';
            }
            
            if(!empty($btncolor)) {
                $closebtncolor = $btncolor;
            } else {
                $closebtncolor = 'red';
            }
            
            
            // Output variables
            $css = '
            <style type="text/css">
                div#wpdev-top-bar {
                    background: ' . $barcolor . ';
                    position: relative;
                    z-index: 999;
                    width: 100%;
                    text-align: center;
                    padding: 10px 0;
                    font-family: sans-serif;
                    font-size: 16px;
                    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.15);
                }

                span#wpdev-top-bar-mess {
                    margin-top: 5px;
                    display: inline-block;
                    color: ' . $textcolor . ';
                }' . $btncss . '

                span#wpdev-top-bar-close {
                    background: rgba(0, 0, 0, 0.4);
                    color: #fff;
                    padding: 5px 9px;
                    border-radius: 2px;
                    margin-right: 10px;
                    cursor: pointer;
                    font-size: 14px;
                    right: 0;
                    bottom: 5px;
                }

                span#wpdev-top-bar-close:hover {
                    background: ' . $closebtncolor . ';
                    color: #fff;
                }
            </style>
            ';
            
            $script = '
            <script type="text/javascript">
            jQuery(document).ready(function() {' . $cookieso . '
                    // Add top bar
                    jQuery(\'body\').before(\'<div id="wpdev-top-bar"><span id="wpdev-top-bar-mess">' . $bartext . '</span>' . $btntext . '<span id="wpdev-top-bar-close">×</span></div>\');
                    // Get bar height
                    var barHeight = jQuery(\'#wpdev-top-bar\').height();
                    // Close on click
                    jQuery(\'#wpdev-top-bar-close\').on(\'click\', function() {
                        jQuery(\'#wpdev-top-bar\').hide();
                        jQuery(\'body\').css(\'margin-top\', \'0\');
                        ' . $cookiess . '
                    });' . $cookiesx . '
            });
            </script>';
            
            echo $css . $script;
        }
    } else {
        // No bars found.
    }

    // Restore original Post Data
    wp_reset_postdata();
}
add_action('wp_footer', 'wpdev_topbar_header', 50);