<?php
namespace {

  if (!function_exists('drupal_get_path')) {
    function drupal_get_path($type, $name) {
      return "/path/$type/$name";
    }
  }

  if (!function_exists('t')) {
    function t($string, $data = []) {
      return $string;
    }
  }

}

namespace Drupal\Tests\university_ckeditor\Unit {

  use Drupal\Tests\UnitTestCase;
  use Drupal\university_ckeditor\Plugin\CKEditorPlugin\PasteCode;

  /**
   * PasteCode unit test.
   *
   * @todo: More documentation.
   *
   * @group university_ckeditor
   */
  class PasteCodeTest extends UnitTestCase {

    /**
     * Dialog object.
     *
     * @var \Drupal\university_ckeditor\Plugin\CKEditorPlugin\PasteCode
     */
    protected $pasteCode;

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

      $plugin_id = 'pastecode';

      $plugin_definition = [
        'id' => $plugin_id,
        'class' => 'Drupal\university_ckeditor\Plugin\CKEditorPlugin\PasteCode',
        'provider' => 'university_ckeditor',
      ];

      $this->pasteCode = new PasteCode([], $plugin_id, $plugin_definition);

      $this->editorMock = $this->getMockBuilder('Drupal\editor\Entity\Editor')
        ->disableOriginalConstructor()
        ->getMock();

    }

    /**
     * Test getDependencies().
     */
    public function testGetDependencies() {

      $this->assertEquals(['clipboard'], $this->pasteCode->getDependencies($this->editorMock));

    }

    /**
     * Test getLibraries().
     */
    public function testGetLibraries() {

      $this->assertEmpty($this->pasteCode->getLibraries($this->editorMock));

    }

    /**
     * Test isInternal().
     */
    public function testIsInternal() {

      $this->assertFalse($this->pasteCode->isInternal());

    }


    /**
     * Test getFile().
     */
    public function testGetFile() {

      $expect = '/path/module/university_ckeditor/js/plugins/pastecode/plugin.js';
      $this->assertEquals($expect, $this->pasteCode->getFile());

    }

    /**
     * Test getConfig().
     */
    public function testGetConfig() {

      $this->assertEmpty($this->pasteCode->getConfig($this->editorMock));

    }

    /**
     * Test getButtons().
     */
    public function testGetButtons() {

      $expect = [
        'PasteCode' => [
          'label' => 'Paste Code',
          'image' => '/path/module/university_ckeditor/js/plugins/pastecode/icons/pastecode.png',
        ],
      ];
      $this->assertEquals($expect, $this->pasteCode->getButtons());

    }

  }

}
