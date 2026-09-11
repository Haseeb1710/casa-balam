<?php
/**
 * Casa Bālam Header & Navigation System
 * 
 * Milestone 1: Navigation & Landing Controls
 * - Transparent header transitioning to sticky frosted navigation on scroll
 * - Breadcrumbs hierarchy for deep catalog navigation
 * - Header hide controls integration
 * 
 * @package Astra_Child_Casa_Balam
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Casa Bālam Navigation Menus
 */
function casa_balam_register_menus() {
    register_nav_menus( array(
        'casa_balam_primary'   => esc_html__( 'Casa Bālam Primary Menu', 'astra-child-casabalam' ),
        'casa_balam_mobile'    => esc_html__( 'Casa Bālam Mobile Menu', 'astra-child-casabalam' ),
        'casa_balam_footer_nav'=> esc_html__( 'Casa Bālam Footer Policies', 'astra-child-casabalam' ),
    ) );
}
add_action( 'init', 'casa_balam_register_menus' );

/**
 * Render Custom Casa Bālam Header (Hooked into Astra or standalone template)
 */
function casa_balam_render_custom_header() {
    if ( is_singular() && get_post_meta( get_the_ID(), '_cb_hide_header', true ) === '1' ) {
        return;
    }

    $logo_url = get_stylesheet_directory_uri() . '/assets/images/casa-balam-logo.svg';
    $logo_fallback = get_stylesheet_directory_uri() . '/assets/images/casa-balam-logo.png';
    $cart_count = class_exists( 'WooCommerce' ) && WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
    ?>
    <header id="cb-site-header" class="cb-header-wrapper transparent-header" role="banner">
        <!-- Top Announcement Bar -->
        <div class="cb-announcement-bar">
          <div class="cb-container cb-announcement-inner">
            <p>Free Standard Shipping on Contiguous U.S. Orders $100+ &bull; Artisan Made with Love</p>
            <div class="cb-top-socials">
              <a href="https://instagram.com/casabalamboutique" target="_blank" rel="noopener noreferrer" aria-label="Instagram" class="cb-top-social-link">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
              </a>
              <a href="https://facebook.com/casabalamboutique" target="_blank" rel="noopener noreferrer" aria-label="Facebook" class="cb-top-social-link">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
              </a>
            </div>
          </div>
        </div>

        <!-- Main Navigation Bar -->
        <div class="cb-main-header">
            <div class="cb-container cb-header-inner">
                
                <!-- Mobile Menu Hamburger Button -->
                <button type="button" class="cb-mobile-toggle" aria-label="<?php esc_attr_e( 'Toggle Navigation Menu', 'astra-child-casabalam' ); ?>" aria-expanded="false" aria-controls="cb-mobile-nav">
                    <span class="cb-hamburger-bar"></span>
                    <span class="cb-hamburger-bar"></span>
                    <span class="cb-hamburger-bar"></span>
                </button>

                <!-- Brand Logo -->
                <div class="cb-brand-logo">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="cb-logo-link" style="text-decoration: none; border: none;">
                        <img src="<?php echo esc_url( $logo_url ); ?>" onerror="this.onerror=null;this.src='<?php echo esc_url( $logo_fallback ); ?>'" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - Handmade Treasures for Little Souls" class="cb-logo-img" />
                    </a>
                </div>

                <!-- Desktop Primary Navigation -->
                <nav id="cb-primary-nav" class="cb-nav-desktop" aria-label="<?php esc_attr_e( 'Primary Store Navigation', 'astra-child-casabalam' ); ?>">
                    <ul class="cb-menu">
                        <li class="cb-menu-item"><a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>"><?php esc_html_e( 'Shop All', 'astra-child-casabalam' ); ?></a></li>
                        <li class="cb-menu-item cb-has-dropdown">
                            <a href="<?php echo esc_url( home_url( '/product-category/handmade-toys/' ) ); ?>">
                                <?php esc_html_e( 'Handmade Toys', 'astra-child-casabalam' ); ?>
                                <svg class="cb-chevron-down" width="10" height="6" viewBox="0 0 10 6" fill="none"><path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                            <ul class="cb-dropdown-menu">
                                <li><a href="<?php echo esc_url( home_url( '/product-category/handmade-toys/abuelas-toys/' ) ); ?>"><?php esc_html_e( 'Abuela’s Toys (Small, Medium, Large)', 'astra-child-casabalam' ); ?></a></li>
                                <li><a href="<?php echo esc_url( home_url( '/product-category/handmade-toys/dolls/' ) ); ?>"><?php esc_html_e( 'Artisan Dolls', 'astra-child-casabalam' ); ?></a></li>
                                <li><a href="<?php echo esc_url( home_url( '/product-category/handmade-toys/alpaca-collection/' ) ); ?>"><?php esc_html_e( 'Alpaca Collection (Bears, Alpacas, Rabbits, Lions)', 'astra-child-casabalam' ); ?></a></li>
                            </ul>
                        </li>
                        <li class="cb-menu-item cb-has-dropdown">
                            <a href="<?php echo esc_url( home_url( '/product-category/childrens-clothing/' ) ); ?>">
                                <?php esc_html_e( 'Children’s Clothing', 'astra-child-casabalam' ); ?>
                                <svg class="cb-chevron-down" width="10" height="6" viewBox="0 0 10 6" fill="none"><path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                            <ul class="cb-dropdown-menu">
                                <li><a href="<?php echo esc_url( home_url( '/product-category/childrens-clothing/girls-dresses/' ) ); ?>"><?php esc_html_e( 'Girls’ Dresses (Ballerina, Embroidered, Tulum)', 'astra-child-casabalam' ); ?></a></li>
                                <li><a href="<?php echo esc_url( home_url( '/product-category/childrens-clothing/boys-shirts-sets/' ) ); ?>"><?php esc_html_e( 'Boys’ Shirts & Sets (Linen, Tulum, Havana)', 'astra-child-casabalam' ); ?></a></li>
                                <li><a href="<?php echo esc_url( home_url( '/product-category/childrens-clothing/swimwear/' ) ); ?>"><?php esc_html_e( 'Swimwear', 'astra-child-casabalam' ); ?></a></li>
                            </ul>
                        </li>
                        <li class="cb-menu-item"><a href="<?php echo esc_url( home_url( '/product-category/accessories/' ) ); ?>"><?php esc_html_e( 'Accessories', 'astra-child-casabalam' ); ?></a></li>
                        <li class="cb-menu-item"><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'Our Story', 'astra-child-casabalam' ); ?></a></li>
                        <li class="cb-menu-item"><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'astra-child-casabalam' ); ?></a></li>
                    </ul>
                </nav>

                <!-- Header Actions (Search, Account, Cart Drawer Trigger) -->
                <div class="cb-header-actions">
                    <button type="button" class="cb-action-btn cb-search-trigger" aria-label="<?php esc_attr_e( 'Search Products', 'astra-child-casabalam' ); ?>">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </button>

                    <a href="<?php echo esc_url( class_exists( 'WooCommerce' ) ? wc_get_page_permalink( 'myaccount' ) : home_url( '/my-account/' ) ); ?>" class="cb-action-btn cb-account-link" aria-label="<?php esc_attr_e( 'My Account', 'astra-child-casabalam' ); ?>">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </a>

                    <button type="button" class="cb-action-btn cb-cart-trigger" id="cb-cart-drawer-toggle" aria-label="<?php esc_attr_e( 'View Shopping Bag', 'astra-child-casabalam' ); ?>">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <path d="M16 10a4 4 0 0 1-8 0"></path>
                        </svg>
                        <span class="cb-cart-count" id="cb-cart-count"><?php echo esc_html( $cart_count ); ?></span>
                    </button>
                </div>

            </div>
        </div>

        <!-- Mobile Drawer Navigation -->
        <div id="cb-mobile-nav" class="cb-mobile-drawer" aria-hidden="true">
            <div class="cb-drawer-header">
                <img src="<?php echo esc_url( $logo_url ); ?>" onerror="this.onerror=null;this.src='<?php echo esc_url( $logo_fallback ); ?>'" alt="Casa Bālam" class="cb-drawer-logo" />
                <button type="button" class="cb-drawer-close" aria-label="<?php esc_attr_e( 'Close Navigation', 'astra-child-casabalam' ); ?>">&times;</button>
            </div>
            <ul class="cb-mobile-menu">
                <li><a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>"><?php esc_html_e( 'Shop All', 'astra-child-casabalam' ); ?></a></li>
                <li class="cb-mobile-has-sub">
                    <a href="<?php echo esc_url( home_url( '/product-category/handmade-toys/' ) ); ?>"><?php esc_html_e( 'Handmade Toys', 'astra-child-casabalam' ); ?></a>
                    <ul class="cb-mobile-submenu">
                        <li><a href="<?php echo esc_url( home_url( '/product-category/handmade-toys/abuelas-toys/' ) ); ?>"><?php esc_html_e( 'Abuela’s Toys', 'astra-child-casabalam' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/product-category/handmade-toys/dolls/' ) ); ?>"><?php esc_html_e( 'Dolls', 'astra-child-casabalam' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/product-category/handmade-toys/alpaca-collection/' ) ); ?>"><?php esc_html_e( 'Alpaca Collection', 'astra-child-casabalam' ); ?></a></li>
                    </ul>
                </li>
                <li class="cb-mobile-has-sub">
                    <a href="<?php echo esc_url( home_url( '/product-category/childrens-clothing/' ) ); ?>"><?php esc_html_e( 'Children’s Clothing', 'astra-child-casabalam' ); ?></a>
                    <ul class="cb-mobile-submenu">
                        <li><a href="<?php echo esc_url( home_url( '/product-category/childrens-clothing/girls-dresses/' ) ); ?>"><?php esc_html_e( 'Girls’ Dresses', 'astra-child-casabalam' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/product-category/childrens-clothing/boys-shirts-sets/' ) ); ?>"><?php esc_html_e( 'Boys’ Shirts & Sets', 'astra-child-casabalam' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/product-category/childrens-clothing/swimwear/' ) ); ?>"><?php esc_html_e( 'Swimwear', 'astra-child-casabalam' ); ?></a></li>
                    </ul>
                </li>
                <li><a href="<?php echo esc_url( home_url( '/product-category/accessories/' ) ); ?>"><?php esc_html_e( 'Accessories', 'astra-child-casabalam' ); ?></a></li>
                <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About Casa Bālam', 'astra-child-casabalam' ); ?></a></li>
                <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact Us', 'astra-child-casabalam' ); ?></a></li>
            </ul>
            <div class="cb-drawer-socials">
              <a href="https://instagram.com/casabalamboutique" target="_blank" rel="noopener noreferrer" class="cb-drawer-social-link" aria-label="Instagram">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                <span>Instagram</span>
              </a>
              <a href="https://facebook.com/casabalamboutique" target="_blank" rel="noopener noreferrer" class="cb-drawer-social-link" aria-label="Facebook">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                <span>Facebook</span>
              </a>
            </div>
        </div>
        <div class="cb-backdrop" id="cb-nav-backdrop"></div>
    </header>
    <?php
}
remove_action( 'astra_header', 'astra_header_markup' );
add_action( 'astra_header', 'casa_balam_render_custom_header' );

/**
 * Deep Breadcrumbs Hierarchy Implementation
 */
function casa_balam_render_breadcrumbs() {
    if ( is_front_page() || ( is_singular() && get_post_meta( get_the_ID(), '_cb_hide_header', true ) === '1' ) ) {
        return;
    }

    echo '<div class="cb-breadcrumbs-wrapper"><div class="cb-container">';
    if ( function_exists( 'woocommerce_breadcrumb' ) ) {
        $args = array(
            'delimiter'   => '<span class="cb-breadcrumb-sep">&rsaquo;</span>',
            'wrap_before' => '<nav class="cb-breadcrumbs" aria-label="' . esc_attr__( 'Breadcrumb Navigation', 'astra-child-casabalam' ) . '">',
            'wrap_after'  => '</nav>',
            'before'      => '<span class="cb-breadcrumb-item">',
            'after'       => '</span>',
            'home'        => _x( 'Home', 'breadcrumb', 'astra-child-casabalam' ),
        );
        woocommerce_breadcrumb( $args );
    } else {
        echo '<nav class="cb-breadcrumbs">';
        echo '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'astra-child-casabalam' ) . '</a>';
        echo '<span class="cb-breadcrumb-sep">&rsaquo;</span>';
        if ( is_page() ) {
            echo '<span class="cb-breadcrumb-current">' . esc_html( get_the_title() ) . '</span>';
        }
        echo '</nav>';
    }
    echo '</div></div>';
}
add_action( 'astra_content_before', 'casa_balam_render_breadcrumbs', 15 );
