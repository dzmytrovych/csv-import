@extends('app')

@section('title')
    <title>CSV File Upload</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <h1> Upload, match and save CSV data</h1>
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">CSV Import Form</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('mapping') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('csv') ? ' has-error' : '' }}">
                                <label for="csv" class="col-md-4 control-label">CSV file for import</label>

                                <div class="col-md-6">
                                    <input id="csv" type="file" class="form-control" name="csv" required>

                                    @if ($errors->has('csv'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('csv') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Parse
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
