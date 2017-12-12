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
This can bne easily overriden by using your own template (see Advanced Usage) 

## Usage (basic)

You can use Gallery module administration to create galleries using photos uploaded through Media module. Each gallery
will generate a short code snippet that you can copy and paste either into the blade template, or into any page or
article (created for example using Page or Blog module).

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
Gallery module uses baguetteBox.js library (https://feimosi.github.io/baguetteBox.js/).
In order to get full frontend functionality running:
* include baguetteBox.js JavaScript file into your page. You can either use local copy from the module Assets folder, or load
it from CDN 
`<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.9.1/baguetteBox.min.js" async></script>`
* include baguetteBox.js CSS file into your page
`<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.9.1/baguetteBox.min.css" />`

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

## Resources

- [License](LICENSE.md)
- [Asgard Documentation](http://asgardcms.com/docs/)