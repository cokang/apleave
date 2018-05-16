<div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Leave Approval</h1>
      </div>
      <!-- /.col-lg-12 --> 
    </div>
    <!-- /.row --> 
    
    <!-- /.row --> 
    
    <!-- /.row --> 
    
    <!-- /.row -->
    <div class="row"> 
      
      <!-- /.col-lg-6 -->
      <div class="col-lg-7">
        <div class="panel panel-default">
          <div class="panel-heading"> </div>
          <!-- /.panel-heading -->
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Reason</th>
                    <th>Action</th>
                    <th></th>
                  </tr>
                </thead>
                <?php $num=1;foreach($leaveapp as $row): ?>
                <tbody>
                  
                  <tr class="">
                    <td><?=($start+1)?></td>
                    <td><a href="<?php echo base_url(); ?>index.php/leave_application?name=<?=$row->user_id?>&id=<?=$row->id?>"><?=isset($row->user_id) ? $row->user_id : '' ?></a></td>
                    <td><?=isset($row->leave_from) ? $row->leave_from : '' ?></td>
                    <td><?=isset($row->leave_to) ? $row->leave_to : '' ?></td>
                    <td><a href="#" onclick="return showDialog('<?= $row->id ?>','approval','<?= $limit ?>','<?= $start ?>','<?=$row->v_GroupID?>')">View Reason</a><div id="dialog" style="display:none;"><div id="myDialogText"></div></td>
                    <td><?= isset($row->leave_status) ? $row->leave_status : '' ?></td>
                    <td><?= $row->leave_status == 'Accepted' ? anchor ('leave_approval_ctrl?name='.$row->user_id.'&id='.$row->id.'&status=Cancelled','Cancel') : '' ?></td>
                  </tr>
                <?php $start++ ?>
                </tbody>
                <?php endforeach; ?>
              </table>
              <ul class="pagination">
              <?php if ($rec[0]->jumlah > $limit){ ?>
              <?php for ($i=1;$i<=$page;$i++){ ?>
              <li class="paginate_button">&nbsp;<a href="?p=<?php echo $i?>"><?=$i?></a></li>
              <?php } ?>
              <li class="paginate_button previous"><a href="?p=<?php echo $page?>">Next</a></li>
              <?php } ?>
              </ul>
            </div>
            <!-- /.table-responsive --> 
          </div>
          <!-- /.panel-body --> 
        </div>
        <!-- /.panel --> 
      </div>
      <!-- /.col-lg-7 --> 
      
    </div>
    <!-- /.row --> 
  </div>
  <!-- /#page-wrapper --> 