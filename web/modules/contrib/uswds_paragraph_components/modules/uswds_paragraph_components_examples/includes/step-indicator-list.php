<?php

/**
 * @file
 * Generate Step Indicator List Content.
 */

use Drupal\node\Entity\Node;
use Drupal\paragraphs\Entity\Paragraph;

/**
 * Generate Step Indicator List Paragraph Bundles + Node.
 *
 * @throws \Drupal\Core\Entity\EntityStorageException
 */
function generate_step_indicator_list_paragraphs() {
  // Generate Step Indicator Items.
  $step1 = Paragraph::create([
    'type' => 'uswds_step_indicator_item',
    'field_item_title' => [
      "value" => 'Step 1',
    ],
    'field_current' => [
      "value" => FALSE,
    ],
  ]);
  $step1->save();

  $step2 = Paragraph::create([
    'type' => 'uswds_step_indicator_item',
    'field_item_title' => [
      "value" => 'Step 2',
    ],
    'field_current' => [
      "value" => FALSE,
    ],
  ]);
  $step2->save();

  $step3 = Paragraph::create([
    'type' => 'uswds_step_indicator_item',
    'field_item_title' => [
      "value" => 'Step 3',
    ],
    'field_current' => [
      "value" => TRUE,
    ],
  ]);
  $step3->save();

  $step4 = Paragraph::create([
    'type' => 'uswds_step_indicator_item',
    'field_item_title' => [
      "value" => 'Step 4',
    ],
    'field_current' => [
      "value" => FALSE,
    ],
  ]);
  $step4->save();

  $list1 = Paragraph::create([
    'type' => 'uswds_step_indicator_list',
    'field_step_indicator_items' => [
      [
        'target_id' => $step1->id(),
        'target_revision_id' => $step1->getRevisionId(),
      ],
      [
        'target_id' => $step2->id(),
        'target_revision_id' => $step2->getRevisionId(),
      ],
      [
        'target_id' => $step3->id(),
        'target_revision_id' => $step3->getRevisionId(),
      ],
      [
        'target_id' => $step4->id(),
        'target_revision_id' => $step4->getRevisionId(),
      ],
    ],
    'field_centered' => [
      'value' => FALSE,
    ],
    'field_counters' => [
      'value' => FALSE,
    ],
    'field_no_labels' => [
      'value' => FALSE,
    ],
    'field_small_counters' => [
      'value' => FALSE,
    ],
    'field_header' => [
      'value' => 'List with Labels, Not Centered, Not Counters',
    ],
  ]);
  $list1->save();

  $list2 = Paragraph::create([
    'type' => 'uswds_step_indicator_list',
    'field_step_indicator_items' => [
      [
        'target_id' => $step1->id(),
        'target_revision_id' => $step1->getRevisionId(),
      ],
      [
        'target_id' => $step2->id(),
        'target_revision_id' => $step2->getRevisionId(),
      ],
      [
        'target_id' => $step3->id(),
        'target_revision_id' => $step3->getRevisionId(),
      ],
      [
        'target_id' => $step4->id(),
        'target_revision_id' => $step4->getRevisionId(),
      ],
    ],
    'field_centered' => [
      'value' => FALSE,
    ],
    'field_counters' => [
      'value' => FALSE,
    ],
    'field_no_labels' => [
      'value' => TRUE,
    ],
    'field_small_counters' => [
      'value' => FALSE,
    ],
    'field_header' => [
      'value' => 'List with No Labels, Not Centered, Not Counters',
    ],
  ]);
  $list2->save();

  $list3 = Paragraph::create([
    'type' => 'uswds_step_indicator_list',
    'field_step_indicator_items' => [
      [
        'target_id' => $step1->id(),
        'target_revision_id' => $step1->getRevisionId(),
      ],
      [
        'target_id' => $step2->id(),
        'target_revision_id' => $step2->getRevisionId(),
      ],
      [
        'target_id' => $step3->id(),
        'target_revision_id' => $step3->getRevisionId(),
      ],
      [
        'target_id' => $step4->id(),
        'target_revision_id' => $step4->getRevisionId(),
      ],
    ],
    'field_centered' => [
      'value' => TRUE,
    ],
    'field_counters' => [
      'value' => FALSE,
    ],
    'field_no_labels' => [
      'value' => FALSE,
    ],
    'field_small_counters' => [
      'value' => FALSE,
    ],
    'field_header' => [
      'value' => 'List with Labels, Centered, Not Counters',
    ],
  ]);
  $list3->save();

  $list4 = Paragraph::create([
    'type' => 'uswds_step_indicator_list',
    'field_step_indicator_items' => [
      [
        'target_id' => $step1->id(),
        'target_revision_id' => $step1->getRevisionId(),
      ],
      [
        'target_id' => $step2->id(),
        'target_revision_id' => $step2->getRevisionId(),
      ],
      [
        'target_id' => $step3->id(),
        'target_revision_id' => $step3->getRevisionId(),
      ],
      [
        'target_id' => $step4->id(),
        'target_revision_id' => $step4->getRevisionId(),
      ],
    ],
    'field_centered' => [
      'value' => FALSE,
    ],
    'field_counters' => [
      'value' => TRUE,
    ],
    'field_no_labels' => [
      'value' => FALSE,
    ],
    'field_small_counters' => [
      'value' => FALSE,
    ],
    'field_header' => [
      'value' => 'List with Labels, Not Centered, with Regular Counters',
    ],
  ]);
  $list4->save();

  $list5 = Paragraph::create([
    'type' => 'uswds_step_indicator_list',
    'field_step_indicator_items' => [
      [
        'target_id' => $step1->id(),
        'target_revision_id' => $step1->getRevisionId(),
      ],
      [
        'target_id' => $step2->id(),
        'target_revision_id' => $step2->getRevisionId(),
      ],
      [
        'target_id' => $step3->id(),
        'target_revision_id' => $step3->getRevisionId(),
      ],
      [
        'target_id' => $step4->id(),
        'target_revision_id' => $step4->getRevisionId(),
      ],
    ],
    'field_centered' => [
      'value' => FALSE,
    ],
    'field_counters' => [
      'value' => TRUE,
    ],
    'field_no_labels' => [
      'value' => FALSE,
    ],
    'field_small_counters' => [
      'value' => TRUE,
    ],
    'field_header' => [
      'value' => 'List with Labels, Not Centered, with Small Counters',
    ],
  ]);
  $list5->save();

  $node = Node::create([
    'type'        => 'uswds_page',
    'title'       => 'USWDS Paragraph Components Example Step Indicator Lists',
    'field_uswds_paragraphs'  => [
      [
        'target_id' => $list1->id(),
        'target_revision_id' => $list1->getRevisionId(),
      ],
      [
        'target_id' => $list2->id(),
        'target_revision_id' => $list2->getRevisionId(),
      ],
      [
        'target_id' => $list3->id(),
        'target_revision_id' => $list3->getRevisionId(),
      ],
      [
        'target_id' => $list4->id(),
        'target_revision_id' => $list4->getRevisionId(),
      ],
      [
        'target_id' => $list5->id(),
        'target_revision_id' => $list5->getRevisionId(),
      ],
    ],
    'created' => time(),
    'status' => 0,
  ]);
  $node->save();
}
