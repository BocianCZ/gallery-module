<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->group(['prefix' => 'gallery'], function (Router $router) {
    $router->bind('gallery__gallery', function ($id) {
        return app(\Modules\Gallery\Repositories\GalleryRepository::class)->find($id);
    });

    $router->get('', 'GalleryController@index')
        ->name('admin.gallery.galleries.index')
        ->middleware('can:gallery.galleries.index');

    $router->get('create', 'GalleryController@create')
        ->name('admin.gallery.galleries.create')
        ->middleware('can:gallery.galleries.create');

    $router->post('', 'GalleryController@store')
        ->name('admin.gallery.galleries.store')
        ->middleware('can:gallery.galleries.create');

    $router->get('{gallery__gallery}/edit', 'GalleryController@edit')
        ->name('admin.gallery.galleries.edit')
        ->middleware('can:gallery.galleries.edit');

    $router->put('{gallery__gallery}', 'GalleryController@update')
        ->name('admin.gallery.galleries.update')
        ->middleware('can:gallery.galleries.edit');

    $router->delete('{gallery__gallery}', 'GalleryController@destroy')
        ->name('admin.gallery.galleries.destroy')
        ->middleware('can:gallery.galleries.destroy');

});
