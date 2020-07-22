@extends('layout')

@section('title', 'Закупки :: Нова закупка')

@breadcrumbs(
    ['Закупки', uri('purchase/main')],
    ['Нова закупка']
)

@section('content')
    @if(request()->has('manufacturer_id'))
        <script>
            window.Purchase = {
                manufacturer_id: '{{ request('manufacturer_id') }}',
                storage_id: '{{ request('storage_id') }}',
            }
        </script>

        <h3>{{ $manufacturer->name }} => {{ $storage->name }}</h3>

        <hr>

        @include('purchase.add_product')

        <hr>

        <form action="@uri('purchase/create')" data-type="ajax" data-after="redirect" data-redirect-to="@uri('purchase/main')">
            <input type="hidden" name="manufacturer_id" value="{{ request('manufacturer_id') }}">
            <input type="hidden" name="storage_id" value="{{ request('storage_id') }}">

            <table class="table table-bordered">
                <thead>
                <th>Назва товару</th>
                <th style="width: 100px">На складі</th>
                <th>Кількість</th>
                <th>Закупівельна вартість($)</th>
                <th>Сума</th>
                <th></th>
                </thead>
                <tbody>

                </tbody>
            </table>

            <div class="form-group">
                <label>Сума</label>
                <input class="form-control" id="sum" data-inspect="decimal">
            </div>

            <div class="form-group">
                <label>Коментар</label>
                <textarea class="form-control" name="comment"></textarea>
            </div>

            <div class="form-group">
                <button class="btn btn-primary">Зберегти</button>
            </div>
        </form>
    @else
        <form action="@uri('purchase/create')">
            <div class="form-group"><label>Виробник</label>
                <select required name="manufacturer_id" class="form-control">
                    <option value=""></option>
                    @foreach($manufacturers as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Склад</label>
                <select required name="storage_id" class="form-control">
                    @foreach ($warehouses as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <button class="btn btn-primary">Дальше</button>
            </div>
        </form>
    @endif

@endsection