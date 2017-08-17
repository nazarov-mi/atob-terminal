
/**
 * @copyright  ©2016 https://nazarov-mi.ru/
 * @author     Nazarov Maksim
 */

if (typeof jQuery === undefined) {
	throw new Error('JavaScript requires jQuery');
}

var _ = console.log;

var Main = {
	
	SAVE_INTERVAL:   1000 * 60, // в миллисекундах
	RELOAD_INTERVAL: 20,       // в секундах
	SCROLL_H:        20,
	
	init: function (opts)
	{
		_(opts);
		$.each(opts, function (k, v) {
			Main[k] = v;
		});

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': Main.token
			}
		});

		$(document).ready(Main.initDOM);
	},

	initDOM: function ()
	{
		var body = $('body'),
			nav = $('.navigation'),
			intervalId, scroll, dir;
		
		nav.mousedown(function () {
			if ($(this).is('.navigation-up')) {
				dir = -Main.SCROLL_H;
			} else {
				dir = Main.SCROLL_H;
			}

			intervalId = setInterval(function () {
				scroll = body.scrollTop();
				body.scrollTop(scroll + dir);
			}, 20);
		});

		nav.mouseup(function () {
			clearInterval(intervalId);
		});
	},

	block: function ()
	{
		$('body').append('<div class="overlap"><div class="spin"></div></div>');
	},

	unblock: function ()
	{
		var el = $('body').find('.overlap')
		el.fadeOut(200, function () {
			el.remove();
		});
	},

	msg: function (text, isWarn)
	{
		$('.container__inner').find('.msg-bl').remove();
		var el = $('<div class="msg-bl ' + (isWarn ? 'msg-bl_warn' : '') + '">' + text + '</div>')
			.prependTo('.container__inner')
			.delay(5000)
			.slideUp(200)
			.queue(function ()
			{
				el.remove();
			});
		_(text);
	},

	post: function (url, data, success, error, complete)
	{
		$.ajax({
			url: url,
			cache: false,
			type: 'post',
			dataType: 'json',
			data: data,
			complete: complete,
			
			success: function (data)
			{
				if (data.ok) {
					Main.msg(data.msg || 'Выполнено', false);
					if (success) {
						success(data)
					}
				} else {
					_(data);
					Main.msg(data.msg || 'Ошибка на сервере', true);
					if (error) {
						error(data);
					}
				}
			},

			error: function (data)
			{
				_(data);
				Main.msg('Ошибка Ajax запроса', true);
				if (error) {
					error(data);
				}
				$('body').html(data.responseText);
			}
		});
	}
}

var View = {

	init: function ()
	{
		Main.block();
		Main.post(
			Main.getUrl,
			{
				date:	Main.date
			},
			View.parse,
			false,
			Main.unblock
		);
		
		var process = Main.RELOAD_INTERVAL;
		
		$('body').click(function () {
			process = Main.RELOAD_INTERVAL;
		});
		
		$(window).scroll(function () {
			process = Main.RELOAD_INTERVAL;
		});

		var intervalId = setInterval(function () {
			_(process);
			if (-- process <= 0) {
				clearInterval(intervalId);
				window.location.reload(true);
			}
		}, 1000);
	},

	parse: function (data)
	{
		if (data.data == undefined) return;

		const dataJson = data.data;

		if (dataJson == undefined || dataJson == '') return;

		data = JSON.parse(dataJson);
		_(data);
		
		$.each(data.groups, function (i, group)
		{
			var $group = $('.group[data-name="' + group.name + '"]').show();
			var $inner = $('<div class="group__inner"></div>').appendTo($group);
			
			$.each(group.items, function (i, item)
			{
				var $item = $('<div class="group__item"></div>').appendTo($inner);
				
				$.each(item.fields, function (i, field)
				{
					if (field.type == 1) {
						if (field.label) {
							$item.append('<h5>' + field.label + '</h5>');
						}
						
						$item.append('<p>' + field.html + '</p>');
					} else {
						if (field.label) {
							$item.append('<div class="row"><div><b>' + field.label + '</b></div><div>' + field.text + '</div></div>');
						} else {
							$item.append('<h5><i>' + field.text + '</i></h5>');
						}
					}
				});
			});
		});
	}
}

var Edit = {

	init: function ()
	{
		$('.group .group__delete-btn').click(function ()
		{
			if (!confirm('Вы уверены?')) return;

			$item = $(this).parents('.group__item');
			$item.slideUp(200, function () {
				$item.remove();
			});
		});

		$('.group .group__add-btn').click(function ()
		{
			$group = $(this).parents('.group');
			$inner = $group.find('.group__inner');
			$item = $group.find('.group__sample')
				.clone(true)
				.removeClass('group__sample')
				.removeClass('hidden')
				.addClass('group__item')
				.appendTo($inner)
				.hide()
				.slideDown(200);
		});

		$('.header__save-btn').click(Edit.save);

		Main.block();
		Main.post(
			Main.getUrl,
			{
				date:	Main.date
			},
			function (data) {
				Edit.parse(data);
				
				setInterval(function () {
					Edit.save();
				}, Main.SAVE_INTERVAL);
			},
			false,
			Main.unblock
		);
	},

	save: function ()
	{
		var res = {}
		var groups = res.groups = [];
		
		$('.group').each(function (i, el) {
			$el = $(el);
			var group = {
				'name': $el.attr('data-name')
			};
			var items = group.items = [];
			
			$el.find('.group__item').each(function (i, el) {
				$el = $(el);
				var item = {};
				var fields = item.fields = [];
				
				$el.find(':input').not(':button, :submit, :reset').each(function (i, el) {
					$el = $(el);
					var val = $el.val();
					
					if (val !== undefined && val !== '') {
						fields.push({
							name:	$el.attr('data-name'),
							label:	$el.attr('data-label'),
							type:	$el.is('textarea') ? 1 : 0,
							text:	val,
							html:	val.replace(/\n\r|\r\n|\n|\r/g, '<br/>')
						});
					}
				});
				
				if (fields.length > 0) items.push(item);
			});
			
			if (items.length > 0) groups.push(group);
		});
		
		if (groups.length > 0) res = JSON.stringify(res);
		else res = '';
		
		Main.msg('Сохранение...');
		Main.post(
			Main.saveUrl,
			{
				date:	Main.date,
				data:	res
			}
		);
	},

	parse: function (data)
	{
		if (data.data == undefined) return;
		
		const dataJson = data.data;

		if (dataJson == undefined || dataJson == '') return;

		data = JSON.parse(dataJson);
		
		$.each(data.groups, function (i, group)
		{
			var $group = $('.group[data-name="' + group.name + '"]');
			var $inner = $group.find('.group__inner');
			
			$.each(group.items, function (i, item)
			{
				$item = $group.find('.group__sample')
					.clone(true)
					.removeClass('group__sample')
					.removeClass('hidden')
					.addClass('group__item')
					.appendTo($inner);
				
				$.each(item.fields, function (i, field)
				{ 
					$item.find('[data-name="' + field.name + '"]').val(field.text);
				});
			});
		});
	}
}

var Datepicker = {
	
	init: function ()
	{
		Datepicker.months = [
			'Январь', 'Февраль', 'Март',
			'Апрель', 'Май', 'Июнь',
			'Июль', 'Август', 'Сентябрь',
			'Октябрь', 'Ноябрь', 'Декабрь'
		];

		Datepicker.days = [
			'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'
		];

		Datepicker.$container = $('.datepicker__table');
		Datepicker.$title = $('.datepicker__title');

		Datepicker.date = new Date(Main.date);
		Datepicker.year = Datepicker.date.getFullYear();
		Datepicker.month = Datepicker.date.getMonth();
		
		Datepicker.$container.click(function (event)
		{
			var target = $(event.target);
			
			if (target.is('td[data-bind]')) {
				window.location = Main.homeUrl + '/' + target.attr('data-bind');
			}
		});
		
		$('.datepicker__prev').click(function ()
		{
			if (Datepicker.month == 0) {
				Datepicker.month = 11;
				-- Datepicker.year;
			} else {
				-- Datepicker.month;
			}

			Datepicker.show();
		});
		
		$('.datepicker__next').click(function ()
		{
			if (Datepicker.month == 11) {
				Datepicker.month = 0;
				++ Datepicker.year;
			} else {
				++ Datepicker.month;
			}

			Datepicker.show();
		});

		Datepicker.show();
	},
	
	show: function ()
	{
		Datepicker.date.setFullYear(Datepicker.year, Datepicker.month, 1);
		var date = Datepicker.date;
		var day = date.getDay();
		const firstDay = (day == 0 ? 6 : day - 1);
		const markp = Datepicker.year + '-' + (Datepicker.month < 9 ? '0' : '') + (Datepicker.month + 1) + '-';

		date.setDate(33);
		const numDays = 33 - date.getDate();
		const weeksInMonth = Math.ceil((firstDay + numDays) / 7) + 1; // + поле для выходных

		var res = '<table><tbody>';
		var curDay = 1;
		
		for (var i = 0; i < weeksInMonth; ++ i) {
			
			res += '<tr>';
			
			for (var j = 0; j < 7; ++ j) {
				if (i == 0) {
					res += '<th>' + Datepicker.days[j] + '</th>';
				} else
				if ((i == 1 && j < firstDay) || curDay > numDays) {
					res += '<td class="datepicker__disabled"></td>';
				} else {
					const mark = markp + (curDay < 10 ? '0' : '') + curDay;

					res += '<td data-bind="' + mark + '" ' + (mark == Main.date ? 'class="datepicker__active"' : '') + '>' + curDay + '</td>';
					++ curDay;
				}
			}
			
			res += '</tr>';
		}
		
		res += '</tbody></table>';
		
		Datepicker.$container.fadeOut(100, function () {
			$(this).html(res).fadeIn(200);
		});
		Datepicker.$title.html(Datepicker.year + ' ' + Datepicker.months[Datepicker.month]);
	}
}
