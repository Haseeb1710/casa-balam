<?php
/**
 * Astra Child - Casa Bālam Theme Functions
 *
 * @package Astra_Child_Casa_Balam
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'CASA_BALAM_VERSION', '1.0.0' );
define( 'CASA_BALAM_DIR', get_stylesheet_directory() );
define( 'CASA_BALAM_URI', get_stylesheet_directory_uri() );

/**
 * Enqueue Styles and Scripts
 */
function casa_balam_enqueue_scripts() {
    // 1. Google Fonts: Montserrat (300 Light, 400 Regular, 500 Medium)
    wp_enqueue_style(
        'casa-balam-google-fonts',
        'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;1,300;1,400&display=swap',
        array(),
        null
    );

    // 2. Parent Astra Theme Style
    wp_enqueue_style(
        'astra-parent-theme-css',
        get_template_directory_uri() . '/style.css',
        array(),
        CASA_BALAM_VERSION
    );

    // 3. Child Theme Style (Brand Tokens & Global Typography)
    wp_enqueue_style(
        'casa-balam-child-style',
        get_stylesheet_uri(),
        array( 'astra-parent-theme-css', 'casa-balam-google-fonts' ),
        CASA_BALAM_VERSION
    );

    // 4. Header & Navigation Stylesheet
    wp_enqueue_style(
        'casa-balam-header-nav',
        CASA_BALAM_URI . '/assets/css/casa-balam-header-nav.css',
        array( 'casa-balam-child-style' ),
        CASA_BALAM_VERSION
    );

    // 5. Custom Footer Stylesheet
    wp_enqueue_style(
        'casa-balam-footer',
        CASA_BALAM_URI . '/assets/css/casa-balam-footer.css',
        array( 'casa-balam-child-style' ),
        CASA_BALAM_VERSION
    );

    // 6. Navigation & Sticky Header Behavior JS
    wp_enqueue_script(
        'casa-balam-nav-js',
        CASA_BALAM_URI . '/assets/js/casa-balam-navigation.js',
        array( 'jquery' ),
        CASA_BALAM_VERSION,
        true
    );

    // Pass localized data to JavaScript
    wp_localize_script( 'casa-balam-nav-js', 'casaBalamData', array(
        'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
        'siteUrl'   => home_url( '/' ),
        'cartCount' => class_exists( 'WooCommerce' ) && WC()->cart ? WC()->cart->get_cart_contents_count() : 0,
    ) );
}
add_action( 'wp_enqueue_scripts', 'casa_balam_enqueue_scripts', 15 );

/**
 * Load Modular Architecture Includes
 */
require_once CASA_BALAM_DIR . '/inc/woocommerce-setup.php';
require_once CASA_BALAM_DIR . '/inc/landing-page-controls.php';
require_once CASA_BALAM_DIR . '/inc/header-navigation.php';
require_once CASA_BALAM_DIR . '/inc/footer.php';

/**
 * Declare WooCommerce & Theme Features Support
 */
function casa_balam_theme_setup() {
    add_theme_support( 'woocommerce', array(
        'thumbnail_image_width' => 600,
        'single_image_width'    => 1000,
        'product_grid'          => array(
            'default_rows'    => 3,
            'min_rows'        => 1,
            'max_rows'        => 6,
            'default_columns' => 4,
            'min_columns'     => 2,
            'max_columns'     => 4,
        ),
    ) );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'casa_balam_theme_setup' );
