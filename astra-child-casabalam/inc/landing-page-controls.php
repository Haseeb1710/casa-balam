<?php
/**
 * Casa Bālam Landing Page Controls
 * 
 * Allows editors to toggle Header and Footer visibility per page
 * to create distraction-free, high-converting performance landing pages.
 * 
 * @package Astra_Child_Casa_Balam
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Meta Box for Page Display Settings
 */
function casa_balam_register_landing_page_meta_box() {
    $screens = array( 'page', 'post', 'product' );
    foreach ( $screens as $screen ) {
        add_meta_box(
            'cb_landing_page_settings',
            esc_html__( 'CASA BĀLAM Page Display Settings', 'astra-child-casabalam' ),
            'casa_balam_render_landing_page_meta_box',
            $screen,
            'side',
            'high'
        );
    }
}
add_action( 'add_meta_boxes', 'casa_balam_register_landing_page_meta_box' );

/**
 * Render Meta Box Controls
 */
function casa_balam_render_landing_page_meta_box( $post ) {
    wp_nonce_field( 'casa_balam_landing_nonce_action', 'casa_balam_landing_nonce' );

    $hide_header = get_post_meta( $post->ID, '_cb_hide_header', true );
    $hide_footer = get_post_meta( $post->ID, '_cb_hide_footer', true );
    ?>
    <div class="cb-meta-options" style="padding: 10px 0;">
        <p style="margin-bottom: 12px;">
            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-weight: 500;">
                <input type="checkbox" name="cb_hide_header" value="1" <?php checked( $hide_header, '1' ); ?> />
                <?php esc_html_e( 'Hide Header (Landing Page Mode)', 'astra-child-casabalam' ); ?>
            </label>
            <span style="display: block; font-size: 11px; color: #666; margin-left: 24px;">
                Removes top navigation, logo, and search bar for focused PPC campaigns.
            </span>
        </p>
        <p style="margin-bottom: 8px;">
            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-weight: 500;">
                <input type="checkbox" name="cb_hide_footer" value="1" <?php checked( $hide_footer, '1' ); ?> />
                <?php esc_html_e( 'Hide Footer (Landing Page Mode)', 'astra-child-casabalam' ); ?>
            </label>
            <span style="display: block; font-size: 11px; color: #666; margin-left: 24px;">
                Suppresses site footer and navigation links for minimal exit points.
            </span>
        </p>
    </div>
    <?php
}

/**
 * Save Meta Box Settings
 */
function casa_balam_save_landing_page_meta( $post_id ) {
    if ( ! isset( $_POST['casa_balam_landing_nonce'] ) || ! wp_verify_nonce( $_POST['casa_balam_landing_nonce'], 'casa_balam_landing_nonce_action' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Save or delete Header hide flag
    if ( isset( $_POST['cb_hide_header'] ) ) {
        update_post_meta( $post_id, '_cb_hide_header', '1' );
    } else {
        delete_post_meta( $post_id, '_cb_hide_header' );
    }

    // Save or delete Footer hide flag
    if ( isset( $_POST['cb_hide_footer'] ) ) {
        update_post_meta( $post_id, '_cb_hide_footer', '1' );
    } else {
        delete_post_meta( $post_id, '_cb_hide_footer' );
    }
}
add_action( 'save_post', 'casa_balam_save_landing_page_meta' );

/**
 * Inject Body Classes when Header or Footer is hidden
 */
function casa_balam_landing_body_classes( $classes ) {
    if ( is_singular() ) {
        $post_id = get_the_ID();
        if ( get_post_meta( $post_id, '_cb_hide_header', true ) === '1' ) {
            $classes[] = 'cb-hide-header';
        }
        if ( get_post_meta( $post_id, '_cb_hide_footer', true ) === '1' ) {
            $classes[] = 'cb-hide-footer';
        }
    }
    return $classes;
}
add_filter( 'body_class', 'casa_balam_landing_body_classes' );

/**
 * Conditionally disable Astra Header and Footer rendering based on post meta
 */
function casa_balam_apply_landing_page_controls() {
    if ( ! is_singular() ) {
        return;
    }

    $post_id = get_the_ID();

    if ( get_post_meta( $post_id, '_cb_hide_header', true ) === '1' ) {
        remove_action( 'astra_header', 'astra_header_markup' );
        add_filter( 'astra_main_header_display', '__return_false' );
    }

    if ( get_post_meta( $post_id, '_cb_hide_footer', true ) === '1' ) {
        remove_action( 'astra_footer', 'astra_footer_markup' );
        add_filter( 'astra_footer_display', '__return_false' );
    }
}
add_action( 'wp', 'casa_balam_apply_landing_page_controls' );
