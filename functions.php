
/* ============================ *\
    FAUX HEADLINES
\* ============================ */

// Shortcode for H1
function custom_shortcode_h1($atts, $content = null) {
    return '<p class="h1">' . $content . '</p>';
}
add_shortcode('h1', 'custom_shortcode_h1');

// Shortcode for H2
function custom_shortcode_h2($atts, $content = null) {
    return '<p class="h2">' . $content . '</p>';
}
add_shortcode('h2', 'custom_shortcode_h2');

// Shortcode for H3
function custom_shortcode_h3($atts, $content = null) {
    return '<p class="h3">' . $content . '</p>';
}
add_shortcode('h3', 'custom_shortcode_h3');

// Shortcode for H4
function custom_shortcode_h4($atts, $content = null) {
    return '<p class="h4">' . $content . '</p>';
}
add_shortcode('h4', 'custom_shortcode_h4');

// Shortcode for H5
function custom_shortcode_h5($atts, $content = null) {
    return '<p class="h5">' . $content . '</p>';
}
add_shortcode('h5', 'custom_shortcode_h5');

// Shortcode for H6
function custom_shortcode_h6($atts, $content = null) {
    return '<p class="h6">' . $content . '</p>';
}
add_shortcode('h6', 'custom_shortcode_h6');
