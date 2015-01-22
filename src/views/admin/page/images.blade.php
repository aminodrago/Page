

@foreach($page->getFile('images') as $key => $image)
<a href='{{$image['folder']}}{{$image['file']}}'>{{$image['file']}} </a> &nbsp; <a href='{{URL::to('admin/page')}}/{{$page->id}}/images/{{$key}}' ><i class='fa fa-times'></i></a>
@endforeach