@extends('admin.layouts.create')

@section('heading')
<h1>
    {{ Lang::get('page::package.name') }}
    <small> {{ Lang::get('app.manage') }} {{ Lang::get('page::package.names') }}</small>
</h1>
@stop

@section('title')
{{Lang::get('app.new')}} {{Lang::get('page::page.name')}}
@stop

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ URL::to('admin') }}"><i class="fa fa-dashboard"></i> {{  Lang::get('app.home') }}</a></li>
    <li><a href="{{ URL::to('admin/page') }}">{{ Lang::get('page::page.names') }}</a></li>
    <li class="active">{{ Lang::get('app.new') }} {{ Lang::get('page::page.name') }}</li>
</ol>
@stop


@section('buttons')
<a class="btn btn-info pull-right   btn-xs" href="{{ URL::to('admin/page') }}"><i class="fa fa-angle-left"></i> {{  Lang::get('app.back') }}</a>
@stop

@section('content')

{{Former::vertical_open()
    ->id('page')
    ->method('POST')
    ->files('true')
    ->action(URL::to('admin/page'))}}
    <div class="box-body">

        <div class="row">

            <div class="col-md-12 ">
                {{ Former::text('name')
                -> label('page::page.label.name')
                -> placeholder('page::page.placeholder.name')}}

            </div>

        </div>
        <div class="row">
            <div class="col-md-12 ">
                {{ Former::textarea('content')
                -> label('page::page.label.content')
                -> addclass('content')
                -> placeholder('page::page.placeholder.content')}}
            </div>

            <div class="col-md-12 ">
                {{ Former::checkbox('status')
                -> label('page::page.label.status')
                -> addClass('checkbox-status')}}
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
    <script type="text/javascript">
        jQuery(function ($) {
            $('.content').redactor({
                minHeight: 200,
                direction: '{{ Localization::getCurrentLocaleDirection() }}'
                lang: '{{ App::getLocale()'
            });
        });
    </script>

    @stop
