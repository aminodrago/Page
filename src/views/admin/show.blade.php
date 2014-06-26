<div class="page-show">
    <div class='row view-toolbar'>
        {{-- Breadcrumbs --}}
        <div class="col-md-8 col-xs-7 view-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin') }}">{{ Lang::get('app.home') }}</a></li>
                <li><a href="{{ URL::to('admin/page') }}">{{ Lang::get('page::page.names') }}</a></li>
                <li class="active">{{ $page['name'] }}</li>
            </ol>
        </div>

        {{-- Buttons --}}
        <div class="col-md-4 col-xs-5 view-buttons" align="right">
            <a class="btn btn-info view-btn-back" href="{{ URL::to('admin/page') }}" ><i class="fa fa-angle-left"></i> {{ Lang::get('app.back') }}</a>
            <a class="btn btn-info view-btn-edit {{ ($permissions['edit']) ? '' : 'disabled' }}" href="{{ URL::to('admin/page') . '/' . $page['id'] . '/edit'}}">
                <i class="fa fa-pencil-square-o"></i> {{ Lang::get('app.edit') }}
            </a>
        </div>
    </div>

    {{-- Content --}}
    <div class='view-content'>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{ Lang::get('page::page.name') }} [{{ $page['name'] }}]</h3>
            </div>
            <div class="panel-body">
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
            </div>
        </div>
    </div>
</div>
