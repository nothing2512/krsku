<div class="modal fade" id="score-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title" id="score-modal-title">Edit Score</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form action="{{ $url }}"
                          enctype="multipart/form-data"
                          method="post"
                          autocomplete="off" id="score-modal-form">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="score-field">Score</label>
                            <input id="score-field" type="number" step="0.1" class="form-control" name="score" required>
                        </div>

                    </form>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button id="score-modal-button" type="button" class="btn btn-info"
                        onclick="document.getElementById('score-modal-form').submit()">Edit
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
