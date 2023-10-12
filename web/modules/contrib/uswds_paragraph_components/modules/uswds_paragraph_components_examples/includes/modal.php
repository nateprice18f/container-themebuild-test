<?php

/**
 * @file
 * Generate Alert Content.
 */

use Drupal\node\Entity\Node;
use Drupal\paragraphs\Entity\Paragraph;
use Drupal\uswds_paragraph_components_examples\ExampleConstantsInterface;

/**
 * Generate Modla Paragraph Bundles + Node.
 *
 * @throws \Drupal\Core\Entity\EntityStorageException
 */
function generate_modal_paragraphs() {
  $body = ExampleConstantsInterface::UPCE_BODY_SHORT;

  $modal1 = Paragraph::create([
    'type' => 'uswds_modal',
    'field_modal_body' => [
      "value" => $body,
      "format" => "basic_html",
    ],
    'field_button_text' => [
      "value" => 'Button Text - Regular not large or force',
    ],
    'field_force_action' => [
      "value" => FALSE,
    ],
    'field_large_modal' => [
      "value" => FALSE,
    ],
    'field_modal_no_button_text' => [
      "value" => 'Button No Text',
    ],
    'field_modal_yes_button_text' => [
      "value" => 'Button Yes Text',
    ],
    'field_modal_title' => [
      "value" => 'Hell World',
    ],
  ]);
  $modal1->save();

  $modal2 = Paragraph::create([
    'type' => 'uswds_modal',
    'field_modal_body' => [
      "value" => $body,
      "format" => "basic_html",
    ],
    'field_button_text' => [
      "value" => 'Button Text - Regular large or force',
    ],
    'field_force_action' => [
      "value" => FALSE,
    ],
    'field_large_modal' => [
      "value" => TRUE,
    ],
    'field_modal_no_button_text' => [
      "value" => 'Button No Text',
    ],
    'field_modal_yes_button_text' => [
      "value" => 'Button Yes Text',
    ],
    'field_modal_title' => [
      "value" => 'Hell World',
    ],
  ]);
  $modal2->save();

  $modal3 = Paragraph::create([
    'type' => 'uswds_modal',
    'field_modal_body' => [
      "value" => $body,
      "format" => "basic_html",
    ],
    'field_button_text' => [
      "value" => 'Button Text - Regular not large but force',
    ],
    'field_force_action' => [
      "value" => TRUE,
    ],
    'field_large_modal' => [
      "value" => FALSE,
    ],
    'field_modal_no_button_text' => [
      "value" => 'Button No Text',
    ],
    'field_modal_yes_button_text' => [
      "value" => 'Button Yes Text',
    ],
    'field_modal_title' => [
      "value" => 'Hell World',
    ],
  ]);
  $modal3->save();

  $node = Node::create([
    'type'        => 'uswds_page',
    'title'       => 'USWDS Paragraph Components Example Modal',
    'body' => [
      'value' => '',
      "format" => "basic_html",
    ],
    'field_uswds_paragraphs'  => [
      [
        'target_id' => $modal1->id(),
        'target_revision_id' => $modal1->getRevisionId(),
      ],
      [
        'target_id' => $modal2->id(),
        'target_revision_id' => $modal2->getRevisionId(),
      ],
      [
        'target_id' => $modal3->id(),
        'target_revision_id' => $modal3->getRevisionId(),
      ],
    ],
    'created' => time(),
    'status' => 0,
  ]);
  $node->save();
}
