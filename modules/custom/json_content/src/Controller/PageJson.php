<?php

namespace Drupal\json_content\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\NodeInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Access\AccessResult;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * PageJson Class
 */
class PageJson extends ControllerBase {

    protected $configFactory;

    /**
     * {@inheritdoc}
     */
    public static function create(ContainerInterface $contianer) {
        return new static(
            $contianer->get('config.factory')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function __construct(ConfigFactory $configFactory) {
        $this->configFactory = $configFactory;
    }

    /**
     * Get json data of Page type content
     *
     * @param
     *  $site_pai_key site api key to access the url to get get json data of page
     *  $node page type node object
     *
     * @return
     *  - nid, title and body of page
     */
    public function getjsondata($site_api_key, NodeInterface $node) {
        $response = new JsonResponse();
        $data = [
            'nid' => $node->id(),
            'title' => $node->get('title')->getValue()[0]['value'],
            'body' => $node->get('body')->getValue()[0]['value'],
        ];

        $response->setData($data);
        return $response;
    }

    /**
     * Access callback for Json Content of Page
     * @param
     *  $site_pai_key site api key to access the url to get get json data of page
     *  $node page type node object
     *
     * @return
     *  AccessResult object
     */
    public function accesjsondata($site_api_key, NodeInterface $node) {
        $saved_api_key = $this->configFactory->get('system.site')->get('siteapikey');

        // If not same site api key Access denied
        if ($site_api_key != $saved_api_key) {

            // Return 403 Access Denied page.
            return AccessResult::forbidden();
        }

        // If not page node Access denied
        if ($node->getType() != 'page') {

            // Return 403 Access Denied page.
            return AccessResult::forbidden();
        }

        // Allowed
        return AccessResult::allowed();
    }
}