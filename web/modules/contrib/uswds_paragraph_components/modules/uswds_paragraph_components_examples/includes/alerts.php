<?php

/**
 * @file
 * Generate Alert Content.
 */

use Drupal\node\Entity\Node;
use Drupal\paragraphs\Entity\Paragraph;
use Drupal\uswds_paragraph_components_examples\ExampleConstantsInterface;

/**
 * Generate Alert Paragraph Bundles + Node.
 *
 * @throws \Drupal\Core\Entity\EntityStorageException
 */
function generate_alert_paragraphs() {
  $body = ExampleConstantsInterface::UPCE_BODY_SHORT;

  $alertParagraph1 = Paragraph::create([
    'type' => 'uswds_alert',
    'field_alert_body' => [
      "value" => $body,
      "format" => "basic_html",
    ],
    'field_alert_status' => [
      "value" => 'info',
    ],
    'field_alert_title' => [
      "value" => 'Info Alert with Icon and No Slim',
    ],
    'field_no_icon' => [
      "value" => FALSE,
    ],
    'field_slim' => [
      "value" => FALSE,
    ],
  ]);
  $alertParagraph1->save();

  $alertParagraph2 = Paragraph::create([
    'type' => 'uswds_alert',
    'field_alert_body' => [
      "value" => $body,
      "format" => "basic_html",
    ],
    'field_alert_status' => [
      "value" => 'warning',
    ],
    'field_alert_title' => [
      "value" => 'Warning Alert with Icon and No Slim',
    ],
    'field_no_icon' => [
      "value" => FALSE,
    ],
    'field_slim' => [
      "value" => FALSE,
    ],
  ]);
  $alertParagraph2->save();

  $alertParagraph3 = Paragraph::create([
    'type' => 'uswds_alert',
    'field_alert_body' => [
      "value" => $body,
      "format" => "basic_html",
    ],
    'field_alert_status' => [
      "value" => 'error',
    ],
    'field_alert_title' => [
      "value" => 'Error Alert with Icon and No Slim',
    ],
    'field_no_icon' => [
      "value" => FALSE,
    ],
    'field_slim' => [
      "value" => FALSE,
    ],
  ]);
  $alertParagraph3->save();

  $alertParagraph4 = Paragraph::create([
    'type' => 'uswds_alert',
    'field_alert_body' => [
      "value" => $body,
      "format" => "basic_html",
    ],
    'field_alert_status' => [
      "value" => 'success',
    ],
    'field_alert_title' => [
      "value" => 'Success Alert with Icon and No Slim',
    ],
    'field_no_icon' => [
      "value" => FALSE,
    ],
    'field_slim' => [
      "value" => FALSE,
    ],
  ]);
  $alertParagraph4->save();

  $alertParagraph5 = Paragraph::create([
    'type' => 'uswds_alert',
    'field_alert_body' => [
      "value" => $body,
      "format" => "basic_html",
    ],
    'field_alert_status' => [
      "value" => 'info',
    ],
    'field_alert_title' => [
      "value" => 'Info Alert with No Icon and No Slim',
    ],
    'field_no_icon' => [
      "value" => TRUE,
    ],
    'field_slim' => [
      "value" => FALSE,
    ],
  ]);
  $alertParagraph5->save();

  $alertParagraph6 = Paragraph::create([
    'type' => 'uswds_alert',
    'field_alert_body' => [
      "value" => $body,
      "format" => "basic_html",
    ],
    'field_alert_status' => [
      "value" => 'info',
    ],
    'field_alert_title' => [
      "value" => 'Info Alert with No Icon and Slim',
    ],
    'field_no_icon' => [
      "value" => TRUE,
    ],
    'field_slim' => [
      "value" => TRUE,
    ],
  ]);
  $alertParagraph6->save();

  $node = Node::create([
    'type'        => 'uswds_page',
    'title'       => 'USWDS Paragraph Components Example Alert',
    'body' => [
      'value' => '<p>Each Accordion contains 2 accordions.</p><p>First set is not border and not multiselect</p><p>Second set contains both border and multiselect</p><p>Third set contains just mutliselect</p>',
      "format" => "basic_html",
    ],
    'field_uswds_paragraphs'  => [
      [
        'target_id' => $alertParagraph1->id(),
        'target_revision_id' => $alertParagraph1->getRevisionId(),
      ],
      [
        'target_id' => $alertParagraph2->id(),
        'target_revision_id' => $alertParagraph2->getRevisionId(),
      ],
      [
        'target_id' => $alertParagraph3->id(),
        'target_revision_id' => $alertParagraph3->getRevisionId(),
      ],
      [
        'target_id' => $alertParagraph4->id(),
        'target_revision_id' => $alertParagraph4->getRevisionId(),
      ],
      [
        'target_id' => $alertParagraph5->id(),
        'target_revision_id' => $alertParagraph5->getRevisionId(),
      ],
      [
        'target_id' => $alertParagraph6->id(),
        'target_revision_id' => $alertParagraph6->getRevisionId(),
      ],
    ],
    'created' => time(),
    'status' => 0,
  ]);
  $node->save();
}
