<?php

use PHPUnit\Framework\TestCase;

class TemplateTest extends TestCase
{
    private $dataDir;

    protected function doSetUp()
    {
        $this->dataDir = __DIR__ . '/_data/';
    }

    // setUp compatibility for PHPUnit 4-7 (no return type) and 8+ (void return type)
    protected function setUp(): void
    {
        $this->doSetUp();
    }

    public function testSimpleVariableSubstitution()
    {
        $result = template($this->dataDir . 'simple.php', array(
            'title' => 'Hello World',
            'message' => 'This is a test message.'
        ));

        $this->assertContainsString('<h1>Hello World</h1>', $result);
        $this->assertContainsString('<p>This is a test message.</p>', $result);
    }

    public function testLoopRendering()
    {
        $result = template($this->dataDir . 'loop.php', array(
            'items' => array('Apple', 'Banana', 'Cherry')
        ));

        $this->assertContainsString('<li>Apple</li>', $result);
        $this->assertContainsString('<li>Banana</li>', $result);
        $this->assertContainsString('<li>Cherry</li>', $result);
    }

    public function testNestedArrayAccess()
    {
        $result = template($this->dataDir . 'nested.php', array(
            'user' => array(
                'name' => 'John Doe',
                'email' => 'john@example.com'
            )
        ));

        $this->assertContainsString('<span class="name">John Doe</span>', $result);
        $this->assertContainsString('<span class="email">john@example.com</span>', $result);
    }

    public function testEmptyVariablesArray()
    {
        $result = template($this->dataDir . 'simple.php', array(
            'title' => '',
            'message' => ''
        ));

        $this->assertContainsString('<h1></h1>', $result);
        $this->assertContainsString('<p></p>', $result);
    }

    public function testHtmlEscapingNotAutomatic()
    {
        $result = template($this->dataDir . 'simple.php', array(
            'title' => '<script>alert("xss")</script>',
            'message' => 'Normal text'
        ));

        // Template does not auto-escape - this verifies the behavior
        $this->assertContainsString('<script>alert("xss")</script>', $result);
    }

    public function testReturnsString()
    {
        $result = template($this->dataDir . 'simple.php', array(
            'title' => 'Test',
            'message' => 'Test'
        ));

        $this->assertTrue(is_string($result));
    }

    public function testDoesNotOutputDirectly()
    {
        ob_start();
        template($this->dataDir . 'simple.php', array(
            'title' => 'Test',
            'message' => 'Test'
        ));
        $output = ob_get_clean();

        $this->assertEmpty($output);
    }

    /**
     * Helper for assertContains/assertStringContainsString compatibility
     */
    protected function assertContainsString($needle, $haystack)
    {
        if (method_exists($this, 'assertStringContainsString')) {
            $this->assertStringContainsString($needle, $haystack);
        } else {
            $this->assertContains($needle, $haystack);
        }
    }
}
