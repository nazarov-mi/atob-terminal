@extends('layouts.app')

@section('content')

<script type="text/javascript">
	Main.init({
		date:		'{{ $date }}',
		token:		'{{ csrf_token() }}',
		homeUrl:	'{{ action('ScheduleController@view') }}',
		getUrl:		'{{ action($controller . '@get') }}',
		saveUrl:	'{{ action($controller . '@save') }}'
	});

	$(document).ready(Datepicker.init);
</script>

<div class="menu">
	<div class="menu__inner">
		<div class="menu__header">
			<div class="menu__logo logo"></div>
		</div>
		<div class="menu__item">
			<div class="datepicker">
				<h5 class="datepicker__title"></h5>
				<div class="datepicker__nav">
					<a href="javascript:void(0)" class="datepicker__prev">&larr;Пред</a>
					<a href="javascript:void(0)" class="datepicker__next">След&rarr;</a>
				</div>
				<div class="datepicker__table"></div>
			</div>
		</div>
		<div class="menu__item">
			<div class="menu__link-list">
				<a href="{{ action($controller . '@view', ['date' => date('Y-m-d')]) }}">Сегодня</a>
				<a href="{{ action($controller . '@view', ['date' => date('Y-m-d', time() + 86400)]) }}">Завтра</a>
				<a href="{{ action($controller . '@view', ['date' => date('Y-m-d', time() + 172800)]) }}">Послезавтра</a>
			</div>
		</div>
		<div class="menu__item">
			@if ($controller == 'ScheduleController')
				<a href="{{ action('NoticeController@view', ['date' => $date]) }}">Объявления</a>
			@else
				<a href="{{ action('ScheduleController@view', ['date' => $date]) }}">Расписание</a>
			@endif
		</div>
	</div>
	{{--
	<div class="menu__auth-link">
		@if (Auth::check())
			<a href="{{ action('AuthController@logout') }}">Выйти</a>
		@else
			<a href="{{ action('AuthController@login') }}">Войти</a>
		@endif
	</div>
	--}}
</div>

<div class="header">
	<div class="header__inner">
		<h4 class="header__title">
			{{ ($controller == 'ScheduleController') ? 'Расписание' : 'Объявления' }} на <i>{{ strtr(date('j F, Y', strtotime($date)), trans('date.month_declensions')) }}</i>
		</h4>
		<div class="header__btn-list">
			@if (Auth::check())
				@if (isset($edit) && $edit)
					<a href="{{ action($controller . '@view', ['date' => $date]) }}">Назад</a>
					<button class="header__save-btn">Сохранить</button>
				@else
					<a href="{{ action($controller . '@edit', ['date' => $date]) }}" class="btn">Изменить</a>
				@endif
			@endif
		</div>
	</div>
</div>

<div class="navigation navigation-up"></div>
<div class="navigation navigation-down"></div>

<div class="container">
	<div class="container__inner">
		@yield('container')
	</div>
</div>

@endsection