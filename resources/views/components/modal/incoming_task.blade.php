<?php $i = -1; ?>
<div class="modal fade" id="task-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title" id="task-modal-title">Detail Task</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form action="#" enctype="multipart/form-data" id="task-modal-form">

                        <div class="form-group mb-3">
                            <label for="task-field-title">Title</label>
                            <input id="task-field-title" type="text" class="form-control" name="title" disabled>
                        </div>

                        <div class="form-group mb-3">
                            <label for="task-field-course">Course</label>
                            <input id="task-field-course" type="text" class="form-control disabled" name="course" disabled>
                        </div>

                        <div class="form-group mb-3">
                            <label for="task-field-desc">Description</label>
                            <textarea id="task-field-desc" style="resize: none" name="description" class="form-control" disabled></textarea>
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
                                    <input name="deadline" type="text" class="form-control datetimepicker-input" data-target="#timepicker-deadline" id="task-field-deadline" disabled>
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

                    </form>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <a id="task-button-done" href="#">
                    <button id="task-modal-button" type="button" class="btn btn-success">
                        <i class="fas fa-check"> Done</i>
                    </button>
                </a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
