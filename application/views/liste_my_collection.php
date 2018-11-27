<div class="container">
		<h1>Liste</h1>
		
		<h3><?php if (isset($_SESSION['loginName'])){
			echo "Login : " . ($_SESSION['loginName']);
		}else{
			echo "No Login"; 
		}
		?>
		</h3>
		<br />

		<br />
    <br />
    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th> ID</th>
          <th> Collector_login</th>
          <th style="width:125px;">Action</p></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($collection as $item){?>
          <tr>
						<td><?php echo $item->pokemon_id;?></td>
						<td><?php echo $item->collector_login?></td>
						<td>
							<button class="btn btn-danger" onclick="remove_my_collection(name='<?php echo $_SESSION['loginName'];?>', id=<?php echo $item->pokemon_id;?>)"><i class="glyphicon glyphicon-remove"></i></button>
						</td>
          </tr>
        <?php }?>
      </tbody>
      <tfoot>
        <tr>
					<th> ID</th>
					<th> Identifier</th>
					<th>Action</th>
        </tr>
      </tfoot>
    </table>

  <script type="text/javascript">
    $(document).ready( function () {
        $('#table_id').DataTable();
    } );

    var save_method; //for save method string
    var table;
 
		function remove_my_collection(name, id)
    {
			//alert(name);
			//alert(id);
			/*
			if(confirm('Are you sure delete this data ?'))
      {
			*/
        // ajax delete data from database
				$.ajax({
					url : "<?php echo site_url('collection/delete_by_id_by_name')?>/"+id+"/"+name,
					type: "POST",
					dataType: "text",
					success: function(data)
					{
						location.reload();
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						alert('Error deleting data');
					}
        });
      //}

    } 
  </script>
  
  </body>
</html>
