# CASA BĀLAM — Online Storefront & System Integration

> **Artisan Handmade Treasures for Little Souls**  
> Family-owned boutique inspired by a grandmother's love, based in Miami, Florida.  
> Official Domain: [casabalam.net](https://casabalam.net)

---

## 🌟 Milestone 1: Core Architecture, Settings & Design Tokens

This repository contains the complete codebase for **Milestone 1** of the CASA BĀLAM e-commerce rebuild:
1. **Bespoke Astra Child Theme** (`astra-child-casabalam/`) ready for production installation on Hostinger WordPress & WooCommerce.
2. **One-Click Theme Package** (`astra-child-casabalam.zip`).
3. **Interactive Storefront Preview Application** (`index.html`, `preview.css`, `preview.js`).
4. **Configuration & Deployment Guides** (`docs/`).

---

## 🎨 Visual & Technical Specifications

- **Brand Palette Tokens**:
  - `Warm Bone`: `#F7F2EA`
  - `Soft Ivory`: `#FFFDF9`
  - `Sand Beige`: `#E8DED1`
  - `Blush Ivory`: `#F8F1EC`
  - `Dusty Blush`: `#DEC8C3`
  - `Powder Blue`: `#E3EFF2` (Top Announcement Bar)
  - `Terracotta`: `#D8B8B4`
  - `Deep Cocoa`: `#3B302B` (Typography & Icons)
  - `Soft Pastel Pink`: `#F5E3E6` (Badges, Tags, Pills, and Popups)
- **Typography**: Google Font **Montserrat** (300 Headings, 400 Body, 500 Actions).
- **Navigation**: Transparent-to-sticky navigation with 40px glassmorphism blur and social action links (Instagram & Facebook).
- **Footer**: Custom branded footer with Miami, Florida location, social links, and seamlessly repeating artisan toy background pattern with soft gradient edge feathering.
- **WooCommerce Core Setup**:
  - Currency: USD (`$`)
  - Weight & Dimensions: `lbs`, `in`
  - Timezone: Eastern Time (`America/New_York`)
  - Selling/Shipping: Restricted to Contiguous United States
  - Address Privacy: Residential address kept private; frontend template filters display "Miami, Florida".
- **Performance Landing Page Controls**: Dynamic controls to suppress header and footer on PPC landing pages.

---

## 📂 Repository Structure

```
casa-balam/
├── astra-child-casabalam/          # Production WordPress Astra Child Theme
│   ├── assets/
│   │   ├── css/
│   │   │   ├── casa-balam-header-nav.css
│   │   │   └── casa-balam-footer.css
│   │   └── images/
│   │       ├── casa-balam-logo.svg
│   │       ├── casa-balam-icon.svg
│   │       └── casa-balam-footer-pattern.png
│   ├── inc/
│   │   ├── woocommerce-setup.php
│   │   ├── header-navigation.php
│   │   ├── footer.php
│   │   └── landing-page-controls.php
│   ├── functions.php
│   └── style.css
├── astra-child-casabalam.zip       # Deployable theme archive for WordPress upload
├── docs/                           # Documentation & Configuration Guides
│   └── MILESTONE_1_DEPLOYMENT_GUIDE.md
├── index.html                      # Interactive Storefront Preview
├── preview.css
├── preview.js
├── images/
├── vercel.json                     # Vercel deployment configuration
└── README.md
```

---

## 🚀 Live Demo & Deployment

- **Live Storefront Preview**: [https://haseeb1710.github.io/casa-balam/](https://haseeb1710.github.io/casa-balam/)
- **GitHub Repository**: [https://github.com/Haseeb1710/casa-balam](https://github.com/Haseeb1710/casa-balam)

### Deploy to Vercel in 1 Click:
[![Deploy with Vercel](https://vercel.com/button)](https://vercel.com/new/clone?repository-url=https://github.com/Haseeb1710/casa-balam)

Or via Vercel Dashboard:
1. Navigate to [vercel.com/new](https://vercel.com/new)
2. Import `Haseeb1710/casa-balam`
3. Click **Deploy** (zero configuration needed)

---

## 📜 Next Milestone: Milestone 2 Preview

- **Front-End UI/UX, Conversion Engine & Category Architecture** ($200):
  - Category page builds: *Handmade Toys*, *Abuela's Toys*, *Alpaca Collection*, *Children's Clothing*, *Artisan Accessories*.
  - Hero slider with promotional banner system.
  - Featured products grid with fast-loading card micro-interactions.
  - Cart drawer and conversion-optimized checkout flow.

---
© 2026 CASA BĀLAM. All rights reserved.
