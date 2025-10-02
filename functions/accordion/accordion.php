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
    // Extract the attributes
    $atts = shortcode_atts(array(
        'label'  => 'Section',
        'active' => '', // default empty
    ), $atts, 'accordion');

    // Check if active is set
    $is_active = !empty($atts['active']) ? true : false;

    // Add active class if set
    $button_class = 'accordion' . ($is_active ? ' active' : '');

    // If active, set inline style to open
    $panel_style = $is_active ? 'style="max-height: 9999px;"' : '';

    // Build output
    $output  = '<button class="' . esc_attr($button_class) . '">' . esc_html($atts['label']) . '</button>';
    $output .= '<div class="panel" ' . $panel_style . '><div class="panel-content">' . do_shortcode($content) . '</div></div>';

    return $output;
}
add_shortcode('accordion', 'custom_accordion_shortcode');
