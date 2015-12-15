@extends('back::app')

@section('page-title', trans('base.files'))

@section('page-actions')
    <a href="{{ route('back.system.users.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> {{ trans('actions.create') }}</a>
@stop

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('base.files') }}</h3>
        </div>
        <div class="panel-body">

        </div>
    </div>
@stop
