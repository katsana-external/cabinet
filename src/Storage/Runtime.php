<?php

namespace Laravie\Cabinet\Storage;

use Closure;
use Illuminate\Cache\ArrayStore;
use Laravie\Cabinet\Contracts\Storage;
use Illuminate\Cache\Repository as CacheRepository;

class Runtime implements Storage
{
    protected $cache;

    public function __construct()
    {
        $this->cache = new CacheRepository(new ArrayStore());
    }

    /**
     * Get an item from the cache, or store the default value.
     *
     * @param  string  $key
     * @param  \DateTimeInterface|\DateInterval|float|int|string  $duration
     * @param  \Closure  $callback
     *
     * @return mixed
     */
    public function remember(string $key, $duration, Closure $callback)
    {
        return $this->cache->sear($key, $callback);
    }

    /**
     * Remove an item from the cache.
     *
     * @param  string  $key
     *
     * @return bool
     */
    public function forget(string $key): bool
    {
        return $this->cache->forget($key);
    }

    /**
     * Remove all items from the cache.
     *
     * @return void
     */
    public function flush(): void
    {
        $this->cache->clear();
    }
}
