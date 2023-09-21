<script>
    $('.imageModal').on('click', function() {
        $("#myModal").modal('show');
        var imagesrc = $(this).attr('data-src');
        var imagetitle = $(this).attr('data-title');
        $('.modal-title').html(imagetitle);
        $('#imagePreview').attr("src", imagesrc);
    })
    $('.closeModal').on('click', function() {
        $("#myModal").modal('hide');
    })
</script>
