<?php
/**
 * This module detects wp-cloud and adjusts features accordingly.
 */

use function NewfoldLabs\WP\Context\getContext;

if ( function_exists( 'add_action' ) ) {

	add_action(
		'plugins_loaded',
        function() {
            if ( 'atomic' === getContext( 'platform' ) ) {

                // Disable performance
                add_filter( 'newfold/features/filter/canToggle:performance', '__return_false' );
                add_filter( 'newfold/features/filter/isEnabled:performance', '__return_false' );
                
                // Disable staging
                add_filter( 'newfold/features/filter/canToggle:staging', '__return_false' );
                add_filter( 'newfold/features/filter/isEnabled:staging', '__return_false' );

            }
        },
        11
    );
}