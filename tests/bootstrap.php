<?php
/**
 * Test bootstrap for PHPUnit compatibility across versions 4.8 - 11.x
 */

require_once dirname(__DIR__) . '/vendor/autoload.php';

// For PHPUnit < 6, create an alias to the namespaced class
if (!class_exists('PHPUnit\Framework\TestCase') && class_exists('PHPUnit_Framework_TestCase')) {
    class_alias('PHPUnit_Framework_TestCase', 'PHPUnit\Framework\TestCase');
}
