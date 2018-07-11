
<div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Manage Employees</h1>
      </div>
      <!-- /.col-lg-12 --> 
    </div>
    <!-- /.row --> 
    
    <!-- /.row --> 
    
    <!-- /.row --> 
    
    <!-- /.row -->
    <div class="row"> 
      
      <!-- /.col-lg-6 -->
      <div class="col-lg-6" style="width:80%">
        <div class="panel panel-default">
          <div class="panel-heading"> </div>
          <!-- /.panel-heading -->
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <?php foreach($stafflist as $row): ?>
                <tbody>
                  <tr class="">
                    <td><?=($start+1)?></td>
                    <td><?=isset($row->v_UserID) ? $row->v_UserID : '' ?></td>
                    <td><?=isset($row->v_UserName) ? $row->v_UserName : '' ?></td>
                    <td><?=isset($row->v_GroupID) ? $row->v_GroupID : '' ?></td>                    
                    <td><a href="<?php echo base_url(); ?>index.php/Controllers/add_employee?name=<?=isset($row->v_UserID) ? $row->v_UserID : '' ?>" >Edit</a> &nbsp;&nbsp;&nbsp;
                        <a href="<?php echo base_url(); ?>index.php/Controllers/add_leaves?employee_name=<?=isset($row->v_UserID) ? $row->v_UserID : '' ?>" > Update Leaves </a>
                    </td>
                  </tr>
                </tbody>
                <?php $start++ ?>
                <?php endforeach; ?>
              </table>
              <ul class="pagination">
                <?php if ($rec[0]->jumlah > $limit){ ?>						
						<?php if ($this->input->get('p') != ''){ ?>
						<li><a href="?p=1"> <i class="fa fa-chevron-circle-left" style="color:green"></i> First Page </a></li>
					  	<li><a href="?p=<?=($this->input->get('p') > 1 ? $this->input->get('p')-1 : 1)?>">Prev</a></li> 
						<?php } ?>
						<li><a href=""><?=($this->input->get('p') ? $this->input->get('p') : 1)?></a></li>
		               <li class="paginate_button previous"><a href="?p=<?php echo $page?>">Next</a></li>
						<li><a href="?p=<?php echo ceil($rec[0]->jumlah/$limit);?>"> Last Page <i class="fa fa-chevron-circle-right" style="color:red;"></i></a></li>				
                <?php } ?>
              </ul>
			  
            </div>
            <!-- /.table-responsive --> 
          </div>
          <!-- /.panel-body --> 
        </div>
        <!-- /.panel --> 
      </div>
      <!-- /.col-lg-6 --> 
      
    </div>
    <!-- /.row --> 
  </div>
  <!-- /#page-wrapper -->