<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://finca.org
 * @since      1.0.0
 *
 * @package    Finca_Calculator
 * @subpackage Finca_Calculator/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Finca_Calculator
 * @subpackage Finca_Calculator/public
 * @author     Luis Gomez Donis <luis.gomez@finca.org>
 */
class FINCA_Calculator_Public {

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
     * Subsidiary code
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $subsidiary    Subsidiary code
     */
    private $subsidiary;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $subsidiary ) {

		$this->plugin_name = $plugin_name;
        $this->subsidiary = $subsidiary;
        $this->version = $version;

		add_shortcode( 'finca-calculator', array($this, 'finca_calculator') );

	}

	

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ )
            . $this->subsidiary . '/finca-calculator-public.css', array(), null, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
        
        /* moment.js - library to manage dates */
        wp_enqueue_script( $this->plugin_name . '-moment', plugin_dir_url( __FILE__ )
            . 'js/moment.min.js');

        /* finca-calculator.js - loan and savings calculator in a sinble javascript library */
        wp_enqueue_script( $this->plugin_name . '-calculator', plugin_dir_url( __FILE__ )
            . 'js/finca-calculator.js', array('moment'), $this->version, false );

        /* angular.js - front-end mvc library */
        wp_enqueue_script( $this->plugin_name . '-angular', plugin_dir_url( __FILE__ )
            . 'js/angular.min.js');
        
        /* {{subsidiary}}-finca-calculator-public.js - calculator implementation for thesubsidiary */
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ )
            . $this->subsidiary . '/finca-calculator-public.js', array(), null, false );

	}

    /**
     * Load the calculator according to the subsidiary code
     *
     * @since    1.0.0
     */
    public function finca_calculator(){

		// $this->loader->add_action( 'wp_enqueue_scripts', $this, 'enqueue_styles' );
		// $this->loader->add_action( 'wp_enqueue_scripts', $this, 'enqueue_scripts' );
		require $this->subsidiary . '/data.php';
		require $this->subsidiary . '/finca-calculator-public.php';

    }

}
