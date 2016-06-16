<?php
/**
 * Created by PhpStorm.
 * User: ioannispapikas
 * Date: 16/06/16
 * Time: 16:46
 */

namespace Panda\Ui\Tests\Factories;

use Panda\Ui\Factories\HTMLFactory;
use PHPUnit_Framework_TestCase;

// Initialize testing env
include('../init.php');

class HTMLFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var HTMLFactory
     */
    private $HTMLFactory;

    public function setUp()
    {
        parent::setUp();

        $this->HTMLFactory = new HTMLFactory();
    }

    public function testBuildElement()
    {
        $element = $this->HTMLFactory->buildElement($name = 'item', $value = 'value', $id = 'id', $class = 'class');
        $this->assertEquals('item', $element->tagName);
        $this->assertEquals('value', $element->nodeValue);
        $this->assertEquals('id', $element->getAttribute('id'));
        $this->assertEquals('class', $element->getAttribute('class'));
    }

    public function testBuildWeblink()
    {
        $element = $this->HTMLFactory->buildWeblink($href = 'http://test.example.com', $target = '_self', $content = 'test_weblink', $id = 'weblink_id', $class = 'weblink_class');
        $this->assertEquals('a', $element->tagName);
        $this->assertEquals('test_weblink', $element->nodeValue);
        $this->assertEquals('weblink_id', $element->getAttribute('id'));
        $this->assertEquals('weblink_class', $element->getAttribute('class'));
        $this->assertEquals('http://test.example.com', $element->getAttribute('href'));
        $this->assertEquals('_self', $element->getAttribute('target'));
    }

    public function testBuildMeta()
    {
        $element = $this->HTMLFactory->buildMeta($name = 'test_meta', $content = 'meta_content', $httpEquiv = 'http_equiv', $charset = 'utf-8');
        $this->assertEquals('meta', $element->tagName);
        $this->assertEquals('test_meta', $element->getAttribute('name'));
        $this->assertEquals('meta_content', $element->getAttribute('content'));
        $this->assertEquals('http_equiv', $element->getAttribute('http-equiv'));
        $this->assertEquals('utf-8', $element->getAttribute('charset'));
    }

    public function testBuildLink()
    {
        $element = $this->HTMLFactory->buildLink($rel = 'rel', $href = 'http://test.link.com');
        $this->assertEquals('link', $element->tagName);
        $this->assertEquals('rel', $element->getAttribute('rel'));
        $this->assertEquals('http://test.link.com', $element->getAttribute('href'));
    }

    public function testBuildScript()
    {
        $element = $this->HTMLFactory->buildScript($src = 'http://test.script.com', $async = true);
        $this->assertEquals('script', $element->tagName);
        $this->assertEquals('', $element->getAttribute('async'));
        $this->assertEquals('http://test.script.com', $element->getAttribute('src'));
    }
}
