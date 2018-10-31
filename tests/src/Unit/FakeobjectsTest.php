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
  use Drupal\university_ckeditor\Plugin\CKEditorPlugin\Fakeobjects;

  /**
   * Fakeobjects unit test.
   *
   * @todo: More documentation.
   *
   * @group university_ckeditor
   */
  class FakeobjectsTest extends UnitTestCase {

    /**
     * Fakeobjects object.
     *
     * @var \Drupal\university_ckeditor\Plugin\CKEditorPlugin\Fakeobjects
     */
    protected $fakeObjects;

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

      $plugin_id = 'fakeobjects';

      $plugin_definition = [
        'id' => $plugin_id,
        'class' => 'Drupal\university_ckeditor\Plugin\CKEditorPlugin\Fakeobjects',
        'provider' => 'university_ckeditor',
      ];

      $this->fakeObjects = new Fakeobjects([], $plugin_id, $plugin_definition);

      $this->editorMock = $this->getMockBuilder('Drupal\editor\Entity\Editor')
        ->disableOriginalConstructor()
        ->getMock();

    }

    /**
     * Test getDependencies().
     */
    public function testGetDependencies() {

      $this->assertEmpty($this->fakeObjects->getDependencies($this->editorMock));

    }

    /**
     * Test getLibraries().
     */
    public function testGetLibraries() {

      $this->assertEmpty($this->fakeObjects->getLibraries($this->editorMock));

    }

    /**
     * Test isInternal().
     */
    public function testIsInternal() {

      $this->assertFalse($this->fakeObjects->isInternal());

    }


    /**
     * Test getFile().
     */
    public function testGetFile() {

      $expect = '/path/module/university_ckeditor/js/plugins/fakeobjects/plugin.js';
      $this->assertEquals($expect, $this->fakeObjects->getFile());

    }

    /**
     * Test getConfig().
     */
    public function testGetConfig() {

      $this->assertEmpty($this->fakeObjects->getConfig($this->editorMock));

    }

  }

}
