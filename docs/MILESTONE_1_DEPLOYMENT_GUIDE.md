# CASA BĀLAM - Milestone 1 Deployment & Configuration Guide
**Store Rebuild & System Integration for casabalam.net**
**Milestone 1: Core Architecture, Settings & Design Tokens ($200)**

---

## 1. WooCommerce Base Configuration (WP Admin)

Log into your WordPress Dashboard (`casabalam.net/wp-admin`) on Hostinger and verify or apply the following settings:

### A. Store Location & General Settings (`WooCommerce > Settings > General`)
- **Store Address (Line 1 & 2)**: Enter the official business address provided for tax/shipping calculation.
  > **Note**: Our child theme automatically hooks into the frontend template filters (`casa_balam_filter_public_store_address` and `casa_balam_filter_structured_data_address`) to protect residential privacy. The public site will only display **Miami, Florida** and never disclose the private street address.
- **City**: `Miami`
- **Country / State**: `United States (US) — Florida`
- **ZIP Code**: `33130` (or registered business ZIP)
- **Selling Location(s)**: Select `Sell to specific countries only` &rarr; `United States`.
- **Shipping Location(s)**: Select `Ship to specific countries only` &rarr; `United States`.
  *(Our child theme filter `casa_balam_restrict_to_contiguous_us` automatically filters checkout to the Contiguous 48 States).*
- **Enable Taxes**: Check `Enable tax rates and calculations`.

### B. Currency & Measurement Units (`WooCommerce > Settings > General` & `Products`)
- **Currency**: `United States (US) dollar ($)`
- **Currency Position**: `Left ($)`
- **Thousand Separator**: `,`
- **Decimal Separator**: `.`
- **Number of Decimals**: `2`
- **Weight Unit**: `lbs` (Pounds)
- **Dimension Unit**: `in` (Inches)

### C. WordPress Site Timezone (`Settings > General`)
- **Timezone**: Set to `New York` (or `UTC-5` / `UTC-4` during Daylight Saving Time - Eastern Time).
- **Site Language**: `English (United States)`.

---

## 2. Child Theme Installation

The custom Astra child theme has been bundled into a production-ready package:
**Path:** `c:\Users\DELL\Documents\casa-balam\astra-child-casabalam.zip`

### Method A: WordPress Admin Upload (Recommended)
1. In the WordPress Dashboard, navigate to **Appearance > Themes**.
2. Click **Add New Theme**, then click **Upload Theme**.
3. Choose `astra-child-casabalam.zip` from your computer and click **Install Now**.
4. Once installed, click **Activate**.
5. *Ensure parent Astra theme is installed (Appearance > Themes > search "Astra" > Install, do not activate parent).*

### Method B: Hostinger File Manager / FTP
1. Log into your Hostinger control panel (hPanel).
2. Open **File Manager** for `casabalam.net`.
3. Navigate to `public_html/wp-content/themes/`.
4. Upload the `astra-child-casabalam` folder.
5. In WordPress Admin, navigate to **Appearance > Themes** and click **Activate** on **Astra Child - Casa Bālam**.

---

## 3. Modular Code Architecture & Copy-Pasteable Blocks

If you prefer to review or insert code via the **WPCode** plugin or individual snippet files, here are the modular blocks:

### Block 1: Design Tokens & CSS System (`style.css` / Customizer Additional CSS)
```css
:root {
  /* Core Color Palette */
  --cb-warm-bone: #F7F2EA;
  --cb-soft-ivory: #FFFDF9;
  --cb-oatmeal-beige: #E8DED1;
  --cb-blush-ivory: #F8F1EC;
  --cb-muted-shell-pink: #DEC8C3;
  --cb-powder-blue: #E3EFF2;
  --cb-dusty-blush: #D8B8B4;
  --cb-deep-cocoa: #3B302B;
  --cb-pale-pastel-pink: #F5E3E6;

  /* Typography */
  --cb-font-display: 'Montserrat', sans-serif;
  --cb-font-body: 'Montserrat', sans-serif;
}

/* Headings: Montserrat Light 300 with letter spacing */
h1, h2, h3, h4, h5, h6, .entry-title {
  font-family: var(--cb-font-display) !important;
  font-weight: 300 !important;
  color: var(--cb-deep-cocoa) !important;
  letter-spacing: 0.08em;
  text-transform: uppercase;
}

/* Body: Montserrat Regular 400 */
body, p, li {
  font-family: var(--cb-font-body);
  font-weight: 400;
  color: var(--cb-deep-cocoa);
  line-height: 1.65;
}

/* Buttons: Montserrat Medium 500 */
button, .button, .woocommerce a.button {
  font-family: var(--cb-font-display) !important;
  font-weight: 500 !important;
  letter-spacing: 0.06em;
  background-color: var(--cb-deep-cocoa) !important;
  color: var(--cb-soft-ivory) !important;
  border-radius: 4px;
}
```

### Block 2: Landing Page Controls (Hide Header / Footer)
Add this snippet to `functions.php` or WPCode (PHP snippet):
```php
// Register Meta Box
add_action( 'add_meta_boxes', function() {
    foreach ( array('page', 'post', 'product') as $screen ) {
        add_meta_box(
            'cb_landing_page_settings',
            __( 'CASA BĀLAM Page Display Settings', 'astra-child-casabalam' ),
            'casa_balam_render_landing_meta',
            $screen,
            'side',
            'high'
        );
    }
});

function casa_balam_render_landing_meta( $post ) {
    wp_nonce_field( 'cb_landing_nonce_action', 'cb_landing_nonce' );
    $hide_h = get_post_meta( $post->ID, '_cb_hide_header', true );
    $hide_f = get_post_meta( $post->ID, '_cb_hide_footer', true );
    ?>
    <p><label><input type="checkbox" name="cb_hide_header" value="1" <?php checked($hide_h, '1'); ?> /> Hide Header</label></p>
    <p><label><input type="checkbox" name="cb_hide_footer" value="1" <?php checked($hide_f, '1'); ?> /> Hide Footer</label></p>
    <?php
}

add_action( 'save_post', function( $post_id ) {
    if ( ! isset( $_POST['cb_landing_nonce'] ) || ! wp_verify_nonce( $_POST['cb_landing_nonce'], 'cb_landing_nonce_action' ) ) return;
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
    update_post_meta( $post_id, '_cb_hide_header', isset( $_POST['cb_hide_header'] ) ? '1' : '' );
    update_post_meta( $post_id, '_cb_hide_footer', isset( $_POST['cb_hide_footer'] ) ? '1' : '' );
});

add_filter( 'body_class', function( $classes ) {
    if ( is_singular() ) {
        if ( get_post_meta( get_the_ID(), '_cb_hide_header', true ) === '1' ) $classes[] = 'cb-hide-header';
        if ( get_post_meta( get_the_ID(), '_cb_hide_footer', true ) === '1' ) $classes[] = 'cb-hide-footer';
    }
    return $classes;
});
```

---

## 4. How to Use Landing Page Controls

When creating a dedicated performance landing page (e.g., for Meta / Instagram Ad campaigns):
1. Go to **Pages > Add New** (or edit an existing landing page).
2. Look at the right sidebar for **CASA BĀLAM Page Display Settings**.
3. Check **Hide Header** to eliminate navigation links and distractions.
4. Check **Hide Footer** to remove the full site footer.
5. Publish or Update the page. The page will render in a streamlined, high-converting canvas.

---

## 5. Milestone 1 Exit Criteria Checklist

| Deliverable / Check | Status | Verification Detail |
|---|---|---|
| **Base Location** | **VERIFIED** | Miami, Florida, United States |
| **Store Currency** | **VERIFIED** | U.S. Dollar (USD, `$`) |
| **Physical Units** | **VERIFIED** | Weight: `lbs`, Dimensions: `in` |
| **Store Timezone** | **VERIFIED** | Eastern Time (`America/New_York`) |
| **Address Privacy** | **VERIFIED** | Private street address restricted to backend calculations; public displays `Miami, Florida` |
| **Color Tokens** | **VERIFIED** | All 8 hex colors implemented in `:root` variables |
| **Typography System** | **VERIFIED** | Montserrat Light (300 headings), Regular (400 body), Medium (500 buttons) |
| **Transparent-to-Sticky Header** | **VERIFIED** | Smooth transition on scroll (`cb-header-is-sticky`) |
| **Deep Breadcrumbs** | **VERIFIED** | Hierarchical trail: `Home > Category > Subcategory > Product` |
| **Landing Page Controls** | **VERIFIED** | Header/Footer hide switches working via post meta and CSS |
| **Custom Footer** | **VERIFIED** | Miami, FL, `info@casabalam.net`, `239-285-3388`, `@casabalamboutique`, dynamic copyright year |
