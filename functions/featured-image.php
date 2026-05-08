<?php
/**
 * Return the featured image URL and alt text for a post.
 *
 * @param int|null $post_id Optional. Defaults to current post ID.
 * @param string   $size    Optional. Image size. Defaults to 'full'.
 *
 * @return array|null
 */
function get_featured_image_data( $post_id = null, $size = 'full' ) {
    $post_id = $post_id ?: get_the_ID();

    if ( ! $post_id || ! has_post_thumbnail( $post_id ) ) {
        return null;
    }

    $thumbnail_id = get_post_thumbnail_id( $post_id );
    $image_url    = get_the_post_thumbnail_url( $post_id, $size );
    $alt_text     = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );

    return array(
        'url' => $image_url,
        'alt' => $alt_text,
    );
}

/**
 * Usage inside the loop:
 */

$featured_image = get_featured_image_data();

if ( $featured_image ) : ?>
    <img 
        src="<?php echo esc_url( $featured_image['url'] ); ?>" 
        alt="<?php echo esc_attr( $featured_image['alt'] ); ?>"
    >
<?php endif;

/**
 * Usage with a specific post ID:
 */

$featured_image = get_featured_image_data( 123, 'large' );

if ( $featured_image ) {
    echo esc_url( $featured_image['url'] );
    echo esc_html( $featured_image['alt'] );
}

/**
 * For extra safety, you can fallback the alt text to the post title:
 */

$alt_text = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );

if ( empty( $alt_text ) ) {
    $alt_text = get_the_title( $post_id );
}
