<?php

namespace App\Listener;

use Hyperf\Event\Annotation\Listener;
use Hyperf\Database\Model\Events\Event;
use Hyperf\Database\Model\Events\Saved;
use Hyperf\Database\Model\Events\Deleted;
use Hyperf\ModelCache\CacheableInterface;
use Hyperf\Event\Contract\ListenerInterface;

/**
 * Every time one model gets created, updated or deleted it is removed from cache
 *
 * @Listener
 */
class DeleteCacheListener implements ListenerInterface
{
    public function listen(): array
    {
        return [
            Deleted::class,
            Saved::class,
        ];
    }

    public function process(object $event)
    {
        if ($event instanceof Event) {
            $model = $event->getModel();
            if ($model instanceof CacheableInterface) {
                $model->deleteCache();
            }
        }
    }
}
