@extends('back::layout.app')

@section('page-name', 'documents images')

@section('page-title')
    <h1>{{ _ucwords(trans('back::documents.images.crop')) }}</h1>
@stop

@section('page-actions')
    <a href="{{ route('back.documents.images.index') }}" class="btn btn-flat btn-default">
        <i class="fa fa-arrow-left"></i> {{ _ucwords(trans('back::dictionary.back')) }}
    </a>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1">
            <div class="box box-primary">
                {!! Form::model($record, ['route' => ['back.documents.images.update', $record->id], 'method' => 'put', 'files' => true]) !!}
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ _ucwords(trans('back::documents.images.crop')) }}</h3>
                    </div>

                    <div class="box-body">
                        <div id="cropper">
                            <img id="image" src="{{ route('image.view', ['folder' => 'images', 'file' => $record->file]) }}">
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop