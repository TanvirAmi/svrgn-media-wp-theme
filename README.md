# SVRGN Media — WordPress Theme

A custom WordPress theme for SVRGN Media, a boutique creative-performance
studio for growth-stage ecommerce brands. Converted from a 5-page static
HTML site into a fully widget-driven, CPT-backed WordPress theme.

- **Version:** 1.0.0
- **Requires:** WordPress 6.0+, PHP 7.4+
- **Optional plugin:** [Contact Form 7](https://wordpress.org/plugins/contact-form-7/) (Contact page can use either the built-in form or CF7)

---

## Install

1. Zip the `svrgn-media/` folder (if it isn't already) and upload it via
   **Appearance → Themes → Add New → Upload Theme**, or drop the folder
   into `wp-content/themes/` directly.
2. Activate **SVRGN Media**.
3. Create the pages listed under [Pages you need to create](#pages-you-need-to-create) below.
4. Set a **Primary Navigation** menu under **Appearance → Menus** (optional — a sensible fallback nav is built in if you skip this).
5. Everything else (widgets, Customizer settings) has working defaults out of the box — the site looks complete before you touch anything.

---

## Pages you need to create

| Page | Slug | Or select this template instead |
|---|---|---|
| Homepage | — | Set as **Settings → Reading → homepage** (uses `front-page.php` automatically) |
| About | `about` | Page Attributes → Template → **About** |
| Contact | `contact` | Page Attributes → Template → **Contact** |
| Case Studies listing | any | Page Attributes → Template → **Case Studies** |
| Services listing | any | Page Attributes → Template → **Services** |
| Projects listing | `projects` (recommended) | Page Attributes → Template → **Projects** |

Slug-matching and template-selection both work and stay in sync — use
whichever fits your workflow. If a page has neither, it falls back to a
generic layout (`page.php`).

---

## Custom Post Types

### Case Studies (`case_study`)
Powers the `/case-studies/` listing page and the Results & Impact section
on the homepage.

- **Tag** (meta box) — small pill above the title, e.g. "Creative — Paid Media"
- **Result headline** (meta box) — the punchy one-liner used on the homepage's Results highlight cards, e.g. "10x blended ROAS across Meta" (falls back to a trimmed excerpt if left blank)
- **Excerpt** — card description
- **Featured Image** — card thumbnail
- **Page Attributes → Order** — display order (lower = first)

### Services (`service`)
Powers the `/services/` listing page.

- **Tag**, **Excerpt**, **Featured Image**, **Order** (same as above)
- **Includes** (meta box) — one chip per line, e.g. "Account Audits"

### Projects (`project`)
Powers the homepage "Selected Work" gallery, and its own dedicated listing
page via the **Projects** template (same design as Case Studies, just a
different post type). Kept separate from Case Studies on purpose — mirrors
the original static site, where the homepage gallery and the dedicated
write-up pages were different sections.

- **Tag**, **Excerpt**, **Featured Image**, **Order**

> Give the Projects listing page the slug `projects` and the "Back to
> selected work" link on single Project pages will point straight to it
> automatically — otherwise it falls back to the homepage gallery anchor.

---

## Widget areas (Classic Widgets)

Every major section on Home, About, and Contact is a registered widget
area. Each one ships with a **matching custom classic widget** with real
structured fields (not just a raw HTML box) — go to
**Appearance → Widgets**, find the widget named for that section, and
drag it into the area with the same name.

**Leave an area empty and the original design still renders** — nothing
looks broken while you're setting things up.

### Home
| Widget area | Widget |
|---|---|
| Home — Hero | SVRGN: Hero Video |
| Home — Problem | SVRGN: Problem |
| Home — Insight | SVRGN: Insight |
| Home — System Diagram Intro | SVRGN: System Diagram |
| Home — What We Do | SVRGN: What We Do |
| Home — Selected Work | SVRGN: Selected Work Intro *(cards pull live from the Project CPT — not editable here)* |
| Home — Results & Impact | SVRGN: Results & Impact *(highlight cards pull live from the Case Study CPT)* |
| Home — Who We Work With | SVRGN: Who We Work With |
| Home — Engage | SVRGN: Engage |
| Home — What Makes Us Different | SVRGN: What Makes Us Different |
| Home — Contact CTA | SVRGN: Contact CTA |

### About
| Widget area | Widget |
|---|---|
| About — Hero | SVRGN: About Hero |
| About — Story / Philosophy | SVRGN: About Story |
| About — Team | SVRGN: About Team *(real media-library image picker per member, optional LinkedIn/email links)* |
| About — Values | SVRGN: About Values |
| About — Closing CTA | SVRGN: About Closing CTA |

### Contact
| Widget area | Widget |
|---|---|
| Contact — Hero | SVRGN: Contact Hero |
| Contact — Location & Info Card | SVRGN: Contact Info Card |
| Contact — What Happens Next | SVRGN: Contact Process |
| Contact — Closing CTA | SVRGN: Contact Page Closing CTA |

Image fields use the real WordPress media library (click **Choose Image**),
not a raw URL box.

---

## Menus

Registered under **Appearance → Menus**:

- **Primary Navigation** — supports nested/child items (build a dropdown by dragging an item under a parent). Renders with no bullet points, a white dropdown arrow, and a hover-opens dropdown on desktop / tap-to-expand on mobile.
- **Footer Navigation** — optional. If you assign a menu here, it replaces the static tagline in the footer's bottom-right corner, styled to match. Leave it unassigned and the tagline (editable in the Customizer) shows instead.

### Mobile menu
Under 980px, a hamburger button (top-right, orange) opens an off-canvas
drawer with a dark scrim behind it. Closes on scrim click, `Escape`, or
tapping a real link. Includes its own "Book a Call" button.

---

## Customizer settings

**Appearance → Customize**

- **Site Identity → Logo** — native WordPress image logo upload.
- **Logo Text (fallback)** — the text shown when no image logo is uploaded (currently just the subtext line, e.g. "Media / Performance Creative").
- **Footer** — copyright text (supports a `{year}` token that auto-fills the current year) and the right-side tagline (used only if no Footer Navigation menu is assigned).
- **Contact Form** — paste a Contact Form 7 shortcode here to switch the Contact page from the built-in form to CF7 (see below). Leave blank to keep the built-in form.

---

## Contact form

Two options, switchable without editing code:

**1. Built-in (default)** — a coded form that submits via AJAX
(`inc/contact-form.php`) and emails the site admin via `wp_mail()`. No
setup required.

**2. Contact Form 7** — install/activate the plugin, create a form using
the field markup below (reuses the theme's existing styling), then paste
its shortcode into **Customizer → Contact Form**.

```html
<div class="field-row">
  <div class="field">
    <label for="your-name">Full Name</label>
    <div class="field-input-wrap">
      [text* your-name id:your-name]
      <span class="field-underline"></span>
    </div>
  </div>
  <div class="field">
    <label for="your-email">Email</label>
    <div class="field-input-wrap">
      [email* your-email id:your-email]
      <span class="field-underline"></span>
    </div>
  </div>
</div>

<div class="field-row">
  <div class="field">
    <label for="your-company">Brand / Company</label>
    <div class="field-input-wrap">
      [text* your-company id:your-company]
      <span class="field-underline"></span>
    </div>
  </div>
  <div class="field">
    <label for="your-website">Website</label>
    <div class="field-input-wrap">
      [url your-website id:your-website placeholder "https://"]
      <span class="field-underline"></span>
    </div>
  </div>
</div>

<div class="field">
  <label for="your-spend">Monthly Ad Spend</label>
  <div class="field-input-wrap">
    [select* your-spend id:your-spend "Under $10k / mo" "$10k – $50k / mo" "$50k – $150k / mo" "$150k+ / mo"]
    <span class="field-underline"></span>
  </div>
</div>

<div class="field">
  <label for="your-message">Tell Us About Your Brand</label>
  <div class="field-input-wrap">
    [textarea* your-message id:your-message placeholder "What's working, what isn't, and what you're hoping to fix."]
    <span class="field-underline"></span>
  </div>
  <p class="field-note">The more specific, the more useful our first call will be.</p>
</div>

[submit class:btn class:btn-solid "Send Message"]
```

CF7's success event is wired to the same themed "Message Received" panel
the built-in form uses, so the design stays identical either way.

> The theme disables CF7's automatic `wpautop()` paragraph-wrapping
> (`inc/contact-form.php`) since it otherwise injects an extra `<p>` into
> the field markup above and breaks the spacing. If you ever see odd
> padding around a CF7 field, that filter is the first thing to check.

---

## Fonts

Self-hosted in `assets/fonts/` (Anton, Archivo, IBM Plex Mono — same
families and weights the design was originally built with) instead of
loading from `fonts.googleapis.com` / `fonts.gstatic.com`. Enqueued first,
with `font-display: swap`, so nothing blocks first paint.

If you need a weight or style that isn't already included, add the
matching `.woff2` file to `assets/fonts/` and a `@font-face` block to
`assets/fonts/fonts.css`.

---

## Theme structure

```
svrgn-media/
├── style.css                  Theme header (required by WP)
├── functions.php              Setup, enqueueing, all inc/ requires
├── header.php / footer.php    Shared chrome (logo, nav, mobile menu, footer)
├── front-page.php             Homepage — widget areas + Project/Case Study CPT queries
├── page.php / index.php       Generic fallbacks
├── page-about.php             About, matched by slug "about"
├── page-contact.php           Contact, matched by slug "contact"
├── single-case_study.php      Single Case Study
├── single-service.php         Single Service
├── single-project.php         Single Project
├── page-templates/
│   ├── about.php              Selectable "About" template
│   ├── contact.php            Selectable "Contact" template
│   ├── case-studies.php       Selectable "Case Studies" listing template
│   ├── services.php           Selectable "Services" listing template
│   └── projects.php           Selectable "Projects" listing template (same design as Case Studies)
├── inc/
│   ├── cpt-case-study.php     Case Study CPT + meta box
│   ├── cpt-service.php        Service CPT + meta box
│   ├── cpt-project.php        Project CPT + meta box
│   ├── widget-areas.php       Registers all widget areas (sidebars)
│   ├── widget-base.php        Shared base class for the structured-field widgets
│   ├── widget-*.php           The 20 individual classic widgets
│   ├── contact-form.php       Built-in AJAX form handler + CF7 autop fix
│   ├── customizer.php         Logo text, footer, and CF7 shortcode settings
│   └── template-tags.php      Small shared helpers (svrgn_section(), icons, etc.)
└── assets/
    ├── css/                   One stylesheet per page, + site-header.css (global: logo/nav/mobile menu)
    ├── js/                    One script per page, + site-header.js (global)
    ├── fonts/                 Self-hosted webfonts
    └── img/                   Placeholder images (see img/README.txt for what to replace)
```

### Why per-page CSS/JS instead of one global bundle?
The original static site was authored as five independent HTML files,
each with its own full `<style>`/`<script>` block. Those were extracted
as-is into `assets/css/{page}.css` / `assets/js/{page}.js` rather than
hand-merged, to avoid the risk of silently breaking an animation or hover
state while de-duplicating five overlapping stylesheets. There's real
duplication as a result (shared reset/typography/etc. repeated across
files). `site-header.css`/`site-header.js` (header, logo, nav, mobile
menu, footer) were pulled out into a proper shared, global file since
those needed to behave identically everywhere — that's the pattern any
further consolidation should follow.

---

## Notes & assumptions

- **Placeholder images**: a few images still need replacing — see `assets/img/README.txt` (team photos, the Contact page's decorative background graphic).
- **Demo content**: Projects/Case Studies/Services have no seeded posts by default — add them from the WP admin to populate the homepage gallery, Results section, and the two listing pages.
- **GSAP** is loaded from cdnjs (not self-hosted) for the scroll animations throughout.
