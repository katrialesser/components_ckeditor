<?php

namespace Drupal\university_ckeditor\Plugin\CKEditorPlugin;

use Drupal\ckeditor\CKEditorPluginBase;
use Drupal\ckeditor\CKEditorPluginConfigurableInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\editor\Entity\Editor;

/**
 * Defines the "imageresizerowandcolumn" plugin.
 *
 * @CKEditorPlugin(
 *   id = "imageresizerowandcolumn",
 *   label = @Translation("Image Resizer(Width and Height)")
 * )
 */
class ImageResizeRowAndColumn extends CKEditorPluginBase {

  /**
   * Get path to library folder.
   */
  public function getLibraryPath() {
    $path = '/libraries/imageresizerowandcolumn';
    if (\Drupal::moduleHandler()->moduleExists('libraries')) {
      $path = libraries_get_path('imageresizerowandcolumn');
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
    return '';
  }

  /**
   * {@inheritdoc}
   */
  public function getButtons() {
    return '';
  }

}
