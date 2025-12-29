@extends('layouts.app')
@section('title')
{{ trans('profile.templateTitle') }}
@endsection
@section('css')
<style>
    .mdl-gen__preview {
        position: relative;
        height: 350px
    }

    .mdl-demo-card .mdl-layout__content {
        margin: 0 1em;
    }

    .demo-layout .mdl-layout__header .mdl-layout__drawer-button i {
        margin-top: 12px;
    }

    .mdl-demo-card .mdl-layout__header .mdl-layout__drawer-button i {
        color: #ffffff;
    }

    body .mdl-card__title {
        display: block;
        height: 190px;
    }

    /* from material.class */
    .mdl-button--fab {
        border-radius: 50%;
        font-size: 24px;
        height: 30px;
        margin: auto;
        min-width: 30px;
        width: 30px;
        padding: 0;
        overflow: hidden;
        background: rgba(158, 158, 158, 0.20);
        box-shadow: 0 1px 1.5px 0 rgba(0, 0, 0, 0.12), 0 1px 1px 0 rgba(0, 0, 0, 0.24);
        position: relative;
        line-height: normal;
    }
</style>
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
                    <img src="{{ gravatar($user->email, 'small') }}" alt="{{ $user->name }}" class="user-avatar">
                    <h3 class="mdl-card__title-text mdl-title-username mdl-color-text--grey-900">
                        {{ $user->name }}
                    </h3>
                </div>
                <div id="avatar_selector_userimage" class="avatar-selecter @if($user->profile->avatar_status == 1) active-avatar-selecter @endif">
                    <div class="dz-preview"></div>
                    <form action="{{ route('avatar.upload')}}" method="post" name="avatarDropzone" id="avatarDropzone" class="form single-dropzone dropzone single" , files=true>
                        @if($user->profile->avatar)
                        <img id="user_selected_avatar" class="user-avatar" src="{{ $user->profile->avatar }}" alt="{{ $user->name }}">
                        @else
                        <div class="user-avatar-icon">
                            <i class="material-icons">file_upload</i>
                        </div>
                        @endif
                        <h3 class="mdl-card__title-text mdl-title-username mdl-color-text--grey-900">
                            {{ $user->name }}
                        </h3>
                    </form>
                    {{-- {!! Form::close() !!} --}}
                </div>
                <span itemprop="image" style="display:none;">{{ gravatar($user->email) }}</span>
            </div>
            <div id="user_profile_header" class="mdl-card__title mdl-color--primary mdl-color-text--white" @if ($user->profile->user_profile_bg != NULL) style="background: url('{{$user->profile->user_profile_bg}}') center/cover;" @endif>
                <form action="{{ route('background.upload')}}" method="POST" name="backgroundDropzone" id="backgroundDropzone" class="form single-dropzone dropzone single mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-js-ripple-effect mdl-color-text--white" enctype="multipart/form-data">
                    <i class="material-icons">wallpaper</i>
                </form>
            </div>
            <form method="POST" action="{{ Route('profile.update',$user->name)}}" , class="" , id="edit_profile_form" , role="form" , enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mdl-card__supporting-text">
                    <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
                        <div class="mdl-tabs__tab-bar">
                            <a href="#profile-panel" class="mdl-tabs__tab is-active">
                                Profile
                            </a>
                            <a href="#theme-panel" class="mdl-tabs__tab">
                                Theme
                            </a>
                        </div>
                        <div class="mdl-tabs__panel is-active" id="profile-panel">
                            <div class="mdl-grid ">
                                <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('name') ? 'is-invalid' :'' }}">
                                        <label for="name" class="textfield__label">{{__('auth.name')}}</label>
                                        <input type="text" name="name" id="name" value="{{ $user->username }}" class="mdl-textfield__input" pattern="[A-Z,a-z,0-9]*" disabled>
                                        <span class="mdl-textfield__error">Letters and numbers only</span>
                                    </div>
                                </div>
                                <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('email') ? 'is-invalid' :'' }}">
                                      <label for="email" class="textfield__label">{{__('auth.email')}}</label>
                                      <input type="email" name="email" id="email" value="{{ $user->email}}" class="mdl-textfield__input" disabled>
                                   </div>
                                </div>
                                <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('email') ? 'is-invalid' :'' }}">
                                      <label for="name" class="textfield__label">{{__('user.name')}}</label>
                                      <input type="text" name="name" id="name" value="{{ $user->name}}" class="mdl-textfield__input">
                                    </div>
                                </div>
                                  <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('email') ? 'is-invalid' :'' }}">
                                      <label for="name" class="textfield__label">{{__('user.lastName')}}</label>
                                      <input type="text" name="lastName" id="lastName" value="{{ $user->lastName}}" class="mdl-textfield__input">
                                    </div>
                                </div>
                                </div>
                                  <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('email') ? 'is-invalid' :'' }}">
                                      <label for="address" class="textfield__label">{{__('user.address')}}</label>
                                      <input type="text" name="address" id="address" value="{{ $user->address}}" class="mdl-textfield__input">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mdl-tabs__panel" id="theme-panel">
                            <div id="color_select_panel">
                                <div class="mdl-gen mdl-cell mdl-cell--12-col">
                                    <div class="mdl-grid">
                                        <div class="mdl-gen__panel mdl-gen__panel--left mdl-cell mdl-cell--6-col-desktop mdl-cell--8-col">
                                            <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-select mdl-select__fullwidth {{ $errors->has('theme_id') ? 'is-invalid' :'' }}">
                                                    <select class="mdl-selectfield__select mdl-textfield__input" name="theme_id" id="theme_id">
                                                        @if ($themes->count())
                                                            @foreach($themes as $theme)
                                                                <option value="{{ $theme->id }}"{{ $currentTheme->id == $theme->id ? 'selected="selected"' : '' }} data-link="{{ $theme->link }}" >{{ $theme->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <label for="theme_id">
													    <i class="mdl-icon-toggle__label material-icons">arrow_drop_down</i>
													</label>
                                                    <label for="theme_id" class="mdl-textfield__label mdl-selectfield__label mdl-color-text--primary">{{ __('profile.label-theme')}}</label>
                                                    @if ($errors->has('theme_id'))
                                                        <span class="mdl-textfield__error">{{ $errors->first('theme') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="mdl-gen__cdn mdl-cell mdl-cell--12-col sr-only">
                                                <div class="code-with-text" id="cdn-code">
                                                    <pre class="demo-code language-markup codepen-button-disabled">
                                                        <code class="language-markup mdl-gen__cdn-link" data-language="markup" id="color_selected">
                                                            material.$primary-$accent.min.css
                                                        </code>
                                                    </pre>
                                                </div>
                                            </div>
                                            <div id="wheel">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                    <defs>
                                                        <filter id="drop-shadow">
                                                            <feGaussianBlur in="SourceAlpha" stdDeviation="3.2" />
                                                            <feOffset dx="0" dy="0" result="offsetblur" />
                                                            <feFlood flood-color="rgba(0,0,0,1)" />
                                                            <feComposite in2="offsetblur" operator="in" />
                                                            <feMerge>
                                                                <feMergeNode />
                                                                <feMergeNode in="SourceGraphic" />
                                                            </feMerge>
                                                        </filter>
                                                    </defs>
                                                    <g class="wheel--maing"></g>
                                                </svg>
                                                <div class="mdl-gen-download">
                                                    <a href="#" id="download" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--fab">
                                                        <i class="material-icons">
                                                            format_color_fill
                                                        </i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mdl-gen__panel--right mdl-gen__panel mdl-cell mdl-cell--6-col-desktop mdl-cell--8-col">
                                            <div class="mdl-gen__desc docs-text-styling">
                                                <strong>
                                                    Custom CSS theme builder
                                                </strong>
                                                <p>
                                                    Click on the color wheel to choose a primary (1) and accent (2) color to preview the theme below.
                                                    When you’ve selected a color combination you like, simply click save.
                                                </p>
                                            </div>
                                            <div class="mdl-demo-card mdl-card mdl-shadow--2dp">
                                                <div class="mdl-gen__preview">
                                                    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
                                                        <header class="mdl-layout__header">
                                                            <div class="mdl-layout__header-row">
                                                                <span class="mdl-layout-title">Theme Preview</span>
                                                            </div>
                                                        </header>
                                                        <div class="mdl-layout__drawer">
                                                            <span class="mdl-layout-title">Theme Preview</span>
                                                            <nav class="mdl-navigation">
                                                                <a class="mdl-navigation__link" href="#">Some</a>
                                                                <a class="mdl-navigation__link" href="#">Links</a>
                                                                <a class="mdl-navigation__link" href="#">Here</a>
                                                            </nav>
                                                        </div>
                                                        <div class="mdl-layout__content">
                                                            <h4 class="margin-bottom-0">
                                                                Try it out
                                                            </h4>
                                                            <p>
                                                                Lorem ipsum dolor sit amet.
                                                            </p>
                                                            <p>
                                                                <a href="#" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                                                                    Accent
                                                                </a>
                                                                <a href="#" class="mdl-button mdl-button--colored mdl-button--raised mdl-js-button mdl-js-ripple-effect">
                                                                    Primary
                                                                </a>
                                                            </p>
                                                            <p>
                                                                <a href="#" class="mdl-button mdl-js-button mdl-button--primary">
                                                                    Primary
                                                                </a>
                                                                <a href="#" class="mdl-button mdl-js-button mdl-button--accent">
                                                                    Accent
                                                                </a>
                                                            </p>
                                                            <p>
                                                                <a href="#" class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored mdl-js-ripple-effect">
                                                                    <i class="material-icons">email</i>
                                                                </a>
                                                                <a href="#" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
                                                                    <i class="material-icons">add</i>
                                                                </a>
                                                                <a href="#" class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored">
                                                                    <i class="material-icons">person</i>
                                                                </a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mdl-card__actions padding-top-0 ">
                    <div class="mdl-grid padding-top-0">
                        <div class="mdl-cell mdl-cell--12-col padding-top-0 margin-top-0">
                            <span class="save-actions start-hidden">
                               
                                <button type="submit" class="btn bg-gradient-primary dialog-button-save mdl-button mdl-js-button mdl-js-ripple-effect margin-top-1 margin-top-0-desktop">{{ __('profile.submitButton')}}</button>
                            </span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection
@section('js')
<script type="text/javascript">
    initColorWheel();
    $(function() {

        /*    
        var userAvatarDropzone = Dropzone.forElement("#avatarDropzone");
		userAvatarDropzone.on('success', function() {
		 		var userAvatarStamped = "{{$user->profile->avatar}}?" + new Date().getTime() + (Math.floor(Math.random() * 1000) * Math.floor(Math.random() * 1000));
		 		var profileAvatar = $("#user_selected_avatar");
		 		var drawerAvatar = $("#drawer_avatar");
		 		profileAvatar.attr("src", userAvatarStamped);
		 		drawerAvatar.attr("src", userAvatarStamped);
		 	});
            */
        /*
         Dropzone.forElement(".single-dropzone").options.autoProcessQueue = false;
                    if (myDropzone.getQueuedFiles().length >= minFiles) {
                        //myDropzone.processQueue();
                        Dropzone.forElement(".single-dropzone").options.autoProcessQueue = true;                        
                        Dropzone.forElement(".single-dropzone").processQueue();
                        $('#form-create').submit();
                    } else { // Minimum file upload validations
                        Dropzone.forElement(".single-dropzone").options.autoProcessQueue = false;
                        alert("Minimum "+minFiles+" file needs to upload...!");
                        return false;
        }
        */
    });
</script>
@endsection