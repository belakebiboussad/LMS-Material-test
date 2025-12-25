@extends('layouts.app')
@section('title')
Profile du {{ $user->name }}
@endsection
@section('css')
<style>
    .mdl-list__item-avatar.demo-avatar {
        width: 75px;
        height: 75px;
        border-radius: 24px;
        border: 2px solid rgba(255, 255, 255, 0.9);
        border-radius: 50%;
        padding: 3px;
    }

    .mdl-list__item a {
        text-decoration: none;
    }

    li.mdl-list__item {
        border-bottom: 1px solid #dddddd;
    }

    li.mdl-list__item:last-child {
        border: none;
    }

.mdl-card__actions .mdl-button {
  min-width: auto;
}
</style>
@endsection
@section('content')
@include('profiles.partials.user-profile-card') 
@endsection