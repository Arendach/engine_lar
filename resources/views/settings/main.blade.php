@extends('layout')

@section('title', 'Налаштуванян')

@breadcrumbs(['Налаштуванян'])

@section('content')
    <i class="fa fa-cog"></i> <a href="@uri('settings/hints')">Кольорові підказки</a><br>
    <i class="fa fa-cog"></i> <a href="@uri('settings/delivery')">Доставка</a><br>
    <i class="fa fa-cog"></i> <a href="@uri('settings/pay')">Оплата</a><br>
    <i class="fa fa-cog"></i> <a href="@uri('settings/attribute')">Атрибути</a><br>
    <i class="fa fa-cog"></i> <a href="@uri('settings/order_type')">Типи замовлень</a><br>
    <i class="fa fa-cog"></i> <a href="@uri('sms/templates')">Смс-Шаблони</a><br>
    <i class="fa fa-cog"></i> <a href="@uri('settings/course')">Курс валют</a><br>
    <i class="fa fa-cog"></i> <a href="@uri('settings/sites')">Сайти</a><br>
    <i class="fa fa-cog"></i> <a href="@uri('settings/ids')">Ідентифікатори складів</a><br>
    <i class="fa fa-cog"></i> <a href="@uri('settings/merchant')">Мерчанти</a><br>
    <i class="fa fa-cog"></i> <a href="@uri('settings/shops')">Магазини</a><br>
    <i class="fa fa-cog"></i> <a href="@uri('settings/characteristics')">Характеристики</a><br>
    <i class="fa fa-cog"></i> <a href="@uri('settings/black_dates')">Чорна дата</a><br>
@stop