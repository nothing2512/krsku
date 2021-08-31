<script>
    Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    }).fire({
        icon: 'error',
        title: '{{ $message }}'
    })
</script>
