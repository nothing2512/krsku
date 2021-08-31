<?php $menu = TAB_SEMESTER; ?>
<?php $i = 0; ?>

@extends("components.main")

@section("title", "Semester")
@section("contentTitle", "Semester")

@section("content")
    <div class="row">

        <div class="card col-12">
            <div class="card-body">
                @include("components.tables.semester")
            </div>
            <!-- /.card-body -->
        </div>
    </div>

    @include("components.modal.semester")
    @include("components.modal.preview")
@endsection

@section("script")
    <script>

        function showAddModal() {
            const title = $("#semester-modal-title")
            const form = $("#semester-modal-form")

            title.html(title.html().replace("Edit", "Add"))

            form.attr('action', "{{ route("api.semester.add") }}")
            form.trigger('reset')

            $("#semester-modal-button").html("Add")
            $("#semester-modal").modal('show');
        }

        function showEditModal(data) {
            data = JSON.parse(data);
            const form = $("#semester-modal-form")
            const title = $("#semester-modal-title")

            form.attr('action', "{{ route("api.semester.add") }}/" + data.id.toString())
            title.html(title.html().replace("Add", "Edit"))

            $("#semester-field-name").val(data.name)
            $("#semester-field-code").val(data.code)
            $("#semester-modal-button").html("Edit")

            $("#semester-modal").modal('show');
        }

        $(function () {
            $("#semester-table")
                .DataTable({
                    lengthChange: false,
                    autoWidth: false,
                    scrollX: true,
                    pageLength: 5,
                    columnDefs: [
                        {
                            targets: [1, 5],
                            orderable: false,
                            searchable: false
                        }
                    ],
                    buttons: [
                        {
                            className: "btn btn-info btn-sm ml-1",
                            text: '<i class="fas fa-plus"> Add Semester </i>',
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
