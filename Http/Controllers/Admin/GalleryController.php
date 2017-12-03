<?php

namespace Modules\Gallery\Http\Controllers\Admin;

use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Gallery\Entities\Gallery;
use Modules\Gallery\Http\Requests\CreateGalleryRequest;
use Modules\Gallery\Http\Requests\UpdateGalleryRequest;
use Modules\Gallery\Repositories\GalleryRepository;

class GalleryController extends AdminBaseController
{
    /** @var GalleryRepository */
    private $galleryRepository;

    public function __construct(GalleryRepository $galleryRepository)
    {
        parent::__construct();

        $this->galleryRepository = $galleryRepository;
    }

    public function index()
    {
        return view('gallery::admin.galleries.index')
            ->with([
                'galleries' => $this->galleryRepository->all()
            ]);
    }

    public function create()
    {
        return view('gallery::admin.galleries.create');
    }

    public function store(CreateGalleryRequest $request)
    {
        $this->galleryRepository->create($request->all());

        return redirect()->route('admin.gallery.galleries.index')
            ->withSuccess(
                trans('core::core.messages.resource created', ['name' => trans('gallery::galleries.gallery')])
            );
    }

    public function edit(Gallery $gallery)
    {
        return view('gallery::admin.galleries.edit')
            ->with([
                'gallery' => $gallery
            ]);
    }

    public function update(Gallery $gallery, UpdateGalleryRequest $request)
    {
        $this->galleryRepository->update($gallery, $request->all());

        return redirect()->route('admin.gallery.galleries.index')
            ->withSuccess(
                trans('core::core.messages.resource updated', ['name' => trans('gallery::galleries.gallery')])
            );
    }

    public function destroy(Gallery $gallery)
    {
        $this->galleryRepository->destroy($gallery);

        return redirect()->route('admin.gallery.galleries.index')
            ->withSuccess(
                trans('core::core.messages.resource deleted', ['name' => trans('gallery::galleries.gallery')])
            );
    }

}
