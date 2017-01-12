<?php
/**
 * Dazzling functions and definitions
 *
 * @package dazzling
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
  $content_width = 730; /* pixels */
}

/**
 * Set the content width for full width pages with no sidebar.
 */
function dazzling_content_width() {
  if ( is_page_template( 'page-fullwidth.php' ) || is_page_template( 'front-page.php' ) ) {
    global $content_width;
    $content_width = 1110; /* pixels */
  }
}
add_action( 'template_redirect', 'dazzling_content_width' );

if ( ! function_exists( 'dazzling_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function dazzling_setup() {

  /*
   * Make theme available for translation.
   * Translations can be filed in the /languages/ directory.
   * If you're building a theme based on Dazzling, use a find and replace
   * to change 'dazzling' to the name of your theme in all the template files
   */
  load_theme_textdomain( 'dazzling', get_template_directory() . '/languages' );

  // Add default posts and comments RSS feed links to head.
  add_theme_support( 'automatic-feed-links' );

  /*
   * Enable support for Post Thumbnails on posts and pages.
   *
   * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
   */
  add_theme_support( 'post-thumbnails' );

  add_image_size( 'dazzling-featured', 730, 410, true );
  add_image_size( 'tab-small', 60, 60 , true); // Small Thumbnail

  // This theme uses wp_nav_menu() in one location.
  register_nav_menus( array(
    'primary'      => __( 'Primary Menu', 'dazzling' ),
    'footer-links' => __( 'Footer Links', 'dazzling' ) // secondary menu in footer
  ) );

  // Enable support for Post Formats.
  add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

  // Setup the WordPress core custom background feature.
  add_theme_support( 'custom-background', apply_filters( 'dazzling_custom_background_args', array(
    'default-color' => 'ffffff',
    'default-image' => '',
  ) ) );

  /*
   * Let WordPress manage the document title.
   * By adding theme support, we declare that this theme does not use a
   * hard-coded <title> tag in the document head, and expect WordPress to
   * provide it for us.
   */
  add_theme_support( 'title-tag' );
}
endif; // dazzling_setup
add_action( 'after_setup_theme', 'dazzling_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function dazzling_widgets_init() {
  register_sidebar( array(
    'name'          => __( 'Sidebar', 'dazzling' ),
    'id'            => 'sidebar-1',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ) );
  register_sidebar(array(
    'id'            => 'home-widget-1',
    'name'          => __( 'Homepage Widget 1', 'dazzling' ),
    'description'   => __( 'Displays on the Home Page', 'dazzling' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widgettitle">',
    'after_title'   => '</h3>',
  ));

  register_sidebar(array(
    'id'            => 'home-widget-2',
    'name'          =>  __( 'Homepage Widget 2', 'dazzling' ),
    'description'   => __( 'Displays on the Home Page', 'dazzling' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widgettitle">',
    'after_title'   => '</h3>',
  ));

  register_sidebar(array(
    'id'            => 'home-widget-3',
    'name'          =>  __( 'Homepage Widget 3', 'dazzling' ),
    'description'   =>  __( 'Displays on the Home Page', 'dazzling' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widgettitle">',
    'after_title'   => '</h3>',
  ));

  register_sidebar(array(
    'id'            => 'footer-widget-1',
    'name'          =>  __( 'Footer Widget 1', 'dazzling' ),
    'description'   =>  __( 'Used for footer widget area', 'dazzling' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widgettitle">',
    'after_title'   => '</h3>',
  ));

  register_sidebar(array(
    'id'            => 'footer-widget-2',
    'name'          =>  __( 'Footer Widget 2', 'dazzling' ),
    'description'   =>  __( 'Used for footer widget area', 'dazzling' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widgettitle">',
    'after_title'   => '</h3>',
  ));

  register_sidebar(array(
    'id'            => 'footer-widget-3',
    'name'          =>  __( 'Footer Widget 3', 'dazzling' ),
    'description'   =>  __( 'Used for footer widget area', 'dazzling' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widgettitle">',
    'after_title'   => '</h3>',
  ));


  register_widget( 'dazzling_social_widget' );
  register_widget( 'dazzling_popular_posts_widget' );
}
add_action( 'widgets_init', 'dazzling_widgets_init' );

include(get_template_directory() . "/inc/widgets/widget-popular-posts.php");
include(get_template_directory() . "/inc/widgets/widget-social.php");


/**
 * Enqueue scripts and styles.
 */
function dazzling_scripts() {

  wp_enqueue_style( 'dazzling-bootstrap', get_template_directory_uri() . '/inc/css/bootstrap.min.css' );

  wp_enqueue_style( 'dazzling-icons', get_template_directory_uri().'/inc/css/font-awesome.min.css' );

  if( ( is_home() || is_front_page() ) && of_get_option('dazzling_slider_checkbox') == 1 ) {
    wp_enqueue_style( 'flexslider-css', get_template_directory_uri().'/inc/css/flexslider.css' );
  }

  if ( class_exists( 'jigoshop' ) ) { // Jigoshop specific styles loaded only when plugin is installed
    wp_enqueue_style( 'jigoshop-css', get_template_directory_uri().'/inc/css/jigoshop.css' );
  }

  wp_enqueue_style( 'dazzling-style', get_stylesheet_uri() );

  wp_enqueue_script('dazzling-bootstrapjs', get_template_directory_uri().'/inc/js/bootstrap.min.js', array('jquery') );

  if( ( is_home() || is_front_page() ) && of_get_option('dazzling_slider_checkbox') == 1 ) {
    wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/inc/js/flexslider.min.js', array('jquery'), '2.5.0', true );
  }

  wp_enqueue_script( 'dazzling-main', get_template_directory_uri() . '/inc/js/main.js', array('jquery'), '1.5.4', true );

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}
add_action( 'wp_enqueue_scripts', 'dazzling_scripts' );

/**
 * Add HTML5 shiv and Respond.js for IE8 support of HTML5 elements and media queries
 */
function dazzling_ie_support_header() {
  echo '<!--[if lt IE 9]>'. "\n";
  echo '<script src="' . esc_url( get_template_directory_uri() . '/inc/js/html5shiv.min.js' ) . '"></script>'. "\n";
  echo '<script src="' . esc_url( get_template_directory_uri() . '/inc/js/respond.min.js' ) . '"></script>'. "\n";
  echo '<![endif]-->'. "\n";
}
add_action( 'wp_head', 'dazzling_ie_support_header', 11 );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load custom nav walker
 */
require get_template_directory() . '/inc/navwalker.php';

if ( class_exists( 'woocommerce' ) ) {
/**
 * WooCommerce related functions
 */
require get_template_directory() . '/inc/woo-setup.php';
}

if ( class_exists( 'jigoshop' ) ) {
/**
 * Jigoshop related functions
 */
require get_template_directory() . '/inc/jigoshop-setup.php';
}

/**
 * Metabox file load
 */
require get_template_directory() . '/inc/metaboxes.php';

/**
 * Register Social Icon menu
 */
add_action( 'init', 'register_social_menu' );

function register_social_menu() {
  register_nav_menu( 'social-menu', _x( 'Social Menu', 'nav menu location', 'dazzling' ) );
}

/* Globals variables */
global $options_categories;
$options_categories = array();
$options_categories_obj = get_categories();
foreach ($options_categories_obj as $category) {
        $options_categories[$category->cat_ID] = $category->cat_name;
}

global $site_layout;
$site_layout = array('side-pull-left' => esc_html__('Right Sidebar', 'dazzling'),'side-pull-right' => esc_html__('Left Sidebar', 'dazzling'),'no-sidebar' => esc_html__('No Sidebar', 'dazzling'),'full-width' => esc_html__('Full Width', 'dazzling'));

// Typography Options
global $typography_options;
$typography_options = array(
        'sizes' => array( '6px' => '6px','10px' => '10px','12px' => '12px','14px' => '14px','15px' => '15px','16px' => '16px','18px'=> '18px','20px' => '20px','24px' => '24px','28px' => '28px','32px' => '32px','36px' => '36px','42px' => '42px','48px' => '48px' ),
        'faces' => array(
                'arial'          => 'Arial,Helvetica,sans-serif',
                'verdana'        => 'Verdana,Geneva,sans-serif',
                'trebuchet'      => 'Trebuchet,Helvetica,sans-serif',
                'georgia'        => 'Georgia,serif',
                'times'          => 'Times New Roman,Times, serif',
                'tahoma'         => 'Tahoma,Geneva,sans-serif',
                'Open Sans'      => 'Open Sans,sans-serif',
                'palatino'       => 'Palatino,serif',
                'helvetica'      => 'Helvetica,Arial,sans-serif',
                'helvetica-neue' => 'Helvetica Neue,Helvetica,Arial,sans-serif'
        ),
        'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
        'color'  => true
);

// Typography Defaults
global $typography_defaults;
$typography_defaults = array(
        'size'  => '14px',
        'face'  => 'helvetica-neue',
        'style' => 'normal',
        'color' => '#6B6B6B'
);

/**
 * Helper function to return the theme option value.
 * If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 *
 * Not in a class to support backwards compatibility in themes.
 */
if ( ! function_exists( 'of_get_option' ) ) :
function of_get_option( $name, $default = false ) {

  $option_name = '';
  // Get option settings from database
  $options = get_option( 'dazzling' );

  // Return specific option
  if ( isset( $options[$name] ) ) {
    return $options[$name];
  }

  return $default;
}
endif;


add_action('template_redirect', 'wpse_131562_redirect');
function wpse_131562_redirect() {
    if (! is_user_logged_in() )
    {
        wp_safe_redirect(wp_login_url( get_permalink() ));
        exit;
    }
    if (is_page('all-products')) {
        wp_redirect(get_home_url());
        exit;
    }
}


add_shortcode('my_orders', 'shortcode_my_orders');
function shortcode_my_orders( $atts ) {
    extract( shortcode_atts( array(
        'order_count' => -1
    ), $atts ) );

    ob_start();
    wc_get_template( 'myaccount/my-orders.php', array(
        'current_user'  => get_user_by( 'id', get_current_user_id() ),
        'order_count'   => $order_count
    ) );
    return ob_get_clean();
}


add_filter( 'woocommerce_breadcrumb_defaults', 'jk_change_breadcrumb_home_text' );
function jk_change_breadcrumb_home_text( $defaults ) {
    // Change the breadcrumb home text from 'Home' to 'Apartment'
  $defaults['home'] = 'All Products';
  return $defaults;
}

function change_price_by_type( $product_id, $new_price, $price_type ) {
    // $the_price = get_post_meta( $product_id, '_' . $price_type, true );
    // $the_price *= $new_price;
    update_post_meta( $product_id, '_' . $price_type, $new_price );
}
 
function change_price_all_types( $product_id, $new_price ) {
    change_price_by_type( $product_id, $new_price, 'price' );
    change_price_by_type( $product_id, $new_price, 'sale_price' );
    change_price_by_type( $product_id, $new_price, 'regular_price' );
}
 
/*
 * `change_product_price` is main function you should call to change product's price
 */
function change_product_price( $product_id, $new_price ) {
    change_price_all_types( $product_id, $new_price );
}
function my_product_update( $post_id ) {
    if (wc_get_product($post_id)) {
      $unit_price = get_field_object('unit_price', $post_id);
      if ($unit_price) {
        $qty_obj = get_field_object('qty', $post_id);
        $qty = 1;
        if ($qty_obj) {
          $qty = $qty_obj['value'];
        }
        change_product_price( $post_id, $unit_price['value'] * $qty );
      }
    }
}

add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
  function loop_columns() {
    return 3; // 3 products per row
  }
}


add_action( 'save_post', 'my_product_update' );
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 15;' ), 12 );


// change item numbers on cart menu
add_filter('wp_nav_menu_items','sk_wcmenucart', 10, 2);
function sk_wcmenucart($menu, $args) {
  // Check if WooCommerce is active and add a new item to a menu assigned to Primary Navigation Menu location
  if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || 'primary' !== $args->theme_location )
    return $menu;

  ob_start();
    global $woocommerce;
    $viewing_cart = __('View your shopping cart', 'your-theme-slug');
    $start_shopping = __('Start shopping', 'your-theme-slug');
    $cart_url = $woocommerce->cart->get_cart_url();
    $shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
    // $cart_contents_count = $woocommerce->cart->cart_contents_count;
    $cart_contents_count = count($woocommerce->cart->cart_contents);    // change cart item number
    $cart_contents = sprintf(_n('%d item', '%d items', $cart_contents_count, 'your-theme-slug'), $cart_contents_count);
    $cart_total = $woocommerce->cart->get_cart_total();
    // Uncomment the line below to hide nav menu cart item when there are no items in the cart
    // if ( $cart_contents_count > 0 ) {
      if ($cart_contents_count == 0) {
        $menu_item = '<li class="right"><a class="wcmenucart-contents" href="'. $shop_page_url .'" title="'. $start_shopping .'">';
      } else {
        $menu_item = '<li class="right"><a class="wcmenucart-contents" href="'. $cart_url .'" title="'. $viewing_cart .'">';
      }

      $menu_item .= '<i class="fa fa-shopping-cart"></i> ';

      $menu_item .= $cart_contents.' - '. $cart_total;
      $menu_item .= '</a></li>';
    // Uncomment the line below to hide nav menu cart item when there are no items in the cart
    // }
    echo $menu_item;
  $social = ob_get_clean();
  return $menu . $social;
}


// qty add/minus button
add_action( 'wp_enqueue_scripts', 'wcqi_enqueue_polyfill' );
function wcqi_enqueue_polyfill() {
    wp_enqueue_script( 'wcqi-number-polyfill' );
}


// remove order status
function so_39252649_remove_processing_status( $statuses ){
    if( isset( $statuses['wc-on-hold'] ) ){
        unset( $statuses['wc-on-hold'] );
    }
    if( isset( $statuses['wc-failed'] ) ){
        unset( $statuses['wc-failed'] );
    }
    if( isset( $statuses['wc-refunded'] ) ){
        unset( $statuses['wc-refunded'] );
    }
    return $statuses;
}
add_filter( 'wc_order_statuses', 'so_39252649_remove_processing_status' );

// change order name
function wc_renaming_order_status( $order_statuses ) {
    foreach ( $order_statuses as $key => $status ) {
        $new_order_statuses[ $key ] = $status;
        if ( 'wc-processing' === $key ) {
            $order_statuses['wc-processing'] = _x( 'Approved/Awaiting Dispatch', 'Order status', 'woocommerce' );
        }
        if ( 'wc-pending' === $key ) {
            $order_statuses['wc-pending'] = _x( 'Pending Approval', 'Order status', 'woocommerce' );
        }
        if ( 'wc-completed' === $key ) {
            $order_statuses['wc-completed'] = _x( 'Dispatch', 'Order status', 'woocommerce' );
        }
        if ( 'wc-cancelled' === $key ) {
            $order_statuses['wc-cancelled'] = _x( 'Reject', 'Order status', 'woocommerce' );
        }
    }
    return $order_statuses;
}
add_filter( 'wc_order_statuses', 'wc_renaming_order_status' );

// add order status to admin order actions column
add_filter( 'woocommerce_admin_order_actions', 'add_cancel_order_actions_button', PHP_INT_MAX, 2 );
function add_cancel_order_actions_button( $actions, $the_order ) {
    // save old view status to put it to last
    $tmp = $actions['view'];
    unset($actions['view']);
    if ( $the_order->has_status( array( 'pending' ) ) ) {
        $actions['cancelled'] = array(
            'url'       => wp_nonce_url( admin_url( 'admin-ajax.php?action=woocommerce_mark_order_status&status=cancelled&order_id=' . $the_order->id ), 'woocommerce-mark-order-status' ),
            'name'      => __( 'Reject', 'woocommerce' ),
            'action'    => "view cancelled", // setting "view" for proper button CSS
        );
    }
    $actions['view'] = $tmp;
    return $actions;
}
add_action( 'admin_head', 'add_order_actions_button_css' );
function add_order_actions_button_css() {
    echo '<style>
      .view.cancelled::after { content: "\e013"; font-family: WooCommerce; color: #a00; }
    </style>';
}


// add order admin link to new order email
add_action( 'woocommerce_email_after_order_table', 'add_link_back_to_order', 10, 2 );
function add_link_back_to_order( $order, $is_admin ) {
  // Only for admin emails
  if ( ! $is_admin || $order->get_total() < 1500) {
    return;
  }
  $link = '<p>';
  $link .= '<a href="'. admin_url( 'post.php?post=' . absint( $order->id ) . '&action=edit' ) .'" >';
  $link .= __( 'Go to the order page to approve or reject', 'your_domain' );
  $link .= '</a>';
  $link .= '<a href="'. wp_nonce_url( admin_url( 'admin-ajax.php?action=woocommerce_mark_order_status&status=processing&order_id=' . $order->id ), 'woocommerce-mark-order-status' ) .'">';
  $link .= __( 'Approve', 'your_domain' );
  $link .= '</a>';
  $link .= '<a href="'. wp_nonce_url( admin_url( 'admin-ajax.php?action=woocommerce_mark_order_status&status=processing&order_id=' . $order->id ), 'woocommerce-mark-order-status' ) .'">';
  $link .= __( 'Reject', 'your_domain' );
  $link .= '</a>';
  $link .= '</p>';
  echo $link;
}


// Reset status of new orders from “processing” to "pending" 
add_action( 'woocommerce_thankyou', 'custom_woocommerce_auto_complete_order' );
function custom_woocommerce_auto_complete_order( $order_id ) {
global $woocommerce;
if ( !$order_id )
return;
$order = new WC_Order( $order_id );
$order->update_status( 'pending' );
}


/* Message */

// remove setting menu button
add_filter( 'fep_menu_buttons', 'fep_cus_fep_menu_buttons' );
function fep_cus_fep_menu_buttons( $menu )
{
    unset( $menu['settings'] );
    unset( $menu['announcements'] );
    return $menu;
}


/* ACF Google Map API */
function my_acf_google_map_api( $api ){
  $api['key'] = 'AIzaSyA85VhdXktocyIysDEGwTdIzN7FLorERjY';
  return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');


/* Display posts shortcode */

// display address for each venue
add_filter( 'display_posts_shortcode_output', 'be_display_posts_facebook', 10, 7 );
function be_display_posts_facebook( $output, $atts, $image, $title, $date, $excerpt, $inner_wrapper ) { 
  // $excerpt = '<span class="address">' . get_the_excerpt() . $facebook . '</span>';
  global $post;
  $map_obj = get_field_object('address', $post->ID);
  $address = '';
  if ($map_obj['value'])
    $address = $map_obj['value']['address'];
  $output = '<' . $inner_wrapper . ' class="col-md-3 col-sm-6 col-xs-12">' .
    '<div class="venues-box">' .
      '<div class="venues-img">' .
        $image .
      '</div>' .
      '<div class="venues-text">' .
        '<h5>' . $title . '</h5>' .
        '<p><img src="http://fitzsimmonsportal.com.au/restore/wp-content/uploads/2016/12/map-marker.png" alt="">' .
          $address .
        '</p>' .
      '</div>' .
    '</div>' .
    '</' . $inner_wrapper . '>';
  return $output;
}


/* remove some product sort */
function my_woocommerce_catalog_orderby( $orderby ) {
  unset($orderby["popularity"]);
  unset($orderby["date"]);
  unset($orderby["price"]);
  unset($orderby["price-desc"]);
  return $orderby;
}
add_filter( "woocommerce_catalog_orderby", "my_woocommerce_catalog_orderby", 20 );


/* user role */

// remove some roles
add_action('admin_menu', 'remove_built_in_roles');
function remove_built_in_roles() {
    global $wp_roles;
 
    $roles_to_remove = array('subscriber', 'contributor', 'author', 'editor');
 
    foreach ($roles_to_remove as $role) {
        if (isset($wp_roles->roles[$role])) {
            $wp_roles->remove_role($role);
        }
    }
}


/* admin customize */

// remove or change some rows on email settings
add_filter('woocommerce_email_classes', 'my_woocommerce_email_classes');
function my_woocommerce_email_classes($emails) {
  $row_to_remove = array('WC_Email_Failed_Order', 'WC_Email_Customer_Refunded_Order', 'WC_Email_Customer_Invoice');
  foreach ($row_to_remove as $row) {
    if (isset($emails[$row])) {
      unset($emails[$row]);
    }
  }

  $emails['WC_Email_Customer_On_Hold_Order']->title = 'Pending Approval order';
  $emails['WC_Email_Customer_Processing_Order']->title = 'Approved/Awaiting Dispatch order';
  $emails['WC_Email_Customer_Completed_Order']->title = 'Dispatch order';
  $emails['WC_Email_Cancelled_Order']->title = 'Reject order';
  return $emails;
}

/**
 * Add custom where statement to product search query
 * @param  string $where
 * @return string
 */

//add_filter('pre_get_posts', 'jc_search_post_excerpt');
function jc_search_post_excerpt($where = ''){
 
    global $wp_the_query;
 
    // escape if not woocommerce search query
    if ( empty( $wp_the_query->query_vars['wc_query'] ) || empty( $wp_the_query->query_vars['s'] ) )
            return $where;
 
    $where = preg_replace("/post_title LIKE ('%[^%]+%')/", "post_title LIKE $1) OR (post_content LIKE $1) OR (jcmt1.meta_key = 'acf-field-description' AND CAST(jcmt1.meta_value AS CHAR) LIKE $1 ", $where);
 
    return $where;
}

//custom css
add_action( 'admin_enqueue_scripts', 'wp_proaject_thm_admin_scripts' );
function wp_proaject_thm_admin_scripts(){
	//wp_enqueue_style( 'main-css', get_template_directory_uri().'/css/font-awesome.min.css' );
	wp_enqueue_style('dazz_custom_css',get_stylesheet_directory_uri().'/dazz_customcss.css');
	
}


/* add new sort in category page */
function add_postmeta_ordering_args( $sort_args ) {
		
	$orderby_value = isset( $_GET['orderby'] ) ? wc_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
	switch( $orderby_value ) {
		case 'acf-field-unit_price':
			$sort_args['orderby']  = 'meta_value_num';
			$sort_args['order']    = 'asc';
			$sort_args['meta_key'] = 'unit_price';
			break;
    case 'acf-field-unit_price_desc':
      $sort_args['orderby']  = 'meta_value_num';
      $sort_args['order']    = 'desc';
      $sort_args['meta_key'] = 'unit_price';
      break;
	}
	
	return $sort_args;
}
add_filter( 'woocommerce_get_catalog_ordering_args', 'add_postmeta_ordering_args' );
// Add these new sorting arguments to the sortby options on the frontend
function add_new_postmeta_orderby( $sortby ) {
	// Adjust the text as desired
	$sortby['acf-field-unit_price'] = __( 'Sort by unit price: low to high', 'woocommerce' );
  $sortby['acf-field-unit_price_desc'] = __( 'Sort by unit price: high to low', 'woocommerce' );
	return $sortby;
}
add_filter( 'woocommerce_default_catalog_orderby_options', 'add_new_postmeta_orderby' );
add_filter( 'woocommerce_catalog_orderby', 'add_new_postmeta_orderby' );



add_action( 'woocommerce_order_details_after_order_table', 'nolo_custom_field_display_cust_order_meta', 10, 1 );

function nolo_custom_field_display_cust_order_meta($order){
    echo '<p><strong>'.__('Pickup Location').':</strong> ' . get_post_meta( $order->id, 'Pickup Location', true ). '</p>';
    echo '<p><strong>'.__('Pickup Date').':</strong> ' . get_post_meta( $order->id, 'Pickup Date', true ). '</p>';
}
