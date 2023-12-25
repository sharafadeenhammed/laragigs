@extends('layout')
@section("content")
@include("partials._hero")
@include("partials._search")
{{-- @if (count($listings) == 0)
    <p>no listing found</p>
@endif --}}

{{-- same as below --}}

@unless(count($listings) == 0)
<div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
@foreach ($listings as $listing)
    <x-listing-card :listing="$listing"/>
@endforeach
    <div class="mt5 px10 py-5">
        {{$listings->links()}}
    </div>
@else
    <p>no listing found</p>
@endunless

@endsection