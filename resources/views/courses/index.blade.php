<?php $menu = TAB_COURSE; ?>

@extends("components.main")

@section("title", "Course")
@section("contentTitle", "Course, $semester")

@section("content")
    <div class="row">

        <div class="card col-12">
            <div class="card-header">
                <h3>Total Sks: {{ $totalSks }}</h3>
                <h3>Total Ipk: {{ $ipk }}</h3>
            </div>
            <div class="card-body">
                @include("components.tables.course")
            </div>
            <!-- /.card-body -->
        </div>
    </div>

    @include("components.modal.course")
@endsection

@section("script")
    <script type="text/javascript">

        function showAddModal() {
            const title = $("#course-modal-title")
            const form = $("#course-modal-form")

            title.html(title.html().replace("Edit", "Add"))

            form.attr('action', "{{ route("api.course.add") }}")
            form.trigger('reset')

            $(".opt-day").removeAttr("selected");
            $(".opt-lms").removeAttr("selected");

            $("#opt-day-1").attr("selected", true);
            $("#opt-lms-1").attr("selected", true);

            $("#course-modal-button").html("Add")
            $("#course-modal").modal('show');
        }

        function showEditModal(data) {
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

        $(function () {
            //Timepicker
            $('#timepicker-end').datetimepicker({
                format: 'HH:mm'
            })
            $('#timepicker-start').datetimepicker({
                format: 'HH:mm'
            })

            $("#course-table")
                .DataTable({
                    lengthChange: false,
                    autoWidth: false,
                    scrollX: true,
                    columnDefs: [
                        {
                            targets: [8],
                            orderable: false
                        }
                    ],
                    buttons: [
                        {
                            className: "btn btn-info btn-sm ml-1",
                            text: '<i class="fas fa-plus"> Add Course </i>',
                            action: function () {
                                showAddModal()
                            }
                        }
                    ]
                }).buttons()
                .container()
                .appendTo('.col-md-6:eq(0)');
        });
    </script>
@endsection
