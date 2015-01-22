@extends('Admin::views.index')
@section('heading')
<h1>
    {{ Lang::get('page::category.name') }}
    <small> {{ Lang::get('app.manage') }} {{ Lang::get('page::category.names') }}</small>
</h1>
@stop

@section('title')
{{ Lang::get('page::category.name') }}
@stop

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ URL::to('admin') }}"><i class="fa fa-dashboard"></i> {{ Lang::get('app.home') }} </a></li>
    <li class="active">{{ Lang::get('page::category.name') }}</li>
</ol>
@stop

@section('search')
<form class="form-horizontal pull-right" action="{{ URL::to('admin/page/category') }}" method="get" style="width:50%;margin-right:5px;">
    {{ Form::token() }}
    <div class="input-group">
        <input type="search" class="form-control input-sm" name="q" value="{{$q}}"  pageholder="{{  Lang::get('app.search') }}">
        <span class="input-group-btn">
            <button class="btn  btn-sm btn-default" type="submit"><i class="fa fa-search"></i></button>
        </span>
    </div>
</form>
@stop

@section('buttons')
<a class="btn   btn-sm btn-info pull-right {{ ($permissions['create']) ? '' : 'disabled' }} view-btn-create" href="{{ URL::to('admin/page/category/create') }}">
    <i class="fa fa-plus-circle"></i> {{ Lang::get('app.new') }} {{ Lang::get('page::category.name') }}
</a>
@stop

@section('content')
<table class="table table-condensed">
    <tr>
        <th>{{ Lang::get('page::category.name') }}</th>
        <th>{{ Lang::get('page::category.label.name')}}</th>
        <th width="70">{{ Lang::get('app.options') }}</th>
    </tr>
        @foreach ($categories as $category)
        <tr>
            <td><a href="{{ ($permissions['view']) ? (URL::to('admin/page/category') . '/' . $category->id ) : '# class="disabled"' }}">{{ $category->name }}</a></td>
            <td>{{ $category->name }}</td>
            <td>
                <div class="btn-group  btn-group-xs">
                    <a type="button" class="btn btn-info  {{ ($permissions['edit']) ? '' : 'disabled' }} view-btn-edit" href="{{ URL::to('admin/page/category')}}/{{$category->id}}/edit" title="{{ Lang::get('app.update') }} advert"><i class="fa fa-pencil-square-o"></i></a>
                    <a type="button" class="btn btn-danger action_confirm  {{ ($permissions['delete']) ? '' : 'disabled' }} view-btn-delete" data-method="delete" href="{{ URL::to('admin/page/category') }}/{{ $category->id }}" title="{{ Lang::get('app.delete') }} advert"><i class="fa fa-times-circle-o"></i></a>
                </div>
            </td>
        </tr>
        @endforeach
</table>
{{ $categories->links()}}
@stop






