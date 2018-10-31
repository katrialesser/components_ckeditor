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
  use Drupal\university_ckeditor\Plugin\CKEditorPlugin\BootstrapTable;
  use Drupal\Tests\UnitTestCase;

  /**
   * Bootstrap Table unit test.
   *
   * @group university_ckeditor
   */
  class BootstrapTableTest extends UnitTestCase {

    /**
     * Bootstrap Table.
     *
     * @var \Drupal\university_ckeditor\Plugin\CKEditorPlugin\BootstrapTable
     */
    protected $bootstrapTable;

    /**
     * Editor.
     *
     * @var \Drupal\editor\Entity\Editor
     */
    protected $editor;

    /**
     * {@inheritdoc}
     */
    public function setup() {
      $id = 'table';
      $config = [
        'id' => $id,
        'label' => 'Bootstrap Table'
      ];
      $this->bootstrapTable = new BootstrapTable([], $id, $config);

      // Editor.
      $this->editor = $this
        ->getMockBuilder('\Drupal\editor\Entity\Editor')
        ->disableOriginalConstructor()
        ->getMock();

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
     * Test getFile method.
     */
    public function testGetFile() {
      $file = '/libraries/bootstraptable/plugin.js';
      $this->assertEquals($file, $this->bootstrapTable->getFile());
    }

    /**
     * Test isEnabled method.
     */
    public function testIsEnabled() {
      $this->assertTrue($this->bootstrapTable->isEnabled($this->editor));
    }

    /**
     * Test getConfig method.
     */
    public function testGetConfig() {
      $config = [];
      $this->assertEquals($config, $this->bootstrapTable->getConfig($this->editor));
    }

    /**
     * Test getButtons method.
     */
    public function testGetButtons() {
      $config = [];
      $this->assertEquals($config, $this->bootstrapTable->getButtons());
    }

  }

}
