<?php

/**
 * Custom Accordion Shortcode
 * 
 * This function registers a WordPress shortcode [accordion] that creates a collapsible 
 * accordion section with a button and a content panel. The label of the button can be 
 * customized using the 'label' attribute.
 * 
 * Usage:
 * [accordion label="Click Me"]Your content here[/accordion]
 * 
 * @param array  $atts    Shortcode attributes (expects 'label').
 * @param string $content Content enclosed within the shortcode.
 * @return string HTML output for the accordion component.
 */
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
