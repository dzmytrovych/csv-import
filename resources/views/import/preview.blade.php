@extends('app')

@section('title')
    <title>Mapping Preview</title>
@endsection

@section('content')
    <div class="container">
        <form class="form-horizontal" method="POST" action="{{ route('save') }}">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6">
                    <h2>Comfirm Mappings</h2>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-group">
                        <h3>Contact Fields</h3>
                        @foreach ($mappedArray[0] as $key => $value)
                            <li class="list-group-item">{{ $key }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list-group">
                        <h3>Mapped Values</h3>
                        @foreach ($mappedArray[0] as $key => $value)
                            <li class="list-group-item ">
                                <input type="text" name="fields[]" value="{{ $value }}">
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <button type="submit" class="btn btn-success pull-right">Save</button>

        </form>
    </div>
@endsection
