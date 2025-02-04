<?php 

/**
 * Button Shortcode (Internal Links)
 * 
 * Creates a styled button for internal links using the [button] shortcode.
 * The button's URL and optional style can be customized.
 * 
 * Usage:
 * [button href="https://example.com" style="primary"]Click Me[/button]
 * 
 * @param array  $atts    Shortcode attributes (expects 'href' and 'style').
 * @param string $content Content enclosed within the shortcode (button text).
 * @return string HTML output for the styled button.
 */
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


/**
 * URL Shortcode (External Links)
 * 
 * Creates a styled button for external links using the [url] shortcode.
 * Adds `target="_blank"` to open links in a new tab and `rel="nofollow"` for SEO best practices.
 * 
 * Usage:
 * [url href="https://external.com" style="secondary"]Visit Site[/url]
 * 
 * @param array  $atts    Shortcode attributes (expects 'href' and 'style').
 * @param string $content Content enclosed within the shortcode (button text).
 * @return string HTML output for the external link button.
 */
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
