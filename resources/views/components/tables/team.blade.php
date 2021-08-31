<?php $i = 0; ?>

<table id="team-table" class="table table-striped table-bordered nowrap">
    <thead>
    <tr>
        <th>#</th>
        <th class="w-auto">Name</th>
        <th>Member</th>
        <th></th>
    </tr>
    </thead>
    @foreach($teams as $item)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->member }}</td>
            <td class="text-right">
                <button class="btn btn-warning btn-sm ml-1" onclick="editTeam('{{ json_encode($item) }}')">
                    <i class="fas fa-edit"></i>
                </button>
                <a href="{{ route("api.team.delete", ["id" => $item->id]) }}" onclick="return confirm('delete team {{ $item->name }}?')">
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
        <th class="w-auto">Name</th>
        <th>Member</th>
        <th></th>
    </tr>
    </tfoot>
</table>
