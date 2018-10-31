<?php
namespace {

  if (!function_exists('drupal_get_path')) {
    function drupal_get_path($type, $name) {
      return "/path/$type/$name";
    }
  }

}

namespace Drupal\Tests\university_ckeditor\Unit {

  use Drupal\Tests\UnitTestCase;
  use Drupal\university_ckeditor\Plugin\CKEditorPlugin\Clipboard;

  /**
   * Clipboard unit test.
   *
   * @todo: More documentation.
   *
   * @group university_ckeditor
   */
  class ClipboardTest extends UnitTestCase {

    /**
     * Clipboard object.
     *
     * @var \Drupal\university_ckeditor\Plugin\CKEditorPlugin\Clipboard
     */
    protected $clipboard;

    /**
     * Mock \Drupal\editor\Entity\Editor.
     *
     * @var \PHPUnit_Framework_MockObject_MockBuilder
     */
    protected $editorMock;

    /**
     * {@inheritdoc}
     */
    public function setup() {

      parent::setup();

      $plugin_id = 'clipboard';

      $plugin_definition = [
        'id' => $plugin_id,
        'class' => 'Drupal\university_ckeditor\Plugin\CKEditorPlugin\Clipboard',
        'provider' => 'university_ckeditor',
      ];

      $this->clipboard = new Clipboard([], $plugin_id, $plugin_definition);

      $this->editorMock = $this->getMockBuilder('Drupal\editor\Entity\Editor')
        ->disableOriginalConstructor()
        ->getMock();

    }

    /**
     * Test getDependencies().
     */
    public function testGetDependencies() {

      $this->assertEmpty($this->clipboard->getDependencies($this->editorMock));

    }

    /**
     * Test getLibraries().
     */
    public function testGetLibraries() {

      $this->assertEmpty($this->clipboard->getLibraries($this->editorMock));

    }

    /**
     * Test isInternal().
     */
    public function testIsInternal() {

      $this->assertFalse($this->clipboard->isInternal());

    }


    /**
     * Test getFile().
     */
    public function testGetFile() {

      $expect = '/path/module/university_ckeditor/js/plugins/clipboard/plugin.js';
      $this->assertEquals($expect, $this->clipboard->getFile());

    }

    /**
     * Test getConfig().
     */
    public function testGetConfig() {

      $this->assertEmpty($this->clipboard->getConfig($this->editorMock));

    }

  }

}
