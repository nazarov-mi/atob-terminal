@extends('layouts.app_container')

@section('container')

<script type="text/javascript">
	$(document).ready(Edit.init);
</script>

<div class="row">
	<div>
		<div class="group" data-name="orchestra">
			<h4 class="group__title">ОРКЕСТР</h4>
			<div class="group__sample hidden">
				<button class="group__delete-btn">×</button>
				<label>
					Время
					<br/>
					<input type="text" data-name="time" />
				</label>
				<label>
					Название
					<br/>
					<input type="text" data-name="name" />
				</label>
				<label>
					Тип
					<br/>
					<input type="text" data-name="type" />
				</label>
				<label>
					Место
					<br/>
					<input type="text" data-name="place" data-label="Место" />
				</label>
				<label>
					Дирижёр
					<br/>
					<input type="text" data-name="conductor" data-label="Дирижёр" />
				</label>
			</div>
			<div class="group__inner"></div>
			<button class="group__add-btn">Добавить</button>
		</div>
		<div class="group" data-name="chorus">
			<h4 class="group__title">ХОР</h4>
			<div class="group__sample hidden">
				<button class="group__delete-btn">×</button>
				<label>
					Время
					<br/>
					<input type="text" data-name="time" />
				</label>
				<label>
					Название
					<br/>
					<input type="text" data-name="name" />
				</label>
				<label>
					Тип
					<br/>
					<input type="text" data-name="type" />
				</label>
				<label>
					Место
					<br/>
					<input type="text" data-name="place" data-label="Место" />
				</label>
				<label>
					Хормейстер
					<br/>
					<input type="text" data-name="choirmaster" data-label="Хормейстер" />
				</label>
				<label>
					Концертмейстер
					<br/>
					<input type="text" data-name="concertmaster" data-label="Концертмейстер" />
				</label>
			</div>
			<div class="group__inner"></div>
			<button class="group__add-btn">Добавить</button>
		</div>
		<div class="group" data-name="ballet">
			<h4 class="group__title">БАЛЕТ</h4>
			<div class="group__sample hidden">
				<button class="group__delete-btn">×</button>
				<label>
					Время
					<br/>
					<input type="text" data-name="time" />
				</label>
				<label>
					Название
					<br/>
					<input type="text" data-name="name" />
				</label>
				<label>
					Тип
					<br/>
					<input type="text" data-name="type" />
				</label>
				<label>
					Место
					<br/>
					<input type="text" data-name="place" data-label="Место" />
				</label>
				<label>
					Балетмейстер
					<br/>
					<input type="text" data-name="choreographer" data-label="Балетмейстер" />
				</label>
				<label>
					Концертмейстер
					<br/>
					<input type="text" data-name="concertmaster" data-label="Концертмейстер" />
				</label>
			</div>
			<div class="group__inner"></div>
			<button class="group__add-btn">Добавить</button>
		</div>
		<div class="group" data-name="lessons">
			<h4 class="group__title">УРОКИ СОЛИСТОВ</h4>
			<p class="group__desc">
				Список солистов вводиться в следующем формате:<br/>
				Время - Солист<br/>
				...
			</p>
			<div class="group__sample hidden">
				<button class="group__delete-btn">×</button>
				<label>
					Преподаватель
					<br/>
					<input type="text" data-name="teacher" data-label="Преподаватель" />
				</label>
				<label>
					Место
					<br/>
					<input type="text" data-name="place" data-label="Место" />
				</label>
				<label>
					Солисты
					<br/>
					<textarea data-name="artists" data-label="Солисты"></textarea>
				</label>
			</div>
			<div class="group__inner"></div>
			<button class="group__add-btn">Добавить</button>
		</div>
		<div class="group" data-name="mimamsa">
			<h4 class="group__title">МИМАНС</h4>
			<div class="group__sample hidden">
				<button class="group__delete-btn">×</button>
				<label>
					Время
					<br/>
					<input type="text" data-name="time" />
				</label>
				<label>
					Название
					<br/>
					<input type="text" data-name="name" />
				</label>
				<label>
					Тип
					<br/>
					<input type="text" data-name="type" />
				</label>
				<label>
					Место
					<br/>
					<input type="text" data-name="place" data-label="Место" />
				</label>
				<label>
					Описание
					<br/>
					<textarea data-name="description"></textarea>
				</label>
			</div>
			<div class="group__inner"></div>
			<button class="group__add-btn">Добавить</button>
		</div>
	</div>
	<div>
		<div class="group" data-name="tech-shop">
			<h4 class="group__title">МОНТИРОВОЧНЫЙ ЦЕХ</h4>
			<div class="group__sample hidden">
				<button class="group__delete-btn">×</button>
				<label>
					Время
					<br/>
					<input type="text" data-name="time" />
				</label>
				<label>
					Место
					<br/>
					<input type="text" data-name="place" data-label="Место" />
				</label>
				<label>
					Описание
					<br/>
					<textarea data-name="description"></textarea>
				</label>
			</div>
			<div class="group__inner"></div>
			<button class="group__add-btn">Добавить</button>
		</div>
		<div class="group" data-name="songfest">
			<h4 class="group__title">СПЕВКИ</h4>
			<div class="group__sample hidden">
				<button class="group__delete-btn">×</button>
				<label>
					Время
					<br/>
					<input type="text" data-name="time" />
				</label>
				<label>
					Название
					<br/>
					<input type="text" data-name="name" />
				</label>
				<label>
					Тип
					<br/>
					<input type="text" data-name="type" />
				</label>
				<label>
					Место
					<br/>
					<input type="text" data-name="place" data-label="Место" />
				</label>
				<label>
					Описание
					<br/>
					<textarea data-name="description"></textarea>
				</label>
			</div>
			<div class="group__inner"></div>
			<button class="group__add-btn">Добавить</button>
		</div>
		<div class="group" data-name="rehearsals">
			<h4 class="group__title">СЦЕНИЧЕСКИЕ РЕПЕТИЦИИ</h4>
			<div class="group__sample hidden">
				<button class="group__delete-btn">×</button>
				<label>
					Время
					<br/>
					<input type="text" data-name="time" />
				</label>
				<label>
					Название
					<br/>
					<input type="text" data-name="name" />
				</label>
				<label>
					Место
					<br/>
					<input type="text" data-name="place" data-label="Место" />
				</label>
				<label>
					Дирижёр
					<br/>
					<input type="text" data-name="conductor" data-label="Дирижёр" />
				</label>
				<label>
					Режиссёр
					<br/>
					<input type="text" data-name="producer" data-label="Режиссёр" />
				</label>
				<label>
					Помощники режиссёра
					<br/>
					<textarea data-name="assistants" data-label="Помощники режиссёра"></textarea>
				</label>
				<label>
					Концертмейстеры
					<br/>
					<textarea data-name="accompanists" data-label="Концертмейстеры"></textarea>
				</label>
				<label>
					Заняты
					<br/>
					<textarea data-name="others" data-label="Заняты"></textarea>
				</label>
			</div>
			<div class="group__inner"></div>
			<button class="group__add-btn">Добавить</button>
		</div>
		<div class="group" data-name="performances">
			<h4 class="group__title">СПЕКТАКЛИ И КОНЦЕРТЫ</h4>
			<div class="group__sample hidden">
				<button class="group__delete-btn">×</button>
				<label>
					Время
					<br/>
					<input type="text" data-name="time" />
				</label>
				<label>
					Название
					<br/>
					<input type="text" data-name="name" />
				</label>
				<label>
					Место
					<br/>
					<input type="text" data-name="place" data-label="Место" />
				</label>
				<label>
					Дирижёр
					<br/>
					<input type="text" data-name="conductor" data-label="Дирижёр" />
				</label>
				<label>
					Режиссёр
					<br/>
					<input type="text" data-name="producer" data-label="Режиссёр" />
				</label>
				<label>
					Концертмейстеры
					<br/>
					<textarea data-name="accompanists" data-label="Концертмейстеры"></textarea>
				</label>
				<label>
					Помощники режиссёра
					<br/>
					<textarea data-name="assistants" data-label="Помощники режиссёра"></textarea>
				</label>
				<label>
					Заняты
					<br/>
					<textarea data-name="others" data-label="Заняты"></textarea>
				</label>
			</div>
			<div class="group__inner"></div>
			<button class="group__add-btn">Добавить</button>
		</div>
	</div>
</div>

@endsection