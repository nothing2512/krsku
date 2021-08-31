<div class="modal fade" id="course-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title" id="course-modal-title">Add Course</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form action="#"
                          enctype="multipart/form-data"
                          method="post"
                          autocomplete="off" id="course-modal-form">
                        @csrf

                        <input type="hidden" name="semesterId" value="{{ $semesterId }}">

                        <div class="form-group mb-3">
                            <label for="course-field-kosek">Kosek</label>
                            <input id="course-field-kosek" type="number" class="form-control" name="kosek" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="course-field-name">Name</label>
                            <input id="course-field-name" type="text" class="form-control" name="name" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="course-field-short-name">Short Name</label>
                            <input id="course-field-short-name" type="text" class="form-control" name="short_name" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="course-field-sks">Sks</label>
                            <input id="course-field-sks" type="number" class="form-control" name="sks" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="course-field-dosen">Dosen</label>
                            <input id="course-field-dosen" type="text" class="form-control" name="dosen" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="course-field-day">Day</label>
                            <select class="custom-select rounded-0" id="course-field-day" name="day" required>
                                <option class="opt-day" id="opt-day-1" value="1" selected>Senin</option>
                                <option class="opt-day" id="opt-day-2" value="2">Selasa</option>
                                <option class="opt-day" id="opt-day-3" value="3">Rabu</option>
                                <option class="opt-day" id="opt-day-4" value="4">Kamis</option>
                                <option class="opt-day" id="opt-day-5" value="5">Jumat</option>
                                <option class="opt-day" id="opt-day-6" value="6">Sabtu</option>
                                <option class="opt-day" id="opt-day-7" value="7">Minggu</option>
                            </select>
                        </div>

                        <div class="bootstrap-timepicker">
                            <div class="form-group">
                                <label for="course-field-start-time">Start Time</label>
                                <div class="input-group date" id="timepicker-start" data-target-input="nearest">
                                    <input name="start_time" type="text" class="form-control datetimepicker-input" data-target="#timepicker-start" id="course-field-start-time" onchange="return" value="08:00">
                                    <div class="input-group-append" data-target="#timepicker-start" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bootstrap-timepicker">
                            <div class="form-group">
                                <label for="course-field-end-time">End Time</label>
                                <div class="input-group date" id="timepicker-end" data-target-input="nearest">
                                    <input name="end_time" type="text" class="form-control datetimepicker-input" data-target="#timepicker-end" id="course-field-end-time" onchange="return" value="09:50">
                                    <div class="input-group-append" data-target="#timepicker-end" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="course-field-lms-type">LMS Type</label>
                            <select class="custom-select rounded-0" id="course-field-lms-type" name="lms_type" required>
                                <option class="opt-lms" id="opt-lms-1" value="1" selected>LMS UNJ</option>
                                <option class="opt-lms" id="opt-lms-2" value="2">Google Classroom</option>
                                <option class="opt-lms" id="opt-lms-3" value="3">Ms. Teams</option>
                                <option class="opt-lms" id="opt-lms-4" value="4">Other</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="course-field-lms-link">LMS Link</label>
                            <input id="course-field-lms-link" type="text" class="form-control" name="lms_link">
                        </div>

                        <div class="form-group mb-3">
                            <label for="course-field-group-link">Group Link</label>
                            <input id="course-field-group-link" type="text" class="form-control" name="group_link">
                        </div>

                    </form>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button id="course-modal-button" type="button" class="btn btn-info"
                        onclick="document.getElementById('course-modal-form').submit()">Add
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
