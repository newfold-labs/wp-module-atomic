<?php
/**
 * This module detects wp-cloud and adjusts features accordingly.
 */

use function NewfoldLabs\WP\Context\getContext;
use function NewfoldLabs\WP\Module\Features\disable as disableFeature;

if ( function_exists( 'add_action' ) ) {

	add_action(
		'plugins_loaded',
        function() {
            if ( 'atomic' === getContext( 'platform' ) ) {

                // Disable performance
                disableFeature( 'performance' );
                add_filter( 'newfold/features/filter/canToggle:performance', '__return_false' );
                add_filter( 'newfold/features/filter/isEnabled:performance', '__return_false' );
                
                // Disable staging
                disableFeature( 'staging' );
                add_filter( 'newfold/features/filter/canToggle:staging', '__return_false' );
                add_filter( 'newfold/features/filter/isEnabled:staging', '__return_false' );

            }
        }.
        11
    );
}