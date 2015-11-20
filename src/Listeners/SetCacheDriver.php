<?php namespace Hyn\Cache\Listeners;

use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Foundation\Application;

class SetCacheDriver {

    static protected $called = false;

    /**
     * @var Application
     */
    protected $application;

    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    public function __construct(Application $application, SettingsRepositoryInterface $settings)
    {
        $this->application = $application;
        $this->settings = $settings;
    }

    public function subscribe(Dispatcher $event)
    {
        if(static::$called) { return; }


        // only actively do something in case the default cache driver has been changed
        if($this->settings->get('hyn.cache.driver', 'file') != 'file') {
            /** @var \Illuminate\Contracts\Config\Repository $config */
            $config = $this->application->make('config');

            $cacheConfig = [
                'driver' => $this->settings->get('hyn.cache.driver'),
            ];

            switch($this->settings->get('hyn.cache.driver')) {
                case 'database':
                    $merge = [
                        'table' => $this->settings->get('hyn.cache.table', 'cache'),
                        'connection' => $this->settings->get('hyn.cache.connection')
                    ];
                    break;
                case 'redis':
                    $merge = [
                        'connection' => $this->settings->get('hyn.cache.connection')
                    ];
                    break;
                case 'memcached':
                    // @todo..
                    break;
                default:
                    $merge = [];
            }

            // merges driver specific settings into the config
            $cacheConfig = array_merge($cacheConfig, $merge);

            // sets the cache store
            $config->set('cache.stores.hyn-cache', $cacheConfig);

            $config->set('cache.driver', 'hyn-cache');
        }
    }
}