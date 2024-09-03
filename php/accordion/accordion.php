<?php

function custom_accordion_shortcode($atts, $content = null) {
    // Extract the label attribute
    $atts = shortcode_atts(array(
        'label' => 'Section',
    ), $atts);

    // Build the output
    $output = '<button class="accordion">' . esc_html($atts['label']) . '</button>';
    $output .= '<div class="panel"><div class="panel-content">' . do_shortcode($content) . '</div></div>';

    return $output;
}
add_shortcode('accordion', 'custom_accordion_shortcode'); 
