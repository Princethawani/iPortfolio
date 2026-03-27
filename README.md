# Prince Thawani — Portfolio Website

A modern, responsive personal portfolio website for **Prince Thawani**, Backend & Full-Stack Developer from Blantyre, Malawi.

---

## Live Site

[www.princethawani.com](https://www.princethawani.com)

---

## Features

- **Dark / Light Mode** — theme toggle with localStorage persistence
- **Animated Typing Effect** — cycling role titles in the hero section
- **Page Transitions** — curtain wipe animation between sections
- **AJAX Contact Form** — sends emails via PHP with spam protection and auto-reply
- **Responsive Design** — fully mobile-friendly with collapsible sidebar
- **Font Awesome Icons** — real icons throughout navigation, skills, and contact
- **Scroll Animations** — sections animate in as you scroll
- **Active Nav Highlighting** — sidebar link updates on scroll

---

## Project Structure

```
portfolio/
├── index.html              # Main portfolio page
├── README.md               # This file
├── LICENSE                 # License file
├── form/
│   └── mail.php            # Contact form email handler
└── assets/
    ├── img/
    │   └── home.jpg        # Profile photo
    └── css/
        └── style.css       # (optional: extracted styles)
```

---

## Tech Stack

| Layer      | Technology                          |
|------------|-------------------------------------|
| Markup     | HTML5                               |
| Styling    | CSS3, CSS Variables, CSS Animations |
| Scripts    | Vanilla JavaScript (ES6+)           |
| Icons      | Font Awesome 6.5                    |
| Fonts      | Google Fonts — Syne, DM Sans, DM Mono |
| Backend    | PHP 7.4+ (mail function)            |
| Hosting    | cPanel Shared Hosting               |

---

## Getting Started

### Prerequisites

- A web hosting account with cPanel and PHP support
- An email account created in cPanel (e.g. `noreply@princethawani.com`)
- FTP client or cPanel File Manager access

### Deployment

1. **Clone or download** this repository
2. **Upload all files** to your `public_html` directory via cPanel File Manager or FTP
3. **Ensure the folder structure** matches what is shown above
4. **Create email accounts** in cPanel:
   - `noreply@princethawani.com` — used as the sender
   - `info@princethawani.com` — receives contact form messages
5. **Open your domain** in a browser — the site is live!

### Configuration

To change the contact form recipient email, open `form/mail.php` and update:

```php
$to_email   = 'info@princethawani.com';   // Where messages are delivered
$from_email = 'noreply@princethawani.com'; // Must exist in cPanel
```

To update your photo, replace `assets/img/home.jpg` with your own image (keep the same filename, or update the `src` in `index.html`).

---

## Contact Form

The contact form (`form/mail.php`) includes:

- Server-side input sanitization and validation
- Honeypot field to block spam bots
- Auto-reply email sent back to the visitor
- JSON response handled by JavaScript (no page reload)
- Success and error feedback shown inline

---

## Sections

| # | Section    | Description                                      |
|---|------------|--------------------------------------------------|
| 1 | Hero       | Name, typing animation, photo, CTA, stats        |
| 2 | About      | Bio, info grid (location, email, phone, website) |
| 3 | Skills     | 6 skill cards with technology tags               |
| 4 | Experience | Timeline of 3 work roles                         |
| 5 | Education  | 2 academic qualifications                        |
| 6 | Contact    | Contact info cards + working contact form        |

---

## Customization

- **Colors** — edit the CSS variables in `:root` inside `index.html`
- **Typing words** — update the `words` array in the `<script>` block
- **Social links** — update `href` values in the sidebar footer
- **Stats** — update the numbers in the `.hero-stats` section
- **Content** — all text is plain HTML, easy to find and edit

---

## Browser Support

| Browser        | Support |
|----------------|---------|
| Chrome 90+     | ✅      |
| Firefox 88+    | ✅      |
| Safari 14+     | ✅      |
| Edge 90+       | ✅      |
| Opera 76+      | ✅      |

---

## Author

**Prince Thawani**
Backend & Full-Stack Developer
Blantyre, Malawi

- Website: [princethawani.com](https://www.princethawani.com)
- Email: [princethawani4@gmail.com](mailto:princethawani4@gmail.com)
- LinkedIn: [linkedin.com/in/prince-thawani-8a46b31b6](https://www.linkedin.com/in/prince-thawani-8a46b31b6/)
- GitHub: [github.com/Princethawani](https://github.com/Princethawani)

---

## License

Copyright (c) 2025 Prince Thawani. See [LICENSE](LICENSE) for details.