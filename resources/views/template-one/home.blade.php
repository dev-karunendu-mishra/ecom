@extends('template-one.layout')
@section('main')
    @include('sub-views.template-one.navbar')
    @include('sub-views.template-one.featured')
    @include('sub-views.template-one.categories')
   

    <!-- Offer Start -->
    @include('sub-views.template-one.offers')
    <!-- Offer End -->


    <!-- Products Start -->
    <!-- @include('sub-views.template-one.products') -->
    <x-products title="Trandy Products" :products='$products'/>
    <!-- Products End -->


    <!-- Subscribe Start -->
    @include('sub-views.template-one.subscribe')
    <!-- Subscribe End -->


    <!-- Products Start -->
    <!-- @include('sub-views.template-one.products') -->
    <!-- Products End -->


    <!-- Vendor Start -->
    @include('sub-views.template-one.vendors')
    <!-- Vendor End -->
@endsection