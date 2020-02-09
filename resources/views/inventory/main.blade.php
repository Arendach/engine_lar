@extends('layout')

@section('title', 'Інвентаризація')

@breadcrumbs(['Інвентаризація'])

@section('content')
    <div class="right" style="margin-bottom: 15px">
        <a href="@uri('InventoryController@sectionCreate')" class="btn btn-primary">Додати</a>
    </div>

    @if($inventory->count())
        <table class="table table-bordered">
            <tr>
                <th>Дата</th>
                <th>Виробник</th>
                <th>Склад</th>
                <th>Провів</th>
                <th>Підкоректовано</th>
                <th>Коментар</th>
                <th class="action-1">Дії</th>
            </tr>
            @foreach ($inventory as $item)
                <tr>
                    <td>{{ $item->created_date_human }}</td>
                    <td>{{ $item->manufacturer->name ?? null }}</td>
                    <td>{{ $item->storage->name ?? null }}</td>
                    <td>{{ $item->user->login ?? null }}</td>
                    <td>{{ $item->products->count() }}</td>
                    <td>{{ $item->comment }}</td>
                    <td>
                        <a href="@uri('InventoryController@sectionPrint', ['id' => $item->id])" class="btn btn-primary btn-xs">
                            <span class="fa fa-eye"></span>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>

        {{ $inventory->links() }}
    @else
        <h4 class="centered">Тут пусто :(</h4>
    @endif
@endsection