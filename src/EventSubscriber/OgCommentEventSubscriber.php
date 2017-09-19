<?php

namespace Drupal\og_comment\EventSubscriber;

use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\og\Event\PermissionEventInterface;
use Drupal\og\GroupPermission;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event subscribers for Organic Groups Comment.
 */
class OgCommentEventSubscriber implements EventSubscriberInterface {

  use StringTranslationTrait;

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    return [
      PermissionEventInterface::EVENT_NAME => [
        ['provideDefaultCommentPermissions'],
      ],
    ];
  }

  /**
   * Provides comment permissions to OG.
   *
   * @param \Drupal\og\Event\PermissionEventInterface $event
   *   The OG permission event.
   */
  public function provideDefaultCommentPermissions(PermissionEventInterface $event) {
    $event->setPermissions([
      new GroupPermission([
        'name' => 'administer comments',
        'title' => $this->t('Administer comments and comment settings'),
      ]),
      new GroupPermission([
        'name' => 'access comments',
        'title' => $this->t('View comments'),
      ]),
      new GroupPermission([
        'name' => 'post comments',
        'title' => $this->t('Post comments'),
      ]),
      new GroupPermission([
        'name' => 'skip comment approval',
        'title' => $this->t('Skip comment approval'),
      ]),
      new GroupPermission([
        'name' => 'edit own comments',
        'title' => $this->t('Edit own comments'),
      ]),
      new GroupPermission([
        'name' => 'delete own comments',
        'title' => $this->t('Delete own comments'),
      ]),
    ]);
  }

}
