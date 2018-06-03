<?php

namespace Modules\Newsletter\Repositories\Cache;

use Modules\Newsletter\Repositories\SubscriberRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheSubscriberDecorator extends BaseCacheDecorator implements SubscriberRepository
{
    public function __construct(SubscriberRepository $subscriber)
    {
        parent::__construct();
        $this->entityName = 'newsletter.subscribers';
        $this->repository = $subscriber;
    }
}
