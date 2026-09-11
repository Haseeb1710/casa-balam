<?php
/**
 * Casa Bālam WooCommerce Core Architecture & Base Settings
 * 
 * Milestone 1: Base Configuration
 * - Base Location: Miami, Florida, United States
 * - Currency: USD ($)
 * - Language: en_US, Timezone: America/New_York (Eastern Time)
 * - Units: Weight = lbs, Dimensions = in
 * - Selling/Shipping: Contiguous US only (excluding AK, HI, territories initially)
 * - Privacy: Official address reserved strictly for backend tax/shipping calculations.
 * 
 * @package Astra_Child_Casa_Balam
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Configure default WooCommerce settings on theme activation or setup
 */
function casa_balam_configure_woocommerce_defaults() {
    if ( ! class_exists( 'WooCommerce' ) ) {
        return;
    }

    // Base Location: Miami, Florida, US
    update_option( 'woocommerce_default_country', 'US:FL' );
    
    // Store Currency Settings
    update_option( 'woocommerce_currency', 'USD' );
    update_option( 'woocommerce_currency_pos', 'left' );
    update_option( 'woocommerce_price_thousand_sep', ',' );
    update_option( 'woocommerce_price_decimal_sep', '.' );
    update_option( 'woocommerce_price_num_decimals', 2 );

    // Dimension and Weight Units
    update_option( 'woocommerce_weight_unit', 'lbs' );
    update_option( 'woocommerce_dimension_unit', 'in' );

    // Selling & Shipping restrictions: Contiguous US only initially
    update_option( 'woocommerce_allowed_countries', 'specific' );
    update_option( 'woocommerce_specific_allowed_countries', array( 'US' ) );
    update_option( 'woocommerce_ship_to_countries', 'specific' );
    update_option( 'woocommerce_specific_ship_to_countries', array( 'US' ) );

    // Tax calculation base: Customer shipping address (destination-based for FL counties)
    update_option( 'woocommerce_calc_taxes', 'yes' );
    update_option( 'woocommerce_prices_include_tax', 'no' ); // Product prices entered and displayed excluding tax
    update_option( 'woocommerce_tax_based_on', 'shipping' );
    update_option( 'woocommerce_tax_display_shop', 'excl' );
    update_option( 'woocommerce_tax_display_cart', 'excl' );
    update_option( 'woocommerce_tax_total_display', 'itemized' );

    // Ensure site timezone is Eastern Time
    if ( get_option( 'timezone_string' ) !== 'America/New_York' ) {
        update_option( 'timezone_string', 'America/New_York' );
    }
}
add_action( 'after_switch_theme', 'casa_balam_configure_woocommerce_defaults' );

/**
 * Filter shipping states to Contiguous US only (disallow AK, HI, PR, territories at checkout)
 */
function casa_balam_restrict_to_contiguous_us( $states ) {
    if ( isset( $states['US'] ) ) {
        // Disallowed non-contiguous states/territories for initial launch
        $disallowed = array( 'AK', 'HI', 'PR', 'VI', 'GU', 'AS', 'MP', 'AA', 'AE', 'AP' );
        foreach ( $disallowed as $code ) {
            unset( $states['US'][ $code ] );
        }
    }
    return $states;
}
add_filter( 'woocommerce_states', 'casa_balam_restrict_to_contiguous_us', 20, 1 );

/**
 * Address Privacy Guard:
 * Strictly prevents the official private store address from appearing on public frontend views.
 * Public brand location displays as "Miami, Florida".
 */
function casa_balam_filter_public_store_address( $address_html ) {
    // If we're on the public frontend (not admin or private order processing)
    if ( ! is_admin() && ! is_account_page() ) {
        return esc_html__( 'Miami, Florida', 'astra-child-casabalam' );
    }
    return $address_html;
}
add_filter( 'woocommerce_store_address_display', 'casa_balam_filter_public_store_address' );

/**
 * Hide raw street address in public schema / microdata to protect residential privacy
 */
function casa_balam_filter_structured_data_address( $markup ) {
    if ( isset( $markup['address'] ) ) {
        $markup['address'] = array(
            '@type'           => 'PostalAddress',
            'addressLocality' => 'Miami',
            'addressRegion'   => 'FL',
            'addressCountry'  => 'US',
        );
    }
    return $markup;
}
add_filter( 'woocommerce_structured_data_organization', 'casa_balam_filter_structured_data_address', 20, 1 );

/**
 * Custom Notice for Contiguous US Shipping Restriction
 */
function casa_balam_contiguous_us_checkout_validation() {
    if ( ! is_checkout() ) {
        return;
    }

    $shipping_state = WC()->customer ? WC()->customer->get_shipping_state() : '';
    $non_contiguous = array( 'AK', 'HI', 'PR', 'VI', 'GU', 'AS', 'MP' );

    if ( in_array( $shipping_state, $non_contiguous, true ) ) {
        wc_add_notice( 
            esc_html__( 'Casa Bālam currently ships exclusively to the Contiguous 48 United States. For orders to Alaska, Hawaii, or US Territories, please contact info@casabalam.net for custom shipping arrangements.', 'astra-child-casabalam' ), 
            'error' 
        );
    }
}
add_action( 'woocommerce_checkout_process', 'casa_balam_contiguous_us_checkout_validation' );
