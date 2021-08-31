<div class="modal fade" id="team-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title" id="team-modal-title">Add Team</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form action="#"
                          enctype="multipart/form-data"
                          method="post"
                          autocomplete="off" id="team-modal-form">
                        @csrf

                        <input type="hidden" name="courseId" value="{{ $course->id }}">

                        <div class="form-group mb-3">
                            <label for="team-field-name">Name</label>
                            <input id="team-field-name" type="text" class="form-control" name="name" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="team-field-members">Members</label>
                            <textarea id="team-field-members" name="users" rows="3" class="form-control"></textarea>
                        </div>

                    </form>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button id="team-modal-button" type="button" class="btn btn-info"
                        onclick="document.getElementById('team-modal-form').submit()">Add
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
