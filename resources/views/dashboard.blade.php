<?php $menu = TAB_DASHBOARD; ?>
@extends("components.main")

@section("title", "Dashboard")
@section("contentTitle", "Dashboard")

@section("content")

    <div class="row">
        <div class="col-md-7">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Schedules</h3>
                </div>
                <div class="card-body p-0 m-0">
                    <!-- THE CALENDAR -->
                    <div id="calendar"></div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>

        <div class="col-md-5 row m-0">

            <div class="col-md-6">
                <div class="info-box">
                    <span class="info-box-icon {{ $counter->bgSemester }}"><i class="fas fa-exchange-alt"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Semester</span>
                        <span class="info-box-number">{{ $counter->semester }} of {{ $counter->targetSemester }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-md-6">
                <div class="info-box">
                    <span class="info-box-icon {{ $counter->bgSks }}"><i class="fas fa-list-ol"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Sks</span>
                        <span class="info-box-number">{{ $counter->sks }} of {{ $counter->targetSks }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-md-6">
                <div class="info-box">
                    <span class="info-box-icon {{ $counter->bgIpk }}"><i class="fas fa-star"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Ipk</span>
                        <span class="info-box-number">{{ $counter->ipk }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-md-6">
                <div class="info-box">
                    <span class="info-box-icon {{ $counter->bgCertificate }}"><i class="far fa-envelope"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Certificates</span>
                        <span class="info-box-number">{{ $counter->certificates }} of {{ $counter->targetCertificates }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Ipk Charts</h3>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="lineChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Incoming Tasks</h3>
                </div>
                <div class="card-body">
                    @include("components.tables.incoming_task")
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

    @include("components.modal.incoming_task")
    @include("components.modal.preview")
@endsection
@section("script")
    <script>
        const previewBody = $("#preview-body")
        const modalBody = $("#preview-modal .modal-body").eq(0)
        const previewContent = $("#preview-modal embed").eq(0)
        let id = 0

        function addAttachments(data) {
            id += 1
            let fileName = data.filename
            let fileUrl = data.url
            let fileMime = data.mime

            const item = `
                 <div id="file-item-${id}">
                    <div class="input-group input-group-sm mb-2">
                        <div class="input-group-prepend">
                            <button type="button" class="btn btn-primary" id="field-file-preview-button-${id}">
                                <i class="fas fa-search-plus"></i>
                            </button>
                            <button class="btn btn-info btn-sm" onclick="window.open('${fileUrl}?r=download')">
                                <i class="fas fa-download"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control" id="field-file-name-${id}" value="${fileName}" disabled>
                        <span class="input-group-append">
                            <button class="btn btn-danger btn-flat" onclick="$('#file-item-${id}').remove(); return false;">
                                <i class="fas fa-trash"></i>
                            </button>
                        </span>
                    </div>
                </div>
            `

            $("#file-container").append(item)

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
            })

            return false;
        }
    </script>
    <script>
        $(function () {
            new FullCalendar.Calendar(document.getElementById('calendar'), {
                initialView: 'timeGridWeek',
                businessHours: true,
                maxContentHeight: 10,
                events: {!! $events !!},
                headerToolbar: false,
                themeSystem: 'bootstrap',
                editable: false,
                draggable: false,
                slotMinTime: '08:00:00',
                slotMaxTime: '17:00:00',
                hiddenDays: [0, 6],
                allDaySlot: false,
                contentHeight:"auto",
                handleWindowResize:true,
                eventClick: (info) => {
                    window.location.href = info.event.url
                },
                dayHeaderContent: (args) => {
                    switch (args.date.getDay()) {
                        case 1: return "Senin";
                        case 2: return "Selasa";
                        case 3: return "Rabu";
                        case 4: return "Kamis";
                        case 5: return "Jumat";
                        case 6: return "Sabtu";
                        default: return "Minggu";
                    }
                },
            }).render()
        })
    </script>
    <script>
        const chartData = JSON.parse('{!! $ipk !!}')
        const labels = []

        for (let i = 1; i <= {{ $counter->targetSemester }}; i++) labels.push(i.toString())

        new Chart($('#lineChart').get(0).getContext('2d'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Ipk',
                        backgroundColor: '#00c0ef',
                        borderColor: '#00c0ef',
                        pointBorderColor: 'rgba(0, 0, 0, 0)',
                        pointBackgroundColor: 'rgba(0, 0, 0, 0)',
                        pointHoverBackgroundColor: 'rgb(54, 162, 235)',
                        pointHoverBorderColor: 'rgb(54, 162, 235)',
                        pointColor: 'rgba(210, 214, 222, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: '#00c0ef',
                        data: chartData,
                        fill: false
                    },
                ]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                datasetFill: false,
                legend: {display: false},
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: false,
                        }
                    }]
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'index',
                    intersect: false
                },

            }
        })
    </script>
    <script>

        function showTask(data) {
            const taskDesc = $("#task-field-desc")
            data = JSON.parse(data.replaceAll("\r", "").replaceAll("\n", "<<<breakline>>>"))
            data.description = data.description ?? ""

            taskDesc.attr("rows", data.description.split("<<<breakline>>>").length)
            taskDesc.val(data.description.replaceAll("<<<breakline>>>", "\n"))

            $("#file-container").empty()

            $("#task-button-done").attr("href", "{{ route('api.task.add') }}/" + data.id.toString() + "/status")

            $("#task-field-title").val(data.title)
            $("#task-field-course").val(data.courseName)
            $("#task-field-deadline").val(data.deadline)
            $(".opt-team").removeAttr("selected")
            $(`#opt-team-${data.teamId}`).attr("selected", true)
            $("#task-field-teams").change()

            if (data.teamId !== 0) {
                $("#task-members").removeClass("d-none")
                const item = $("#task-members-item")
                for (let member of data.members.split(",")) {
                    item.append("<li>" + member + "</li>")
                }
            }

            $.get("{{ route("api.task.add") }}/" + data.id.toString() + "/attachments", (data) => {
                for (let item of data) {
                    addAttachments(item)
                }
                $("#task-modal").modal('show');
            })
        }

        $("#task-table")
            .DataTable({
                lengthChange: false,
                autoWidth: false,
                scrollX: true,
                pageLength: 5,
                columnDefs: [
                    {
                        targets: [2, 3],
                        orderable: false,
                        searchable: false
                    }
                ]
            }).buttons()
            .container()
            .appendTo('.col-md-6:eq(0)');
    </script>
@endsection
