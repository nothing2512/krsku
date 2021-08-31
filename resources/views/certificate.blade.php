<?php $menu = TAB_CERTIFICATE; ?>
<?php $i = 0; ?>

@extends("components.main")

@section("title", "Certificates")
@section("contentTitle", "Certificates")

@section("content")
    <div class="row">

        <div class="card col-12">
            <div class="card-body">
                @include("components.tables.certificate")
            </div>
            <!-- /.card-body -->
        </div>
    </div>

    @include("components.modal.certificate")
    @include("components.modal.preview")
@endsection

@section("script")
    <script>

        $('#timepicker-obtained').datetimepicker({
            format: 'yyyy-MM-DD'
        })

        $('#timepicker-expired').datetimepicker({
            format: 'yyyy-MM-DD'
        })

        function updatePreview(ctx) {
            const file = ctx.files[0]
            const mime = file.type
            const fileUrl = URL.createObjectURL(file)
            const buttonDownload = $("#certificate-button-download")

            $("#certificate-button-preview").click(function() {
                showContent(fileUrl, mime)
            })

            buttonDownload.click(function () {
                window.open(fileUrl)
                return false;
            })

            buttonDownload.removeClass("d-none");

            $("#certificate-file-name").val(file.name)
        }

        function showContent(url, mime) {
            const previewBody = $("#preview-body")
            const modalBody = $("#preview-modal .modal-body").eq(0)
            const previewContent = $("#preview-modal embed").eq(0)

            const isImage = /Image\/*/i.test(mime)

            if (isImage) {
                modalBody.css("height", "unset")
                previewContent.css("height", "unset")
            } else {
                modalBody.css("height", "90vh")
                previewContent.css("height", "100%")
            }

            previewBody.attr("src", url)
            previewBody.attr("type", mime)

            $("#preview-modal").modal('show')
            return false;
        }

        function showAddModal() {
            const title = $("#certificate-modal-title")
            const form = $("#certificate-modal-form")

            title.html(title.html().replace("Edit", "Add"))

            form.attr('action', "{{ route("api.certificate.add") }}")
            form.trigger('reset')

            $("#certificate-modal-button").html("Add")
            $("#certificate-modal").modal('show');
        }

        function showEditModal(data) {
            data = JSON.parse(data);
            const form = $("#certificate-modal-form")
            const title = $("#certificate-modal-title")

            form.attr('action', "{{ route("api.certificate.add") }}/" + data.id.toString())
            title.html(title.html().replace("Add", "Edit"))

            $("#certificate-field-title").val(data.title)
            $("#certificate-field-obtained").val(data.obtainedDate)
            $("#certificate-field-expired").val(data.expiredDate)
            $("#certificate-modal-button").html("Edit")

            $("#certificate-file-name").val(data.title)

            $("#certificate-button-preview").click(function() {
                showContent(data.attachments, data.mime)
            })

            $("#certificate-modal").modal('show');
        }

        $(function () {
            $("#certificate-table")
                .DataTable({
                    responsive: true,
                    lengthChange: false,
                    autoWidth: false,
                    pageLength: 5,
                    columnDefs: [
                        {
                            targets: [1, 4],
                            orderable: false,
                            searchable: false
                        }
                    ],
                    buttons: [
                        {
                            className: "btn btn-info btn-sm ml-1",
                            text: '<i class="fas fa-plus"> Add Certificate </i>',
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
