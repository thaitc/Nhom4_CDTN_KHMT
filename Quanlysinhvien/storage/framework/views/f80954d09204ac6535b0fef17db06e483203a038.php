<html>

<head>
    <title>Laravel 7 Ajax CRUD tutorial using Datatable</title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.17/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.17/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>

<body class="bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-header">
                        <div class="col-md-12">
                            <h4 class="card-title">Laravel 7 Ajax CRUD tutorial using Datatable - nicesnippets.com
                                <a class="btn btn-success ml-5" href="javascript:void(0)" id="createNewItem"> Create New Item</a>
                            </h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th width="5%">STT</th>
                                    <th>Tên môn</th>
                                    <th>Tên khoa</th>
                                    <th>Tín chi</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="ajaxModel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modelHeading"></h4>
                                </div>
                                <div class="modal-body">
                                    <form id="ItemForm" name="ItemForm" class="form-horizontal">
                                        <input type="hidden" name="Item_id" id="Item_id">
                                        <div class="form-group">
                                            <label for="tenmon" class="col-sm-2 control-label">Tên môn</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="tenmon" name="tenmon" placeholder="Enter tên môn" value="" maxlength="50" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tenmon" class="col-sm-2 control-label">Tên khoa</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="tenkhoa" name="tenkhoa" placeholder="Enter tên môn" value="" maxlength="50" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Tín chỉ</label>
                                            <div class="col-sm-12">
                                                <textarea id="tinchi" name="tinchi" required="" placeholder="Enter tín chỉ" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Lưu
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    $(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "<?php echo e(route('monhoc1.index')); ?>",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data:'tenmon',
                    name:'tenmon'
                },
                {
                    data: 'tenkhoa',
                    name: 'tenkhoa'
                },
                {
                    data: 'tinchi',
                    name: 'tinchi'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $('#createNewItem').click(function() {
            $('#saveBtn').val("create-Item");
            $('#Item_id').val('');
            $('#ItemForm').trigger("reset");
            $('#modelHeading').html("Create New Item");
            $('#ajaxModel').modal('show');
        });

        $('body').on('click', '.editItem', function() {
            var Item_id = $(this).data('id');
            $.get("<?php echo e(route('monhoc1.index')); ?>" + '/' + Item_id + '/edit', function(data) {
                $('#modelHeading').html("Edit Item");
                $('#saveBtn').val("edit-user");
                $('#ajaxModel').modal('show');
                $('#Item_id').val(data.id);
                $('#tenmon').val(data.tenmon);
                $('#tenkhoa').val(data.tenkhoa);
                $('#tinchi').val(data.tinchi);
            })
        });

        $('#saveBtn').click(function(e) {
            e.preventDefault();
            $(this).html('Đang lưu...');

            $.ajax({
                data: $('#ItemForm').serialize(),
                url: "<?php echo e(route('monhoc1.store')); ?>",
                type: "POST",
                dataType: 'json',
                success: function(data) {

                    $('#ItemForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();

                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save Changes');
                }
            });
        });

        $('body').on('click', '.deleteItem', function() {

            var Item_id = $(this).data("id");
            confirm("Are You sure want to delete !");

            $.ajax({
                type: "DELETE",
                url: "<?php echo e(route('monhoc1.store')); ?>" + '/' + Item_id,
                success: function(data) {
                    table.draw();
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        });

    });
</script>

</html><?php /**PATH F:\xampp\htdocs\thaitc\resources\views/monhoc1.blade.php ENDPATH**/ ?>