<?php /** @var \Modules\Gallery\Entities\Gallery $gallery */ ?>
<?php $galleryId = 'bociancz-gallery-' . $gallery->system_name; ?>
<div id="{{ $galleryId }}">
    @foreach($gallery->files as $picture)
        <a href="{{ $picture->path_string }}" target="_blank">
            <img src="{{ $picture->path_string }}" />
        </a>
    @endforeach
</div>

<style>
    #{{ $galleryId }} img {
        max-width: 100%;
    }
</style>