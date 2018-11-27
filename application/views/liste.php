
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

		<?php if (isset($_SESSION['loginName']) && $_SESSION['loginName'] == 'admin'){ ?>
			<button class="btn btn-success" onclick="add_collection()"><i class="glyphicon glyphicon-plus"></i> Add collection</button>
		<?php } ?>
		<br />
    <br />
    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th> ID</th>
          <th> Identifier</th>
          <th> Height</th>
          <th> Weight</th>
          <th> Base Experience</th>
          <th style="width:125px;">Action</p></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($pokemons as $pokemon){?>
          <tr>
          <td><?php echo $pokemon->pokemon_id;?></td>
          <td><?php echo $pokemon->identifier;?></td>
          <td><?php echo $pokemon->height;?></td>
          <td><?php echo $pokemon->weight;?></td>
          <td><?php echo $pokemon->base_experience;?></td>
          <td> 
              <?php if(isset($_SESSION['loginName']) && ($_SESSION['loginName'] == 'admin')){ ?>
              <button class="btn btn-warning" onclick="edit_collection(<?php echo $pokemon->pokemon_id;?>)"><i class="glyphicon glyphicon-pencil"></i></button>
              <button class="btn btn-danger" onclick="delete_collection(<?php echo $pokemon->pokemon_id;?>)"><i class="glyphicon glyphicon-remove"></i></button>
              <?php } if(isset($_SESSION['loginName']) && ($_SESSION['loginName'] <> 'admin')){ ?>
								<button class="btn btn-warning" onclick="add_my_collection(name='<?php echo $_SESSION['loginName'];?>',id=<?php echo $pokemon->pokemon_id;?>)"><i class="glyphicon glyphicon-plus"></i></button>
                <button class="btn btn-danger" onclick="remove_my_collection(<?php echo $_SESSION['loginName'];?>)"><i class="glyphicon glyphicon-minus"></i></button>
              <?php } ?>
            </td>
          </tr>
        <?php }?>
      </tbody>
      <tfoot>
        <tr>
        <th> ID</th>
        <th> Identifier</th>
        <th> Height</th>
        <th> Weight</th>
        <th> base experience</th>
        <th>Action</th>
        </tr>
      </tfoot>
    </table>

		<!--
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script> 	  
		-->
  <script type="text/javascript">
    $(document).ready( function () {
        $('#table_id').DataTable();
    } );

    var save_method; //for save method string
    var table;
 
    function add_collection()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Add Pokemon');
    }


    function delete_collection(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('liste/delete_by_id')?>/"+id,
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

		function add_my_collection(name, id)
    {

			//alert(name);
			//alert(id);

			/*
			if(confirm('Are you sure add this data ?'))
      {
			*/
        	// ajax add data from database
          $.ajax({
            url : "<?php echo site_url('collection/add')?>/"+id+"/"+name,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding data');
            }
        });
      //}

    }

    function edit_collection(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals
 
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('liste/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="pokemon_id"]').val(data.pokemon_id);
            $('[name="identifier"]').val(data.identifier);
            $('[name="height"]').val(data.height);
            $('[name="weight"]').val(data.weight);
            $('[name="base_experience"]').val(data.base_experience);
  
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Pokemon'); // Set title to Bootstrap modal title
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
          url = "<?php echo site_url('liste/add')?>";
      }
      else
      {
        url = "<?php echo site_url('liste/update')?>";
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
               $('#modal_form').modal('hide');
              location.reload();// for reload a page
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
    }
 
  </script>
 
  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title alert alert-info">Liste Form</h3>
      </div>
      <div class="modal-body form">
        
      <form action="#" id="form" class="form-horizontal">
          
        <input type="hidden" value="" name="pokemon_id"/>
          
          <div class="form-body">
            
            <div class="form-group">
              <label class="control-label col-md-3">Identifier</label>
              <div class="col-md-9">
                <input name="identifier" placeholder="Identifier" class="form-control" type="text">
              </div>
            </div>
            
            <div class="form-group">
              <label class="control-label col-md-3">Height</label>
              <div class="col-md-9">
                <input name="height" placeholder="height" class="form-control" type="text">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3">Weight</label>
              <div class="col-md-9">
								<input name="weight" placeholder="Weight" class="form-control" type="text">
              </div>
            </div>
        
            <div class="form-group">
							<label class="control-label col-md-3">Base Experience</label>
							<div class="col-md-9">
								<input name="base_experience" placeholder="Base experience" class="form-control" type="text">
							</div>
						</div>
 
          </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-success">Save</button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
 
  </body>
</html>
