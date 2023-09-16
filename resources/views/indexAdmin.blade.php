@extends('layouts.base')



@section ('main')
<h1>Admin panel</h1>
<div>
	<div class="admin_item">
		<h3>Поповнити монети</h3>
		<a href="{{route('coins.add', 4)}}">Поповнити рахунок ресторану</a>

	</div>

	<div class="admin_item">
		<h3>Скарги</h3>
		foreach
		<p>Placename Dishid dishname cost datetime read/unread</p>
	</div>
	<p>
		Підключено закладів: 76 закладів <br>
		Куплено реклами 1м : 5 закладів <br>
		куплено Up 1м: 5 закладів <br>
		куплено стилів QR 1м: 5 закладів <br>
		Відключено рекламу 6м: 5 закладів <br>
		Відключено рекламу 12м: 5 закладів <br>
	</p>
	<table>
		<th>
			<dt>Показник</dt>
			<dt>7д</dt>
			<dt>30д</dt>
			<dt>90д</dt>
		</th>
		<tr>
			<dt>Переглядів меню</dt>
			<dt></dt>
			<dt></dt>
			<dt></dt>
		</tr>
		<tr>
			<dt>Переглядів index</dt>
			<dt></dt>
			<dt></dt>
			<dt></dt>
		</tr>
		<tr>
			<dt></dt>
			<dt></dt>
			<dt></dt>
			<dt></dt>
		</tr>
		<tr>
			<dt></dt>
			<dt></dt>
			<dt></dt>
			<dt></dt>
		</tr>
		<tr>
			<dt></dt>
			<dt></dt>
			<dt></dt>
			<dt></dt>
		</tr>
	</table>
</div>


@endsection('main')