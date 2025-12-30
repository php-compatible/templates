# templates

Modern PHP-style templating that works on PHP 5.5+.

## Installation

```bash
composer require php-compatible/templates
```

## Usage

### Basic Example

Create a template file `views/hello.php`:

```php
<h1><?php echo $title; ?></h1>
<p><?php echo $message; ?></p>
```

Render the template:

```php
<?php
require 'vendor/autoload.php';

$html = template('views/hello.php', array(
    'title' => 'Hello World',
    'message' => 'Welcome to my site!'
));

echo $html;
```

### Using Loops

Template file `views/list.php`:

```php
<ul>
<?php foreach ($items as $item): ?>
    <li><?php echo $item; ?></li>
<?php endforeach; ?>
</ul>
```

Render:

```php
$html = template('views/list.php', array(
    'items' => array('Apple', 'Banana', 'Cherry')
));
```

### Nested Data

Template file `views/user.php`:

```php
<div class="user-card">
    <h2><?php echo $user['name']; ?></h2>
    <p><?php echo $user['email']; ?></p>
</div>
```

Render:

```php
$html = template('views/user.php', array(
    'user' => array(
        'name' => 'John Doe',
        'email' => 'john@example.com'
    )
));
```

### HTML Escaping

The `template()` function does not automatically escape output. For security, use `htmlspecialchars()` in your templates:

```php
<h1><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h1>
```

## API

### `template($path, $variables)`

Parses a PHP template file and returns the rendered output as a string.

**Parameters:**
- `$path` (string) - Path to the template file
- `$variables` (array) - Associative array of variables to make available in the template

**Returns:** string - The rendered template output

## Requirements

- PHP 5.5 or higher

## Development

### Running Tests

```bash
composer install
composer test
```

### Running Tests with Docker

```bash
docker-compose run php-cli composer install
docker-compose run php-cli composer test
```

### Code Coverage

```bash
composer coverage
```

## License

MIT
