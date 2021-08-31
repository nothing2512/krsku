<?php $i = 0; ?>
<table
    id="course-table"
    class="table table-striped table-bordered text-center nowrap">
    <thead>
    <tr>
        <th>#</th>
        <th>Kosek</th>
        <th>Dosen</th>
        <th>Name</th>
        <th>Day</th>
        <th>Start</th>
        <th>Sks</th>
        <th>Score</th>
        <th></th>
    </tr>
    </thead>
    @foreach($courses as $item)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $item->kosek }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->dosen }}</td>
            <td>{{ $item->day_name }}</td>
            <td>{{ $item->start_time }}</td>
            <td>{{ $item->sks }}</td>
            <td>{{ $item->score }}</td>
            <td class="text-right">
                <a href="{{ route("course.detail", ["id" => $item->id]) }}">
                    <button
                        class="btn btn-primary btn-sm ml-1">
                        <i class="fas fa-search-plus"></i>
                    </button>
                </a>
                <button class="btn btn-warning btn-sm ml-1"
                        onclick="showEditModal('{{ json_encode($item) }}')">
                    <i class="fas fa-edit"></i>
                </button>
                <a href="{{ route("api.course.delete", ["id" => $item->id]) }}" onclick="return confirm('delete course {{ $item->code }}?')">
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
        <th>Kosek</th>
        <th>Dosen</th>
        <th>Name</th>
        <th>Day</th>
        <th>Start</th>
        <th>{{ $totalSks }}</th>
        <th>{{ $totalScore }}</th>
        <th></th>
    </tr>
    </tfoot>
</table>
