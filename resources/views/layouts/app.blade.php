<html>
<head>
<title> Form </title>
<link rel='stylesheet'
href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>

<body>

    @yield('form')
    @yield('edit')
    @yield('main')


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    {{-- <script src="{{ asset('js/custom.js') }}"></script> <!-- Path to your custom JavaScript file --> --}}
<script>

$(document).ready(function(){
    $('#add_item_form').submit(function(e) {
        e.preventDefault(); 
       const fd = new FormData(this);
       $.ajax({
        url: '{{ route('items.store') }}' ,
        method: 'post',
        data: fd,
        cache: false,
        contentType: false,
        processData:false,
        dataType: 'json',
        success: function (response) {
         if(response.status == 0){
            $.each(response.error, function (prefix, val) { 
               $('span.'+prefix+'_error').text(val[0])  
            });
         }else if(response.status == 201){
            $("#add_item_btn").text("Adding");
            Swal.fire(
                'Added!',
                "Item added successfully",
                'Success'
            )
            $("#add_item_btn").text('Add Item')
            $('#add_item_form')[0].reset()
            $('#addItemsModal').modal('hide')
         }else{
            Swal.fire(
                'Something is not right',
                'Please Contact Admin'
            )
         }
        }
       });
    })

    fetchItems()

    function fetchItems(){
        $.ajax({
            type: "GET",
            url: "{{ route('items.create') }}",
            dataType: "json",
            success: function (response) {
                var items = response.items.data
                var tableHTML = '<table class="table table-stripped table-sm table-center align-middle">' + 
                '<thead>' + 
                '<tr>' +
                '<th>ID</th>' +
                '<th>Name</th>' + 
                '<th>Image</th>' +
                '<th>Actions</th>' +
                '</tr>' + 
                '</thead>'+
                '<tbody>';

                $.each(items, function (index, item) { 
                    tableHTML += '<tr>' +
                        '<td>' + item.id + '</td>' +
                        '<td>' + item.name + '</td>'+
                        '<td><img src="storage/images/' + item.image + '"width="50" class="img-thumbnail rounded-circle"></td>' +
                        '<td>' +
                        '<a href="#" id="' + item.id + '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editItemModal"><i class="bi-pencil-square h4"></i></a>' +
                        '<a href="#" id="' + item.id + '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>' +
                        '</tr>';
                    });

                    tableHTML += '</tbody></table>'
                    $('#show_all_item').html(tableHTML)
                    $("table").DataTable({
                        order: [0, 'desc']
                    })
            }
        });
    }

    $(document).on('click', '.editIcon',  function (e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
            type: "get",
            url: "{{ route('items.ajaxEdit') }}",
            data: {
                id: id,
                _token: '{{ csrf_token() }}'
            },
            dataType: "json",
            success: function (response) {
                $("#name").val(response.name)
                $("#image").html(
                    `<img src="storage/images/${response.image}" width="100" class="img-fluid img-thumbnail">`
                )
                $('#item_id').val(response.id)
                $('#item_image').val(response.image)
            }
        });
      })


      $("#edit_item_form").submit(function(e){
        e.preventDefault();
        const fd = new FormData(this);
        $.ajax({
            url: '{{ route('items.ajaxUpdate') }}',
            method: 'post',
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
         if(response.status == 0){
            $.each(response.error, function (prefix, val) { 
               $('span.'+prefix+'_error').text(val[0])  
            });
         }else if(response.status == 200){
            $("#edit_item_btn").text("Updated");
            Swal.fire(
                'Updated!',
                "Item Updated successfully",
                'Success'
            )
            fetchItems()
            $("#edit_item_btn").text('Add Item')
            $('#edit_item_form')[0].reset()
            $('#editItemModal').modal('hide')
         }else{
            Swal.fire(
                'Something is not right',
                'Please Contact Admin'
            )
         }
        }
        })
      })

      $(document).on('click', '.deleteIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        let csrf = '{{ csrf_token() }}';
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: '{{ route('items.ajaxDelete') }}',
              method: 'delete',
              data: {
                id: id,
                _token: csrf
              },
              success: function(response) {
                console.log(response);
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
                fetchItems();
              }
            });
          }
        })
      });
})
</script>

</body>
</html>
