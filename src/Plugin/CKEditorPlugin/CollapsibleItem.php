<?php

namespace Drupal\university_ckeditor\Plugin\CKEditorPlugin;

use Drupal\ckeditor\CKEditorPluginBase;
use Drupal\ckeditor\CKEditorPluginConfigurableInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\editor\Entity\Editor;

/**
 * Defines the "collapsibleItem" plugin.
 *
 * @CKEditorPlugin(
 *   id = "collapsibleItem",
 *   label = @Translation("Bootstrap Collapsible Item")
 * )
 */
class CollapsibleItem extends CKEditorPluginBase {

  /**
   * Get path to library folder.
   */
  public function getLibraryPath() {
    $path = '/libraries/collapsibleitem';
    if (\Drupal::moduleHandler()->moduleExists('libraries')) {
      $path = libraries_get_path('collapsibleitem');
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
    $config['collapsibleitem'] = '';
    return $config;
  }

  /**
   * {@inheritdoc}
   */
  public function getButtons() {
    $path = $this->getLibraryPath();
    return [
      'CollapsibleItem' => [
        'label' => t('Collapsible Item'),
        'image' => $path . '/icons/collapsibleitem.png',
      ],
    ];
  }

}
