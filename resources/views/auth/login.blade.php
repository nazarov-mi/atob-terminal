@extends('layouts.app')


@section('content')

<div class="login">
	<div class="login__inner">
		<form action="{{ action('AuthController@auth') }}" method="POST">
			<div class="login__logo logo"></div>
			@if (isset($error))
				{{ $error }}
			@endif
			{{ csrf_field() }}
			<input type="text" name="username" placeholder="Логин" />
			<input type="password" name="password" placeholder="Пароль" />
			<button class="login__btn">Войти</button>
		</form>
	</div>
</div>

@endsection