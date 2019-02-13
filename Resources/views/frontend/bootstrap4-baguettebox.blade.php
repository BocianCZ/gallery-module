<?php /** @var \Modules\Gallery\Entities\Gallery $gallery */ ?>
<?php $galleryId = 'bociancz-gallery-' . $gallery->system_name; ?>
<div class="row" id="{{ $galleryId }}">
    @foreach($gallery->files as $picture)
        <div class="col-sm-3 col-xs-6">
            <a href="{{ $picture->path_string }}" target="_blank">
                <img class="img-fluid" src="{{ $picture->path_string }}" />
            </a>
        </div>
    @endforeach
</div>

<script type="text/javascript">
    window.addEventListener('load', function() {
        baguetteBox.run('#{{ $galleryId }}');
    });
</script>