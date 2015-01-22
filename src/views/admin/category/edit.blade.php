@extends('Admin::views.edit')

@section('heading')
<h1>
    {{ Lang::get('page::category.name') }}
    <small> {{ Lang::get('app.manage') }} {{ Lang::get('page::category.names') }}</small>
</h1>
@stop

@section('title')
{{Lang::get('app.edit')}} {{Lang::get('page::category.name')}} {{$category['name']}}
@stop

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ URL::to('admin') }}"><i class="fa fa-dashboard"></i> {{  Lang::get('app.home') }}</a></li>
    <li><a href="{{ URL::to('admin/page/category')}}">{{ Lang::get('page::category.names') }}</a></li>
    <li class="active">{{ $category['name'] }}</li>
</ol>

@stop

@section('buttons')
<a class="btn btn-info pull-right view-btn-back" href="{{ URL::to('admin/page/ccategory') }}"><i class="fa fa-angle-left"></i> {{  Lang::get('app.back') }}</a>
@stop


@section('tabs')
<li class="active"><a href="#details" data-toggle="tab">{{ Lang::get('page::category.name') }}</a></li>
<li><a href="#image" data-toggle="tab">{{ Lang::get('page::category.image') }}</a></li>
@stop

@section('icon')
<i class="fa fa-th"></i>
@stop


@section('content')

{{Former::vertical_open()
->id('category')
->secure()
->method('PUT')
->files('true')
->enctype('multipart/form-data')
->action(URL::to('admin/page/category/'. $category['id']))}}
{{Former::hidden('id')}}
{{ Former::token() }}
<div class="tab-content">
    <div class="tab-pane active" id="details">
        <div class="row">

               <div class='col-md-6'>{{ Former::text('name')
               -> label('page::category.label.name')
               -> placeholder('page::category.placeholder.name')}}
               </div>
        </div>
    </div>
</div>
<div class="tab-footer">
    <div class="row">
        <div class="col-md-12">
            {{Former::actions()
            ->large_primary_submit(Lang::get('app.save'))
            ->large_default_reset(Lang::get('app.reset'))}}
        </div>
    </div>
</div>
{{Former::close()}}
@stop

@section('script')

@stop