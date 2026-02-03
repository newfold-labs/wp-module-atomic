<?php

namespace NewfoldLabs\WP\Module\Atomic;

/**
 * Tests when platform is 'atomic': bootstrap callbacks add filters and set option.
 *
 * Uses the context module's setContext (require dependency) so we can re-fire
 * plugins_loaded and after_setup_theme with platform=atomic and assert atomic behavior.
 * Skipped if setContext is not available.
 *
 * @coversNothing
 */
class AtomicHooksWhenAtomicWPUnitTest extends \lucatume\WPBrowser\TestCase\WPTestCase {

	/**
	 * Set atomic platform and re-fire hooks so bootstrap callbacks run (requires context module).
	 *
	 * Context module fires do_action('newfold/context/set') at plugins_loaded priority 1; its
	 * callback on that action sets platform to 'default' when IS_ATOMIC is not defined. We
	 * hook into newfold/context/set at priority 999 so we run after that and set platform to
	 * 'atomic'. Then we fire plugins_loaded and after_setup_theme so the atomic module's
	 * callbacks run with platform=atomic.
	 *
	 * @return void
	 */
	public function setUp(): void {
		parent::setUp();
		if ( ! function_exists( 'NewfoldLabs\WP\Context\setContext' ) ) {
			return;
		}
		add_action(
			'newfold/context/set',
			function () {
				\NewfoldLabs\WP\Context\setContext( 'platform', 'atomic' );
			},
			999
		);
		do_action( 'plugins_loaded' );
		do_action( 'after_setup_theme' );
	}

	/**
	 * Skip the suite if context setContext is not available.
	 *
	 * @return void
	 */
	private function skip_if_no_context() {
		if ( ! function_exists( 'NewfoldLabs\WP\Context\setContext' ) ) {
			$this->markTestSkipped( 'wp-module-context setContext is required to test atomic branch' );
		}
	}

	/**
	 * Verifies that performance feature is disabled when platform is atomic.
	 *
	 * @return void
	 */
	public function test_performance_disabled_on_atomic() {
		$this->skip_if_no_context();
		$this->assertFalse( apply_filters( 'newfold/features/filter/isEnabled:performance', true ) );
		$this->assertFalse( apply_filters( 'newfold/features/filter/canToggle:performance', true ) );
	}

	/**
	 * Verifies that staging feature is disabled when platform is atomic.
	 *
	 * @return void
	 */
	public function test_staging_disabled_on_atomic() {
		$this->skip_if_no_context();
		$this->assertFalse( apply_filters( 'newfold/features/filter/isEnabled:staging', true ) );
		$this->assertFalse( apply_filters( 'newfold/features/filter/canToggle:staging', true ) );
	}

	/**
	 * Verifies that Help Center and patterns default to disabled when platform is atomic.
	 *
	 * @return void
	 */
	public function test_help_center_and_patterns_default_disabled_on_atomic() {
		$this->skip_if_no_context();
		$this->assertFalse( apply_filters( 'newfold/features/filter/defaultValue:helpCenter', true ) );
		$this->assertFalse( apply_filters( 'newfold/features/filter/defaultValue:patterns', true ) );
	}

	/**
	 * Verifies that container cache types are empty when platform is atomic.
	 *
	 * @return void
	 */
	public function test_cache_types_empty_on_atomic() {
		$this->skip_if_no_context();
		$this->assertSame( array(), apply_filters( 'newfold/container/cache_types', array( 'browser' ) ) );
	}

	/**
	 * Verifies that marketplace and plugin brand are bluehost-cloud when platform is atomic.
	 *
	 * @return void
	 */
	public function test_marketplace_and_plugin_brand_bluehost_cloud_on_atomic() {
		$this->skip_if_no_context();
		$this->assertSame( 'bluehost-cloud', apply_filters( 'newfold/container/marketplace_brand', '' ) );
		$this->assertSame( 'bluehost-cloud', apply_filters( 'newfold/container/plugin/brand', '' ) );
	}

	/**
	 * Verifies that onboarding redirect option is set to 0 when platform is atomic.
	 *
	 * @return void
	 */
	public function test_onboarding_redirect_disabled_on_atomic() {
		$this->skip_if_no_context();
		$this->assertSame( '0', get_option( 'nfd_module_onboarding_should_redirect' ) );
	}
}
