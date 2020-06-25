@php /** @var \App\Models\OrderHistory $history*/ @endphp
<div class="panel panel-primary">
    <div class="panel-heading">
        <div data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $history->id }}">
            <h4 class="panel-title">
                {{ $history->human('created_at', true) }}
                <a class="alert-link" href="#">{{ $history->user->login }}</a> {{ $history->getTitle() }}
            </h4>
        </div>
    </div>
    <div id="collapse{{ $history->id }}" class="panel-collapse collapse">
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Поле</th>
                    <th>Старе значення</th>
                    <th>Нове значення</th>
                </tr>
                @foreach($history->getData() as $field => $item)
                    <tr>
                        <td>
                            {{ $history->getFieldName($field) }}
                        </td>
                        <td>
                            {{ $item['old'] ?? 'null' }}
                        </td>
                        <td>
                            {{ $item['new'] ?? 'null' }}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>