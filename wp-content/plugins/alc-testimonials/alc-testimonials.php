<?php
/*
Plugin Name: ALC Témoignages
Description: Plugin pour gérer les témoignages clients avec API, shortcode et back-office.
Author: METOMO David
Version: 1.0
*/

add_action('init', 'alc_register_testimonial_cpt');
function alc_register_testimonial_cpt() {
    register_post_type('testimonial', [
        'labels' => [
            'name' => 'Témoignages',
            'singular_name' => 'Témoignage',
        ],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-testimonial',
        'supports' => ['title', 'editor'],
        'show_in_rest' => true,
    ]);
}

add_action('add_meta_boxes', function () {
    add_meta_box('alc_rating', 'Note (1 à 5)', 'alc_display_rating_field', 'testimonial', 'side');
});

function alc_display_rating_field($post) {
    $value = get_post_meta($post->ID, '_alc_rating', true);
    echo '<input type="number" name="alc_rating" value="' . esc_attr($value) . '" min="1" max="5" />';
}

add_action('save_post', function ($post_id) {
    if (isset($_POST['alc_rating'])) {
        update_post_meta($post_id, '_alc_rating', intval($_POST['alc_rating']));
    }
});

add_shortcode('alc_testimonials', function () {
    $args = [
        'post_type' => 'testimonial',
        'posts_per_page' => 6,
    ];
    $query = new WP_Query($args);
    ob_start();
    echo '<div id="alc-testimonials">';
    while ($query->have_posts()) {
        $query->the_post();
        $rating = get_post_meta(get_the_ID(), '_alc_rating', true);
        echo '<div style="margin-bottom: 1rem">';
        echo '<strong>' . get_the_title() . '</strong><br>';
        echo '<em>' . get_the_content() . '</em><br>';
        echo '<span>Note : ' . $rating . '/5</span>';
        echo '</div>';
    }
    echo '</div>';
    echo '<button id="load-more">Charger plus</button>';
    ?>
    <script>
    document.getElementById('load-more').addEventListener('click', function () {
        alert("Appelle AJAX fictif ici !");
    });
    </script>
    <?php
    wp_reset_postdata();
    return ob_get_clean();
});


add_action('rest_api_init', function () {
    register_rest_route('alc/v1', '/testimonials', [
        'methods' => 'GET',
        'callback' => function ($request) {
            $page = $request->get_param('page') ?: 1;
            $args = [
                'post_type' => 'testimonial',
                'posts_per_page' => 6,
                'paged' => $page,
            ];
            $query = new WP_Query($args);
            $data = [];

            while ($query->have_posts()) {
                $query->the_post();
                $data[] = [
                    'name' => get_the_title(),
                    'message' => get_the_content(),
                    'rating' => get_post_meta(get_the_ID(), '_alc_rating', true)
                ];
            }
            return rest_ensure_response($data);
        }
    ]);
});


add_action('admin_menu', function () {
    add_options_page('ALC Options', 'ALC', 'manage_options', 'alc-options', 'alc_render_options_page');
});

function alc_render_options_page() {
    ?>
    <div class="wrap">
        <h2>Réglages ALC</h2>
        <form method="post" action="options.php">
            <?php
            settings_fields('alc_options_group');
            do_settings_sections('alc-options');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

add_action('admin_init', function () {
    register_setting('alc_options_group', 'alc_slogan');
    add_settings_section('alc_main_section', '', null, 'alc-options');
    add_settings_field('alc_slogan', 'Slogan du site', function () {
        echo '<input type="text" name="alc_slogan" value="' . esc_attr(get_option('alc_slogan')) . '" />';
    }, 'alc-options', 'alc_main_section');
});
