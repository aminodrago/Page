@extends('Admin::views.create')

@section('heading')
<h1>
    {{ Lang::get('page::category.name') }}
    <small> {{ Lang::get('app.manage') }} {{ Lang::get('page::category.names') }}</small>
</h1>
@stop

@section('title')
{{Lang::get('app.new')}} {{Lang::get('page::category.name')}}
@stop

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ URL::to('admin') }}"><i class="fa fa-dashboard"></i> {{  Lang::get('app.home') }}</a></li>
    <li><a href="{{ URL::to('admin/page/category') }}">{{ Lang::get('page::category.names') }}</a></li>
    <li class="active">{{ Lang::get('app.new') }} {{ Lang::get('page::category.name') }}</li>
</ol>
@stop

@section('buttons')
<a class="btn btn-info pull-right   btn-xs" href="{{ URL::to('admin/page/category') }}"><i class="fa fa-angle-left"></i> {{  Lang::get('app.back') }}</a>
@stop

@section('content')
    {{Former::vertical_open()
    ->id('category')
    ->method('POST')
    ->files('true')
    ->action(URL::to('admin/page/category'))}}
    <div class="box-body">
          <div class="row">

               <div class='col-md-6'>{{ Former::text('name')
               -> label('page::category.label.name')
               -> placeholder('page::category.placeholder.name')}}
               </div>
        </div>
    </div>
    <div class="box-footer">
        <div class="row">
            <div class="col-md-12">
                {{Former::actions()
                ->large_primary_submit(Lang::get('app.save'))
                ->large_default_reset(Lang::get('app.reset'))}}
            </div>

        </div>
    </div>

    {{ Former::close() }}
@stop

@section('script')


@stop



