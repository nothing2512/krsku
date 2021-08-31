<?php $i = -1; ?>
<div class="modal fade" id="certificate-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title" id="certificate-modal-title">Add Certificate</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form action="#"
                          enctype="multipart/form-data"
                          method="post"
                          autocomplete="off" id="certificate-modal-form">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="certificate-field-title">Title</label>
                            <input id="certificate-field-title" type="text" class="form-control" name="title" required>
                        </div>

                        <div class="bootstrap-timepicker">
                            <div class="form-group">
                                <label for="certificate-field-obtained">Obtained Date</label>
                                <div class="input-group date" id="timepicker-obtained" data-target-input="nearest">
                                    <input name="obtainedDate" type="text" class="form-control datetimepicker-input" data-target="#timepicker-obtained" id="certificate-field-obtained" onchange="return" required>
                                    <div class="input-group-append" data-target="#timepicker-obtained" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bootstrap-timepicker">
                            <div class="form-group">
                                <label for="certificate-field-expired">Expired Date</label>
                                <div class="input-group date" id="timepicker-expired" data-target-input="nearest">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-danger" onclick="$('#timepicker-expired').datetimepicker('clear'); return false;">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <input name="expiredDate" type="text" class="form-control datetimepicker-input" data-target="#timepicker-expired" id="certificate-field-expired" onchange="return">
                                    <div class="input-group-append" data-target="#timepicker-expired" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" id="file-container">
                            <label for="certificate-file-name">Attachments</label>
                            <div>
                                <div class="input-group input-group-sm mb-2">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-primary" id="certificate-button-preview" onclick="return false;">
                                            <i class="fas fa-search-plus"></i>
                                        </button>
                                        <button type="button" class="btn btn-info d-none" id="certificate-button-download" onclick="return false;">
                                            <i class="fas fa-download"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control" id="certificate-file-name" value="Choose File" disabled>
                                    <div class="input-group-append">
                                        <button class="btn btn-info btn-flat" onclick="$('#certificate-file-input').click(); return false;">
                                            <i class="fas fa-upload"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <input
                                name="attachments"
                                type="file"
                                class="d-none"
                                id="certificate-file-input"
                                onchange="updatePreview(this)">

                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button id="certificate-modal-button" type="button" class="btn btn-info"
                        onclick="document.getElementById('certificate-modal-form').submit()">Add
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
