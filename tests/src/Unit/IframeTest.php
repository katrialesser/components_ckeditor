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
  use Drupal\university_ckeditor\Plugin\CKEditorPlugin\Iframe;

  /**
   * Iframe unit test.
   *
   * @todo: More documentation.
   *
   * @group university_ckeditor
   */
  class IframeTest extends UnitTestCase {

    /**
     * Dialog object.
     *
     * @var \Drupal\university_ckeditor\Plugin\CKEditorPlugin\Iframe
     */
    protected $iframe;

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

      $plugin_id = 'iframe';

      $plugin_definition = [
        'id' => $plugin_id,
        'class' => 'Drupal\university_ckeditor\Plugin\CKEditorPlugin\Iframe',
        'provider' => 'university_ckeditor',
      ];

      $this->iframe = new Iframe([], $plugin_id, $plugin_definition);

      $this->editorMock = $this->getMockBuilder('Drupal\editor\Entity\Editor')
        ->disableOriginalConstructor()
        ->getMock();

    }

    /**
     * Test getDependencies().
     */
    public function testGetDependencies() {

      $this->assertEquals(['dialog', 'fakeobjects'], $this->iframe->getDependencies($this->editorMock));

    }

    /**
     * Test getLibraries().
     */
    public function testGetLibraries() {

      $this->assertEmpty($this->iframe->getLibraries($this->editorMock));

    }

    /**
     * Test isInternal().
     */
    public function testIsInternal() {

      $this->assertFalse($this->iframe->isInternal());

    }


    /**
     * Test getFile().
     */
    public function testGetFile() {

      $expect = '/path/module/university_ckeditor/js/plugins/iframe/plugin.js';
      $this->assertEquals($expect, $this->iframe->getFile());

    }

    /**
     * Test getConfig().
     */
    public function testGetConfig() {

      $this->assertEmpty($this->iframe->getConfig($this->editorMock));

    }

    /**
     * Test getButtons().
     */
    public function testGetButtons() {

      $expect = [
        'Iframe' => [
          'label' => 'Iframe',
          'image' => '/path/module/university_ckeditor/js/plugins/iframe/icons/iframe.png',
        ],
      ];
      $this->assertEquals($expect, $this->iframe->getButtons());

    }

  }

}
