@extends('front.layout.app')

@section('title', 'Contact Us')
@section('meta', 'Contact us page for the website')

@section('content')
    @includeIf('front.cache.contact.index')
    @includeIf('front.cache.contact.map')
@endsection
