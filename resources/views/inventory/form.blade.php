<table class="table table-bordered">
    <tr>
        <td><b>ІД</b></td>
        <td><b>Назва</b></td>
        <td><b>Артикул</b></td>
        <td><b>Модель</b></td>
        <td><b>На складі</b></td>
        <td style="width: 250px"><b>+/-</b></td>
    </tr>
    @foreach($products as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td><a href="@uri('ProductController@sectionUpdate', ['id' => $item->id])">{{ $item->name }}</a></td>
            <td>{{ $item->articul }}</td>
            <td>{{ $item->model }}</td>
            <td>{{ $item->storage_list->first()->count }}</td>
            <td><input style="width: 100%" name="products[{{ $item->id }}]" data-inspect="integer"></td>
        </tr>
    @endforeach
</table>

<div class="form-group">
    <label>Коментар</label>
    <textarea name="comment" class="form-control"></textarea>
</div>

<div class="form-group">
    <button class="btn btn-primary">Прийняти</button>
</div>