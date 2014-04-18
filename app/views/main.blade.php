@extends('layouts.master')

@section('estilos')
{{ isset($estilos) ? $estilos : '' }}
@stop

@section('scripts')
{{ isset($scripts) ? $scripts : '' }}
@stop

@section('header')
{{ isset($header) ? $header : '' }}
@stop

@section('nav')
{{ isset($nav) ? $nav : '' }}
@stop

@section('content')
{{ isset($content) ? $content : '' }}
@stop
