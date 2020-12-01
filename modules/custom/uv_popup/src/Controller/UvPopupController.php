<?php

  namespace Drupal\uv_popup\Controller;

  use Drupal\Core\Cache\CacheableMetadata;
  use Drupal\Core\Controller\ControllerBase;
  use Drupal\node\NodeInterface;

  class UvPopupController extends ControllerBase {
    public function index(NodeInterface $node){
      $output = sprintf('<div class="node-short-info"><div class="node-short-info-title">Title:%s</div><div class="node-short-info-autor">Autir:%s</div><div class="node-short-info-body">Body:%s</div></div>',
        $node->getTitle(),
        $node->getOwner()->getDisplayName(),
        $node->get('body')->value
      );
      //https://drupal.ru/docs/videouroki/drupalbookru/12111-obrashchenie-k-polyam-v-entity
      //dpm($node->get('body')->value);
      //$node->get('title')->value;
      $render = [
        '#type' => 'inline_template',
        '#template' => $output,
      ];
      $cacheMetadata = new CacheableMetadata();
      $cacheMetadata->addCacheableDependency($node);
      $cacheMetadata->applyTo($render);
      return $render;
    }
  }
