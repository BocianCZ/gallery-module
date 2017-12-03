<div class="box-body">
    {!! Form::normalInput('name', trans('gallery::galleries.name'), $errors, $gallery, ['data-slug' => 'source']) !!}
    {!! Form::normalInput('system_name', trans('gallery::galleries.system name'), $errors, $gallery, ['data-slug' => 'target']) !!}
</div>
