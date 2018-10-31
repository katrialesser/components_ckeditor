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
  use Drupal\university_ckeditor\Plugin\CKEditorPlugin\AutoCorrect;
  use Drupal\Tests\UnitTestCase;

  /**
   * AutoCorrect unit test.
   *
   * @group university_ckeditor
   */
  class AutoCorrectTest extends UnitTestCase {

    /**
     * AutoCorrect.
     *
     * @var \Drupal\university_ckeditor\Plugin\CKEditorPlugin\AutoCorrect
     */
    protected $autoCorrect;

    /**
     * {@inheritdoc}
     */
    public function setup() {
      $id = 'autocorrect';
      $config = [
        'id' => $id,
        'label' => 'AutoCorrect'
      ];
      $this->autoCorrect = new AutoCorrect([], $id, $config);

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
      $folder = '/libraries/autocorrect';
      $this->assertEquals($folder, $this->autoCorrect->getLibraryPath());
    }

    /**
     * Test getFile method.
     */
    public function testGetFile() {
      $file = '/libraries/autocorrect/plugin.js';
      $this->assertEquals($file, $this->autoCorrect->getFile());
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

      $config['autocorrect'] = '';
      $this->assertEquals($config, $this->autoCorrect->getConfig($editor));
    }

    /**
     * Test getButtons method.
     */
    public function testGetButtons() {
      $config = [
        'AutoCorrect' => [
          'label' => t('AutoCorrect'),
          'image' => '/libraries/autocorrect/icons/autocorrect.png',
        ],
      ];
      $this->assertEquals($config, $this->autoCorrect->getButtons());
    }

  }

}
