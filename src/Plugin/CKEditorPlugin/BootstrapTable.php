<?php

namespace Drupal\university_ckeditor\Plugin\CKEditorPlugin;

use Drupal\ckeditor\CKEditorPluginBase;
use Drupal\editor\Entity\Editor;
use Drupal\ckeditor\CKEditorPluginContextualInterface;

/**
 * Defines the "bootstraptable" plugin.
 *
 * @CKEditorPlugin(
 *   id = "table",
 *   label = @Translation("Bootstrap Table"),
 * )
 */
class BootstrapTable extends CKEditorPluginBase implements CKEditorPluginContextualInterface {

  /**
   * {@inheritdoc}
   */
  public function getFile() {
    $path = '/libraries/bootstraptable/plugin.js';
    if (\Drupal::moduleHandler()->moduleExists('libraries')) {
      $path = libraries_get_path('bootstraptable', TRUE) . '/plugin.js';
    }
    return $path;
  }

  /**
   * {@inheritdoc}
   */
  public function isEnabled(Editor $editor) {
    return TRUE;
  }

  /**
   * {@inheritdoc}
   */
  public function getConfig(Editor $editor) {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function getButtons() {
    return [];
  }

}
