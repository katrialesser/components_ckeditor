<?php

namespace Drupal\university_ckeditor\Plugin\CKEditorPlugin;

use Drupal\ckeditor\CKEditorPluginBase;
use Drupal\ckeditor\CKEditorPluginConfigurableInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\editor\Entity\Editor;

/**
 * Defines the "accordionList" plugin.
 *
 * @CKEditorPlugin(
 *   id = "accordionList",
 *   label = @Translation("Bootstrap Accordion List")
 * )
 */
class AccordionList extends CKEditorPluginBase {

  /**
   * Get path to library folder.
   */
  public function getLibraryPath() {
    $path = '/libraries/accordionlist';
    if (\Drupal::moduleHandler()->moduleExists('libraries')) {
      $path = libraries_get_path('accordionlist');
    }

    return $path;
  }

  /**
   * {@inheritdoc}
   */
  public function getFile() {
    return $this->getLibraryPath() . '/plugin.js';
  }

  /**
   * {@inheritdoc}
   */
  public function getConfig(Editor $editor) {
    $config['accordionlist'] = '';
    return $config;
  }

  /**
   * {@inheritdoc}
   */
  public function getButtons() {
    $path = $this->getLibraryPath();
    return [
      'AccordionList' => [
        'label' => t('AccordionList'),
        'image' => $path . '/icons/accordionlist.png',
      ],
    ];
  }

}
