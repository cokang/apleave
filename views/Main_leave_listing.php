<div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Leave Request(s)</h1>
      </div>
      <!-- /.col-lg-12 --> 
    </div>
    <!-- /.row --> 
    
    <!-- /.row --> 
    
    <!-- /.row --> 
    
    <!-- /.row -->
    <div class="row"> 
      
      <!-- /.col-lg-7 -->
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
                <?php $num=1; foreach($leavelist as $row): ?>
                <tbody>
                  <tr class="">
                    
                    <td><?= ($start+1) ?></td>
                    <td><?= isset($row->user_id) ? $row->user_id : '' ?></td>
                    <td><?= isset($row->leave_from) ? date('d-m-Y',strtotime($row->leave_from)) : '' ?></td>
                    <td><?= isset($row->leave_to) ? date('d-m-Y',strtotime($row->leave_to)) : '' ?></td>
                    <td><a href="#" onclick="return showDialog('<?= $row->id ?>','listing','<?= $limit ?>','<?= $start ?>')">View Reason</a><div id="dialog" style="display:none;"><div id="myDialogText"></div></td>
                    <td><?= isset($row->leave_status) ? $row->leave_status : 'Pending' ?></td>
					          <td><?= !(isset($row->leave_status)) ||  $row->leave_status == '' ? '<a href="'.base_url().'index.php/Controllers/print_out?id='.$row->id.'" ><i class="fa fa-print fa-fw" title="Print"></i></a> | <a href="#" onclick="cancelrequest(this)" data-id="'.$row->id.'" data-toggle="confirmation" data-user="'.$row->user_id.'"><i class="fa fa-times fa-fw" title="Cancel Request"></i></a>' : '' ?></td> 
                    <?php $start++ ?>
                  </tr>
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
      <!-- /.col-lg-6 --> 
      
    </div>
    <!-- /.row --> 
  </div>
  <!-- /#page-wrapper --> 



  <script type="text/javascript">
      function cancelrequest(e){
        var answer = confirm("Are You Sure Want To Cancel This Request?");
        if (answer) {
          var id      = $(e).data("id");
          var user_id = $(e).data("user");
          $.ajax({
            url: "<?=site_url()?>/leave_approval_ctrl",
            data:{name:user_id,id:id,status:"Cancelled",ref:1},
            type:"GET",
            success: function(data){
              if(data==1){
                location.reload();
              }
            }
          });
        }
      }
  </script>