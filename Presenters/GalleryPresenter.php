<?php

namespace Modules\Gallery\Presenters;


use Illuminate\View\Factory;
use Modules\Gallery\Entities\Gallery;
use Modules\Gallery\Repositories\GalleryRepository;

class GalleryPresenter
{
    const TEMPLATE_DEFAULT = 'partials.gallery';
    const TEMPLATE_FALLBACK = 'gallery::frontend.bootstrap3-baguettebox';

    /** @var GalleryRepository */
    protected $galleryRepository;

    /** @var Factory */
    protected $viewFactory;

    public function __construct(GalleryRepository $galleryRepository, Factory $viewFactory)
    {
        $this->galleryRepository = $galleryRepository;
        $this->viewFactory = $viewFactory;
    }

    public function renderGalleries($html)
    {
        preg_match_all('/\[\[GALLERY\((.*)\)\]\]/U', $html, $matches);
        $replaceGalleries = [];
        foreach ($matches[1] as $galleryIndex => $galleryName) {
            // prevent loading same gallery twice
            if (isset($replaceGalleries[$matches[0][$galleryIndex]])) {
                continue;
            }

            $gallery = $this->galleryRepository->findByAttributes(['system_name' => $galleryName]);
            if ($gallery) {
                $replaceGalleries[$matches[0][$galleryIndex]] = $this->render($gallery);
            }
        }

        return str_replace(array_keys($replaceGalleries), $replaceGalleries, $html);
    }

    /**
     * @param Gallery|string $gallery
     * @param string|null $template
     * @return string
     */
    public function render($gallery, $template = null)
    {
        if (!$gallery instanceof Gallery && is_string($gallery)) {
            $gallery = $this->galleryRepository->findByAttributes(['system_name' => $gallery]);
        }
        if (!$gallery) {
            return '';
        }

        $view = $this->viewFactory->make($this->findTemplate($template))
            ->with([
                'gallery' => $gallery
            ]);

        return $view->render();
    }

    /**
     * @param string $template
     * @return string
     */
    private function findTemplate($template)
    {
        if ($this->viewFactory->exists($template)) {
            return $template;
        } elseif ($this->viewFactory->exists(self::TEMPLATE_DEFAULT)) {
            return self::TEMPLATE_DEFAULT;
        } elseif ($this->viewFactory->exists('gallery::frontend.' . setting('gallery::default-template'))) {
            return 'gallery::frontend.' . setting('gallery::default-template');
        }

        return self::TEMPLATE_FALLBACK;
    }

}