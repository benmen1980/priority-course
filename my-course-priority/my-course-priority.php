<?php

/**
*
*
*
* @wordpress-plugin
* Plugin Name: Priority course
* Plugin URI: http://simplyCT.co.il
* Description: Priority course of Roy Ben Menachem
* Version: 1.0.0
* Author:Ester SimplyCT
* Author URI: http://www.simplyCT.co.il
* Licence: GPLv2
* Text Domain: p18w
* Domain Path: /languages
*/

defined('ABSPATH') or die ('no script kiddies please!');

//include plugin_dir_path( __FILE__ ) . 'includes/my-course-page.php';

// Enqueue jQuery from CDN
function enqueue_scripts_and_style() {
   
    wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.7.1.min.js', array(), null, true);
    wp_enqueue_style('plugin-style-accordion',plugins_url('includes/css/accordion.css', __FILE__));
    wp_enqueue_style('plugin-style-popup',plugins_url('includes/css/popup-register.css', __FILE__));
    wp_enqueue_style('plugin-style-title',plugins_url('includes/css/welcome-title.css', __FILE__));
    wp_enqueue_style('plugin-style-shop',plugins_url('includes/css/shop-of-course.css', __FILE__));


    // Enqueue JS and pass jQuery as dependency
    wp_enqueue_script('plugin-script', plugins_url('includes/my-script/accordion.js', __FILE__), array('jquery'), null, true );


}
add_action('wp_enqueue_scripts', 'enqueue_scripts_and_style');


//shortcode of acordion lessons >> put in the new page [page_course_priority]

function page_course_priority($att) {
    // Get the path to the custom page content file
    $html_file = plugin_dir_path(__FILE__) . 'includes/my-course-page.php';

    // Check if the file exists
    if (file_exists($html_file)) {
        // Output the HTML content from the file
        $html="";
        ob_start();
        $html .= "<div class='new-page-course'>";
        include $html_file;
        $html .= "</div>";
        $html .= ob_get_clean();

        return $html;
    } else {
        return 'HTML content file not found.';
    }
}
add_shortcode('page_course_priority', 'page_course_priority');


//shortcode for shop of course >> put in new page[shop_of_course]

function shop_of_course($att) {
    // Get the path to the custom page content file
    $html_file = plugin_dir_path(__FILE__) . 'includes/shop-of-course.php';

    // Check if the file exists
    if (file_exists($html_file)) {
        // Output the HTML content from the file
        $html="";
        ob_start();
        $html .= "<div class='shop-of-course'>";
        include $html_file;
        $html .= "</div>";
        $html .= ob_get_clean();

        return $html;
    } else {
        return 'HTML content file not found.';
    }
}
add_shortcode('shop_of_course', 'shop_of_course');



//create_custom_post_type lessons


function create_custom_post_type()
{
    $labelLessons = array(
        'name' => 'Lessons',
        'singular_name' => 'Lesson',
        'add_new' => 'הוסף שיעור חדש',
        'add_new_item' => 'הוסף שיעור חדש',
        'edit_item' => 'Edit Lesson',
        'new_item' => 'New Lesson',
        'view_item' => 'View Lesson',
        'search_items' => 'Search Lessons',
        'not_found' => 'No Lessons found',
        'not_found_in_trash' => 'No Lessons found in trash',
        'parent_item_colon' => '',
        'menu_name' => 'קורס פריוריטי'
    );
    $argsLessons = array(
        'labels' => $labelLessons,
        'public' => true,
        'show_ui'  => true,
        'has_archive' => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail',
            'custom-fields',
            'comments',
        ),
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,


//		'taxonomies' => array( 'category', 'post_tag' ),
//		'menu_position' => 5,
//		'exclude_from_search' => false
    );

    register_post_type('Lessons', $argsLessons);
}
add_action( 'init', 'create_custom_post_type' );

//הוספת הקובץ של הCPT לתבנית כדי שוורדפרס יטען אותו

function custom_lesson_template($template) {
    if (is_singular('Lessons')) {
        // Check if the template file exists within the plugin directory
        $custom_template = plugin_dir_path(__FILE__) . 'includes/single-Lessons.php';
        if (file_exists($custom_template)) {
            return $custom_template;
        }
    }
    return $template;
}
//add_filter('template_include', 'custom_lesson_template');

function add_additional_content_to_post($content) {
    // Check if it's a single post
    if  (is_single() && get_post_type() === 'lessons' ) {
        // Path to the additional content HTML file
        $html_file_path = plugin_dir_path(__FILE__) . 'includes/single-Lessons.php';

        // Read the contents of the HTML file
        $additional_content = file_get_contents($html_file_path);

        $content="";
        ob_start();
        $content .= "<div class='new-page-lesson-1111'>";
        // Append the additional content to the post content
       // $content .= $additional_content;
        include $html_file_path;
        //$content.= "</div>";
        $content .= ob_get_clean();

    }

    return $content;
}
add_filter('the_content', 'add_additional_content_to_post');


// Enqueue jQuery from CDN
function enqueue_jquery_from_cdn() {
    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_jquery_from_cdn');



//אם נכנס לפוסט שיעור ספציפי, מחזיר אותו בחזרה לאקורדיון, זה חשוב בעיקר בגלל התגובות בתוך האקורדיון.
add_action( 'template_redirect', 'my_redirect_to_accordion' );
function my_redirect_to_accordion() {
    $my_page='course-priority';
    if  (is_single() && get_post_type() === 'lessons' ) {
        wp_redirect( get_site_url().'/'.$my_page);
        exit;
    }
}

// הוספת שדות מותאמים אישית לפרופיל המשתמש
function add_custom_user_fields() {
    // הוספת שדה מותאם אישית לפרופיל המשתמש באמצעות ACF
    acf_add_local_field_group(array(
        'key' => 'group_user_custom_fields',
        'title' => 'פרטי משתמש',
        'fields' => array(
            array(
                'key' => 'maslul-name',
                'label' => 'מסלול שנרכש',
                'name' => 'maslul-name',
                'type' => 'text',

            ),
            array(
                'key' => 'date-finish',
                'label' => 'תאריך סיום קורס',
                'name' => 'date-finish',
                'type' => 'date_picker',
                'display_format' => 'd/m/Y', // פורמט תצוגת התאריך
                'return_format' => 'd/m/Y', // פורמט ההחזרה

            ),
            // ניתן להוסיף עוד שדות מותאמים אישית לפרופיל המשתמש כרצונך
        ),
        'location' => array(
            array(
                array(
                    'param' => 'user_form',
                    'operator' => '==',
                    'value' => 'all',
                ),
            ),
        ),
    ));
}

add_action('acf/init', 'add_custom_user_fields');


// ajax-add to cart
add_action('wp_ajax_add_product_to_cart', 'add_product_to_cart_callback');
add_action('wp_ajax_nopriv_add_product_to_cart', 'add_product_to_cart_callback');

function add_product_to_cart_callback() {
    global $woocommerce;
    // המקט של המוצר שברצונך להוסיף לעגלת הקניות
    $product_sku = $_POST['product_sku'];

    // קבלת המזהה של המוצר על פי המקט שלו
    $product_id = wc_get_product_id_by_sku($product_sku);

    // הוספת המוצר לעגלת הקניות
    if ($product_id) {
        $woocommerce->cart->empty_cart();
        WC()->cart->add_to_cart($product_id);
        echo 'success';
    } else {
        echo 'error';
    }
    die();
}


//save the maslul-product on the user
// שומר את המסלול הנכש כאשר עובר לדף תודה

//add_action( 'woocommerce_thankyou', 'save_custom_field_value' );

function save_custom_field_value( $order_id ) {
    //בדוק אם קיים הזמנה והתשלום התבצע בהצלחה
    if ( ! empty( $order_id ) && is_numeric( $order_id ) ) {
        $order = wc_get_order( $order_id );

        // בדוק אם ההזמנה היא תקינה והתשלום התבצע בהצלחה
        if ( $order && $order->get_status() === 'completed' ) {

            $user_id = get_current_user_id(); // המזהה של המשתמש שברצונך לשמור עבורו את הערך // שמירת הערך לשדה ACF של המשתמש
            foreach ( $order->get_items() as $item_id => $item ) {
                $maslul_sku = $item->get_product()->get_sku();
                $maslul_id = wc_get_product_id_by_sku( $maslul_sku );
                $maslul_title = get_the_title($maslul_id);

            }
            update_field('maslul-name', $maslul_title, 'user_'.$user_id);

        }
    }
}

// שומר את השדות על היוזר אם ההזמנה הועברה למצב הושלם
add_action( 'woocommerce_order_status_completed', 'custom_function_on_order_completion' );

function custom_function_on_order_completion( $order_id ) {
    $order = wc_get_order( $order_id );

    // בדוק אם ההזמנה היא תקינה והתשלום התבצע בהצלחה
    if ( $order && $order->get_status() === 'completed' ) {

        $user_id = get_current_user_id(); // המזהה של המשתמש שברצונך לשמור עבורו את הערך // שמירת הערך לשדה ACF של המשתמש
        foreach ( $order->get_items() as $item_id => $item ) {
            $maslul_sku = $item->get_product()->get_sku();
            $maslul_id = wc_get_product_id_by_sku( $maslul_sku );
            $maslul_title = get_the_title($maslul_id);

        }

        $today_date = date("Y-m-d");
// כמות החודשים שברצונך להוסיף
        $months_to_add = intval(get_field('month', $maslul_id));
// הוספת החודשים המוגדרים לתאריך היום
        $new_date = date("Y-m-d", strtotime("+$months_to_add months", strtotime($today_date)));

        update_field('maslul-name', $maslul_title, 'user_'.$user_id);
        update_field('date-finish', $new_date, 'user_'.$user_id);

    }

}

//בעמוד תשלום הסרת שדות לא רלוונטיפ

add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

function custom_override_checkout_fields( $fields ) {
    unset($fields['billing']['billing_address_1']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_country']);
    unset($fields['billing']['billing_state']);
    unset($fields['shipping']['billing_address_1']);
    unset($fields['shipping']['billing_address_2']);
    unset($fields['shipping']['billing_city']);
    unset($fields['shipping']['billing_postcode']);
    unset($fields['shipping']['billing_country']);
    unset($fields['shipping']['billing_state']);

    return $fields;
}
