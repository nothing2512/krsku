<table id="semester-table" class="table table-striped text-center table-bordered nowrap">
    <thead>
    <tr>
        <th style="width: 10px">#</th>
        <th style="width: 20px">Status</th>
        <th style="width: 20px">Code</th>
        <th class="w-auto">Name</th>
        <th>Ipk</th>
        <th></th>
    </tr>
    </thead>
    @foreach($semesters as $item)
        <tr>
            <td>{{ ++$i }}</td>
            <td>
                <span class="dot {{ $item->active == 1 ? 'bg-success' : 'bg-danger' }}"></span>
            </td>
            <td>{{ $item->code }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->ipk }}</td>
            <td class="text-right">
                @if($item->active == 0)
                    <a href="{{ route('api.semester.activate', ["id" => $item->id]) }}">
                        <button class="btn btn-success btn-sm">
                            <i> Activate</i>
                        </button>
                    </a>
                @endif
                <button class="btn btn-warning btn-sm"
                        onclick="showEditModal('{{ json_encode($item) }}')">
                    <i class="fas fa-edit"></i>
                </button>
                <a href="{{ route("api.semester.delete", ["id" => $item->id]) }}" onclick="return confirm('delete semester {{ $item->code }}?')">
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
        <th style="width: 10px">#</th>
        <th style="width: 20px">Status</th>
        <th style="width: 20px">Code</th>
        <th class="w-auto">Name</th>
        <th>Ipk</th>
        <th></th>
    </tr>
    </tfoot>
</table>
