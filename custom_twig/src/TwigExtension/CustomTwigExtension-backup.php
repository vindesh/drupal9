<?php

namespace Drupal\custom_twig\TwigExtension;

use Twig\Extension\ExtensionInterface;
use Twig\TwigFilter;
use Twig\TwigFunction;
use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Class CustomTwigExtension.
 */
class CustomTwigExtension extends \Twig_Extension {
    use StringTranslationTrait;
   /**
    * {@inheritdoc}
    */
    public function getFilters() {
      return [];
    }

   /**
    * {@inheritdoc}
    */
    public function getFunctions() {
      //return [];
      return [
        //new TwigFunction('node_breadcrumb', [$this, 'nodeBreadcrumb']),
        new \Twig_SimpleFunction('custom_node_breadcrumb', [$this, 'customNodeBreadcrumb']),
      ];
    }

   /**
    * {@inheritdoc}
    */
    public function getName() {
      return 'custom_twig.twig.extension';
    }

    /**
     * [customNodeBreadcrumb description]
     * @param  [type] $node [Entity type node]
     * @return [type]       [Breadcrumb of the node]
     */
    public function customNodeBreadcrumb($node) {
      if (!($node instanceof \Drupal\node\Entity\Node)) {
        return;
      }

      $url = \Drupal\Core\Url::fromRoute('<front>');
      $link = \Drupal\Core\Link::fromTextAndUrl($this->t('Home'), $url);
      $link = $link->toString();
      $title = $node->getTitle();
      $breadcrumb = '<div class="breadcrumb">'.$link.' / '.$title.'</div>' ;

      return $breadcrumb;
    }

}
