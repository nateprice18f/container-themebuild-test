<?php

/**
 * @file
 * Generate Summary Box Content.
 */

use Drupal\node\Entity\Node;
use Drupal\paragraphs\Entity\Paragraph;
use Drupal\uswds_paragraph_components_examples\ExampleConstantsInterface;

/**
 * Generate Alert Paragraph Bundles + Node.
 *
 * @throws \Drupal\Core\Entity\EntityStorageException
 */
function generate_summary_box_paragraphs() {
  $body = ExampleConstantsInterface::UPCE_BODY_LONG;

  $summary1 = Paragraph::create([
    'type' => 'uswds_summary_box',
    'field_text' => [
      "value" => $body,
      "format" => "basic_html",
    ],
    'field_header' => [
      "value" => 'Hello World!',
    ],
  ]);
  $summary1->save();

  $node = Node::create([
    'type'        => 'uswds_page',
    'title'       => 'USWDS Paragraph Components Example Summary Box',
    'field_uswds_paragraphs'  => [
      [
        'target_id' => $summary1->id(),
        'target_revision_id' => $summary1->getRevisionId(),
      ],
    ],
    'created' => time(),
    'status' => 0,
  ]);
  $node->save();
}
