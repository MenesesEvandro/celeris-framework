# CELERIS

**Lightweight PHP, heavyweight performance.**

[![Build Status](https://img.shields.io/github/actions/workflow/status/MenesesEvandro/celeris/ci.yml?branch=main&style=for-the-badge)](https://github.com/MenesesEvandro/celeris/actions)
[![Code Coverage](https://img.shields.io/badge/coverage-100%25-brightgreen?style=for-the-badge)](./)
[![Latest Stable Version](https://img.shields.io/packagist/v/celeris/framework?style=for-the-badge)](https://packagist.org/packages/celeris/framework)
[![License](https://img.shields.io/badge/license-MIT-blue?style=for-the-badge)](./LICENSE)

---

**Celeris** is a modular, high-performance PHP framework built on PSR standards for developing modern, scalable APIs and microservices. It is designed for developers who demand full control, extreme performance, and an exceptional developer experience (DX) without the complexity and overhead of full-stack frameworks.

### ⚠️ Project Status: Active Development (Alpha)
Celeris is currently in the development phase of its **Solid Core (MVP)**. The API is subject to change, and the framework is not yet recommended for production use.

---

### Core Philosophy

Our architectural decisions are guided by four key pillars:

* 🚀 **Extreme Performance:** Low overhead, optimized for the highest possible speed in API scenarios. Our goal is to be among the fastest PHP frameworks in the TechEmpower benchmarks.
* ✨ **Superior Developer Experience (DX):** From installation to deployment, everything is designed to be fast, intuitive, and enjoyable. Aiming for a <5 minute onboarding, clear documentation, and helpful error messages.
* 📦 **True Modularity:** A minimal, lean core. Additional features, such as an ORM or a template engine, are optional packages installed via Composer. You only load what you need.
* 🧩 **Interoperability (PSR):** Full compliance with industry standards (PSR-7, PSR-11, PSR-15, etc.), allowing seamless integration with the best libraries in the PHP ecosystem.

### Installation (Coming Soon)

The goal is to provide a ready-to-use application skeleton with a single Composer command.

```bash
composer create-project celeris/app project-name
```

### Quick Example: "Hello, World!"

Celeris features an elegant and minimalist syntax. Here is how a basic route will be defined:

```php
<?php
// public/index.php

require_once __DIR__ . '/../vendor/autoload.php';

use Celeris\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

// 1. Initialize the application
$app = new App();

// 2. Define a route
$app->get('/', function (Request $request, Response $response) {
    $response->getBody()->write('Hello, World!');
    return $response;
});

// 3. Run the application
$app->run();
```

### Contributing

We believe in the power of open source. Contributions are highly welcome! Please read our `CONTRIBUTING.md` (coming soon) to learn how to participate. If you find a bug or have a suggestion, please open an [Issue](https://github.com/MenesesEvandro/celeris/issues).

### License

The Celeris framework is open-source software licensed under the [MIT License](./LICENSE).