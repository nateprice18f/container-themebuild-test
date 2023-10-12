<?php

/**
 * @file
 * Generate Process List Content.
 */

use Drupal\node\Entity\Node;
use Drupal\paragraphs\Entity\Paragraph;
use Drupal\uswds_paragraph_components_examples\ExampleConstantsInterface;

/**
 * Generate Process List Paragraph Bundles + Node.
 *
 * @throws \Drupal\Core\Entity\EntityStorageException
 */
function generate_process_list_paragraphs() {
  $body = ExampleConstantsInterface::UPCE_BODY_LONG;

  // Generate Process List Items.
  $item1 = Paragraph::create([
    'type' => 'uswds_process_item',
    'field_text' => [
      "value" => $body,
      "format" => "basic_html",
    ],
    'field_header' => [
      "value" => "Header 1",
    ],
  ]);
  $item1->save();

  $item2 = Paragraph::create([
    'type' => 'uswds_process_item',
    'field_text' => [
      "value" => $body,
      "format" => "basic_html",
    ],
    'field_header' => [
      "value" => "Header 2",
    ],
  ]);
  $item2->save();

  $item3 = Paragraph::create([
    'type' => 'uswds_process_item',
    'field_text' => [
      "value" => $body,
      "format" => "basic_html",
    ],
    'field_header' => [
      "value" => "Header 3",
    ],
  ]);
  $item3->save();

  $item4 = Paragraph::create([
    'type' => 'uswds_process_item',
    'field_text' => [
      "value" => $body,
      "format" => "basic_html",
    ],
    'field_header' => [
      "value" => "Header 4",
    ],
  ]);
  $item4->save();

  $list1 = Paragraph::create([
    'type' => 'uswds_process_list',
    'field_process_items' => [
      [
        'target_id' => $item1->id(),
        'target_revision_id' => $item1->getRevisionId(),
      ],
      [
        'target_id' => $item2->id(),
        'target_revision_id' => $item2->getRevisionId(),
      ],
      [
        'target_id' => $item3->id(),
        'target_revision_id' => $item3->getRevisionId(),
      ],
      [
        'target_id' => $item4->id(),
        'target_revision_id' => $item4->getRevisionId(),
      ],
    ],
  ]);
  $list1->save();

  $node = Node::create([
    'type'        => 'uswds_page',
    'title'       => 'USWDS Paragraph Components Example Process Lists',
    'field_uswds_paragraphs'  => [
      [
        'target_id' => $list1->id(),
        'target_revision_id' => $list1->getRevisionId(),
      ],
    ],
    'created' => time(),
    'status' => 0,
  ]);
  $node->save();
}
