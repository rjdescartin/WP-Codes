<?php 
/**
 * Webtek - Smart Alt Text Generator
 *
 * Provides a reliable sequence of fallbacks for image alt text to improve accessibility.
 * Works with ACF image fields (array, ID, or URL), WordPress attachment IDs, or raw image URLs.
 *
 * Fallback sequence:
 *   1. Alt attribute (custom field in Media Library)
 *   2. Image Title
 *   3. Image Caption
 *   4. Image Description (trimmed to 12 words)
 *   5. File Name (humanized: underscores/dashes replaced with spaces)
 *   6. Empty string (for decorative images only)
 *
 * Example usage:
 *   $image = get_field('hero_image'); // ACF image field
 *   $alt   = webtek_get_image_alt( $image );
 *   <img src="echo esc_url($image['url']);" alt="echo webtek_get_image_alt( $image );">
 *   
 *
 * @package  Webtek
 * @author   Robert
 * @license  GPL-2.0+
 */
function webtek_get_image_alt( $image ) {
    $attachment_id = 0;
    $acf_title     = '';

    // Handle ACF Image Array
    if ( is_array( $image ) ) {
        if ( ! empty( $image['alt'] ) ) {
            return esc_attr( $image['alt'] );
        }
        if ( ! empty( $image['ID'] ) ) {
            $attachment_id = (int) $image['ID'];
        } elseif ( ! empty( $image['id'] ) ) {
            $attachment_id = (int) $image['id'];
        }
        if ( ! empty( $image['title'] ) ) {
            $acf_title = $image['title'];
        }
        if ( ! $attachment_id && ! empty( $image['url'] ) ) {
            $attachment_id = attachment_url_to_postid( $image['url'] );
        }

    // Attachment ID
    } elseif ( is_numeric( $image ) ) {
        $attachment_id = (int) $image;

    // Image URL
    } elseif ( is_string( $image ) ) {
        $attachment_id = attachment_url_to_postid( $image );
    }

    // If we have an attachment ID, try grabbing fields in order
    if ( $attachment_id ) {
        // 1. Alt (custom field)
        $alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );
        if ( $alt ) {
            return esc_attr( $alt );
        }

        // 2. Title
        $title = get_the_title( $attachment_id );
        if ( $title ) {
            return esc_attr( $title );
        }

        // 3. Caption
        $caption = wp_get_attachment_caption( $attachment_id );
        if ( $caption ) {
            return esc_attr( $caption );
        }

        // 4. Description (post_content)
        $description = get_post_field( 'post_content', $attachment_id );
        if ( $description ) {
            return esc_attr( wp_trim_words( $description, 12, '…' ) );
        }

        // 5. File name
        $file = get_attached_file( $attachment_id );
        if ( $file ) {
            $filename = pathinfo( $file, PATHINFO_FILENAME );
            return esc_attr( str_replace( ['-', '_'], ' ', $filename ) );
        }
    }

    // If only ACF array was available (no attachment ID)
    if ( $acf_title ) {
        return esc_attr( $acf_title );
    }

    // 6. Last resort → empty alt (decorative)
    return '';
}
