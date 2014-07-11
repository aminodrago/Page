@extends('admin.layouts.index')
@section('heading')
        <h1>
            {{ Lang::get('page::package.name') }}
            <small> {{ Lang::get('app.manage') }} {{ Lang::get('page::package.names') }}</small>
        </h1>
@stop

@section('title')
            {{ Lang::get('page::page.names') }}
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admin') }}"><i class="fa fa-dashboard"></i> {{ Lang::get('app.home') }} </a></li>
        <li class="active">{{ Lang::get('page::page.names') }}</li>
    </ol>
@stop

@section('search')

            <form class="form-horizontal pull-right" action="{{ URL::to('admin/page') }}" method="get" style="width:50%;margin-right:5px;">
                {{ Form::token() }}
                <div class="input-group">
                    <input type="search" class="form-control input-sm" name="q" value="{{$q}}"  placeholder="{{  Lang::get('app.search') }}">
                    <span class="input-group-btn">
                        <button class="btn  btn-sm btn-default" type="submit"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>
@stop

@section('buttons')
            <a class="btn   btn-sm btn-info pull-right {{ ($permissions['create']) ? '' : 'disabled' }} view-btn-create" href="{{ URL::to('admin/page/create') }}">
                <i class="fa fa-plus-circle"></i> {{ Lang::get('app.new') }} {{ Lang::get('page::page.name') }}
            </a>
@stop

@section('content')
        <table class="table table-condensed">
            <tr>
                <th>{{ Lang::get('page::page.name') }}</th>
                <th>{{ Lang::get('page::page.label.title') }}</th>
                <th>{{ Lang::get('page::page.label.slug') }}</th>
                <th width="70">{{ Lang::get('app.options') }}</th>
            </tr>
                @foreach ($pages as $page)
                <tr>
                    <td><a href="{{ ($permissions['view']) ? (URL::to('admin/page/') . '/' . $page->id ) : '#' }}">{{ $page->name }}</a></td>
                    <td>{{ $page->title }}</td>
                    <td>{{ $page->slug }}.html</td>
                    <td>
                        <div class="btn-group  btn-group-xs">
                            <a type="button" class="btn btn-info  {{ ($permissions['edit']) ? '' : 'disabled' }} view-btn-edit" href="{{ URL::to('admin/page')}}/{{$page->id}}/edit" title="{{ Lang::get('app.update') }} Page"><i class="fa fa-pencil-square-o"></i></a>
                            <a type="button" class="btn btn-danger action_confirm  {{ ($permissions['delete']) ? '' : 'disabled' }} view-btn-delete" data-method="delete" href="{{ URL::to('admin/page') }}/{{ $page->id }}" title="{{ Lang::get('app.delete') }} Page"><i class="fa fa-times-circle-o"></i></a>
                        </div>
                    </td>
                </tr>
                @endforeach
        </table>
        {{ $pages->links()}}
@stop
