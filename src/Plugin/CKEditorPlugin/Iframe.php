<?php

namespace Drupal\university_ckeditor\Plugin\CKEditorPlugin;

use Drupal\ckeditor\CKEditorPluginBase;
use Drupal\editor\Entity\Editor;

/**
 * Defines the "iframe" plugin.
 *
 * @CKEditorPlugin(
 *   id = "iframe",
 *   label = @Translation("CKEditor Iframe"),
 * )
 */
class Iframe extends CKEditorPluginBase {

  /**
   * {@inheritdoc}
   */
  public function getDependencies(Editor $editor) {
    return ['dialog', 'fakeobjects'];
  }

  /**
   * {@inheritdoc}
   */
  public function getLibraries(Editor $editor) {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function isInternal() {
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function getFile() {
    $plugin = drupal_get_path('module', 'university_ckeditor') . '/js/plugins/iframe/plugin.js';

    return $plugin;
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
    return array(
      'Iframe' => array(
        'label' => t('Iframe'),
        'image' => drupal_get_path('module', 'university_ckeditor') . '/js/plugins/iframe/icons/iframe.png',
      ),
    );
  }

}
