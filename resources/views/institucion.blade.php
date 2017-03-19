@extends('base')
@section('title')
<title>SocialBook - {{ $institucion->nombre }}</title>
@endsection

@section('content')
<div class="col-md-9">

    <div class="thumbnail">
        <img class="img-responsive" src="http://placehold.it/800x300" alt="">
        <div class="caption-full">
            <h3>Mísión</h3>
            <p>{{ $institucion->mision }}</p>

            <h3>Visión</h3>
            <p>{{$institucion->vision }}</p>

            <h3>Visión</h3>
            <p>{{$institucion->vision }}</p>

            <h3>Contacto</h3>
            <p>Teléfono: +569 {{$institucion->telefono}}</p>
            <p>Dirección: {{$institucion->direccion}}</p>
            <p>Email: {{$institucion->mail}}</p>                         
        </div>
    </div>

    <div class="well">

        <div class="text-right">
            <a class="btn btn-success">Leave a Review</a>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-12">
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star-empty"></span>
                Anonymous
                <span class="pull-right">10 days ago</span>
                <p>This product was great in terms of quality. I would definitely buy another!</p>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-12">
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star-empty"></span>
                Anonymous
                <span class="pull-right">12 days ago</span>
                <p>I've alredy ordered another one!</p>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-12">
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star-empty"></span>
                Anonymous
                <span class="pull-right">15 days ago</span>
                <p>I've seen some better than this, but not at this price. I definitely recommend this item.</p>
            </div>
        </div>

    </div>

</div>
@endsection