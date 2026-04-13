<?php
/**
 * Plugin Name: EWEB Elementor Buttons
 * Description: High-fidelity collection of premium buttons for Elementor. Includes Project Button, Uiverse Styles, and more.
 * Version: 1.4.0
 * Author: enlaweb
 * Author URI: https://enlaweb.com
 * Text Domain: eweb-buttons
 * Domain Path: /languages
 * Requires at least: 6.0
 * Requires PHP: 8.1
 *
 * @package EEB
 * @version 1.4.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Main Button Factory Class
 */
final class EEB_Plugin {

	/**
	 * Plugin version
	 */
	public const VERSION = '1.4.0';

	private static ?self $instance = null;

	public static function get_instance(): self {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		$this->define_constants();
		$this->init_hooks();
	}

	private function define_constants(): void {
		define( 'EEB_PLUGIN_VERSION', self::VERSION );
		define( 'EEB_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		define( 'EEB_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
	}

	private function init_hooks(): void {
		add_action( 'plugins_loaded', [ $this, 'load_textdomain' ] );
		add_action( 'plugins_loaded', [ $this, 'init_updater' ] );
		
		// Registro de Widgets y Categorías.
		add_action( 'elementor/elements/categories_registered', [ $this, 'register_categories' ] );
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
		
		add_action( 'admin_init', [ $this, 'check_elementor_dependency' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'register_assets' ] );
	}

	public function init_updater(): void {
		if ( is_admin() ) {
			require_once EEB_PLUGIN_DIR . 'src/class-eweb-github-updater.php';
			new EWEB_GitHub_Updater( __FILE__, 'Yisus-Develop', 'eweb-elementor-buttons' );
		}
	}

	public function load_textdomain(): void {
		load_plugin_textdomain( 'eweb-buttons', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}

	/**
	 * Register Custom Category "EWEB"
	 */
	public function register_categories( $elements_manager ): void {
		$elements_manager->add_category(
			'eweb-agency',
			[
				'title' => esc_html__( 'EWEB Agency', 'eweb-buttons' ),
				'icon'  => 'fa fa-plug',
			]
		);
	}

	public function register_widgets( $widgets_manager ): void {
		$fancy_button_path   = EEB_PLUGIN_DIR . 'src/Widgets/Fancy_Button_Widget.php';
		$project_button_path = EEB_PLUGIN_DIR . 'src/Widgets/Project_Button_Widget.php';

		if ( file_exists( $fancy_button_path ) ) {
			require_once $fancy_button_path;
			$widgets_manager->register( new \EEB_Fancy_Button_Widget() );
		}

		if ( file_exists( $project_button_path ) ) {
			require_once $project_button_path;
			$widgets_manager->register( new \EEB_Project_Button_Widget() );
		}
	}

	public function check_elementor_dependency(): void {
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_elementor' ] );
		}
	}

	public function admin_notice_missing_elementor(): void {
		printf(
			'<div class="notice notice-error"><p>%s</p></div>',
			esc_html__( 'EWEB Elementor Buttons requires Elementor to be active.', 'eweb-buttons' )
		);
	}

	public function register_assets(): void {
		wp_register_style(
			'widget-fancy-button',
			EEB_PLUGIN_URL . 'assets/css/widget-fancy-button.css',
			[],
			EEB_PLUGIN_VERSION
		);
		wp_register_style(
			'widget-project-button',
			EEB_PLUGIN_URL . 'assets/css/widget-project-button.css',
			[],
			EEB_PLUGIN_VERSION
		);
	}
}

// Start the Factory.
EEB_Plugin::get_instance();
