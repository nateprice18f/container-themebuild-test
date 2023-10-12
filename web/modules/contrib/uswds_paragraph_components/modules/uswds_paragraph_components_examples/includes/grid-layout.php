<?php

/**
 * @file
 * Generate Grid Layout Content.
 */

use Drupal\node\Entity\Node;
use Drupal\paragraphs\Entity\Paragraph;
use Drupal\uswds_paragraph_components_examples\ExampleConstantsInterface;

/**
 * Generate Grid Layout 2 Column Paragraph Bundles + Node.
 *
 * @throws \Drupal\Core\Entity\EntityStorageException
 */
function generate_grid_layout_2_column_paragraphs() {
  $body = ExampleConstantsInterface::UPCE_BODY_LONG;

  // Reusuable column content.
  $column = Paragraph::create([
    'type' => 'text_field',
    'field_text' => [
      "value" => $body,
      "format" => "basic_html",
    ],
  ]);
  $column->save();

  // Get 2 Column Breakpoints.
  $breakpoints = generate_2_column_breakpoints();

  $two_column1 = Paragraph::create([
    'type' => 'uswds_2_columns',
    'field_2_column_content' => [
      [
        'target_id' => $column->id(),
        'target_revision_id' => $column->getRevisionId(),
      ],
      [
        'target_id' => $column->id(),
        'target_revision_id' => $column->getRevisionId(),
      ],
    ],
    'field_column_grid_gap' => [
      "value" => FALSE,
    ],
    'field_uswds_2_column_breakpoints' => $breakpoints,
  ]);
  $two_column1->save();

  $two_column2 = Paragraph::create([
    'type' => 'uswds_2_columns',
    'field_2_column_content' => [
      [
        'target_id' => $column->id(),
        'target_revision_id' => $column->getRevisionId(),
      ],
      [
        'target_id' => $column->id(),
        'target_revision_id' => $column->getRevisionId(),
      ],
    ],
    'field_column_grid_gap' => [
      "value" => TRUE,
    ],
    'field_uswds_2_column_breakpoints' => $breakpoints,
  ]);
  $two_column2->save();

  $node = Node::create([
    'type' => 'uswds_page',
    'title' => 'USWDS Paragraph Components Example 2 Column Layout',
    'body' => [
      "value" => '<p>Both Column sets have breakpoints desktop:4-8 and tablet even.</p><p>First set is not using grid gap.</p><p>Second set is using grid gap.</p>',
      "format" => "basic_html",
    ],
    'field_uswds_paragraphs' => [
      [
        'target_id' => $two_column1->id(),
        'target_revision_id' => $two_column1->getRevisionId(),
      ],
      [
        'target_id' => $two_column2->id(),
        'target_revision_id' => $two_column2->getRevisionId(),
      ],
    ],
    'created' => time(),
    'status' => 0,
  ]);
  $node->save();
}

/**
 * Generate 2 Column Breakpoints.
 *
 * @throws \Drupal\Core\Entity\EntityStorageException
 */
function generate_2_column_breakpoints(): array {

  // Get taxonomy term storage.
  $taxonomyStorage = \Drupal::service('entity_type.manager')
    ->getStorage('taxonomy_term');
  $properties['vid'] = 'uswds_breakpoints';

  // Set name properties.
  $properties['name'] = 'desktop';

  // Load taxonomy term by properties.
  $terms = $taxonomyStorage->loadByProperties($properties);
  $desktop = reset($terms);

  $breakpoint1 = Paragraph::create([
    'type' => 'uswds_2_column_breakpoints',
    'field_2_column_grid_options' => [
      "value" => '4-8',
    ],
    'field_uswds_breakpoints' => [
      "target_id" => $desktop->id(),
    ],
  ]);
  $breakpoint1->save();

  // Set name properties.
  $properties['name'] = 'tablet';

  // Load taxonomy term by properties.
  $terms = $taxonomyStorage->loadByProperties($properties);
  $tablet = reset($terms);

  $breakpoint2 = Paragraph::create([
    'type' => 'uswds_2_column_breakpoints',
    'field_2_column_grid_options' => [
      "value" => 'even',
    ],
    'field_uswds_breakpoints' => [
      "target_id" => $tablet->id(),
    ],
  ]);
  $breakpoint2->save();

  return [
    [
      'target_id' => $breakpoint1->id(),
      'target_revision_id' => $breakpoint1->getRevisionId(),
    ],
    [
      'target_id' => $breakpoint2->id(),
      'target_revision_id' => $breakpoint2->getRevisionId(),
    ],
  ];
}

/**
 * Generate Grid Layout 3 Column Paragraph Bundles + Node.
 *
 * @throws \Drupal\Core\Entity\EntityStorageException
 */
function generate_grid_layout_3_column_paragraphs() {
  $body = ExampleConstantsInterface::UPCE_BODY_LONG;

  // Reusuable column content.
  $column = Paragraph::create([
    'type' => 'text_field',
    'field_text' => [
      "value" => $body,
      "format" => "basic_html",
    ],
  ]);
  $column->save();

  // Get 3 Column Breakpoints.
  $breakpoints = generate_3_column_breakpoints();

  $three_column1 = Paragraph::create([
    'type' => 'uswds_3_columns',
    'field_3_column_content' => [
      [
        'target_id' => $column->id(),
        'target_revision_id' => $column->getRevisionId(),
      ],
      [
        'target_id' => $column->id(),
        'target_revision_id' => $column->getRevisionId(),
      ],
      [
        'target_id' => $column->id(),
        'target_revision_id' => $column->getRevisionId(),
      ],
    ],
    'field_column_grid_gap' => [
      "value" => FALSE,
    ],
    'field_uswds_3_column_breakpoints' => $breakpoints,
  ]);
  $three_column1->save();

  $three_column2 = Paragraph::create([
    'type' => 'uswds_3_columns',
    'field_3_column_content' => [
      [
        'target_id' => $column->id(),
        'target_revision_id' => $column->getRevisionId(),
      ],
      [
        'target_id' => $column->id(),
        'target_revision_id' => $column->getRevisionId(),
      ],
      [
        'target_id' => $column->id(),
        'target_revision_id' => $column->getRevisionId(),
      ],
    ],
    'field_column_grid_gap' => [
      "value" => TRUE,
    ],
    'field_uswds_2_column_breakpoints' => $breakpoints,
  ]);
  $three_column2->save();

  $node = Node::create([
    'type' => 'uswds_page',
    'title' => 'USWDS Paragraph Components Example 3 Column Layout',
    'body' => [
      "value" => '<p>Both Column sets have breakpoints desktop:3-6-3 and tablet even.</p><p>First set is not using grid gap.</p><p>Second set is using grid gap.</p>',
      "format" => "basic_html",
    ],
    'field_uswds_paragraphs' => [
      [
        'target_id' => $three_column1->id(),
        'target_revision_id' => $three_column1->getRevisionId(),
      ],
      [
        'target_id' => $three_column2->id(),
        'target_revision_id' => $three_column2->getRevisionId(),
      ],
    ],
    'created' => time(),
    'status' => 0,
  ]);
  $node->save();
}

/**
 * Generate 3 Column Breakpoints.
 *
 * @throws \Drupal\Core\Entity\EntityStorageException
 */
function generate_3_column_breakpoints(): array {

  // Get taxonomy term storage.
  $taxonomyStorage = \Drupal::service('entity_type.manager')
    ->getStorage('taxonomy_term');
  $properties['vid'] = 'uswds_breakpoints';

  // Set name properties.
  $properties['name'] = 'desktop';

  // Load taxonomy term by properties.
  $terms = $taxonomyStorage->loadByProperties($properties);
  $desktop = reset($terms);

  $breakpoint1 = Paragraph::create([
    'type' => 'uswds_3_column_breakpoints',
    'field_3_column_grid_options' => [
      "value" => '3-6-3',
    ],
    'field_uswds_breakpoints' => [
      "target_id" => $desktop->id(),
    ],
  ]);
  $breakpoint1->save();

  // Set name properties.
  $properties['name'] = 'tablet';

  // Load taxonomy term by properties.
  $terms = $taxonomyStorage->loadByProperties($properties);
  $tablet = reset($terms);

  $breakpoint2 = Paragraph::create([
    'type' => 'uswds_2_column_breakpoints',
    'field_3_column_grid_options' => [
      "value" => 'even',
    ],
    'field_uswds_breakpoints' => [
      "target_id" => $tablet->id(),
    ],
  ]);
  $breakpoint2->save();

  return [
    [
      'target_id' => $breakpoint1->id(),
      'target_revision_id' => $breakpoint1->getRevisionId(),
    ],
    [
      'target_id' => $breakpoint2->id(),
      'target_revision_id' => $breakpoint2->getRevisionId(),
    ],
  ];
}
