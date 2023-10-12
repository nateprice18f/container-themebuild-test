<?php

/**
 * @file
 * Generate Accordion Content.
 */

use Drupal\node\Entity\Node;
use Drupal\paragraphs\Entity\Paragraph;
use Drupal\uswds_paragraph_components_examples\ExampleConstantsInterface;

/**
 * Generate Accordion Paragraph Bundles + Node.
 *
 * @throws \Drupal\Core\Entity\EntityStorageException
 */
function generate_accordion_paragraphs() {
  $body = ExampleConstantsInterface::UPCE_BODY_LONG;

  $body_accordion = Paragraph::create([
    'type' => 'text_field',
    'field_text' => [
      "value" => $body,
      "format" => "basic_html",
    ],
  ]);
  $body_accordion->save();

  // Reuse this Accordion Section.
  $accordionSection = Paragraph::create([
    'type' => 'uswds_accordion_section',
    'field_accordion_section_body' => [
      'target_id' => $body_accordion->id(),
      'target_revision_id' => $body_accordion->getRevisionId(),
    ],
    'field_accordion_section_title' => [
      "value" => 'Accordion Title Example',
    ],
  ]);
  $accordionSection->save();

  $accordion1 = Paragraph::create([
    'type' => 'uswds_accordion',
    'field_accordion_section' => [
      [
        'target_id' => $accordionSection->id(),
        'target_revision_id' => $accordionSection->getRevisionId(),
      ],
      [
        'target_id' => $accordionSection->id(),
        'target_revision_id' => $accordionSection->getRevisionId(),
      ],
    ],
    'field_bordered' => [
      "value" => FALSE,
    ],
    'field_multiselect' => [
      "value" => FALSE,
    ],
  ]);
  $accordion1->save();

  $accordion2 = Paragraph::create([
    'type' => 'uswds_accordion',
    'field_accordion_section' => [
      [
        'target_id' => $accordionSection->id(),
        'target_revision_id' => $accordionSection->getRevisionId(),
      ],
      [
        'target_id' => $accordionSection->id(),
        'target_revision_id' => $accordionSection->getRevisionId(),
      ],
    ],
    'field_bordered' => [
      "value" => TRUE,
    ],
    'field_multiselect' => [
      "value" => TRUE,
    ],
  ]);
  $accordion2->save();

  $accordion3 = Paragraph::create([
    'type' => 'uswds_accordion',
    'field_accordion_section' => [
      [
        'target_id' => $accordionSection->id(),
        'target_revision_id' => $accordionSection->getRevisionId(),
      ],
      [
        'target_id' => $accordionSection->id(),
        'target_revision_id' => $accordionSection->getRevisionId(),
      ],
    ],
    'field_bordered' => [
      "value" => FALSE,
    ],
    'field_multiselect' => [
      "value" => TRUE,
    ],
  ]);
  $accordion3->save();

  $node = Node::create([
    'type' => 'uswds_page',
    'title' => 'USWDS Paragraph Components Example Accordion',
    'body' => [
      'value' => '<p>Each Accordion contains 2 accordions.</p><p>First set is not border and not multiselect</p><p>Second set contains both border and multiselect</p><p>Third set contains just mutliselect</p>',
      "format" => "basic_html",
    ],
    'field_uswds_paragraphs' => [
      [
        'target_id' => $accordion1->id(),
        'target_revision_id' => $accordion1->getRevisionId(),
      ],
      [
        'target_id' => $accordion2->id(),
        'target_revision_id' => $accordion2->getRevisionId(),
      ],
      [
        'target_id' => $accordion3->id(),
        'target_revision_id' => $accordion3->getRevisionId(),
      ],
    ],
    'created' => time(),
    'status' => 0,
  ]);
  $node->save();
}
