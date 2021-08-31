<?php $i = -1; ?>
<div class="modal fade" id="task-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title" id="task-modal-title">Add Task</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form action="#"
                          enctype="multipart/form-data"
                          method="post"
                          autocomplete="off" id="task-modal-form">
                        @csrf

                        <input type="hidden" name="courseId" value="{{ $course->id }}">

                        <div class="form-group mb-3">
                            <label for="task-field-title">Title</label>
                            <input id="task-field-title" type="text" class="form-control" name="title" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="task-field-desc">Description</label>
                            <textarea id="task-field-desc" name="description" rows="5" class="form-control"></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="task-field-teams">Team</label>
                            <select class="custom-select rounded-0" id="task-field-teams" name="teamId" onchange="setTaskMembers(this.selectedIndex)" required>
                                <option class="opt-team" id="opt-team-0" value="0" selected>Individual</option>
                                @foreach($teams as $item)
                                    <option
                                        class="opt-team"
                                        id="opt-team-{{ $item->id }}"
                                        value="{{ $item->id }}"
                                        data="'{{ json_encode($teams[++$i]) }}'"
                                    >{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="task-members" class="border rounded form-group pl-2 d-none">
                            <label>Members</label>
                            <ul id="task-members-item">

                            </ul>
                        </div>

                        <div class="bootstrap-timepicker">
                            <div class="form-group">
                                <label for="task-field-deadline">Deadline</label>
                                <div class="input-group date" id="timepicker-deadline" data-target-input="nearest">
                                    <input name="deadline" type="text" class="form-control datetimepicker-input" data-target="#timepicker-deadline" id="task-field-deadline" onchange="return" required>
                                    <div class="input-group-append" data-target="#timepicker-deadline" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Attachments</label>
                            <div id="file-container">

                            </div>
                        </div>

                        <div class="form-group">
                            <button type="button" class="btn btn-primary w-100" onclick="return addAttachments()">
                                <i class="fas fa-plus"> Add Attachments</i>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button id="task-modal-button" type="button" class="btn btn-info"
                        onclick="document.getElementById('task-modal-form').submit()">Add
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
