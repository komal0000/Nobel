@extends('front.layout.app')

@section('title', 'Contact Us | Nobel Hospital')
@section('meta_title', 'Contact Us | Nobel Hospital')
@section('meta_description', 'Reach out to Nobel for appointments, inquiries, and hospital services. Get in touch with our expert medical team for assistance and patient care.')
@section('meta_keywords', 'contact us')

@section('content')
    @includeIf('front.cache.contact.index')
    @includeIf('front.cache.contact.map')
@endsection
@section('js')

@endsection
