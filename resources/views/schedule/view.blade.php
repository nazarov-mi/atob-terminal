@extends('layouts.app_container')

@section('container')

<script type="text/javascript">
	$(document).ready(View.init);
</script>

<div class="row">
	<div>
		<div class="group hidden" data-name="orchestra">
			<h4>ОРКЕСТР</h4>
		</div>
		<div class="group hidden" data-name="chorus">
			<h4>ХОР</h4>
		</div>
		<div class="group hidden" data-name="lessons">
			<h4>УРОКИ СОЛИСТОВ</h4>
		</div>
		<div class="group hidden" data-name="ballet">
			<h4>БАЛЕТ</h4>
		</div>
		<div class="group hidden" data-name="mimamsa">
			<h4>МИМАНС</h4>
		</div>
	</div>
	<div>
		<div class="group hidden" data-name="tech-shop">
			<h4>МОНТИРОВОЧНЫЙ ЦЕХ</h4>
		</div>
		<div class="group hidden" data-name="songfest">
			<h4>СПЕВКИ</h4>
		</div>
		<div class="group hidden" data-name="rehearsals">
			<h4>СЦЕНИЧЕСКИЕ РЕПЕТИЦИИ</h4>
		</div>
		<div class="group hidden" data-name="performances">
			<h4>СПЕКТАКЛИ И КОНЦЕРТЫ</h4>
		</div>
	</div>
</div>

@endsection