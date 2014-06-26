<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            Pages <span class='pull-right'><button type="button" class="btn btn-primary btn-xs">{{Lang::get('app.more')}}</button> </span>
        </h3>
    </div>
    <table class="table">
        <thead>d
            <th>{{ Lang::get('page::page.name') }}</th>
            <th>{{ Lang::get('page::page.label.title') }}</th>
            <th>{{ Lang::get('page::page.label.slug') }}</th>
            <th width="70">{{ Lang::get('app.options') }}</th>
        </thead>
        <tbody>
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
        </tbody>
    </table>
</div>