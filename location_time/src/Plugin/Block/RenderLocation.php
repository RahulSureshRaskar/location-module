<?php

namespace Drupal\location_time\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'RenderLocation' block.
 *
 * @Block(
 *  id = "render_location",
 *  admin_label = @Translation("Render location"),
 * )
 */
class RenderLocation extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Drupal\Core\Config\ConfigFactoryInterface definition.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    $instance = new static($configuration, $plugin_id, $plugin_definition);
    $instance->configFactory = $container->get('config.factory');
    return $instance;
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->configFactory->get('location_time.formlocation');
    $Country = $config->get('country');
    $City = $config->get('city');
    $Timezone = $config->get('timezone');

    $build = [];
    $build['#theme'] = 'render_location';
    $build['#Country'] = $Country;
    $build['#City'] = $City;
    $build['#Time'] = \Drupal::service('fetch_time')->getData($Timezone);

    $build['#cache'] = ['max-age' => 0];

    return $build;
  }

}
