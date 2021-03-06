<script src="<?php echo base_url(); ?>assets/js/lib/DataTables/datatables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/lib/jquery-ui/jquery-ui.min.js"></script>
<!-- <script src="assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
<script src="assets/js/lib/data-table/dataTables.buttons.min.js"></script>
<script src="assets/js/lib/data-table/buttons.bootstrap.min.js"></script>

<script src="assets/js/lib/data-table/jszip.min.js"></script>
<script src="assets/js/lib/data-table/pdfmake.min.js"></script>
<script src="assets/js/lib/data-table/vfs_fonts.js"></script>
<script src="assets/js/lib/data-table/buttons.html5.min.js"></script>
<script src="assets/js/lib/data-table/buttons.print.min.js"></script>
<script src="assets/js/lib/data-table/buttons.colVis.min.js"></script>
<script src="assets/js/lib/data-table/datatables-init.js"></script> -->

<script type="text/javascript">
	$(document).ready(function() {
		$('.datepicker').datepicker({dateFormat: 'yy-mm-dd'})
		$('#request-list').DataTable();
	});

	var save_method; //for save method string
	var table;


	function add_user()
	{
		save_method = 'add';
		$('#modal-form form')[0].reset(); // reset form on modals
		console.log($('#modal-form'));
		$('#modal-form').modal('show'); // show bootstrap modal
		//$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
	}

	function edit_user(id)
	{
		save_method = 'update';
		$('#modal-form form')[0].reset(); // reset form on modals

		//Ajax Load data from ajax
		$.ajax({
			url : "<?php echo site_url('/user/edit_ajax/')?>" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('[name="id"]').val(data.id);
				$('[name="full_name"]').val(data.full_name);
				$('[name="email"]').val(data.email);
				$('[name="date_of_birth"]').val(data.date_of_birth);
				$('[name="phone_number"]').val(data.phone_number);

				$('#modal-form').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Edit User'); // Set title to Bootstrap modal title

			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error get data from ajax');
			}
		});
	}


	function save()
	{
		var url;
		if(save_method == 'add')
		{
			url = "<?php echo site_url('/user/add')?>";
		}
		else
		{
			url = "<?php echo site_url('/user/update')?>";
		}

		// ajax adding data to database
		$.ajax({
			url : url,
			type: "POST",
			data: $('#form').serialize(),
			dataType: "JSON",
			success: function(data)
			{
				//if success close modal and reload ajax table
				$('#modal-form').modal('hide');
				location.reload();// for reload a page
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error adding / update data');
			}
		});
	}

	function delete_user(id)
	{
		if(confirm('Are you sure delete this data?'))
		{
			// ajax delete data from database
			$.ajax({
				url : "<?php echo site_url('/user/delete/')?>"+id,
				type: "POST",
				dataType: "JSON",
				success: function(data)
				{
					location.reload();
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					alert('Error deleting data');
				}
			});
		}
	}

</script>