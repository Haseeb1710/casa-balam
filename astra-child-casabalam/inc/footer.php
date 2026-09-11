<?php
/**
 * Casa Bālam Custom Branded Footer
 * 
 * Milestone 1: Custom Footer Architecture
 * - Location: Miami, Florida
 * - Email: info@casabalam.net
 * - Phone: 239-285-3388
 * - Instagram: @casabalamboutique
 * - Facebook: CASA BALAM Boutique
 * - Links: Contact, Shipping Policy, Return and Exchange Policy, Privacy Policy, Terms and Conditions
 * - Dynamic copyright with current year
 * - Integration with performance landing page controls
 * 
 * @package Astra_Child_Casa_Balam
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Render Custom Casa Bālam Footer
 */
function casa_balam_render_custom_footer() {
    // Check if footer is suppressed via landing page controls
    if ( is_singular() && get_post_meta( get_the_ID(), '_cb_hide_footer', true ) === '1' ) {
        return;
    }

    $logo_url = get_stylesheet_directory_uri() . '/assets/images/casa-balam-logo.svg';
    $logo_fallback = get_stylesheet_directory_uri() . '/assets/images/casa-balam-logo.png';
    $current_year = date( 'Y' );
    ?>
    <footer id="cb-site-footer" class="cb-site-footer" role="contentinfo">
        <div class="cb-container">
            <div class="cb-footer-top">
                
                <!-- Column 1: Brand Story & Heritage -->
                <div class="cb-footer-col cb-footer-brand">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="cb-footer-logo-link" style="text-decoration: none; border: none;">
                        <img src="<?php echo esc_url( $logo_url ); ?>" onerror="this.onerror=null;this.src='<?php echo esc_url( $logo_fallback ); ?>'" alt="Casa Bālam" class="cb-footer-logo" />
                    </a>
                    <p class="cb-footer-tagline">
                        <?php esc_html_e( 'Handmade treasures for little souls. Born from a grandmother’s love, celebrating cultural heritage, artisan craftsmanship, and the beauty of small-batch keepsakes.', 'astra-child-casabalam' ); ?>
                    </p>
                    <div class="cb-footer-social">
                        <!-- Instagram Button -->
                        <a href="https://instagram.com/casabalamboutique" target="_blank" rel="noopener noreferrer" class="cb-social-icon cb-social-instagram" aria-label="Follow Casa Bālam on Instagram">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>
                            <span>@casabalamboutique</span>
                        </a>

                        <!-- Facebook Button -->
                        <a href="https://facebook.com/casabalamboutique" target="_blank" rel="noopener noreferrer" class="cb-social-icon cb-social-facebook" aria-label="Follow CASA BALAM Boutique on Facebook">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                            </svg>
                            <span>Facebook</span>
                        </a>
                    </div>
                </div>

                <!-- Column 2: Explore Collections -->
                <div class="cb-footer-col cb-footer-nav-col">
                    <h3 class="cb-footer-heading"><?php esc_html_e( 'Collections', 'astra-child-casabalam' ); ?></h3>
                    <ul class="cb-footer-links">
                        <li><a href="<?php echo esc_url( home_url( '/product-category/handmade-toys/' ) ); ?>"><?php esc_html_e( 'Handmade Toys', 'astra-child-casabalam' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/product-category/handmade-toys/abuelas-toys/' ) ); ?>"><?php esc_html_e( 'Abuela’s Toys', 'astra-child-casabalam' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/product-category/handmade-toys/alpaca-collection/' ) ); ?>"><?php esc_html_e( 'Alpaca Collection', 'astra-child-casabalam' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/product-category/childrens-clothing/' ) ); ?>"><?php esc_html_e( 'Children’s Clothing', 'astra-child-casabalam' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/product-category/accessories/' ) ); ?>"><?php esc_html_e( 'Artisan Accessories', 'astra-child-casabalam' ); ?></a></li>
                    </ul>
                </div>

                <!-- Column 3: Customer Care & Policies -->
                <div class="cb-footer-col cb-footer-nav-col">
                    <h3 class="cb-footer-heading"><?php esc_html_e( 'Customer Care', 'astra-child-casabalam' ); ?></h3>
                    <ul class="cb-footer-links">
                        <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About Casa Bālam', 'astra-child-casabalam' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact Us', 'astra-child-casabalam' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/shipping-policy/' ) ); ?>"><?php esc_html_e( 'Shipping Policy', 'astra-child-casabalam' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/return-and-exchange-policy/' ) ); ?>"><?php esc_html_e( 'Return and Exchange Policy', 'astra-child-casabalam' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'astra-child-casabalam' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/terms-and-conditions/' ) ); ?>"><?php esc_html_e( 'Terms and Conditions', 'astra-child-casabalam' ); ?></a></li>
                    </ul>
                </div>

                <!-- Column 4: Location & Direct Contact -->
                <div class="cb-footer-col cb-footer-contact">
                    <h3 class="cb-footer-heading"><?php esc_html_e( 'Get in Touch', 'astra-child-casabalam' ); ?></h3>
                    <ul class="cb-contact-list">
                        <li class="cb-contact-item">
                            <span class="cb-contact-label"><?php esc_html_e( 'Location:', 'astra-child-casabalam' ); ?></span>
                            <span class="cb-contact-val"><?php esc_html_e( 'Miami, Florida', 'astra-child-casabalam' ); ?></span>
                        </li>
                        <li class="cb-contact-item">
                            <span class="cb-contact-label"><?php esc_html_e( 'Email:', 'astra-child-casabalam' ); ?></span>
                            <a href="mailto:info@casabalam.net" class="cb-contact-val">info@casabalam.net</a>
                        </li>
                        <li class="cb-contact-item">
                            <span class="cb-contact-label"><?php esc_html_e( 'Phone:', 'astra-child-casabalam' ); ?></span>
                            <a href="tel:+12392853388" class="cb-contact-val">239-285-3388</a>
                        </li>
                        <li class="cb-contact-item cb-hours-note">
                            <span class="cb-subtext"><?php esc_html_e( 'We typically respond within 1–2 business days, excluding weekends & holidays.', 'astra-child-casabalam' ); ?></span>
                        </li>
                    </ul>
                </div>

            </div>

            <!-- Footer Bottom / Copyright -->
            <div class="cb-footer-bottom">
                <div class="cb-copyright">
                    <p>&copy; <?php echo esc_html( $current_year ); ?> <?php esc_html_e( 'Casa Bālam. All rights reserved.', 'astra-child-casabalam' ); ?></p>
                </div>
                <div class="cb-footer-disclaimer">
                    <p><?php esc_html_e( 'Handmade in small batches with non-toxic, natural materials.', 'astra-child-casabalam' ); ?></p>
                </div>
            </div>
        </div>
    </footer>
    <?php
}
remove_action( 'astra_footer', 'astra_footer_markup' );
add_action( 'astra_footer', 'casa_balam_render_custom_footer' );
