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
  use Drupal\university_ckeditor\Plugin\CKEditorPlugin\ColorButton;
  use Drupal\Tests\UnitTestCase;

  /**
   * ColorButton unit test.
   *
   * @group university_ckeditor
   */
  class ColorButtonTest extends UnitTestCase {

    /**
     * Color Button.
     *
     * @var \Drupal\university_ckeditor\Plugin\CKEditorPlugin\ColorButton
     */
    protected $colorButton;

    /**
     * Editor.
     *
     * @var \Drupal\editor\Entity\Editor
     */
    protected $editor;

    /**
     * Form State Interface.
     *
     * @var \Drupal\Core\Form\FormStateInterface
     */
    protected $formStateInterface;

    /**
     * {@inheritdoc}
     */
    public function setup() {
      $id = 'colorbutton';
      $config = [
        'id' => $id,
        'label' => 'CKEditor Color Button'
      ];
      $this->colorButton = new ColorButton([], $id, $config);

      // Editor.
      $this->editor = $this
        ->getMockBuilder('\Drupal\editor\Entity\Editor')
        ->disableOriginalConstructor()
        ->getMock();

      $settings['plugins']['colorbutton']['colors'] = 'FFFFFF,000000';

      $this->editor->expects($this->any())
        ->method('getSettings')
        ->will($this->returnValue($settings));

      // Form State Interface.
      $this->form_state_interface = $this
        ->getMockBuilder('\Drupal\Core\Form\FormStateInterface')
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
     * Test getLibraryPath method.
     */
    public function testGetLibraryPath() {
      $folder = '/libraries/colorbutton';
      $this->assertEquals($folder, $this->colorButton->getLibraryPath());
    }

    /**
     * Test getDependencies method.
     */
    public function testGetDependencies() {
      $dependencies = ['panelbutton'];
      $this->assertEquals($dependencies, $this->colorButton->getDependencies($this->editor));
    }

    /**
     * Test getFile method.
     */
    public function testGetFile() {
      $file = '/libraries/colorbutton/plugin.js';
      $this->assertEquals($file, $this->colorButton->getFile());
    }

    /**
     * Test getConfig method.
     */
    public function testGetConfig() {
      $config = [
        'colorButton_enableMore' => FALSE,
        'colorButton_enableAutomatic' => TRUE,
        'colorButton_colors' => 'FFFFFF,000000'
      ];
      $this->assertEquals($config, $this->colorButton->getConfig($this->editor));
    }

    /**
     * Test getButtons method.
     */
    public function testGetButtons() {
      $config = [
        'TextColor' => [
          'label' => 'Text Color',
          'image' => '/libraries/colorbutton/icons/textcolor.png',
        ],
        'BGColor' => [
          'label' => 'Background Color',
          'image' => '/libraries/colorbutton/icons/bgcolor.png',
        ],
      ];
      $this->assertEquals($config, $this->colorButton->getButtons());
    }

    /**
     * Test settingsForm method.
     */
    public function testSettingsForm() {
      $form['colors'] = [
        '#type' => 'textarea',
        '#title' => 'Text Colors',
        '#description' => 'Enter the hex values of all colors you would like to support (without the # symbol) separated by a comma. Leave blank to use the default colors for Color Button.',
        '#default_value' => 'FFFFFF,000000',
        '#element_validate' => [
          [$this->colorButton, 'validateInput']
        ]
      ];
      $this->assertEquals($form, $this->colorButton->settingsForm([], $this->form_state_interface, $this->editor));
    }

    /**
     * Test validateInput method.
     */
    public function testValidateInput() {
      $this->form_state_interface->expects($this->any())
        ->method('getValue')
        ->with([
          'editor',
          'settings',
          'plugins',
          'colorbutton',
          'colors',
        ])
        ->will($this->returnValue('TEST'));

      $this->form_state_interface->expects($this->any())
        ->method('setError')
        ->with([], 'Only valid hex values are allowed (A-F, 0-9). No other symbols or letters are allowed. Please check your settings and try again.')
        ->will($this->returnSelf());

      $this->colorButton->validateInput([], $this->form_state_interface);
      $this->assertTrue(TRUE);
    }

  }

}
