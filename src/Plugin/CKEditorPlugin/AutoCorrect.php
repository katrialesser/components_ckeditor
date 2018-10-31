<?php

namespace Drupal\university_ckeditor\Plugin\CKEditorPlugin;

use Drupal\ckeditor\CKEditorPluginBase;
use Drupal\ckeditor\CKEditorPluginConfigurableInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\editor\Entity\Editor;

/**
 * Defines the "autocorrect" plugin.
 *
 * @CKEditorPlugin(
 *   id = "autocorrect",
 *   label = @Translation("AutoCorrect")
 * )
 */
class AutoCorrect extends CKEditorPluginBase {

  /**
   * Get path to library folder.
   */
  public function getLibraryPath() {
    $path = '/libraries/autocorrect';
    if (\Drupal::moduleHandler()->moduleExists('libraries')) {
      $path = libraries_get_path('autocorrect');
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
    $config['autocorrect'] = '';
    return $config;
  }

  /**
   * {@inheritdoc}
   */
  public function getButtons() {
    $path = $this->getLibraryPath();
    return [
      'AutoCorrect' => [
        'label' => t('AutoCorrect'),
        'image' => $path . '/icons/autocorrect.png',
      ],
    ];
  }

}
