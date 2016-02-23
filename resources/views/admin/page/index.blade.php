@extends('admin::curd.index')
@section('heading')
<i class="fa fa-file-text-o"></i> {!! trans('page::page.name') !!} <small> {!! trans('cms.manage') !!} {!! trans('page::page.names') !!}</small>
@stop

@section('title')
{!! trans('page::page.names') !!}
@stop

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{!! trans_url('admin') !!}"><i class="fa fa-dashboard"></i> {!! trans('cms.home') !!} </a></li>
    <li class="active">{!! trans('page::page.names') !!}</li>
</ol>
@stop

@section('entry')
<div class="box box-warning" id='entry-page'>
</div>
@stop

@section('tools')
@stop

@section('content')
<table id="main-list" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>{!! trans('page::page.name') !!}</th>
            <th>{!! trans('page::page.label.title') !!}</th>
            <th>{!! trans('page::page.label.slug') !!}</th>
            <th>{!! trans('page::page.label.order') !!}</th>
        </tr>
    </thead>
</table>
@stop

@section('script')
<script type="text/javascript">
var oTable;
$(document).ready(function(){
    app.load('#entry-page','{{trans_url('/admin/page/page/0')}}');

    oTable = $('#main-list').DataTable( {
        "ajax": '{{ trans_url('/admin/page/page') }}',
        "columns": [
        { "data": "name" },
        { "data": "title" },
        { "data": "url" },
        { "data": "order" }],
        "order": [[ 1, "asc" ]],
        "pageLength": 50,
        "sPaginationType": "full_numbers"
    });

    $('#main-list tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        } else {
            oTable.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
        var d = $('#main-list').DataTable().row( this ).data();
        app.load('#entry-page', '{{trans_url('/admin/page/page')}}' + '/' + d.id);
    });
});
</script>
@stop

@section('style')

@stop
