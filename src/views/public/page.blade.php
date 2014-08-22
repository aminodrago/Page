<span id="header_shadow" style="top: 111px;"></span>
<header id="page-title">
    <div class="container">
        <h1>{{$page->heading}}</h1>

        <ul class="breadcrumb">
        <li><a href="{{URL::to('/')}}">Home</a></li>
            <li class="active">{{$page->heading}}</li>
        </ul>
    </div>
</header>
<section class='container'>
<article> {{$page->content}}</article>
</section>
