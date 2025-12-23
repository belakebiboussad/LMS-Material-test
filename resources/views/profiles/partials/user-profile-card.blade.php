<div class="mdl-grid full-grid margin-top-0 padding-0">
	<div class="mdl-cell mdl-cell mdl-cell--12-col mdl-cell--12-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop mdl-card mdl-shadow--3dp margin-top-0 padding-top-0">
	    <div class="mdl-card card-wide" style="width:100%;" itemscope itemtype="https://schema.org/Person">
			<div class="mdl-user-avatar">
				<img src="" alt="{{-- $user->name --}}" class="user-avatar">
				<span itemprop="image" style="display:none;">{{ $user->email }}</span>
			</div>
			<div class="mdl-card__title mdl-color--primary mdl-color-text--white"> 
            
		        <h3 class="mdl-card__title-text mdl-title-username">
		        	{{ $user->name }}
		        </h3>
            </div>
            <div class="mdl-card__supporting-text">
				<div class="mdl-grid full-grid padding-0">
					<div class="mdl-cell mdl-cell--12-col-phone mdl-cell--12-col-tablet mdl-cell--6-col-desktop">
					    <ul class="demo-list-icon mdl-list">
					        <li class="mdl-list__item mdl-typography--font-light">
					        	<div class="mdl-list__item-primary-content">
					        		<i class="material-icons mdl-list__item-icon">person</i>
									<span itemprop="name">
										{{ $user->name }} @if ($user->lastName) {{ $user->lastName }} @endif
									</span>
					        	</div>
					        </li>
					        <li class="mdl-list__item mdl-typography--font-light">
					        	<div class="mdl-list__item-primary-content">
					        		<i class="material-icons mdl-list__item-icon">contact_mail</i>
					        		<span itemprop="email">
										{{ $user->email }}
									</span>
					        	</div>
					        </li>
		 					@if ($user->profile)
								@if ($user->profile->location)
								    <li class="mdl-list__item mdl-typography--font-light">
								    	<div class="mdl-list__item-primary-content" itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
								    		<i class="material-icons mdl-list__item-icon">location_on</i>
											<span itemprop="streetAddress">
												{{ $user->profile->location }}
											</span>
								    	</div>
								    </li>
								@endif
							@endif
                        </ul>
                    </div>
                </div>
					@if ($user->profile)
						@if ($user->profile->location)
							<div class="mdl-cell mdl-cell mdl-cell--12-col-phone mdl-cell--12-col-tablet mdl-cell--6-col-desktop margin-top-0 margin-top-2-desktop">
								<div class="card-image mdl-card mdl-shadow--2dp">
									<div id="map-canvas"></div>
									<div class="mdl-card__actions mdl-color--primary mdl-color-text--white">
										<p class="mdl-typography--font-light">
											LON: <span id="longitude"></span> / LAT: <span id="latitude"></span>
										</p>
									</div>
								</div>
							</div>
						@endif
					@endif
            </div>
            <div class="mdl-card__actions">
				<div class="mdl-grid full-grid">
					<div class="mdl-cell mdl-cell--12-col">
						    @if (Auth::user()->id == $user->id)
								<!-- <a href="/profile/{{-- Auth::user()->name --}}/edit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-shadow--3dp mdl-button--raised mdl-button--primary mdl-color-text--white"> -->
                                    <a href="{{ route('profile.edit') }}" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-shadow--3dp mdl-button--raised mdl-button--primary mdl-color-text--white">
									<i class="material-icons padding-right-half-1">edit</i>
									{{ Lang::get('app.edit_profile') }}
								</a>
							@endif
					
					</div>
				</div>
		    </div>
        </div>
    </div>
</div>