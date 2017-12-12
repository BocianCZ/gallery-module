<?php

namespace Modules\Gallery\Http\Middleware;


use Illuminate\Http\Response;
use Modules\Gallery\Presenters\GalleryPresenter;

class RenderGallery
{
    /** @var GalleryPresenter */
    protected $galleryPresenter;

    public function __construct(GalleryPresenter $galleryPresenter)
    {
        $this->galleryPresenter = $galleryPresenter;
    }

    public function handle($request, \Closure $next)
    {
        /** @var Response $response */
        $response = $next($request);

        // do not render galleries on backend
        if (app('asgard.onBackend') === true) {
            return $response;
        }

        // if this is not a standard Response, return right away
        if(!$response instanceof Response) {
            return $response;
        }

        $response->setContent($this->galleryPresenter->renderGalleries($response->getContent()));

        return $response;
    }
}
