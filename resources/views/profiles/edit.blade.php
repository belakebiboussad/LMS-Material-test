{{--
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
</h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profiles.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profiles.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profiles.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
</x-app-layout>
--}}
@extends('layouts.app')
@section('title')
{{ trans('profile.templateTitle') }}
@endsection
@section('header')
<small>
    {{ trans('profile.editProfileTitle') }} | {{ trans('profile.showProfileTitle',['username' => $user->name]) }}
</small>
@endsection
@section('content')
@if (Auth::user()->id == $user->id)
<div class="mdl-grid full-grid margin-top-0 padding-0">
    <div class="mdl-cell mdl-cell mdl-cell--12-col mdl-cell--12-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop mdl-card mdl-shadow--3dp margin-top-0 padding-top-0">
        <div class="mdl-card card-wide" style="width:100%;" itemscope itemtype="http://schema.org/Person">
            <div class="mdl-user-avatar">
                <div id="avatar_selector_avatar" class="avatar-selecter @if($user->profile->avatar_status == 0) active-avatar-selecter @endif">
                    <img src="{{-- Gravatar::get($user->email) --}}" alt="{{ $user->name }}" class="user-avatar">
                    <h3 class="mdl-card__title-text mdl-title-username mdl-color-text--white">
                        {{ $user->name }}
                    </h3>
                </div>
                <div id="avatar_selector_userimage" class="avatar-selecter @if($user->profile->avatar_status == 1) active-avatar-selecter @endif">
                    <div class="dz-preview"></div>
                    {!! Form::open(array('route' => 'avatar.upload', 'method' => 'POST', 'name' => 'avatarDropzone','id' => 'avatarDropzone', 'class' => 'form single-dropzone dropzone single', 'files' => true)) !!}
                    @if($user->profile->avatar)
                    <img id="user_selected_avatar" class="user-avatar" src="{{ $user->profile->avatar }}" alt="{{ $user->name }}">
                    @else
                    <div class="user-avatar-icon">
                        <i class="material-icons">file_upload</i>
                    </div>
                    @endif
                    <h3 class="mdl-card__title-text mdl-title-username mdl-color-text--white">
                        {{ $user->name }}
                    </h3>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection