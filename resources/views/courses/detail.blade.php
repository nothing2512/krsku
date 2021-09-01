<?php $menu = TAB_COURSE; ?>

@extends("components.main")

@section("title", "Course")

@section("backButton")
    <a href="{{ route("course") }}">
        <button
            class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"> Back</i>
        </button>
    </a>
@endsection

@section("content")
    <div class="row">

        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <h3 class="profile-username text-center">{{ $course->name }}</h3>

                    <p class="text-muted text-center">{{ $course->kosek }}</p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Dosen</b> <a class="float-right">{{ $course->dosen }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Semester</b> <a class="float-right">{{ $semester->code }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Day</b> <a class="float-right">{{ $course->day_name }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Time</b> <a class="float-right">{{ $course->start_time }} - {{ $course->end_time }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Sks</b> <a class="float-right">{{ $course->sks }}</a>
                        </li>
                    </ul>

                    <button class="btn btn-primary btn-block mt-4" onclick="editCourse('{{ json_encode($course) }}')"><b>Edit Course</b></button>
                </div>
                <!-- /.card-body -->
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">LMS</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <strong><i class="fas fa-dot-circle mr-1"></i> Type</strong>

                    <p class="text-muted">
                        {{ $course->lms_name }}
                    </p>

                    <hr>

                    @if($course->lms_link)
                        <a href="{{ $course->lms_link }}" target="_blank">
                            <strong><i class="fas fa-external-link-alt mr-1"></i> LMS Homepage</strong>
                        </a>
                    @else
                        <strong><i class="fas fa-building mr-1"></i> LMS Homepage</strong>

                        <p class="text-muted">
                            <span>Undefined</span>
                        </p>
                    @endif

                    <hr>

                    @if($course->group_link)
                        @if(filter_var($course->group_link, FILTER_VALIDATE_URL))
                            <a href="{{ $course->group_link }}" target="_blank">
                                <strong><i class="fas fa-external-link-alt mr-1"></i> Social Media</strong>
                            </a>
                        @else
                            <strong><i class="fas fa-globe mr-1"></i> Social Media</strong>

                            <p class="text-muted">
                                <span>{{ $course->group_link }}</span>
                            </p>
                        @endif
                    @else
                        <strong><i class="fas fa-globe mr-1"></i> Social Media</strong>

                        <p class="text-muted">
                            <span>Undefined</span>
                        </p>
                    @endif

                    <hr>

                    <strong><i class="fas fa-globe mr-1"></i> Score</strong>

                    <p class="text-muted">
                        <span>{{ $course->score }}</span>
                    </p>

                    <button class="btn btn-primary btn-block" onclick="editScore({{ $course->score }})"><b>Edit Score</b></button>
                </div>
                <!-- /.card-body -->
            </div>
        </div>

        <div class="col-md-4 row">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Statistics</h3>
                </div>
                <div class="card-body">
                    <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
    </div>

    <div class="row">
        <div class="col-12 card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#tasks" data-toggle="tab">Tasks</a></li>
                    <li class="nav-item"><a class="nav-link" href="#teams" data-toggle="tab">Teams</a></li>
                    <li class="nav-item"><a class="nav-link" href="#presence" data-toggle="tab">Presence</a></li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="tasks">
                        @include("components.tables.task")
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="teams">
                        @include("components.tables.team")
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="presence">
                        @include("components.tables.presences")
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
    </div>

    @include("components.modal.course", ["semesterId" => $semester->id])
    @include("components.modal.score", ["url" => route("api.course.edit", ["id" => $course->id]) ])
    @include("components.modal.presences")
    @include("components.modal.team")
    @include("components.modal.task")
    @include("components.modal.preview")
@endsection

@section("script")
    <script>
        const previewBody = $("#preview-body")
        const modalBody = $("#preview-modal .modal-body").eq(0)
        const previewContent = $("#preview-modal embed").eq(0)
        let id = 0

        function addAttachments(data=null) {
            id += 1
            let aid = 0
            let fileName = "Choose File"
            let fileUrl = ""
            let fileMime = ""
            let parentClass = "d-none"

            if (data != null) {
                let content = data
                aid = content.id
                parentClass = ""
                fileName = content.filename
                fileUrl = content.url
                fileMime = content.mime
            }

            const item = `
                 <div id="file-item-${id}" class="${parentClass}">
                    <div class="input-group input-group-sm mb-2">
                        <div class="input-group-prepend">
                            <button type="button" class="btn btn-primary" id="field-file-preview-button-${id}">
                                <i class="fas fa-search-plus"></i>
                            </button>
                            <button class="btn btn-info btn-sm" id="field-file-download-button-${id}">
                                <i class="fas fa-download"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control" id="field-file-name-${id}" value="${fileName}" disabled>
                        <span class="input-group-append">
                            <button class="btn btn-info btn-flat" onclick="$('#field-file-${id}').click(); return false;">
                                <i class="fas fa-upload"></i>
                            </button>
                            <button class="btn btn-danger btn-flat" onclick="$('#file-item-${id}').remove(); return false;">
                                <i class="fas fa-trash"></i>
                            </button>
                        </span>
                    </div>
                    <input name="attachmentIds[]" value="${aid}" type="hidden" class="d-none">
                    <input
                        name="attachments[]"
                        type="file"
                        class="d-none"
                        id="field-file-${id}"
                        onchange="updatePreview(this, '${id}')">
                </div>
            `

            $("#file-container").append(item)

            if (data == null) $(`#field-file-${id}`).click();
            else {
                $(`#field-file-download-button-${id}`).click(function() {
                    if (/blob:*/.test(fileUrl)) window.open(fileUrl)
                    else window.open(`${fileUrl}?r=download`)
                    return false;
                })

                $(`#field-file-preview-button-${id}`).click(function () {
                    const isImage = /Image\/*/i.test(fileMime)

                    if (isImage) {
                        modalBody.css("height", "unset")
                        previewContent.css("height", "unset")
                    } else {
                        modalBody.css("height", "90vh")
                        previewContent.css("height", "100%")
                    }

                    previewBody.attr("src", fileUrl)
                    previewBody.attr("type", fileMime)

                    $("#preview-modal").modal('show')

                    return false;
                })
            }

            return false;
        }

        function updatePreview(ctx, id) {
            const file = ctx.files[0]
            const mime = file.type
            const fileUrl = URL.createObjectURL(file)

            $(`#field-file-download-button-${id}`).remove()

            $(`#field-file-preview-button-${id}`).click(function () {
                const isImage = /Image\/*/i.test(mime)

                if (isImage) {
                    modalBody.css("height", "unset")
                    previewContent.css("height", "unset")
                } else {
                    modalBody.css("height", "90vh")
                    previewContent.css("height", "100%")
                }

                previewBody.attr("src", fileUrl)
                previewBody.attr("type", mime)

                $("#preview-modal").modal('show')
            })

            $(`#field-file-name-${id}`).val(file.name)
            $(`#file-item-${id}`).removeClass("d-none")
        }
    </script>
    <script>
        function editScore(score) {
            $("#score-field").val(score)
            $("#score-modal").modal('show');
        }

        function editCourse(data) {
            data = JSON.parse(data);
            const form = $("#course-modal-form")
            const title = $("#course-modal-title")

            form.attr('action', "{{ route("api.course.add") }}/" + data.id.toString())
            title.html(title.html().replace("Add", "Edit"))

            $("#course-field-name").val(data.name)
            $("#course-field-short-name").val(data.short_name)
            $("#course-field-kosek").val(data.kosek)
            $("#course-field-dosen").val(data.dosen)
            $("#course-field-sks").val(data.sks)
            $("#course-field-start-time").val(data.start_time)
            $("#course-field-end-time").val(data.end_time)
            $("#course-field-lms-link").val(data.lms_link)
            $("#course-field-group-link").val(data.group_link)

            $(".opt-day").removeAttr("selected");
            $(".opt-lms").removeAttr("selected");

            $(`#opt-day-${data.day}`).attr("selected", true);
            $(`#opt-lms-${data.lms_type}`).attr("selected", true);

            $("#course-modal-button").html("Edit")

            $("#course-modal").modal('show');
        }

        function addPresence() {
            const title = $("#presence-modal-title")
            const form = $("#presence-modal-form")

            title.html(title.html().replace("Edit", "Add"))

            form.attr('action', "{{ route("api.presence.add") }}")
            form.trigger('reset')

            $("#presence-modal-button").html("Add")
            $("#presence-modal").modal('show');
        }

        function editPresence(data) {
            data = JSON.parse(data)

            const title = $("#presence-modal-title")
            const form = $("#presence-modal-form")

            title.html(title.html().replace("Add", "Edit"))

            $("#presence-field-type").val(data.type)
            $("#presence-field-link").val(data.link)

            form.attr('action', "{{ route("api.presence.add") }}/" + data.id.toString())

            $("#presence-modal-button").html("Edit")
            $("#presence-modal").modal('show');
        }

        function addTask() {
            const title = $("#task-modal-title")
            const form = $("#task-modal-form")

            title.html(title.html().replace("Edit", "Add"))

            form.attr('action', "{{ route("api.task.add") }}")
            form.trigger('reset')
            $("#task-field-deadline").val('{{ $defaultTaskDeadline }}')
            $("#task-field-desc").attr("rows", 3)
            $("#file-container").empty()

            $(".opt-day").removeAttr("selected");

            $("#task-modal-button").html("Add")
            $("#task-modal").modal('show');
        }

        function editTask(data) {
            data = JSON.parse(data.replaceAll("\r", "").replaceAll("\n", "<<<breakline>>>"))
            data.description = data.description ?? ""

            const title = $("#task-modal-title")
            const form = $("#task-modal-form")
            const taskDesc = $("#task-field-desc")

            title.html(title.html().replace("Add", "Edit"))
            taskDesc.attr("rows", data.description.split("<<<breakline>>>").length)
            taskDesc.val(data.description.replaceAll("<<<breakline>>>", "\n"))

            $("#task-field-title").val(data.title)
            $("#task-field-deadline").val(data.deadline)
            $(".opt-team").removeAttr("selected")
            $(`#opt-team-${data.teamId}`).attr("selected", true)
            $("#task-field-teams").change()
            $("#file-container").empty()

            form.attr('action', "{{ route("api.task.add") }}/" + data.id.toString())
            $("#task-modal-button").html("Edit")

            $.get("{{ route("api.task.add") }}/" + data.id.toString() + "/attachments", (data) => {
                for (let item of data) {
                    addAttachments(item)
                }
                $("#task-modal").modal('show');
            })
        }

        function setTaskMembers(i) {
            const container = $("#task-members")
            const item = $("#task-members-item")

            item.empty()

            if (i === 0) {
                container.addClass("d-none")
                return
            }

            const data = JSON.parse($(".opt-team").eq(i).attr('data').replaceAll("\\r", "").replaceAll("'", ""))
            container.removeClass("d-none")
            for (let member of data.members.split(",")) {
                item.append("<li>" + member + "</li>")
            }
        }

        function addTeam() {
            const title = $("#team-modal-title")
            const form = $("#team-modal-form")

            title.html(title.html().replace("Edit", "Add"))

            $("#team-field-members").attr("rows", 3)
            form.attr('action', "{{ route("api.team.add") }}")
            form.trigger('reset')

            $("#team-modal-button").html("Add")
            $("#team-modal").modal('show');
        }

        function editTeam(data) {
            data = JSON.parse(data.replaceAll("\r", ""))

            const title = $("#team-modal-title")
            const form = $("#team-modal-form")
            const members = $("#team-field-members")

            title.html(title.html().replace("Add", "Edit"))

            $("#team-field-name").val(data.name)
            members.val(data.members.replaceAll(",", '\n'))
            members.attr("rows", data.member)

            form.attr('action', "{{ route("api.team.add") }}/" + data.id.toString())

            $("#team-modal-button").html("Edit")
            $("#team-modal").modal('show');
        }

        new Chart($('#pieChart').get(0).getContext('2d'), {
            type: 'pie',
            data: {
                labels: [
                    'Unfinished Task',
                    'Finished Task'
                ],
                datasets: [
                    {
                        data: {!! $taskChart !!},
                        backgroundColor : ['#dc3545', '#28a745'],
                    }
                ]
            },
            options: {
                maintainAspectRatio : false,
                responsive : true,
            }
        })

        $('#timepicker-end').datetimepicker({
            format: 'HH:mm'
        })

        $('#timepicker-start').datetimepicker({
            format: 'HH:mm'
        })

        $('#timepicker-deadline').datetimepicker({
            format: 'yyyy-MM-DD HH:mm',
            icons: {
                time: "fas fa-clock",
            }
        })

        $("#presence-table")
            .DataTable({
                lengthChange: false,
                autoWidth: false,
                scrollX: true,
                pageLength: 10,
                columnDefs: [
                    {
                        targets: [2],
                        orderable: false,
                        searchble: false
                    }
                ],
                buttons: [
                    {
                        className: "btn btn-info btn-sm",
                        text: '<i class="fas fa-plus"> Add Presence </i>',
                        action: function () {
                            addPresence()
                        }
                    }
                ]
            }).buttons()
            .container()
            .appendTo('.col-md-6:eq(0)');

        $("#team-table")
            .DataTable({
                lengthChange: false,
                autoWidth: false,
                scrollX: true,
                pageLength: 10,
                columnDefs: [
                    {
                        targets: [3],
                        orderable: false
                    }
                ],
                buttons: [
                    {
                        className: "btn btn-info btn-sm",
                        text: '<i class="fas fa-plus"> Add Team </i>',
                        action: function () {
                            addTeam()
                        }
                    }
                ]
            }).buttons()
            .container()
            .appendTo('.col-md-6:eq(0)');

        $("#task-table")
            .DataTable({
                lengthChange: false,
                autoWidth: false,
                scrollX: true,
                pageLength: 10,
                columnDefs: [
                    {
                        targets: [1, 4],
                        orderable: false,
                        searchable: false
                    }
                ],
                buttons: [
                    {
                        className: "btn btn-info btn-sm",
                        text: '<i class="fas fa-plus"> Add Task </i>',
                        action: function () {
                            addTask()
                        }
                    }
                ]
            }).buttons()
            .container()
            .appendTo('.col-md-6:eq(0)');

        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            if (e.target.hash === '#teams') {
                $("#team-table").DataTable().columns.adjust().draw()
            }
            if (e.target.hash === '#presence') {
                $("#presence-table").DataTable().columns.adjust().draw()
            }
            if (e.target.hash === '#presences') {
                $("#task-table").DataTable().columns.adjust().draw()
            }
        })
    </script>
@endsection
