<?php

namespace Drupal\mmf_core_fields\Plugin\Field\FieldWidget;

use Drupal\paragraphs\Plugin\Field\FieldWidget\InlineParagraphsWidget;

/**
 * Plugin implementation of the 'mmf_entity_reference_revisions' widget.
 *
 * @FieldWidget(
 *   id = "mmf_entity_reference_revisions",
 *   label = @Translation("Paragraph Classic MMF"),
 *   field_types = {
 *     "entity_reference_revisions"
 *   },
 * )
 */
class MmfEntityReferenceRevisionsWidget extends InlineParagraphsWidget {
  use MmfBase;
}
