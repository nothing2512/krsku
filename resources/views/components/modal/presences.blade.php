<div class="modal fade" id="presence-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title" id="presence-modal-title">Add Presence</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form action="#"
                          enctype="multipart/form-data"
                          method="post"
                          autocomplete="off" id="presence-modal-form">
                        @csrf

                        <input type="hidden" name="courseId" value="{{ $course->id }}">

                        <div class="form-group mb-3">
                            <label for="presence-field-type">Name</label>
                            <input id="presence-field-type" type="text" class="form-control" name="type" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="presence-field-link">Link</label>
                            <input id="presence-field-link" type="text" class="form-control" name="link" required>
                        </div>

                    </form>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button id="presence-modal-button" type="button" class="btn btn-info"
                        onclick="document.getElementById('presence-modal-form').submit()">Add
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
