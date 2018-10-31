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
  use Drupal\university_ckeditor\Plugin\CKEditorPlugin\Dialog;

  /**
   * Dialog unit test.
   *
   * @todo: More documentation.
   *
   * @group university_ckeditor
   */
  class DialogTest extends UnitTestCase {

    /**
     * Dialog object.
     *
     * @var \Drupal\university_ckeditor\Plugin\CKEditorPlugin\Dialog
     */
    protected $dialog;

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

      $plugin_id = 'dialog';

      $plugin_definition = [
        'id' => $plugin_id,
        'class' => 'Drupal\university_ckeditor\Plugin\CKEditorPlugin\Dialog',
        'provider' => 'university_ckeditor',
      ];

      $this->dialog = new Dialog([], $plugin_id, $plugin_definition);

      $this->editorMock = $this->getMockBuilder('Drupal\editor\Entity\Editor')
        ->disableOriginalConstructor()
        ->getMock();

    }

    /**
     * Test getDependencies().
     */
    public function testGetDependencies() {

      $this->assertEmpty($this->dialog->getDependencies($this->editorMock));

    }

    /**
     * Test getLibraries().
     */
    public function testGetLibraries() {

      $this->assertEmpty($this->dialog->getLibraries($this->editorMock));

    }

    /**
     * Test isInternal().
     */
    public function testIsInternal() {

      $this->assertFalse($this->dialog->isInternal());

    }


    /**
     * Test getFile().
     */
    public function testGetFile() {

      $expect = '/path/module/university_ckeditor/js/plugins/dialog/plugin.js';
      $this->assertEquals($expect, $this->dialog->getFile());

    }

    /**
     * Test getConfig().
     */
    public function testGetConfig() {

      $this->assertEmpty($this->dialog->getConfig($this->editorMock));

    }

  }

}
