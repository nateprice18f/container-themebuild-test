<?php

/**
 * @file
 * Generate Cards Content.
 */

use Drupal\Core\File\FileSystemInterface;
use Drupal\media\Entity\Media;
use Drupal\node\Entity\Node;
use Drupal\paragraphs\Entity\Paragraph;
use Drupal\uswds_paragraph_components_examples\ExampleConstantsInterface;

/**
 * Generate Alert Paragraph Bundles + Node.
 *
 * @throws \Drupal\Core\Entity\EntityStorageException
 */
function generate_cards_paragraphs() {
  $body = ExampleConstantsInterface::UPCE_BODY_SHORT;

  // Create Card Image Example.
  $file_data = file_get_contents(__DIR__ . '/../images/card-image.jpg');
  $directory = 'public://example-content/';
  \Drupal::service('file_system')->prepareDirectory($directory, FileSystemInterface::CREATE_DIRECTORY);
  $file = file_save_data($file_data, 'public://example-content/card-image.jpg', FileSystemInterface::EXISTS_REPLACE);
  $media = Media::create([
    'bundle' => 'image',
    'uid' => \Drupal::currentUser()->id(),
    'field_media_image' => [
      'target_id' => $file->id(),
    ],
  ]);
  $media->setName('Example Card Image')->setPublished(TRUE)->save();

  $taxonomyStorage = \Drupal::service('entity_type.manager')
    ->getStorage('taxonomy_term');
  $properties['vid'] = 'uswds_breakpoints';

  // Set name properties.
  $properties['name'] = 'desktop';

  // Load taxonomy term by properties.
  $terms = $taxonomyStorage->loadByProperties($properties);
  $desktop = reset($terms);

  // Create Breakpoints.
  $breakpoint1 = Paragraph::create([
    'type' => 'uswds_card_breakpoints',
    'field_number_of_columns' => [
      "value" => '12',
    ],
    'field_uswds_breakpoints' => [
      "target_id" => $desktop->id(),
    ],
  ]);
  $breakpoint1->save();

  $breakpoint2 = Paragraph::create([
    'type' => 'uswds_card_breakpoints',
    'field_number_of_columns' => [
      "value" => '6',
    ],
    'field_uswds_breakpoints' => [
      "target_id" => $desktop->id(),
    ],
  ]);
  $breakpoint2->save();

  // Create Flag Card.
  $flag1 = Paragraph::create([
    'type' => 'uswds_cards_flag',
    'field_card_title' => [
      "value" => '12 Column left image Flag',
    ],
    'field_card_breakpoints' => [
      'target_id' => $breakpoint1->id(),
      'target_revision_id' => $breakpoint1->getRevisionId(),
    ],
    'field_image_position' => [
      'value' => 'left',
    ],
    'field_card_image' => [
      'target_id' => $media->id(),
    ],
    'field_text' => [
      "value" => $body,
      "format" => "basic_html",
    ],
    'field_make_card_link' => [
      'value' => FALSE,
    ],
    'field_button' => [
      'uri' => 'https://google.com',
      'title' => 'Visit Google',
    ],
  ]);
  $flag1->save();

  $flag2 = Paragraph::create([
    'type' => 'uswds_cards_flag',
    'field_card_breakpoints' => [
      'target_id' => $breakpoint1->id(),
      'target_revision_id' => $breakpoint1->getRevisionId(),
    ],
    'field_card_title' => [
      "value" => '12 Column right image Flag',
    ],
    'field_image_position' => [
      'value' => 'right',
    ],
    'field_card_image' => [
      'target_id' => $media->id(),
    ],
    'field_text' => [
      "value" => $body,
      "format" => "basic_html",
    ],
    'field_make_card_link' => [
      'value' => FALSE,
    ],
    'field_button' => [
      'uri' => 'https://google.com',
      'title' => 'Visit Google',
    ],
  ]);
  $flag2->save();

  $flag3 = Paragraph::create([
    'type' => 'uswds_cards_flag',
    'field_card_breakpoints' => [
      'target_id' => $breakpoint1->id(),
      'target_revision_id' => $breakpoint1->getRevisionId(),
    ],
    'field_card_title' => [
      "value" => '12 Column left image Flag Whole Card Link',
    ],
    'field_image_position' => [
      'value' => 'left',
    ],
    'field_card_image' => [
      'target_id' => $media->id(),
    ],
    'field_text' => [
      "value" => $body,
      "format" => "basic_html",
    ],
    'field_make_card_link' => [
      'value' => TRUE,
    ],
    'field_button' => [
      'uri' => 'https://google.com',
      'title' => 'Visit Google',
    ],
  ]);
  $flag3->save();

  $flag4 = Paragraph::create([
    'type' => 'uswds_cards_flag',
    'field_card_breakpoints' => [
      'target_id' => $breakpoint1->id(),
      'target_revision_id' => $breakpoint1->getRevisionId(),
    ],
    'field_card_title' => [
      "value" => '12 Column left image Flag Whole Card Link',
    ],
    'field_image_position' => [
      'value' => 'left',
    ],
    'field_card_image' => [
      'target_id' => $media->id(),
    ],
    'field_text' => [
      "value" => $body,
      "format" => "basic_html",
    ],
    'field_make_card_link' => [
      'value' => TRUE,
    ],
    'field_button' => [
      'uri' => 'https://google.com',
      'title' => 'Visit Google',
    ],
  ]);
  $flag4->save();

  // Create Flag Group.
  $flag_group1 = Paragraph::create([
    'type' => 'uswds_card_group_flag',
    'field_cards' => [
      [
        'target_id' => $flag1->id(),
        'target_revision_id' => $flag1->getRevisionId(),
      ],
      [
        'target_id' => $flag2->id(),
        'target_revision_id' => $flag2->getRevisionId(),
      ],
      [
        'target_id' => $flag3->id(),
        'target_revision_id' => $flag3->getRevisionId(),
      ],
      [
        'target_id' => $flag4->id(),
        'target_revision_id' => $flag4->getRevisionId(),
      ],
    ],
    'field_alternating_flags' => [
      'value' => FALSE,
    ],
    'field_uswds_classes' => [
      'target_id' => '',
    ],
  ]);
  $flag_group1->save();

  $flag_group2 = Paragraph::create([
    'type' => 'uswds_card_group_flag',
    'field_cards' => [
      [
        'target_id' => $flag1->id(),
        'target_revision_id' => $flag1->getRevisionId(),
      ],
      [
        'target_id' => $flag2->id(),
        'target_revision_id' => $flag2->getRevisionId(),
      ],
      [
        'target_id' => $flag3->id(),
        'target_revision_id' => $flag3->getRevisionId(),
      ],
      [
        'target_id' => $flag4->id(),
        'target_revision_id' => $flag4->getRevisionId(),
      ],
    ],
    'field_alternating_flags' => [
      'value' => TRUE,
    ],
    'field_uswds_classes' => [
      'target_id' => '',
    ],
  ]);
  $flag_group2->save();

  $node = Node::create([
    'type' => 'uswds_page',
    'title' => 'USWDS Paragraph Components Example Cards Flag',
    'body' => [
      "value" => 'First Group is not alternating.  2nd Group is alternating images.',
      "format" => "basic_html",
    ],
    'field_uswds_paragraphs' => [
      [
        'target_id' => $flag_group1->id(),
        'target_revision_id' => $flag_group1->getRevisionId(),
      ],
      [
        'target_id' => $flag_group2->id(),
        'target_revision_id' => $flag_group2->getRevisionId(),
      ],
    ],
    'created' => time(),
    'status' => 0,
  ]);
  $node->save();

  // Generate Regular Cards.
  $regular1 = Paragraph::create([
    'type' => 'uswds_card_regular',
    'field_card_breakpoints' => [
      'target_id' => $breakpoint2->id(),
      'target_revision_id' => $breakpoint2->getRevisionId(),
    ],
    'field_card_title' => [
      "value" => '6 column Regular Card',
    ],
    'field_extend_media' => [
      'value' => FALSE,
    ],
    'field_indent_media' => [
      'value' => FALSE,
    ],
    'field_title_first' => [
      'value' => FALSE,
    ],
    'field_card_image' => [
      'target_id' => $media->id(),
    ],
    'field_text' => [
      "value" => $body,
      "format" => "basic_html",
    ],
    'field_make_card_link' => [
      'value' => FALSE,
    ],
    'field_button' => [
      'uri' => 'https://google.com',
      'title' => 'Visit Google',
    ],
  ]);
  $regular1->save();

  $regular2 = Paragraph::create([
    'type' => 'uswds_card_regular',
    'field_card_breakpoints' => [
      'target_id' => $breakpoint2->id(),
      'target_revision_id' => $breakpoint2->getRevisionId(),
    ],
    'field_card_title' => [
      "value" => '6 column Extend Media Card',
    ],
    'field_extend_media' => [
      'value' => TRUE,
    ],
    'field_indent_media' => [
      'value' => FALSE,
    ],
    'field_title_first' => [
      'value' => FALSE,
    ],
    'field_card_image' => [
      'target_id' => $media->id(),
    ],
    'field_text' => [
      "value" => $body,
      "format" => "basic_html",
    ],
    'field_make_card_link' => [
      'value' => FALSE,
    ],
    'field_button' => [
      'uri' => 'https://google.com',
      'title' => 'Visit Google',
    ],
  ]);
  $regular2->save();

  $regular3 = Paragraph::create([
    'type' => 'uswds_card_regular',
    'field_card_breakpoints' => [
      'target_id' => $breakpoint2->id(),
      'target_revision_id' => $breakpoint2->getRevisionId(),
    ],
    'field_card_title' => [
      "value" => '6 Column Indent image Whole Card Link',
    ],
    'field_extend_media' => [
      'value' => FALSE,
    ],
    'field_indent_media' => [
      'value' => TRUE,
    ],
    'field_title_first' => [
      'value' => FALSE,
    ],
    'field_card_image' => [
      'target_id' => $media->id(),
    ],
    'field_text' => [
      "value" => $body,
      "format" => "basic_html",
    ],
    'field_make_card_link' => [
      'value' => TRUE,
    ],
    'field_button' => [
      'uri' => 'https://google.com',
      'title' => 'Visit Google',
    ],
  ]);
  $regular3->save();

  $regular4 = Paragraph::create([
    'type' => 'uswds_card_regular',
    'field_card_breakpoints' => [
      'target_id' => $breakpoint2->id(),
      'target_revision_id' => $breakpoint2->getRevisionId(),
    ],
    'field_card_title' => [
      "value" => '6 Column Title First Whole Card Link',
    ],
    'field_extend_media' => [
      'value' => FALSE,
    ],
    'field_indent_media' => [
      'value' => FALSE,
    ],
    'field_title_first' => [
      'value' => TRUE,
    ],
    'field_card_image' => [
      'target_id' => $media->id(),
    ],
    'field_text' => [
      "value" => $body,
      "format" => "basic_html",
    ],
    'field_make_card_link' => [
      'value' => TRUE,
    ],
    'field_button' => [
      'uri' => 'https://google.com',
      'title' => 'Visit Google',
    ],
  ]);
  $regular4->save();

  $regular_group1 = Paragraph::create([
    'type' => 'uswds_card_group_regular',
    'field_cards' => [
      [
        'target_id' => $regular1->id(),
        'target_revision_id' => $regular1->getRevisionId(),
      ],
      [
        'target_id' => $regular2->id(),
        'target_revision_id' => $regular2->getRevisionId(),
      ],
      [
        'target_id' => $regular3->id(),
        'target_revision_id' => $regular3->getRevisionId(),
      ],
      [
        'target_id' => $regular4->id(),
        'target_revision_id' => $regular4->getRevisionId(),
      ],
    ],
    'field_uswds_classes' => [
      'target_id' => '',
    ],
  ]);
  $regular_group1->save();

  $regular_card_node = Node::create([
    'type' => 'uswds_page',
    'title' => 'USWDS Paragraph Components Example Cards Regular',
    'body' => [
      "value" => '1 Card Group',
      "format" => "basic_html",
    ],
    'field_uswds_paragraphs' => [
      [
        'target_id' => $regular_group1->id(),
        'target_revision_id' => $regular_group1->getRevisionId(),
      ],
    ],
    'created' => time(),
    'status' => 0,
  ]);
  $regular_card_node->save();
}
