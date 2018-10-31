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
  use Drupal\university_ckeditor\Plugin\CKEditorPlugin\BootstrapTabs;
  use Drupal\Tests\UnitTestCase;

  /**
   * Bootstrap Tabs unit test.
   *
   * @group university_ckeditor
   */
  class BootstrapTabsTest extends UnitTestCase {

    /**
     * Bootstrap Tabs.
     *
     * @var \Drupal\university_ckeditor\Plugin\CKEditorPlugin\BootstrapTabs
     */
    protected $bootstrapTabs;

    /**
     * {@inheritdoc}
     */
    public function setup() {
      $id = 'bootstrapTabs';
      $config = [
        'id' => $id,
        'label' => 'Bootstrap Tabs'
      ];
      $this->bootstrapTabs = new BootstrapTabs([], $id, $config);

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
      $folder = '/libraries/bootstraptabs';
      $this->assertEquals($folder, $this->bootstrapTabs->getLibraryPath());
    }

    /**
     * Test getFile method.
     */
    public function testGetFile() {
      $file = '/libraries/bootstraptabs/plugin.js';
      $this->assertEquals($file, $this->bootstrapTabs->getFile());
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

      $config['bootstraptabs'] = '';
      $this->assertEquals($config, $this->bootstrapTabs->getConfig($editor));
    }

    /**
     * Test getButtons method.
     */
    public function testGetButtons() {
      $config = [
        'BootstrapTabs' => [
          'label' => 'BootstrapTabs',
          'image' => '/libraries/bootstraptabs/icons/bootstrapTabs.png',
        ],
      ];
      $this->assertEquals($config, $this->bootstrapTabs->getButtons());
    }

  }

}
