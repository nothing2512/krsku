<?php $i = 0; ?>

<table id="task-table" class="table table-striped table-bordered nowrap">
    <thead>
    <tr>
        <th style="width: 10px">#</th>
        <th style="width: 140px"></th>
        <th>Title</th>
        <th style="width: 120px">Deadline</th>
        <th style="width: 160px"></th>
    </tr>
    </thead>
    @foreach($tasks as $item)
        <tr>
            <td>{{ ++$i }}</td>
            <td class="text-center">
                @if($item->teamId == 0)
                    <span class="badge badge-success">Individual</span>
                @else
                    <span class="badge badge-info">Teams</span>
                @endif
                @if($item->status == 0)
                    <span class="badge badge-danger">Unfinished</span>
                @else
                    <span class="badge badge-success">Done</span>
                @endif
            </td>
            <td>{{ $item->title }}</td>
            <td>{{ $item->deadline }}</td>
            <td class="text-right">
                @if($item->status == 0)
                    <a href="{{ route('api.task.edit.status', ['id' => $item->id]) }}">
                        <button class="btn btn-success btn-sm ml-1">
                            <i class="fas fa-check"> Finish</i>
                        </button>
                    </a>
                @else
                    <a href="{{ route('api.task.edit.status', ['id' => $item->id]) }}">
                        <button class="btn btn-danger btn-sm ml-1">
                            <i class="fas fa-times"> Undo</i>
                        </button>
                    </a>
                @endif
                <button class="btn btn-warning btn-sm ml-1" onclick="editTask('{{ json_encode($item) }}')">
                    <i class="fas fa-edit"></i>
                </button>
                <a href="{{ route('api.task.delete', ['id' => $item->id]) }}" onclick="return confirm('delete task {{ $item->title }}?')">
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
        <th style="width: 140px"></th>
        <th>Title</th>
        <th style="width: 120px">Deadline</th>
        <th style="width: 160px"></th>
    </tr>
    </tfoot>
</table>
