<?php 

// Use for internal links
function button_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
        "href" => 'http://',
        "style" => '',
    ), $atts));
    
    $classes = 'button';
    if ($style) {
        $classes .= ' button-' . sanitize_html_class($style);
    }
    
    return '<a href="' . esc_url($href) . '" class="' . esc_attr($classes) . '">' . do_shortcode($content) . '</a>';
}
add_shortcode("button", "button_shortcode");


// Use for external links
function url_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		"href" => 'http://',
		"style" => '',
	), $atts));

	$classes = 'button';
	if ($style) {
		$classes .= ' button-' . sanitize_html_class($style);
	}

	return '<a href="' . esc_url($href) . '" class="' . esc_attr($classes) . '" target="_blank" rel="nofollow">' . do_shortcode($content) . '</a>';
}
add_shortcode("url", "url_shortcode");
