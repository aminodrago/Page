<div class="box-header with-border">
    <h3 class="box-title"> View page [{{$page->name or 'New page'}}]</h3>
    <div class="box-tools pull-right">
        <button type="button" class="btn btn-primary btn-sm" id="btn-new-page"><i class="fa fa-plus-circle"></i> New</button>
        @if($page->id)
        <button type="button" class="btn btn-primary btn-sm" id="btn-edit-page"><i class="fa fa-pencil-square"></i> Edit</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" id="btnDelete"><i class="fa fa-times-circle"></i> Delete</button>
        @endif
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div>
</div>
<div class="box-body" >
    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#details" data-toggle="tab">Page</a></li>
            <li><a href="#metatags" data-toggle="tab">Meta</a></li>
            <li><a href="#settings" data-toggle="tab">Settings</a></li>
            <li><a href="#images" data-toggle="tab">Images</a></li>
        </ul>
        {!!Former::vertical_open()
        ->id('show-page')
        ->method('PUT')
        ->action(URL::to('admin/page/'. $page['id']))!!}
        {!!Former::token()!!}
        <div class="tab-content">
            <div class="tab-pane active" id="details">

                {!! Former::text('name')
                -> label(trans(trans('page::page.label.name')))
                -> placeholder(trans(trans('page::page.placeholder.name')))
                -> disabled()!!}

                {!! Former::textarea('content')
                -> label(trans('page::page.label.content'))
                -> value(e($page['content']))
                -> dataUpload(URL::to($page->getUploadURL('content')))
                -> addClass('html-editor')
                -> placeholder(trans('page::page.placeholder.content'))
                -> disabled()!!}
            </div>
            <div class="tab-pane" id="metatags">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        {!! Former::text('title')
                        -> label(trans('page::page.label.title'))
                        -> placeholder(trans('page::page.placeholder.title'))
                        -> disabled()!!}

                    </div>
                    <div class="col-md-6 col-lg-6">

                        {!! Former::text('heading')
                        -> label(trans('page::page.label.heading'))
                        -> placeholder(trans('page::page.placeholder.heading'))
                        -> disabled()!!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        {!! Former::textarea('keyword')
                        -> label(trans('page::page.label.keyword'))
                        -> rows(4)
                        -> placeholder(trans('page::page.placeholder.keyword'))
                        -> disabled()!!}
                    </div>
                    <div class="col-md-6 col-lg-6">
                        {!! Former::textarea('description')
                        -> label(trans('page::page.label.description'))
                        -> rows(4)
                        -> placeholder(trans('page::page.placeholder.description'))
                        -> disabled()!!}
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="settings">
                <div class="row">
                    <div class="col-md-6 ">
                        {!! Former::range('order')
                        -> label(trans('page::page.label.order'))
                        -> placeholder(trans('page::page.placeholder.order'))
                        -> disabled()!!}

                        {!! Former::text('slug')
                        -> label(trans('page::page.label.slug'))
                        -> append('.html')
                        -> placeholder(trans('page::page.placeholder.slug'))
                        -> disabled()!!}

                        {!! Former::select('view')
                        -> options(trans('page::page.options.view'))
                        -> label(trans('page::page.label.view'))
                        -> placeholder(trans('page::page.placeholder.view'))
                        -> disabled()!!}
                    </div>
                    <div class='col-md-6'>
                        {!! Former::select('compiler')
                        -> options(trans('page::page.options.compiler'))
                        -> label(trans('page::page.label.compiler'))
                        -> placeholder(trans('page::page.placeholder.compiler'))
                        -> disabled()!!}

                        {!! Former::select('category_id')
                        -> options([])
                        -> label(trans('page::page.label.category'))
                        -> placeholder(trans('page::page.placeholder.category'))
                        -> disabled()!!}
                        {!! Former::hidden('status')
                        -> forceValue('0')
                        -> disabled()!!}

                        {!! Former::checkbox('status')
                        -> label(trans('page::page.label.status'))
                        -> inline()
                        -> disabled()!!}
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="images">
                <div class="row">
                    <div class='col-md-12'>
                        <label for="order" class="control-label">Banner Image</label>
                        {!! Filer::show($page['banner'], 1) !!}
                    </div>
                </div>
                <div class="row">
                    <div class='col-md-12'>
                        <label for="order" class="control-label">Gallery Images</label>
                        {!! Filer::show($page['images']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!!Former::close()!!}
</div>
<div class="box-footer" >
&nbsp;
</div>
<script type="text/javascript">
$(document).ready(function(){

    $('#btn-new-page').click(function(){
        $('#entry-page').load('{{URL::to('admin/page/create')}}', function( response, status, xhr ) {
          if ( status == "error" ) {
            toastr.error(xhr.status + " " + xhr.statusText, 'Error');
          }
        });
    });

    @if($page->id)
    $('#btn-edit-page').click(function(){
        $('#entry-page').load('{{URL::to('admin/page')}}/{{$page->id}}/edit');
    });
    @endif
});
</script>