<?php $menu = TAB_SEMESTER; ?>

@extends("components.main")

@section("title", "Semester")
@section("contentTitle", "Semester")

@section("content")

    <form action="#"
          enctype="multipart/form-data"
          method="post"
          autocomplete="off"
          id="semester-modal-form">
        @csrf

        <div class="form-group" id="file-container">
            <label>Attachments</label>

        </div>

        <div class="form-group">
            <button type="button" class="btn btn-primary w-100" onclick="return addAttachments()">
                <i class="fas fa-plus"> Add Attachments</i>
            </button>
        </div>
    </form>

    <div class="modal fade" id="preview-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0 m-0" style="height: 90vh">
                    <embed id="preview-body" src="#" alt="#" style="width: 100%; height: 100%">
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection
@section("script")
    <script>
        let id = 0

        function addAttachments() {
            id += 1

            const item = `
                 <div id="file-item-${id}" class="d-none">
                    <div class="input-group input-group-sm mb-2">
                        <div class="input-group-prepend">
                            <button type="button" class="btn btn-info" id="field-file-preview-button-${id}">
                                <i class="fas fa-search-plus"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control" id="field-file-name-${id}" value="Choose File" disabled>
                        <span class="input-group-append">
                            <button class="btn btn-info btn-flat" onclick="$('#field-file-${id}').click(); return false;">
                                <i class="fas fa-upload"></i>
                            </button>
                            <button class="btn btn-danger btn-flat" onclick="$('#file-item-${id}').remove(); return false;">
                                <i class="fas fa-trash"></i>
                            </button>
                        </span>
                    </div>
                    <input
                        name="attachments[]"
                        type="file"
                        class="d-none"
                        id="field-file-${id}"
                        onchange="updatePreview(this, '${id}')">
                </div>
            `

            $("#file-container").append(item)
            $(`#field-file-${id}`).click()

            return false;
        }

        function updatePreview(ctx, id) {
            const file = ctx.files[0]
            const mime = file.type
            const fileUrl = URL.createObjectURL(file)
            const isImage = /Image\/*/i.test(mime)
            const previewButton = $(`#field-file-preview-button-${id}`)
            const previewBody = $("#preview-body")
            const modalBody = $("#preview-modal .modal-body").eq(0)
            const previewContent = $("#preview-modal embed").eq(0)

            if (isImage) {
                modalBody.css("height", "unset")
                previewContent.css("height", "unset")
            } else {
                modalBody.css("height", "90vh")
                previewContent.css("height", "100%")
            }

            previewButton.click(function () {
                previewBody.attr("src", fileUrl)
                previewBody.attr("type", mime)

                $("#preview-modal").modal('show')
            })

            $(`#field-file-name-${id}`).val(file.name)
            $(`#file-item-${id}`).removeClass("d-none")
        }
    </script>
@endsection
