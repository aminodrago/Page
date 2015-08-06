@extends('admin::index')
@section('heading')
<i class="fa fa-file-text-o"></i> {!! trans('page::package.name') !!} <small> {!! trans('app.manage') !!} {!! trans('page::package.names') !!}</small>
@stop

@section('title')
{!! trans('page::page.names') !!}
@stop

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{!! URL::to('admin') !!}"><i class="fa fa-dashboard"></i> {!! trans('app.home') !!} </a></li>
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
<table id="main-list" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th width="20"><input type="checkbox" name="checkall" id="checkall" class="checkbox" value="all"></th>
            <th>{!! trans('page::page.name') !!}</th>
            <th>{!! trans('page::page.label.title') !!}</th>
            <th>{!! trans('page::page.label.slug') !!}</th>
            <th>{!! trans('app.order') !!}</th>
        </tr>
    </thead>
</table>
@stop
@section('script')
<script type="text/javascript">
var oTable;
$(document).ready(function(){
    $('#entry-page').load('{{URL::to('admin/page/0')}}');
    oTable = $('#main-list').dataTable( {
        "ajax": '{{ URL::to('/admin/page/list') }}',
        "columns": [
        { "data": "id" },
        { "data": "name" },
        { "data": "title" },
        { "data": "slug" },
        { "data": "order" }],
        "fnCreatedRow": function( nRow, aData, iDataIndex ) {
            $('td:eq(0)', nRow).html( '<input type="checkbox" name="ids[]" id="ids_'+ aData.id +'" class="checkRow" value="'+ aData.id+'">');
        },
        "aoColumnDefs": [
              { 'bSortable': false, 'aTargets': [0] }
           ],
        "order": [[ 1, "asc" ]],
        "pageLength": 50
    });

    $('#main-list tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');

        var d = $('#main-list').DataTable().row( this ).data();

        $('#entry-page').load('{{URL::to('admin/page')}}' + '/' + d.id, function( response, status, xhr ) {
          if ( status == "error" ) {
            toastr.error(xhr.status + " " + xhr.statusText, 'Error');
          }
        });

        if ( $(this).hasClass('selected') ) {
            $("#ids_"+d.id).prop('checked', true);
        } else {
            $("#ids_"+d.id).prop('checked', false);
        }

    });

    $("#checkall").click(function(e){
      $("#main-list :checkbox").prop('checked', $("#checkall").is(':checked'));

      if ($("#checkall").is(':checked')){
        $("#main-list tr").addClass('selected');
        $.each($("#main-list :checkbox"), function(){
          arrayids.push(parseInt($(this).val()));
          id = parseInt($(this).val());
        });
        $('#form-div').load('/property/properties/'+id);

      } else {
        arrayids = [];
        id = 0;
        $("#main-list tr").removeClass('selected');
        $('#form-div').load('/property/properties/0');
      }
    });

    $('#btnDelete').click(function(){
        toastr.warning('Are you shure you want to delete the pages? <br><div class="pull-right"><button type="button" id="confirmDelete" class="btn btn-danger btn-xs">Yes</button> <button type="button" id="btnClose" class="btn btn-danger btn-xs">No</button></div>', 'Delete page(s)!');
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
