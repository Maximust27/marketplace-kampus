# Marketplace Kampus — Student Marketplace

A Laravel + Livewire application for browsing listings, carts, orders and buyer/seller messages.

**Public demo:** Not currently provided. Review the code on GitHub or follow the local setup instructions below. This repository is a portfolio project, not a claim of production deployment.

## What it demonstrates

| Area | Evidence in source code |
| --- | --- |
| Listings | Product catalog/detail and product management routes (`routes/web.php`) |
| Shopping cart | Authenticated cart component (`app/Livewire/Cart/Cart.php`) |
| Orders | My Orders component supports status, confirm, completion and cancellation flows (`app/Livewire/Order/MyOrder.php`) |
| Messaging | Authenticated inbox route and conversation/message models |
| Data model | Product, cart, order, order item, review and conversation models (`app/Models`) |

## Stack

PHP, Laravel 13, Livewire, Blade, Tailwind CSS, Vite, Eloquent, Pest

## Architecture

```text
Browser
  -> UI (React/Inertia or Blade/Livewire, depending on this project)
  -> Laravel routes / middleware
  -> Controllers or Livewire components
  -> Eloquent models and database
```

Refer to `routes/web.php` and `app/` for this project's implementation details.

## Local development

Requirements: a compatible PHP/Composer environment, Node.js/npm, and a database configured for Laravel.

```bash
git clone https://github.com/Maximust27/marketplace-kampus.git
cd marketplace-kampus
composer install
npm install
cp .env.example .env
php artisan key:generate
```

Configure your `.env` database settings and run:

```bash
php artisan migrate
php artisan serve
```

In another terminal run `npm run dev`. Run tests with `php artisan test` and check production asset compilation using `npm run build`.

**Verification:** These commands are a standard starting point, not evidence that this repository was installed or tested during this documentation change. Project-specific seed data or configuration may be needed. Do not commit secrets or real personal data.

## Source code walkthrough

- [`routes/web.php`](./routes/web.php)
- [`app/Livewire/Order/MyOrder.php`](./app/Livewire/Order/MyOrder.php)
- [`app/Models/Order.php`](./app/Models/Order.php)
- [`app/Models/Conversation.php`](./app/Models/Conversation.php)
- [`tests/Feature`](./tests/Feature)

Read [PORTFOLIO_CASE_STUDY.md](./docs/PORTFOLIO_CASE_STUDY.md) for engineering decisions, current limitations, and proposed verification tasks.

## Engineering next steps

- Order transitions, permissions and messaging are sensitive business logic. Test buyer/seller ownership and prevent unauthorized order changes. No actual payments or marketplace users are claimed.
- Only a starter feature example was identified in the repository; prioritize tests for placing, confirming, cancelling and completing orders.
- Capture screenshots using fictional sample data and record a short walkthrough.
- Add a verified demo and reproducible setup instructions when available.

## Recruiter note

The documentation describes code that is visible in this repository. It does **not** claim real deployments, production users, validated performance gains, or a completed security assessment. Any team contribution should be described accurately before including it on a CV.

**Maintained by:** [@Maximust27](https://github.com/Maximust27) · [Portfolio](https://maximust27.github.io/)
