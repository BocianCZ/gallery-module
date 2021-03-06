@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('gallery::galleries.create gallery') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.gallery.galleries.index') }}">{{ trans('gallery::galleries.galleries') }}</a></li>
        <li class="active">{{ trans('gallery::galleries.create gallery') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => 'admin.gallery.galleries.store', 'method' => 'post']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <div class="tab-content">
                    <div class="box-body">
                        {!! Form::normalInput('name', trans('gallery::galleries.name'), $errors, null, ['data-slug' => 'source']) !!}
                        {!! Form::normalInput('system_name', trans('gallery::galleries.system name'), $errors, null, ['data-slug' => 'target']) !!}
                        @mediaMultiple('gallery')
                    </div>


                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.create') }}</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.tag.tag.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                    </div>
                </div>
            </div> {{-- end nav-tabs-custom --}}
        </div>

    </div>
    {!! Form::close() !!}
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('core::core.back to index') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $('.selectize').selectize();
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.tag.tag.index') ?>" }
                ]
            });
        });
    </script>
    <script>
        $( document ).ready(function() {
            $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });
        });
    </script>
@endpush
