<?php /** @var \Modules\Gallery\Entities\Gallery $gallery */ ?>
<?php $galleryId = 'bociancz-gallery-' . $gallery->system_name; ?>
<div id="{{ $galleryId }}">
    @foreach($gallery->files as $picture)
        <img src="{{ $picture->path_string }}" />
    @endforeach
</div>

<style>
    #{{ $galleryId }} img {
        max-width: 100%;
    }
</style>