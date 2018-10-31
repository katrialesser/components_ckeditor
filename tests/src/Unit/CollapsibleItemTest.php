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
  use Drupal\university_ckeditor\Plugin\CKEditorPlugin\CollapsibleItem;
  use Drupal\Tests\UnitTestCase;

  /**
   * Collapsible Item unit test.
   *
   * @group university_ckeditor
   */
  class CollapsibleItemTest extends UnitTestCase {

    /**
     * Collapsible Item.
     *
     * @var \Drupal\university_ckeditor\Plugin\CKEditorPlugin\CollapsibleItem
     */
    protected $collapsibleItem;

    /**
     * {@inheritdoc}
     */
    public function setup() {
      $id = 'collapsibleItem';
      $config = [
        'id' => $id,
        'label' => 'Bootstrap Collapsible Item'
      ];
      $this->collapsibleItem = new CollapsibleItem([], $id, $config);

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
      $folder = '/libraries/collapsibleitem';
      $this->assertEquals($folder, $this->collapsibleItem->getLibraryPath());
    }

    /**
     * Test getFile method.
     */
    public function testGetFile() {
      $file = '/libraries/collapsibleitem/plugin.js';
      $this->assertEquals($file, $this->collapsibleItem->getFile());
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

      $config['collapsibleitem'] = '';
      $this->assertEquals($config, $this->collapsibleItem->getConfig($editor));
    }

    /**
     * Test getButtons method.
     */
    public function testGetButtons() {
      $config = [
        'CollapsibleItem' => [
          'label' => 'Collapsible Item',
          'image' => '/libraries/collapsibleitem/icons/collapsibleitem.png',
        ],
      ];
      $this->assertEquals($config, $this->collapsibleItem->getButtons());
    }

  }

}
