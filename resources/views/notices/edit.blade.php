@extends('layouts.app_container')

@section('container')

<script type="text/javascript">
	$(document).ready(Edit.init);
</script>

<div class="group" data-name="notices">
	<h4 class="group__title">ОБЪЯВЛЕНИЯ</h4>
	<div class="group__sample hidden">
		<button class="group__delete-btn">×</button>
		<label>
			Заголовок
			<br/>
			<input type="text" data-name="title" />
		</label>
		<label>
			Текст
			<br/>
			<textarea data-name="text"></textarea>
		</label>
	</div>
	<div class="group__inner"></div>
	<button class="group__add-btn">Добавить</button>
</div>

@endsection