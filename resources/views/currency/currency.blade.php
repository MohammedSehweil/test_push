
<script src="https://datatables.yajrabox.com/js/jquery.min.js"></script>
<script src="https://datatables.yajrabox.com/js/bootstrap.min.js"></script>
<script src="https://datatables.yajrabox.com/js/jquery.dataTables.min.js"></script>
<script src="https://datatables.yajrabox.com/js/datatables.bootstrap.js"></script>
<link href="https://datatables.yajrabox.com/css/datatables.bootstrap.css" rel="stylesheet">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="form-group">
    <div class="col-lg-10 col-lg-offset-2">
        {!! Form::submit('Get Or Update Currencies', ['class' => 'btn btn-lg btn-info pull-right', 'id' => 'update_currencies'] ) !!}
    </div>
</div>

<br>
<br>
<br>
<table id="currecyDataTable" class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Symbol</th>
            <th>Exchange Rate</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Actions</th>
        </tr>
    </thead>
</table>

<!-- Submit Button -->






<script>
    $(document).ready(function () {
        var table;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function() {
            table = $('#currecyDataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: 'currency',
                columns: [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'symbol'},
                    {data: 'exchange_rate'},
                    {data: 'created_at'},
                    {data: 'updated_at'},
                    {data: 'cat_id',render: function(cat_id,type,obj) {
                             return '<a data-id=' + cat_id + ' target="_blank" class="btn btn-danger delete_cat">' + 'Delete' + '</a>';
                        }
                    }
                ]
            });
        });

        $(function () {
            $('#update_currencies').on('click', function () {

                $.ajax({
                    url: 'currency/get-all-currencies',
                    success: function (data) {
                        table.ajax.reload(null, false);
                    }
                });
            });
        });

        $('.table').on('click','.delete_cat', function () {


            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                if (willDelete) {

                    $.ajax({
                        url: 'currency/'+$(this).data('id'),
                        method: 'DELETE',
                        success: function (data) {
                            table.ajax.reload(null, false);
                            swal({
                                title: "Deleted!",
                                text: "Currency is deleted!",
                                icon: "success",
                            });
                        }
                    });

                    swal("Poof! Your imaginary file has been deleted!", {
                        icon: "success",
                    });
                } else {
                    swal("Cancled!");
        }
        });

        });



    });
</script>