<script>

    $("body").on("change",".change-status",function() {
        var value=$(this).prop('checked');
        var id=$(this).attr('data-id');
        var url = $(this).attr('data-url');
        var key = $(this).attr('data-key');
        $.ajax({
            type:'POST',
            url:url,
            data:{
                id:id,
                status:value,
                key:key
            },
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success:function(response) {
                swal(response.success,{
                    icon: "success",
                    timer: 1500,
                    button: false, // Prevents users from clicking outside to close
                    className: "custom-sweetalert",
                  });

            }
         });

    });

</script>
