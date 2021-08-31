<table id="certificate-table" class="table table-striped text-center table-bordered nowrap">
    <thead>
    <tr>
        <th style="width: 10px">#</th>
        <th class="w-auto">Title</th>
        <th>Obtained Date</th>
        <th>Expired Date</th>
        <th style="width: 150px"></th>
    </tr>
    </thead>
    @foreach($certificates as $item)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $item->title }}</td>
            <td>{{ $item->obtainedDate }}</td>
            <td>{{ $item->expiredDate ?? '-' }}</td>
            <td class="text-right">
                <button class="btn btn-primary btn-sm" onclick="showContent('{{ $item->attachments }}', '{{ $item->mime }}')">
                    <i class="fas fa-search-plus"></i>
                </button>
                <button class="btn btn-info btn-sm" onclick="window.open('{{ $item->attachments }}?r=download')">
                    <i class="fas fa-download"></i>
                </button>
                <button class="btn btn-warning btn-sm"
                        onclick="showEditModal('{{ json_encode($item) }}')">
                    <i class="fas fa-edit"></i>
                </button>
                <a href="{{ route("api.certificate.delete", ["id" => $item->id]) }}" onclick="return confirm('delete certificate {{ $item->name }}?')">
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
        <th class="w-auto">Title</th>
        <th>Obtained Date</th>
        <th>Expired Date</th>
        <th style="width: 150px"></th>
    </tr>
    </tfoot>
</table>
