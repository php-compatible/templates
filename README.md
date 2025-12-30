# templates

[![CI](https://github.com/php-compatible/templates/actions/workflows/ci.yml/badge.svg)](https://github.com/php-compatible/templates/actions/workflows/ci.yml)
[![codecov](https://codecov.io/gh/php-compatible/templates/branch/main/graph/badge.svg)](https://codecov.io/gh/php-compatible/templates)
[![PHP Version](https://img.shields.io/badge/php-5.5%20--%208.5-8892BF.svg)](https://php.net/)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/php-compatible/templates/blob/main/LICENSE)

**Blazing fast PHP templating with zero dependencies.**

A lightweight, high-performance template engine that leverages PHP's native output buffering for maximum speed. No parsing overhead, no compilation step, no caching layer needed - just pure PHP execution at full speed.

## Why templates?

- **Zero overhead** - Uses PHP's native `require` and output buffering. No regex parsing, no AST compilation, no runtime interpretation.
- **Instant rendering** - Templates execute as native PHP code. What you write is what runs.
- **No dependencies** - A single function. No framework required. No external libraries.
- **Legacy compatible** - Works on PHP 5.5 through 8.x. Modernize your legacy codebase without breaking compatibility.
- **Familiar syntax** - It's just PHP. No new template language to learn.

## Documentation

Full documentation available at **[phpcompatible.dev/docs/category/templates](https://phpcompatible.dev/docs/category/templates)**

## Installation

```bash
composer require php-compatible/templates
```

## Quick Start

Create a template file `views/hello.php`:

```php
<h1><?php echo $title; ?></h1>
<p><?php echo $message; ?></p>
```

Render it:

```php
<?php
require 'vendor/autoload.php';

$html = template('views/hello.php', array(
    'title' => 'Hello World',
    'message' => 'Welcome to my site!'
));

echo $html;
```

## Examples

### Loops

```php
<!-- views/list.php -->
<ul>
<?php foreach ($items as $item): ?>
    <li><?php echo $item; ?></li>
<?php endforeach; ?>
</ul>
```

```php
$html = template('views/list.php', array(
    'items' => array('Apple', 'Banana', 'Cherry')
));
```

### Nested Data

```php
<!-- views/user.php -->
<div class="user-card">
    <h2><?php echo $user['name']; ?></h2>
    <p><?php echo $user['email']; ?></p>
</div>
```

```php
$html = template('views/user.php', array(
    'user' => array(
        'name' => 'John Doe',
        'email' => 'john@example.com'
    )
));
```

### HTML Escaping

The `template()` function does not automatically escape output. For security, use `htmlspecialchars()`:

```php
<h1><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h1>
```

## API

### `template($path, $variables)`

Renders a PHP template file and returns the output as a string.

| Parameter | Type | Description |
|-----------|------|-------------|
| `$path` | string | Path to the template file |
| `$variables` | array | Associative array of variables available in the template |

**Returns:** `string` - The rendered template output

## Requirements

- PHP 5.5 or higher

## License

MIT
