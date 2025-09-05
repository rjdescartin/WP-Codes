<?php
/**
 * Webtek - Smart Alt Text Generator (ALT-only version)
 *
 * Safe to use directly in <img alt="">. Values are escaped inside.
 *
 * Fallback order:
 *  1) Alt (Media Library)
 *  2) Title
 *  3) Caption (stripped)
 *  4) Description (stripped, trimmed to 12 words)
 *  5) File name (humanized)
 *  6) For raw/external URL: basename humanized
 *  7) Empty string
 * 
 *  Example usage:
 *   $image = get_field('hero_image'); // ACF image field
 *   $alt   = webtek_get_image_alt( $image );
 *   <img src="echo esc_url($image['url']);" alt="echo webtek_get_image_alt( $image );">
 *
 
 * @package  Webtek
 * @author   Robert
 * @license  GPL-2.0+
 */
function webtek_get_image_alt( $image ) {
    $attachment_id = 0;
    $acf_title     = '';

    // ACF Image Array
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

    // Raw URL
    } elseif ( is_string( $image ) ) {
        $attachment_id = attachment_url_to_postid( $image );
    }

    // If we have an attachment ID, resolve in order
    if ( $attachment_id > 0 ) {
        // 1) Alt (custom field)
        $alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );
        if ( is_string( $alt ) && $alt !== '' ) {
            return esc_attr( apply_filters( 'webtek/image_alt', $alt, $attachment_id, $image ) );
        }

        // 2) Title
        $title = get_the_title( $attachment_id );
        if ( is_string( $title ) && $title !== '' ) {
            return esc_attr( apply_filters( 'webtek/image_alt', $title, $attachment_id, $image ) );
        }

        // 3) Caption
        $caption = wp_get_attachment_caption( $attachment_id );
        if ( is_string( $caption ) && $caption !== '' ) {
            $caption = wp_strip_all_tags( $caption );
            if ( $caption !== '' ) {
                return esc_attr( apply_filters( 'webtek/image_alt', $caption, $attachment_id, $image ) );
            }
        }

        // 4) Description
        $description = get_post_field( 'post_content', $attachment_id );
        if ( is_string( $description ) && $description !== '' ) {
            $description = wp_strip_all_tags( $description );
            $description = wp_trim_words( $description, 12, '…' );
            if ( $description !== '' ) {
                return esc_attr( apply_filters( 'webtek/image_alt', $description, $attachment_id, $image ) );
            }
        }

        // 5) File name (from local attachment)
        $file = get_attached_file( $attachment_id );
        if ( is_string( $file ) && $file !== '' ) {
            $filename = pathinfo( $file, PATHINFO_FILENAME );
            if ( is_string( $filename ) && $filename !== '' ) {
                $human = ucwords( str_replace( array( '-', '_' ), ' ', $filename ) );
                return esc_attr( apply_filters( 'webtek/image_alt', $human, $attachment_id, $image ) );
            }
        }
    }

    // If ACF array had a title but no attachment ID
    if ( $acf_title ) {
        return esc_attr( apply_filters( 'webtek/image_alt', $acf_title, 0, $image ) );
    }

    // 6) Handle truly external/raw URLs (not in Media Library)
    if ( is_string( $image ) && $image !== '' ) {
        $path     = parse_url( $image, PHP_URL_PATH );
        $basename = $path ? basename( $path ) : '';
        if ( $basename ) {
            $filename = pathinfo( $basename, PATHINFO_FILENAME );
            if ( $filename ) {
                $human = ucwords( str_replace( array( '-', '_' ), ' ', $filename ) );
                return esc_attr( apply_filters( 'webtek/image_alt', $human, 0, $image ) );
            }
        }
    }

    // 7) Decorative
    return '';
}
