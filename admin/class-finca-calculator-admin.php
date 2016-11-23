<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://finca.org
 * @since      1.0.0
 *
 * @package    FINCA_Calculator
 * @subpackage FINCA_Calculator/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    FINCA_Calculator
 * @subpackage FINCA_Calculator/admin
 * @author     Luis Gomez Donis <luis.gomez@finca.org>
 */
class Finca_Calculator_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_action('admin_menu', function(){

			add_menu_page('FINCA Calculator settings',
				'FINCA Calculator', 'manage_options', 'finca-calculator',
				array($this,'finca_calcultor_admin_area'
			));

		});

	}

	
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/plugin-name-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/plugin-name-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Administration area
	 *
	 * @since    1.0.0
	 */
	public function finca_calcultor_admin_area(){

		echo "<h1>FINCA Online calculator</h1><hr>";

	}

}
