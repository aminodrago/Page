@extends('admin.layouts.show')

@section('heading')
<h1>
    {{ Lang::get('page::package.name') }}
    <small> {{ Lang::get('app.manage') }} {{ Lang::get('page::package.names') }}</small>
</h1>
@stop

@section('title')
{{$page['name']}} {{Lang::get('page::page.name')}}
@stop

@section('breadcrumb')
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin') }}"><i class="fa fa-dashboard"></i> {{ Lang::get('app.home') }}</a></li>
                <li><a href="{{ URL::to('admin/page') }}">{{ Lang::get('page::page.names') }}</a></li>
                <li class="active">{{ $page['name'] }}</li>
            </ol>

@stop

@section('buttons')
            <a class="btn btn-info  btn-xs" href="{{ URL::to('admin/page') }}" ><i class="fa fa-angle-left"></i> {{ Lang::get('app.back') }}</a>
            <a class="btn btn-info  btn-xs {{ ($permissions['edit']) ? '' : 'disabled' }}" href="{{ URL::to('admin/page') . '/' . $page['id'] . '/edit'}}">
                <i class="fa fa-pencil-square-o"></i> {{ Lang::get('app.edit') }}
            </a>
@stop



@section('content')

                <div class="row">
                                <div class="col-md-6 ">
                                            <div class="form-group">
                                                <label for="order">{{ Lang::get('page::page.label.order') }}</label><br />

                                                {{ $page['order'] }}
                                            </div>
                                        </div>
            <div class="col-md-6 ">
                                            <div class="form-group">
                                                <label for="image">{{ Lang::get('page::page.label.image') }}</label><br />

                                                {{ $page['image'] }}
                                            </div>
                                        </div>
            <div class="col-md-6 ">
                                            <div class="form-group">
                                                <label for="status">{{ Lang::get('page::page.label.status') }}</label><br />

                                                {{ $page['status'] }}
                                            </div>
                                        </div>
                </div>
@stop