<div class="row">
    @foreach($gallery->files as $picture)
        <div class="col-sm-3 col-xs-6">
            <img class="img-responsive" src="{{ $picture->path_string }}" />
        </div>
    @endforeach
</div>