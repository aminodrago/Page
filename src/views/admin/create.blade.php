
<div class="page-create">
	<div class='row view-toolbar'>
		{{-- Breadcrumbs --}}
		<div class="col-md-8 col-xs-8 view-breadcrumb" >
			<ol class="breadcrumb">
				<li><a href="{{ URL::to('admin') }}">{{  Lang::get('appl.home') }}</a></li>
				<li><a href="{{ URL::to('admin/page') }}">{{ Lang::get('page::module.names') }}</a></li>
				<li class="active">{{ Lang::get('appl.new') }} {{ Lang::get('page::module.name') }}</li>
			</ol>
		</div>


		{{-- Buttons --}} 
		<div class="col-md-4 col-xs-4 view-buttons">
			<a class="btn btn-info pull-right" href="{{ URL::to('admin/page') }}"><i class="fa fa-angle-left"></i> {{  Lang::get('appl.back') }}</a>
		</div>
	</div>

	{{-- Content --}} 
	<div class='view-content'> 
		<fieldset>
			{{Former::legend( Lang::get('appl.new')  . ' ' . Lang::get('page::module.name'))}}
			{{Former::vertical_open()
			->id('page')
			->method('POST')
			->files('true')
			->action(URL::to('admin/page'))}}

			<div class="row"> 

				<div class="col-md-12 ">
					{{ Former::text('name')
					-> label('page::label.name')
					-> placeholder('page::placeholder.name')}}

				</div>
				
			</div>
			<div class="row"> 
				<div class="col-md-12 ">
					{{ Former::textarea('content')
					-> label('page::label.content')
					-> addclass('content')
					-> placeholder('page::placeholder.content')}}
				</div>
				

				<div class="col-md-12 ">
					{{ Former::checkbox('status')
					-> label('page::label.status')
					-> addClass('checkbox-status')}}
				</div>


			</div>
			<div class="row">
				<div class="col-md-12">
					{{Former::actions()
					->large_primary_submit(Lang::get('appl.submit'))
					->large_default_reset(Lang::get('appl.reset'))}}
				</div>

			</div>

			{{ Former::close() }}
		</fieldset>
	</div>
</div>

<script type="text/javascript">
jQuery(function( $ ) {
	$('.content').redactor({
		minHeight: 200, 
		direction: '{{ LaravelLocalization::getCurrentLocaleDirection() }}'
		lang: '{{ App::getLocale()'
	});
});
</script>