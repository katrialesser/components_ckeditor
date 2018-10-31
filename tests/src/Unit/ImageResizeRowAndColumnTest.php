<?php

namespace {

  if (!function_exists('t')) {
    /**
     * Function t.
     */
    function t($string) {
      return $string;
    }
  }

}

namespace Drupal\Tests\university_ckeditor\Unit {

  use Drupal\Core\DependencyInjection\ContainerBuilder;
  use Drupal\university_ckeditor\Plugin\CKEditorPlugin\ImageResizeRowAndColumn;
  use Drupal\Tests\UnitTestCase;

  /**
   * ImageResizeRowAndColumn unit test.
   *
   * @group university_ckeditor
   */
  class ImageResizeRowAndColumnTest extends UnitTestCase {

    /**
     * Image Resize (Row And Column).
     *
     * @var \Drupal\university_ckeditor\Plugin\CKEditorPlugin\ImageResizeRowAndColumn
     */
    protected $imageResizeRowAndColumn;

    /**
     * {@inheritdoc}
     */
    public function setup() {
      $id = 'imageresizerowandcolumn';
      $config = [
        'id' => $id,
        'label' => 'Image Resizer(Width and Height)'
      ];
      $this->imageResizeRowAndColumn = new ImageResizeRowAndColumn([], $id, $config);

      // Module Handler.
      $module_handler = $this
        ->getMockBuilder('\Drupal\Core\Extension\ModuleHandler')
        ->disableOriginalConstructor()
        ->getMock();

      // Container.
      $container = new ContainerBuilder();
      $container->set('module_handler', $module_handler);
      \Drupal::setContainer($container);
    }

    /**
     * Test getLibraryPath method.
     */
    public function testGetLibraryPath() {
      $folder = '/libraries/imageresizerowandcolumn';
      $this->assertEquals($folder, $this->imageResizeRowAndColumn->getLibraryPath());
    }

    /**
     * Test getFile method.
     */
    public function testGetFile() {
      $file = '/libraries/imageresizerowandcolumn/plugin.js';
      $this->assertEquals($file, $this->imageResizeRowAndColumn->getFile());
    }

    /**
     * Test getConfig method.
     */
    public function testGetConfig() {
      // Editor.
      $editor = $this
        ->getMockBuilder('\Drupal\editor\Entity\Editor')
        ->disableOriginalConstructor()
        ->getMock();

      $config = '';
      $this->assertEquals($config, $this->imageResizeRowAndColumn->getConfig($editor));
    }

    /**
     * Test getButtons method.
     */
    public function testGetButtons() {
      $config = '';
      $this->assertEquals($config, $this->imageResizeRowAndColumn->getButtons());
    }

  }

}
