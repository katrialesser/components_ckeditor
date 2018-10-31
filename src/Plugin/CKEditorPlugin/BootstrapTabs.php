<?php

namespace Drupal\university_ckeditor\Plugin\CKEditorPlugin;

use Drupal\ckeditor\CKEditorPluginBase;
use Drupal\ckeditor\CKEditorPluginConfigurableInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\editor\Entity\Editor;

/**
 * Defines the "bootstrapTabs" plugin.
 *
 * @CKEditorPlugin(
 *   id = "bootstrapTabs",
 *   label = @Translation("Bootstrap Tabs")
 * )
 */
class BootstrapTabs extends CKEditorPluginBase {

  /**
   * Get path to library folder.
   */
  public function getLibraryPath() {
    $path = '/libraries/bootstraptabs';
    if (\Drupal::moduleHandler()->moduleExists('libraries')) {
      $path = libraries_get_path('bootstraptabs');
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
    $config['bootstraptabs'] = '';
    return $config;
  }

  /**
   * {@inheritdoc}
   */
  public function getButtons() {
    $path = $this->getLibraryPath();
    return [
      'BootstrapTabs' => [
        'label' => t('BootstrapTabs'),
        'image' => $path . '/icons/bootstrapTabs.png',
      ],
    ];
  }

}
