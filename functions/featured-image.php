<?php
/**
 * Get featured image data for a given WordPress post.
 *
 * Returns the featured image URL, alt text, and attachment ID for a post.
 * If the featured image does not have alt text set in the media library,
 * the function falls back to using the post title as the alt text.
 *
 * This function does not escape the returned values. Escape values at the
 * point of output using functions such as esc_url(), esc_attr(), or esc_html().
 *
 * Example usage:
 *
 * $featured_image = get_featured_image_data();
 *
 * if ( $featured_image ) {
 *     echo '<img src="' . esc_url( $featured_image['url'] ) . '" alt="' . esc_attr( $featured_image['alt'] ) . '">';
 * }
 *
 * @param int|null $post_id Optional. The ID of the post to get the featured image from.
 *                          If null, the current post ID from get_the_ID() will be used.
 *                          Default null.
 * @param string   $size    Optional. The WordPress image size to retrieve.
 *                          Accepts any registered image size, such as 'thumbnail',
 *                          'medium', 'large', or 'full'. Default 'full'.
 *
 * @return array|null {
 *     Featured image data, or null if no valid post ID or featured image exists.
 *
 *     @type string $url The featured image URL.
 *     @type string $alt The featured image alt text. Falls back to the post title if empty.
 *     @type int    $id  The featured image attachment ID.
 * }
 */
function get_featured_image_data( $post_id = null, $size = 'full' ) {
    $post_id = $post_id ?: get_the_ID();

    if ( ! $post_id || ! has_post_thumbnail( $post_id ) ) {
        return null;
    }

    $thumbnail_id = get_post_thumbnail_id( $post_id );
    $image_url    = get_the_post_thumbnail_url( $post_id, $size );
    $alt_text     = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );

    if ( empty( $alt_text ) ) {
        $alt_text = get_the_title( $post_id );
    }

    return array(
        'url' => $image_url,
        'alt' => $alt_text,
        'id'  => $thumbnail_id,
    );
}
