<div class="modal fade" id="semester-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title" id="semester-modal-title">Add Semester</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form action="#"
                          enctype="multipart/form-data"
                          method="post"
                          autocomplete="off" id="semester-modal-form">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="semester-field-code">Code</label>
                            <input id="semester-field-code" type="text" class="form-control" name="code" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="semester-field-name">Name</label>
                            <input id="semester-field-name" type="text" class="form-control" name="name" required>
                        </div>

                    </form>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button id="semester-modal-button" type="button" class="btn btn-info"
                        onclick="document.getElementById('semester-modal-form').submit()">Add
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
