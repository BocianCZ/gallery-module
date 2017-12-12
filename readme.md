# Gallery Module for AsgardCMS

## Special Thanks
to Nicolas Widart for AsgardCMS

## Installation
You can install Gallery module using composer:
`composer require bociancz/gallery-module`

After the module is installed, you have to give yourself access in AsgardCMS (using Roles/Permissions). 
New Gallery item will appear in the Sidebar.

## Prerequisites
Gallery module by default uses Bootstrap 3 grid system and `img-responsive` classes to render gallery thumbnmails.
If your frontend theme does not use bootstrap, you can load bootstrap CSS from CDN 
https://getbootstrap.com/docs/3.3/getting-started/ (bootstrap JavaScript is not needed).  
Alternatively, you can use your own blade template to render gallery (see Advanced Usage) 

## Usage (basic)

You can use Gallery module administration to create galleries using photos uploaded through Media module. Each gallery
will generate a short code snippet that you can copy and paste either into the blade template, or into any page or
article (created for example using Page or Blog module).

#### Register Middleware
In order for the code snippet to be transformed into gallery HTML code, you need to register `RenderGallery` middleware
to the routes you want gallery module to kick in.

This can be done globally by editing `app/Http/Kernel.php` file and adding `\Modules\Gallery\Http\Middleware\RenderGallery::class`
into the `$middlewareGroups` `web` group (this way, gallery will automatically render in all `web` routes on frontend):
```php
 
<?php
    // app/Http/Kernel.php
    ...
    protected $middlewareGroups = [
        'web' => [
            ...
            \Modules\Gallery\Http\Middleware\RenderGallery::class,
        ]
    ...
}
```

#### Gallery Frontend
Gallery module uses baguetteBox.js library (https://feimosi.github.io/baguetteBox.js/). BaguetteBox.js is a lightweight
(3.2kB minified/gzipped) responsive CSS3 gallery with no extra dependencies (i.e. jQuery is not needed)
  
In order to get full frontend functionality running:
* include baguetteBox.js JavaScript file into your page. You can simply load files from CDN 
`<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.9.1/baguetteBox.min.js" async></script>`
* include baguetteBox.js CSS file into your page
`<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.9.1/baguetteBox.min.css" />`

or you can use local assets provided with the module (see Advanced Usage)

## Usage (advanced)

#### Alternative middleware registration
If you do not like using Gallery middleware globally for the whole website, you can apply `gallery.render` middleware
alias selectively to the specific frontend routes in your application

```php
<?php
    // Modules/YourModule/Http/frontendRoutes.php
    ...
    // middleware will be applied to this specific route
    $router->get('your-url', 'YourController@method')
        ->middleware('gallery.render');
    ...
    // middleware will be applied to whole group
    $router->group(['middleware' => 'gallery.render'], function(Router $router) {
        $router->get('your-url', 'YourController@method');
        ...
    });
    ...
?>

```

#### Load frontend assets locally (not from CDN)
if you are not a fan of loading frontend assets from CDN, you can use local copy provided with the Gallery module
for convenience:
* first publish module assets `php artisan module:publish Gallery`
* use `<link rel="stylesheet" href="{!! Module::asset('gallery:css/baguetteBox.min.css') !!}" />` instead of the CDN CSS
* use `<script src="{!! Module::asset('gallery:js/baguetteBox.min.js') !!}" async></script>` instead of the CDN JS

#### Customize Gallery look
Gallery module has several pre-loaded templates. By default, it will use simple bootstrap-based template with 
gallery JavaScript plugin baguetteBox.js (no jQuery neded), located in
`Modules/Gallery/Resources/views/frontend/bootstrap3-baguettebox.blade.php`. There are several ways of changing this
this default behavior:

* you can go into the Gallery module Settings in admin interface, and enter one of the example gallery templates
into the "Default Template" field. Current options are `plain` (simple display of img tags), `plain-links`
(simple image tags, links open to new tab/window) or `bootstrap3-baguettebox` (Bootstrap 3 and BaguetteBox.js based
responsive template with lightbox - this is also a default option)

* you can create your own gallery template in `Theme/YourTheme/view/partials/gallery.blade.php`. If Gallery
module finds a file in this location, it will automatically use it instead of the default one. Feel free to copy
contents of one of the the module-provided samples to get an idea about what the file may look like.
There are several examples in the `Modules/Gallery/Resources/views/frontend` directory

The simplest gallery template example would be something like this:

```php
@foreach($gallery->files as $picture)
    <img src="{{ $picture->path_string }}" />
@endforeach
```
but you can of course override the file as you like. You have `$gallery` variable available in the template, which 
is an instance of `Modules\Gallery\Entities\Gallery` class.

* TODO: provide custom template name (to be added)

## Resources

- [License](LICENSE.md)
- [Asgard Documentation](http://asgardcms.com/docs/)