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
                    <form action="{{ route('avatar.upload')}}" method="post" name="avatarDropzone" id="avatarDropzone" class="form single-dropzone dropzone single", files=true>
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
                <form action="{{ route('background.upload')}}" method="POST" name="backgroundDropzone" id="backgroundDropzone" class="form single-dropzone dropzone single mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-js-ripple-effect mdl-color-text--white" files => true>
                    <i class="material-icons">wallpaper</i>
                </form>
			</div>
        </div>
    </div>
</div>
@endif
@endsection
@section('js')
<script type="text/javascript">
    $(function(){
        
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
    });
</script>
@endsection