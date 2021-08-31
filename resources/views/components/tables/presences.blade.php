<?php $i = 0; ?>
<table id="presence-table" class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th></th>
    </tr>
    </thead>
    @foreach($presences as $item)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $item->type }}</td>
            <td class="text-right">
                <a href="{{ $item->link }}" target="_blank">
                    <button class="btn btn-primary btn-sm ml-1">
                        <i class="fas fa-link"> Presence</i>
                    </button>
                </a>
                <button class="btn btn-warning btn-sm ml-1" onclick="editPresence('{{ json_encode($item) }}')">
                    <i class="fas fa-edit"></i>
                </button>
                <a href="{{ route('api.presence.delete', ['id' => $item->id]) }}" onclick="return confirm('delete presence {{ $item->type }}?')">
                    <button
                        class="btn btn-danger btn-sm ml-1">
                        <i class="fas fa-trash"></i>
                    </button>
                </a>
            </td>
        </tr>
    @endforeach
    <tfoot>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th></th>
    </tr>
    </tfoot>
</table>
