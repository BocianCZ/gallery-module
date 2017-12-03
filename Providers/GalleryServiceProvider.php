<?php

namespace Modules\Gallery\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Traits\CanGetSidebarClassForModule;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Gallery\Entities\Gallery;
use Modules\Gallery\Events\Handlers\RegisterGallerySidebar;
use Modules\Gallery\Repositories\Cache\CacheGalleryDecorator;
use Modules\Gallery\Repositories\Eloquent\EloquentGalleryRepository;
use Modules\Gallery\Repositories\GalleryRepository;

class GalleryServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration, CanGetSidebarClassForModule;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();

        $this->app['events']->listen(
            BuildingSidebar::class,
            $this->getSidebarClassForModule('gallery', RegisterGallerySidebar::class)
        );
    }

    public function boot()
    {
        $this->publishConfig('gallery', 'permissions');
        $this->publishConfig('gallery', 'config');
        $this->registerBladeTags();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function registerBindings()
    {
        $this->app->bind(GalleryRepository::class, function () {
            $repository = new EloquentGalleryRepository(new Gallery());

            if (! config('app.cache')) {
                return $repository;
            }

            return new CacheGalleryDecorator($repository);
        });
    }

    protected function registerBladeTags()
    {
        if (app()->environment() === 'testing') {
            return;
        }
//        $this->app['blade.compiler']->directive('gallery', function ($value) {
/*            return "<?php echo GalleryPresenter::show([$value]); ?>";*/
//        });
    }
}
