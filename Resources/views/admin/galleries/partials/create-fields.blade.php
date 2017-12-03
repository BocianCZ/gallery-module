<div class="box-body">
    {!! Form::normalInput('name', trans('gallery::galleries.name'), $errors, null, ['data-slug' => 'source']) !!}
    {!! Form::normalInput('system_name', trans('gallery::galleries.system name'), $errors, null, ['data-slug' => 'target']) !!}
</div>
