<?php

/** регистрация фильтров и действий * */
function wp_wow_gold_calculator_init() {
    add_action('init', 'wp_wow_gold_calculator_taxonomies');
    add_filter('the_content', 'wp_wow_gold_calculator_author_block_filter');
    add_filter('post_class', 'wp_wow_gold_calculator_post_class');
}

add_action('plugins_loaded', 'wp_wow_gold_calculator_init');

/** taxonomy * */
function wp_wow_gold_calculator_taxonomies() {

    $args = array(
        'labels' => array(
            'name' => 'Guest authors',
            'singular_name' => 'Guest author'
        ),
        'show_in_nav_menus' => false
    );

    register_taxonomy('gauthor', array('post'), $args);
}

/** разметка блока автора * */
function wp_wow_gold_calculator_author_block() {
    global $post;
    $author_terms = wp_get_object_terms($post->ID, 'gauthor');

    if (empty($author_terms)) {
        return;
    }

    $name = stripslashes($author_terms[0]->name);
    $url = esc_url(get_term_link($author_terms[0]));
    $desc = wp_filter_post_kses($author_terms[0]->description);

    //get template from option
    $options = get_option('wp_wow_gold_calculator_options');
    $out = (isset($options['authorbox_template'])) ? $options['authorbox_template'] : '';

    $out = str_replace(
        array('[gauthor_url]','[gauthor_name]', '[gauthor_desc]'), array($url, $name, $desc), $out
    );

    return $out;
}

/** добавить разметку в конец поста * */
function wp_wow_gold_calculator_author_block_filter($content) {

    if (is_single())
        $content .= wp_wow_gold_calculator_author_block();

    return $content;
}

/** добавить CSS class к посту * */
function wp_wow_gold_calculator_post_class($post_class) {
    global $post;

    $author_terms = wp_get_object_terms($post->ID, 'gauthor');
    if (!empty($author_terms)) {
        $post_class[] = 'gauthor';
    }

    return $post_class;
}
