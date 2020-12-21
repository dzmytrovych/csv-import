@extends('app')

@section('title')
    <title>Mapping CSV date and Contact fields</title>
@endsection

@section('content')
    <div class="container">
        <form class="form-horizontal" method="POST" action="{{ route('preview') }}">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6">
                    <h2>CSV data mapper</h2>
                    <span> Found <strong>{{ count($csvDataFileds) }}</strong> contacts in the <strong> {{ $fileName }}</strong></span> <br>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <h2>Contact Fields</h2>
                </div>
                <div class="col-md-6">
                    <h2>CSV Fields</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-group">
                        @foreach ($contactColumns as $key => $column)
                            <li class="list-group-item">
                                {{ $column }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul id="sortable" class="list-group">
                        @foreach ($csvHeader[0] as $key => $header)
                            <li class="list-group-item ui-state-default">
                                <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                                <input type="text" name="fields[]" value="{{ $header }}">
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
            <div class="btn-group pull-right">
                <a href="{{ route('index') }}" class="button btn btn-primary ">Return to file upload</a>
                <button type="submit" class="btn btn-success">Preview</button>
            </div>

        </form>
    </div>
@endsection
