<?php

namespace Drupal\university_ckeditor\Plugin\CKEditorPlugin;

use Drupal\ckeditor\CKEditorPluginBase;
use Drupal\editor\Entity\Editor;

/**
 * Defines the "Paste Code" plugin.
 *
 * @CKEditorPlugin(
 *   id = "pastecode",
 *   label = @Translation("HTML Insert")
 * )
 */
class PasteCode extends CKEditorPluginBase {

  /**
   * {@inheritdoc}
   */
  public function getButtons() {
    return [
      'PasteCode' => [
        'label' => t('Paste Code'),
        'image' => drupal_get_path('module', 'university_ckeditor') . '/js/plugins/pastecode/icons/pastecode.png',
      ],
    ];
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
  public function getDependencies(Editor $editor) {
    return ['clipboard'];
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
  public function getFile() {

    return drupal_get_path('module', 'university_ckeditor') . '/js/plugins/pastecode/plugin.js';

  }

  /**
   * {@inheritdoc}
   */
  public function getConfig(Editor $editor) {
    return [];
  }

}
