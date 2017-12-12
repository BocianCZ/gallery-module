@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('gallery::galleries.galleries') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('gallery::galleries.galleries') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.gallery.galleries.create') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('gallery::galleries.create gallery') }}
                    </a>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="data-table table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>{{ trans('gallery::galleries.name') }}</th>
                            <th>{{ trans('gallery::galleries.snippet') }}</th>
                            <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (isset($galleries))
                            @foreach ($galleries as $gallery)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.gallery.galleries.edit', [$gallery->id]) }}">
                                        {{ $gallery->name }}
                                    </a>
                                </td>
                                <td>
                                    {{ $gallery->snippet }}
                                </td>

                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.gallery.galleries.edit', [$gallery->id]) }}"
                                           class="btn btn-default btn-flat"
                                        >
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button
                                            class="btn btn-danger btn-flat"
                                            data-toggle="modal"
                                            data-target="#modal-delete-confirmation"
                                            data-action-target="{{ route('admin.gallery.galleries.destroy', [$gallery->id]) }}"
                                        >
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
    @include('core::partials.delete-modal')
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>c</code></dt>
        <dd>{{ trans('gallery::galleries.title.create gallery') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.gallery.galleries.create') ?>" }
                ]
            });
        });
    </script>
    <?php $locale = locale(); ?>
    <script type="text/javascript">
        $(function () {
            $('.data-table').dataTable({
                "paginate": true,
                "lengthChange": true,
                "filter": true,
                "sort": true,
                "info": true,
                "autoWidth": true,
                "order": [[ 0, "asc" ]],
                "language": {
                    "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
                }
            });
        });
    </script>
@endpush
