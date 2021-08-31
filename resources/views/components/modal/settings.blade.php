<div class="modal fade" id="settings-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title" id="settings-modal-title">Edit Setting</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form
                        action="{{ route('api.user.edit') ?? '' }}"
                        enctype="multipart/form-data"
                        method="post"
                        autocomplete="off"
                        id="settings-modal-form">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="settings-field-semester">Target Semester</label>
                            <input id="settings-field-semester" type="number" class="form-control" name="targetSemester" value="{{ $counter->targetSemester ?? '' }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="settings-field-sks">Target Sks</label>
                            <input id="settings-field-sks" type="number" class="form-control" name="targetSks" value="{{ $counter->targetSks ?? '' }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="settings-field-certificates">Target Certificates</label>
                            <input id="settings-field-certificates" type="number" class="form-control" name="targetCertificates" required value="{{ $counter->targetCertificates ?? '' }}">
                        </div>

                        <hr>

                        <div class="form-group mb-3">
                            <label for="settings-field-name">Name</label>
                            <div class="input-group">
                                <input id="settings-field-name" type="text" class="form-control" name="name" value="{{ $user->name ?? '' }}" autocomplete="false">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="settings-field-password">Password</label>
                            <div class="input-group">
                                <input id="settings-field-password" placeholder="***" value="" type="password" class="form-control" name="password" autocomplete="false">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button id="settings-modal-button" type="button" class="btn btn-info"
                        onclick="document.getElementById('settings-modal-form').submit()">Edit
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
