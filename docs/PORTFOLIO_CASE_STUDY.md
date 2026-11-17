# Marketplace Kampus — Student Marketplace: Engineering Case Study

## Overview

A Laravel + Livewire application for browsing listings, carts, orders and buyer/seller messages.

**Context:** This project models an application domain rather than a documented commercial production deployment. Its value as a portfolio sample comes from how the workflows are implemented and tested.

## Implementation evidence

### Listings

Product catalog/detail and product management routes (`routes/web.php`).

### Shopping cart

Authenticated cart component (`app/Livewire/Cart/Cart.php`).

### Orders

My Orders component supports status, confirm, completion and cancellation flows (`app/Livewire/Order/MyOrder.php`).

### Messaging

Authenticated inbox route and conversation/message models.

### Data model

Product, cart, order, order item, review and conversation models (`app/Models`).


## Architecture

- **Stack:** PHP, Laravel 13, Livewire, Blade, Tailwind CSS, Vite, Eloquent, Pest
- **Routing and permissions:** Begin at [routes/web.php](../routes/web.php).
- **Application layer:** Inspect the linked controllers or Livewire components in the project README.
- **Persistence:** Eloquent models and migrations model the application's data and relationships.

## Code review entry points

- [`routes/web.php`](../routes/web.php)
- [`app/Livewire/Order/MyOrder.php`](../app/Livewire/Order/MyOrder.php)
- [`app/Models/Order.php`](../app/Models/Order.php)
- [`app/Models/Conversation.php`](../app/Models/Conversation.php)
- [`tests/Feature`](../tests/Feature)

## Risks and improvement opportunities

Order transitions, permissions and messaging are sensitive business logic. Test buyer/seller ownership and prevent unauthorized order changes. No actual payments or marketplace users are claimed.

### Testing

Only a starter feature example was identified in the repository; prioritize tests for placing, confirming, cancelling and completing orders.

### Reproducibility

The repository was inspected remotely. Its tests were **not executed** as part of this documentation-only update. A clean installation, test run, security review, and a short recorded walkthrough are recommended before presenting this project as production-ready.

## How to present the project to recruiters

1. Define the user problem and what the project models.
2. Demonstrate a concrete end-to-end workflow using fictional data.
3. Explain one implementation tradeoff and locate the relevant code.
4. Show passing tests or state clearly which tests remain to be added.
5. Specify your exact personal contribution and any team collaboration honestly.

Avoid unsupported claims about business impact, usage statistics, uptime or performance.
