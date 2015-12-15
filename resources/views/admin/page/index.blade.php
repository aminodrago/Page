@extends('admin::curd.index')
@section('heading')
<i class="fa fa-file-text-o"></i> {!! trans('page::page.name') !!} <small> {!! trans('cms.manage') !!} {!! trans('page::page.names') !!}</small>
@stop

@section('title')
{!! trans('page::page.names') !!}
@stop

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{!! Trans::to('admin') !!}"><i class="fa fa-dashboard"></i> {!! trans('cms.home') !!} </a></li>
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
    $('#entry-page').load('{{Trans::to('/admin/page/page/0')}}');
    oTable = $('#main-list').DataTable( {
        "ajax": '{{ Trans::to('/admin/page/page') }}',
        "columns": [
        { "data": "name" },
        { "data": "title" },
        { "data": "slug" },
        { "data": "order" }],
        "order": [[ 1, "asc" ]],
        "pageLength": 50
    });

    $('#main-list tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
        var d = $('#main-list').DataTable().row( this ).data();
        $('#entry-page').load('{{Trans::to('/admin/page/page')}}' + '/' + d.id);
    });
});
</script>
@stop

@section('style')
<style type="text/css">
.box-body{
    min-height: 420px;
}
</style>
@stop
