<?php
/**
 * Custom Shortcodes for Headings (H1 to H6)
 *
 * This code registers shortcodes [h1] to [h6], replacing them with a <span> element.
 * The span will have the corresponding heading class (h1, h2, etc.) and optionally additional classes.
 *
 * Usage:
 * [h1]Sample Text[/h1] → <span class="h1">Sample Text</span>
 * [h2 class="custom-class"]Sample Text[/h2] → <span class="h2 custom-class">Sample Text</span>
 *
 * Features:
 * - Supports dynamic heading levels (H1 to H6).
 * - Allows adding extra CSS classes via the "class" attribute.
 * - Ensures clean and flexible shortcode implementation.
 */

function custom_shortcode_heading($atts, $content = null, $tag) {
    // Set default attributes (empty class if not provided)
    $atts = shortcode_atts(['class' => ''], $atts);
    $extra_class = !empty($atts['class']) ? ' ' . esc_attr($atts['class']) : '';

    // Return the formatted span element
    return '<span class="' . esc_attr($tag) . $extra_class . '">' . do_shortcode($content) . '</span>';
}

// Register shortcodes for H1 to H6 dynamically
function register_heading_shortcodes() {
    for ($i = 1; $i <= 6; $i++) {
        add_shortcode("h$i", function($atts, $content = null) use ($i) {
            return custom_shortcode_heading($atts, $content, "h$i");
        });
    }
}
add_action('init', 'register_heading_shortcodes');
