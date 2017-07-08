<?php
/*
Plugin Name: WoW Gold Calculator
Description: Calculating wow gold
Version: 1.0
Author: pittsb
Author URI: https://kwork.ru/user/pittsb
Plugin URI: https://kwork.ru/user/pittsb
*/

define('WP_WOW_GOLD_CALCULATOR_DIR', plugin_dir_path(__FILE__));
define('WP_WOW_GOLD_CALCULATOR_URL', plugin_dir_url(__FILE__));


register_activation_hook(__FILE__, 'wp_wow_gold_calculator_activation');


function wp_wow_gold_calculator_activation() {
    // действие при активации
    // регистрируем действие при удалении

}

function wp_wow_gold_calculator_content(){
    $template = 'includes/gold.php';
    $params=[];
    if(isset($_REQUEST["form_submited"]) && $_REQUEST["form_submited"] == "1"){
        $params = $_REQUEST;
        $template = 'includes/confirm.php';
    }else{
        $sarr = get_option('wow_gold_calculator_servers');
        $params["agreement"] = get_option('wow_gold_calculator_agreement_page');
        // $params["servers"]='<option selected="selected">----------------------------------------------</option> ';
        foreach ($sarr as $s) $params["servers"].='<option value="'.$s['title'].'" data-rate="'.$s["rate"].'" data-currency="'.$s["currency"].'">'.$s['title'].'</option>';
    }
    $content = file_get_contents(WP_WOW_GOLD_CALCULATOR_DIR.$template);
    $content = preg_replace_callback('/\{\{([^\}]+)\}\}/im',function($m)use($params){
        $param = strtolower(trim($m[1]));
        return isset($params[$param])?$params[$param]:'';
    },$content);
    echo $content;
}

add_action( 'init', 'wp_wow_gold_calculator_load_resources_and_shortcodes', 1 );
function wp_wow_gold_calculator_load_resources_and_shortcodes(){
    add_shortcode( 'wow_gold_calculator', 'wp_wow_gold_calculator_content' );
	if( is_admin() ){
        include WP_WOW_GOLD_CALCULATOR_DIR.'includes/admin.php';
    }
}

/** регистрация фильтров и действий * */
function wp_wow_gold_calculator_init() {
    wp_deregister_script( 'jquery' );
    wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-2.2.4.min.js');
    wp_enqueue_style( 'wowgoldcalculator',WP_WOW_GOLD_CALCULATOR_URL.'css/style.css', false, '1.0.0', 'all');
    wp_enqueue_script( 'wowgoldcalculator', WP_WOW_GOLD_CALCULATOR_URL.'js/wowgoldcalculator.js', false, '1.0.0', 'all');
}

add_action('wp_enqueue_scripts', 'wp_wow_gold_calculator_init');


add_action( 'wp_ajax_wow_gold_get_data',        'wow_gold_get_data' ); // For logged in users
add_action( 'wp_ajax_nopriv_wow_gold_get_data', 'wow_gold_get_data' ); // For anonymous users

function wow_gold_get_data(){
    // $res = [
    //     "order"=>["min"=>100],
    //     "rate"=>floatval(get_option('gold_rate'))
    // ];
    $res = get_option('wow_gold_calculator_servers');
    echo(json_encode( $res ));
    wp_die();
}

// где-то в functions.php
function wp_wow_gold_calculator_js_variables(){
    $variables = array (
        'ajax_url' => admin_url('admin-ajax.php'),
        'is_mobile' => wp_is_mobile(),
        'min_order' => get_option('wow_gold_calculator_min_order')
        // Тут обычно какие-то другие переменные
    );
    echo '<script type="text/javascript">window.wp_data = '.json_encode($variables).';</script>';
}
add_action('wp_head','wp_wow_gold_calculator_js_variables');
