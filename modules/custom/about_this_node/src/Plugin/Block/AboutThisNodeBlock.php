<?php
/**
 * @file
 * Contains \Drupal\about_this_node\Plugin\Block\AboutThisNodeBlock.
 */

namespace Drupal\about_this_node\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'Node information' block.
 *
 * Drupal\Core\Block\BlockBase gives us a very useful set of basic functionality
 * for this configurable block. We can just fill in a few of the blanks with
 * defaultConfiguration(), blockForm(), blockSubmit(), and build().
 *
 * @Block(
 *   id = "about_this_node_block",
 *   admin_label = @Translation("About this node block")
 * )
 */
class AboutThisNodeBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    $output = array();
    $node = \Drupal::routeMatch()->getParameter('node');
    if ($node) {
      if($node->id()){
        $node_info = about_this_node_get_info($node);
        $output =  array(
            '#theme' => 'about_this_node',
            '#node_info' => $node_info,
            '#cache' => [
                     'max-age' => 0,
                   ],
        );
      }
    }
    return $output;
  }
}