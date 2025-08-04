<?php
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
});

// Enregistrement du menu principal
add_action('after_setup_theme', function () {
    register_nav_menu('primary', 'Menu Principal');
});

// Enregistrer le pattern Hero ALC
add_action('init', function () {
    register_block_pattern(
        'alc-child/hero-alc',
        [
            'title'       => __('Hero ALC'),
            'description' => __('Une section Hero stylisée pour ALC'),
            'content'     => file_get_contents(get_theme_file_path('/patterns/hero-alc.php')),
            'categories'  => ['featured'],
        ]
    );
});
