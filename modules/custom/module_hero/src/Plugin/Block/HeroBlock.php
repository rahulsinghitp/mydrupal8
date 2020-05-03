<?php

namespace Drupal\module_hero\Plugin\Block;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Block\BlockBase;

/**
 * Provides a block called example Hero block
 *
 * @Block(
 *   id = "module_hero_block",
 *   admin_label = @Translation("Module Hero Block")
 * )
 */
class HeroBlock extends BlockBase {

    /**
     * {@inheritdoc}
     */
    public function build() {
        $heroes = [
            ['name' => 'Wolverine', 'real_name' => 'Logan'],
            ['name' => 'Spider-Man', 'real_name' => 'Peter'],
            ['name' => 'Thor', 'real_name' => 'Thor'],
            ['name' => 'Captain America', 'real_name' => 'Steve'],
            ['name' => 'Hulk', 'real_name' => 'Bruce'],
            ['name' => 'Iron Man', 'real_name' => 'Tony'],
            ['name' => 'Hawk Eye', 'real_name' => 'Clint'],
            ['name' => 'Punisher', 'real_name' => 'Fred'],
        ];

        $table = [
            '#type' => 'table',
            '#header' => [$this->t('Hero Name'), $this->t('Real Name')],
        ];

        foreach ($heroes as $hero) {
            $table[] = [
                'hero_name' => ['#type' => 'markup', '#markup' => $hero['name']],
                'real_name' => ['#type' => 'markup', '#markup' => $hero['real_name']],
            ];
        }

        return $table;
    }
}