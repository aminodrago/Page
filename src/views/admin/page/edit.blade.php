@extends('Admin::views.edit')

@section('heading')
<h1>
    {{ Lang::get('page::package.name') }}
    <small> {{ Lang::get('app.manage') }} {{ Lang::get('page::package.names') }}</small>
</h1>
@stop

@section('title')
{{Lang::get('app.edit')}} {{Lang::get('page::page.name')}} {{$page['name']}}
@stop

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ URL::to('admin') }}"><i class="fa fa-dashboard"></i> {{  Lang::get('app.home') }}</a></li>
    <li><a href="{{ URL::to('admin/page')}}">{{ Lang::get('page::page.names') }}</a></li>
    <li class="active">{{ $page['name'] }}</li>
</ol>

@stop

@section('buttons')
<a class="btn btn-info pull-right view-btn-back" href="{{ URL::to('admin/page') }}"><i class="fa fa-angle-left"></i> {{  Lang::get('app.back') }}</a>
@stop


@section('tabs')


<li class="active"><a href="#details" data-toggle="tab">Page</a></li>
<li><a href="#metatags" data-toggle="tab">Meta</a></li>
<li><a href="#settings" data-toggle="tab">Settings</a></li>
@stop

@section('icon')
<i class="fa fa-th"></i>
@stop


@section('content')

{{Former::vertical_open()
    ->id('page')
    ->secure()
    ->method('PUT')
    ->files('true')
    ->enctype('multipart/form-data')
    ->action(URL::to('admin/page/'. $page['id']))}}
    {{Former::hidden('id')}}
    <div class="tab-content">

        <div class="tab-pane active" id="details">

            <div class="row">
                <div class="col-md-12 ">
                    {{ Former::text('name')
                    -> label('page::page.label.name')
                    -> placeholder('page::page.placeholder.name')}}
                </div>

                <div class="col-md-12 ">
                    {{ Former::textarea('content')
                    -> label('page::page.label.content')
                    -> dataUpload(URL::to('/upload/page/page/'.$page['id'].'/content'))
                    -> addClass('html-editor')
                    -> placeholder('page::page.placeholder.content')}}
                </div>

                <div class="col-md-12 ">
                    {{ Former::file('banner')
                    -> label('page::page.label.banner')
                    -> placeholder('page::page.placeholder.banner')
                    -> blockHelp(is_array($page->banner) && count($page->banner) ? "<a href='{$page->banner['folder']}/{$page->banner['file']}'>{$page->banner['file']} </a> &nbsp; <a href='".URL::to('admin/page')."/{$page->id}/banner/1' ><i class='fa fa-times'></i></a>" : '')}}
                </div>

                <div class="col-md-12 ">
                    {{ Former::files('images[]')
                    -> label('page::page.label.image')
                    -> placeholder('page::page.placeholder.image')
                    -> blockHelp($images)}}
                </div>

               <div class='col-md-6'>{{ Former::hidden('status')
                   -> forceValue('0')}}
                   {{ Former::checkbox('status')
                   -> label('page::page.label.status') }}
               </div>
            </div>
        </div>
        <div class="tab-pane" id="metatags">
            <div class="row">
                <div class="col-md-12 ">
                    {{ Former::text('title')
                    -> label('page::page.label.title')
                    -> placeholder('page::page.placeholder.title')}}
                </div>
                <div class="col-md-12 ">
                    {{ Former::text('heading')
                    -> label('page::page.label.heading')
                    -> placeholder('page::page.placeholder.heading')}}
                </div>
                <div class="col-md-12 ">
                    {{ Former::textarea('keyword')
                    -> label('page::page.label.keyword')
                    -> rows(9)
                    -> placeholder('page::page.placeholder.keyword')}}
                </div>
                <div class="col-md-12 ">
                    {{ Former::textarea('description')
                    -> label('page::page.label.description')
                    -> rows(9)
                    -> placeholder('page::page.placeholder.description')}}
                </div>
            </div>
        </div>
        <div class="tab-pane" id="settings">
            <div class="row">
                <div class="col-md-6 ">
                    {{ Former::range('order')
                    -> label('page::page.label.order')
                    -> placeholder('page::page.placeholder.order')}}
                </div>
                <div class="col-md-6 ">
                    {{ Former::text('slug')
                    -> label('page::page.label.slug')
                    -> append('.html')
                    -> placeholder('page::page.placeholder.slug')}}
                </div>
            </div>
            <div class="row">
               <div class='col-md-6'>{{ Former::select('view')
                   -> options(Lang::get('page::page.options.view'))
                   -> label('page::page.label.view')
                   -> placeholder('page::page.placeholder.view')}}
               </div>

               <div class='col-md-6'>{{ Former::select('compiler')
                   -> options(Lang::get('page::page.options.compiler'))
                   -> label('page::page.label.compiler')
                   -> placeholder('page::page.placeholder.compiler')}}
               </div>
               <div class='col-md-6'>{{ Former::select('category_id')
                   -> options(Page::categories())
                   -> label('page::page.label.category')
                   -> placeholder('page::page.placeholder.category')}}
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

