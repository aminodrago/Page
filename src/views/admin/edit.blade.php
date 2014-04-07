
<div class="page-edit">
	<div class='row view-toolbar'>
		{{-- Breadcrumbs --}}
		<div class="col-md-8 col-xs-7 view-breadcrumb">
			<ol class="breadcrumb">
				<li><a href="{{ URL::to('admin') }}">{{  Lang::get('appl.home') }}</a></li>
				<li><a href="{{ URL::to('admin/page')}}">{{ Lang::get('page::module.names') }}</a></li>
				<li class="active">{{ $page['name'] }}</li>
			</ol>
		</div>


		{{-- Buttons --}} 
		<div class="col-md-4 col-xs-5 view-buttons">
			<a class="btn btn-info pull-right view-btn-back" href="{{ URL::to('admin/page') }}"><i class="fa fa-angle-left"></i> {{  Lang::get('appl.back') }}</a>
		</div>
	</div>

	{{-- Content --}}
	<div class='view-content'> 
		<fieldset>
			{{Former::legend( Lang::get('appl.edit') . ' ' . Lang::get('page::module.name') . ' [ ' . $page['name'] . ' ] ')}}

			{{Former::vertical_open()
			->id('page')
			->secure()
			->method('PUT')
			->files('true')
			->enctype('multipart/form-data')
			->action(URL::to('admin/page/'. $page['id']))}}
			{{Former::hidden('id')}}
			<ul class="nav nav-tabs" id="rightTab">
				<li class="active"><a href="#rt-help" data-toggle="tab">Page</a></li>
				<li><a href="#rt-settings" data-toggle="tab">Meta</a></li>
				<li><a href="#rt-request" data-toggle="tab">Settings</a></li>
			</ul>

			<div class="tab-content">
				<div class="tab-pane active" id="rt-help">
				
					<div class="row"> 
						<div class="col-md-12 ">
							{{ Former::text('name')
							-> label('page::label.name')
							-> placeholder('page::placeholder.name')}}
						</div>
						
						<div class="col-md-12 ">
							{{ Former::textarea('content')
							-> label('page::label.content')
							-> addClass('content')
							-> placeholder('page::placeholder.content')}}
						</div>

						<div class="col-md-12 ">
							{{ Former::file('banner')
							-> label('page::label.banner')
							-> placeholder('page::placeholder.banner')
							-> addClass('banner')	}}
						</div>

						<div class="col-md-12 ">
							{{ Former::checkbox('status')
							-> label('page::label.status')
							-> addClass('checkbox-status')}}

						</div>
					</div>
				</div>
				<div class="tab-pane" id="rt-settings">
					<div class="row"> 			
						<div class="col-md-12 ">
							{{ Former::text('title')
							-> label('page::label.title')
							-> placeholder('page::placeholder.title')}}
						</div>
						<div class="col-md-12 ">
							{{ Former::textarea('keyword')
							-> label('page::label.keyword')
							-> rows(9)
							-> placeholder('page::placeholder.keyword')}}
						</div>
						<div class="col-md-12 ">
							{{ Former::textarea('description')
							-> label('page::label.description')
							-> rows(9)
							-> placeholder('page::placeholder.description')}}
						</div>
					</div>
				</div>
				<div class="tab-pane" id="rt-request">
					<div class="row">
						<div class="col-md-6 ">
							{{ Former::range('order')
							-> label('page::label.order')
							-> placeholder('page::placeholder.order')}}
						</div>
						<div class="col-md-6 ">
							{{ Former::text('slug')
							-> label('page::label.slug')
							-> placeholder('page::placeholder.slug')}}
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					{{Former::actions()
					->large_primary_submit('Submit')
					->large_default_reset('Reset')}}
				</div>
			</div>
			{{Former::close()}}
		</fieldset>
	</div>
</div>

<script>
jQuery(function( $ ) {
	$('.content').redactor({
		minHeight: 200, // pixels }
		imageUpload: '/upload/redactor-image/',
	});

	$('.banner').ezdz({
		text: '{{Lang::get('page::placeholder.banner')}}',
		validators: {
			maxWidth:  900,
			maxHeight: 900,
			maxSize: 1000000
		},
		reject: function(file, errors) {
			if (errors.mimeType) {
				alert(file.name + ' must be an image.');
			}

			if (errors.maxWidth) {
				alert(file.name + ' must be width:900px max.');
			}

			if (errors.maxHeight) {
				alert(file.name + ' must be height:900px max.');
			}
		}
	});	
	@if ($page->banner != '')
		$('.banner').ezdz('preview', '{{URL::to($page->banner)}}');
	@endif
});
</script>