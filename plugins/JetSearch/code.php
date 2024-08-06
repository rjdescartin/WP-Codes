<?php

/* ================================== *\
 * JetSearch Search only by post title
 *
 * Add this code 
 * to the theme's functions.php
\* ================================== */

add_action( 'jet-search/ajax-search/search-query', function( $handler ) {
    if ( ! isset( $handler->search_query['search_columns'] ) ) {
        $handler->search_query['search_columns'] = array( 'post_title' );
    }
} );
