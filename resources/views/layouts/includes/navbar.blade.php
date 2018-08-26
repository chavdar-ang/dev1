<div id="nav-header">
	<div class="ui container fluid" style="padding: 0 20px;">
		<div class="ui stackable secondary menu">
			<a href="/" class="active item"> Seminari 365</a>
			<a href="/browse" class="item"> Обучения</a>
			<a href="/v" class="item"> Зали</a>
			<div class="item">
				<search></search>
			</div>

			<!-- <div class="ui mini form">
				<div class="ui action left icon input">
					<i class="search icon"></i>
					<input type="text" placeholder="Search...">
					<div class="ui orange button">Search</div>
				</div>
			</div> -->
			<div class="right menu">
				@guest
				<register></register>			
				<login></login>
				<!-- <div class="item">
					<a class="ui basic secondary button" href="{{ route('login') }}">{{ __('Login') }}</a>	
					<a class="ui basic primary button" href="{{ route('register') }}">{{ __('Register') }}</a>                
				</div> -->
				@else
				@if(Auth::user()->role_id == 2)
					<a href="/dashboard#/home" class="item">Бизнес панел</a>
				@endif
				<div class="ui dropdown item">
					<div class="text">
						<img class="ui avatar image" src="/img/default_user.png"> {{ Auth::user()->firstname }} <i class="dropdown icon"></i>
					</div>
					<div class="menu">

						<a href="/users/settings#/notifications" class="item">Акаунт</a>

						<a class="item" href="{{ route('logout') }}"
	                       onclick="event.preventDefault();
	                                     document.getElementById('logout-form').submit();">
	                        {{ __('Изход') }}
	                    </a>

	                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	                        @csrf
	                    </form>
					</div>
				</div>

				@if(Auth::user()->role_id == 2)
					<!-- <div class="ui dropdown icon item">
						<i class="plus square icon"></i>
						<div class="menu">
							<div class="item">
								Събитие
							</div>
							<div class="item">
								Тема
							</div>
							<div class="item">
								Лектор
							</div>
							<div class="item">
								Зала
							</div>
						</div>
					</div> -->
				@endif

				@if(auth::user()->verified())
					<a href="/messages#/t" class="item">
						<i class="paper plane outline icon"></i>
					</a>
				@endif

				<notifications :user_id="{{ json_encode(auth()->id()) }}"></notifications>
				@endguest

				<!-- <div class="ui dropdown icon item">
					<i class="question outline circle icon"></i>
					<div class="menu">
						<div class="item">
							Помощ
						</div>
						<div class="item">
							Реклама
						</div>
						<div class="item">
							Контакти
						</div>
					</div>
				</div> -->
			</div>
		</div>
	</div>

</div>
