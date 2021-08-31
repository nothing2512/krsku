<?php $i = 0; ?>

<table id="task-table" class="table table-striped table-bordered nowrap">
    <thead>
    <tr>
        <th style="width: 10px"></th>
        <th>Course</th>
        <th>Title</th>
        <th>Deadline</th>
        <th></th>
    </tr>
    </thead>
    @foreach($tasks as $item)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $item->courseName }}</td>
            <td>{{ $item->title }}</td>
            <td class="text-center">
                @if($item->late == 1)
                    <span class="badge badge-danger">Late {{ $item->deadlineDifference }} Day</span>
                @elseif($item->deadlineDifference <= 3)
                    <span class="badge badge-warning">{{ $item->deadlineDifference }} Day Again</span>
                @else
                    <span class="badge badge-info">{{ $item->deadlineDifference }} Day Again</span>
                @endif
            </td>
            <td class="text-right">
                <a href="{{ route('api.task.edit.status', ['id' => $item->id]) }}">
                    <button class="btn btn-success btn-sm ml-1">
                        <i class="fas fa-check"></i>
                    </button>
                </a>
                <button class="btn btn-primary btn-sm ml-1" onclick="showTask('{{ json_encode($item) }}')">
                    <i class="fas fa-search-plus"></i>
                </button>
            </td>
        </tr>
    @endforeach
    <tfoot>
    <tr>
        <th style="width: 10px">#</th>
        <th>Course</th>
        <th>Title</th>
        <th>Deadline</th>
        <th></th>
    </tr>
    </tfoot>
</table>
