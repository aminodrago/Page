@extends('Admin::views.show')

@section('heading')
<h1>
    {{ Lang::get('page::category.name') }}
    <small> {{ Lang::get('app.manage') }} {{ Lang::get('page::category.names') }}</small>
</h1>
@stop

@section('title')
{{$category['name']}} {{Lang::get('page::category.name')}}
@stop

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ URL::to('admin') }}"><i class="fa fa-dashboard"></i> {{ Lang::get('app.home') }}</a></li>
    <li><a href="{{ URL::to('admin/page/category') }}">{{ Lang::get('page::category.names') }}</a></li>
    <li class="active">{{ $category['name'] }}</li>
</ol>
@stop

@section('buttons')
<a class="btn btn-info  btn-xs" href="{{ URL::to('admin/page/category') }}" ><i class="fa fa-angle-left"></i> {{ Lang::get('app.back') }}</a>
<a class="btn btn-info  btn-xs {{ ($permissions['edit']) ? '' : 'disabled' }}" href="{{ URL::to('admin/page/category') . '/' . $category['id'] . '/edit'}}">
    <i class="fa fa-pencil-square-o"></i> {{ Lang::get('app.edit') }}
</a>
@stop

@section('content')
                <div class="row">

                              <div class="col-md-6 ">
                                 <div class="form-group">
                                      <label for="name">{{ Lang::get('page::category.label.name') }}</label><br />
                                      {{ $category['name'] }}
                                 </div>
                              </div>
        </div>
@stop

@section('script')

@stop