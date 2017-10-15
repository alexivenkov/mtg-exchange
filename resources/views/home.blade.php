@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        @foreach($cards as $card)
                            <div class="row form-group">
                                <div class="col-md-3">
                                    <img src="{{ $card->image }}" class="image-responsive img-thumbnail"/>
                                </div>
                                <div class="col-md-9">
                                    <ul class="list-unstyled">
                                        <li>Card Name: {{ $card->name }}</li>
                                        <li>Mana Cost: {{ $card->costs }}</li>
                                        <li>CMC: {{ $card->cmc }}</li>
                                        <li>
                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    {{  $card->description }}
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
