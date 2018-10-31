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
  use Drupal\university_ckeditor\Plugin\CKEditorPlugin\AccordionList;
  use Drupal\Tests\UnitTestCase;

  /**
   * AccordionList unit test.
   *
   * @group university_ckeditor
   */
  class AccordionListTest extends UnitTestCase {

    /**
     * Accordion List.
     *
     * @var \Drupal\university_ckeditor\Plugin\CKEditorPlugin\AccordionList
     */
    protected $accordionList;

    /**
     * {@inheritdoc}
     */
    public function setup() {
      $id = 'accordionList';
      $config = [
        'id' => $id,
        'label' => 'Bootstrap Accordion List'
      ];
      $this->accordionList = new AccordionList([], $id, $config);

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
      $folder = '/libraries/accordionlist';
      $this->assertEquals($folder, $this->accordionList->getLibraryPath());
    }

    /**
     * Test getFile method.
     */
    public function testGetFile() {
      $file = '/libraries/accordionlist/plugin.js';
      $this->assertEquals($file, $this->accordionList->getFile());
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

      $config['accordionlist'] = '';
      $this->assertEquals($config, $this->accordionList->getConfig($editor));
    }

    /**
     * Test getButtons method.
     */
    public function testGetButtons() {
      $config = [
        'AccordionList' => [
          'label' => 'AccordionList',
          'image' => '/libraries/accordionlist/icons/accordionlist.png',
        ],
      ];
      $this->assertEquals($config, $this->accordionList->getButtons());
    }

  }

}
