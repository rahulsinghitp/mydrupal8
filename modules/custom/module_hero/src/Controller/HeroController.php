<?php

/**
 * For document
 * Hero controller doc
 */
namespace Drupal\module_hero\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\module_hero\HeroArticleService;
use Drupal\Core\Config\ConfigFactory;

/**
 * Herocontroller Class
 */
class HeroController extends ControllerBase
{

    private $articleHeroService;
    protected $configFactory;

    /**
     *
     */
    public static function create(ContainerInterface $contianer) {
        return new static(
            $contianer->get('module_hero.hero_articles'),
            $contianer->get('config.factory')
        );
    }

    public function __construct(HeroArticleService $articleHeroService, ConfigFactory $configFactory) {
        $this->articleHeroService = $articleHeroService;
        $this->configFactory = $configFactory;
    }

    /**
     * Function to return herolist
     *
     * @return []
     *   herolist
     */
    public function herolist()
    {
        //kint($this->configFactory->get('module_hero.settings')->get('hero_list_title'));die();
        $heroes = [
            ['name' => 'Wolverine'],
            ['name' => 'Spider-Man'],
            ['name' => 'Thor'],
            ['name' => 'Captain America'],
            ['name' => 'Hulk'],
            ['name' => 'Iron Man'],
            ['name' => 'Hawk Eye'],
            ['name' => 'Punisher'],
        ];

        return [
            '#theme' => 'hero_list',
            '#items' => $heroes,
            '#title' => $this->configFactory->get('module_hero.settings')->get('hero_list_title'),
        ];
    }
}