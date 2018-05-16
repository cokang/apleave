<div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Leave Application for User</h1>
      </div>
      <!-- /.col-lg-12 --> 
    </div>
    <!-- /.row --> 
    
    <!-- /.row --> 
    
    <!-- /.row --> 
    
    <!-- /.row -->
    <div class="row"> 
      
      <!-- /.col-lg-9 -->
      <div class="col-lg-9">
        <div class="panel panel-default">
          <div class="panel-heading"> </div>
          <!-- /.panel-heading -->
          <div class="panel-body">
            <div class="">
              <table class="table" id="no-more-tableshead">
                <thead>
                  <tr>
                    <th colspan="4" bgcolor="#eee"><b>Leave Detail</b></th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="">
                    <th style="text-align:right;"><b>Leave Type :</b></th>
                    <td data-title="Leave Type :" align="left"><?=isset($userleave[0]->leave_name) ? $userleave[0]->leave_name : '' ?></td>
                    <th style="text-align:right;"><b>Leave Balance :</b></th>
                    <td data-title="Leave Balance :" align="left"><?= $balanceleave ?></td>
                  </tr>
                  <tr class="">
                    <th style="text-align:right;"><b>From :</b></th>
                    <td data-title="From :" align="left"><?=isset($leavedet[0]->leave_from) ? date('d-m-Y',strtotime($leavedet[0]->leave_from)) : '' ?></td>
                    <th style="text-align:right;"><b>To :</b></th>
                    <td data-title="To :" align="left"><?=isset($leavedet[0]->leave_to) ? date('d-m-Y',strtotime($leavedet[0]->leave_to)) : '' ?></td>
                  </tr>
                  <tr class="">
                    <th style="text-align:right;"><b>Date of Application :</b></th>
                    <td data-title="Date of Application :" align="left"><?=isset($leavedet[0]->application_date) ? date('d-m-Y',strtotime($leavedet[0]->application_date)) : '' ?></td>
                    <th style="text-align:right;"><b>No. of Day/s Applied :</b></th>
                    <td data-title="NO. of Working Days :" align="left"><?= isset($noleave) ? $noleave : '' ?></td>
                  </tr>
                  <tr class="">
                    <th style="text-align:right;"><b>Reason:</b></th>
                    <td data-title="Reason:" align="left" colspan="3"><?=isset($leavedet[0]->leave_remarks) ? $leavedet[0]->leave_remarks : '' ?></td>
                  </tr>
                  <?php if($leavedet[0]->leave_type == '2' OR $leavedet[0]->leave_type == '3') { ?>
                  <tr class="">
                    <th style="text-align:right;"><b>Sick Leave Image:</b></th>
                    <td colspan="3" data-title="Sick Leave Image:"><a class='sample'  data-lighter='<?php echo base_url(); ?>sick_leave_img/<?=isset($leavedet[0]->file_name) ? $leavedet[0]->file_name : 'No_image_available.jpg'?>'  href='<?php echo base_url(); ?>sick_leave_img/<?=isset($leavedet[0]->file_name) ? $leavedet[0]->file_name : 'No_image_available.jpg'?>'><img src='<?php echo base_url(); ?>sick_leave_img/<?=isset($leavedet[0]->file_name) ? $leavedet[0]->file_name : 'No_image_available.jpg'?>' title="Zoom this Picture"></a></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <table class="table">
                <thead>
                  <tr bgcolor="#eee">
                    <?php if (!isset($leavedet[0]->leave_status)) { ?>
                    <th style="text-align:right;"><?php echo anchor ('leave_approval_ctrl?name='.$userid.'&id='.$regid.'&status=Accepted','Accept'); ?></th>
                    <th><?php echo anchor ('leave_approval_ctrl?name='.$userid.'&id='.$regid.'&status=Rejected','Reject'); ?></th>
                    <?php } else { ?>
                    <th style="text-align:right;">Accept</th>
                    <th>Reject</th>
                    <?php } ?>
                  </tr>
                </thead>
              </table>
              <table class="table">
                <thead>
                  <tr>
                    <th>Staff on Leave during the period</th>
                  </tr>
                </thead>
              </table>
              <table class="table" id="no-more-tables">
                <tbody>
                  <tr bgcolor="#eee">
                    <th>Applicant Name</th>
                    <th>Leave Type</th>
                    <th>From</th>
                    <th>To</th>
                    <th>No of days</th>
                    <th>Reason</th>
                    <th>&nbsp;</th>
                  </tr>
                </tbody>
                <?php foreach($samedateleave as $row): ?>
                <?php 

                $fromdate = $row->leave_from;
                $todate = ($row->leave_to) ? $row->leave_to : $row->leave_from;

                $begin = strtotime($fromdate);
                $end   = strtotime($todate);
                
                if ($row->v_hospitalcode == 'JB'){
                  $holiday_array = $JB_hol;
                }
                elseif($row->v_hospitalcode == 'MKA'){
                  $holiday_array = $MKA_hol;
                }
                elseif($row->v_hospitalcode == 'NS'){
                  $holiday_array = $NS_hol;
                }
                elseif($row->v_hospitalcode == 'SEL'){
                  $holiday_array = $SEL_hol;
                }
                
                $no_days  = 0;
                  $weekends = 0;
                  while ($begin <= $end) {
                      $no_days++; // no of days in the given interval
                      $what_day = date("N", $begin);
                      //echo "$what_day".$what_day;
                      if($row->v_hospitalcode == 'JB'){
                        if (($what_day == 5) || ($what_day == 6) || (in_array($begin, $holiday_array))) { // 5 and 6 are weekend days
                          $weekends++;
                        }
                      }
                      else{
                        if ($what_day > 5 || (in_array($begin, $holiday_array))) { // 6 and 7 are weekend days
                          $weekends++;
                        }
                      }
                      $begin += 86400; // +1 day
                  };
                  $noleave = $no_days - $weekends;

                ?>
                <tbody>
                  <tr>
                    <td data-title="Applicant Name:"><?=isset($row->v_UserName) ? $row->v_UserName : '' ?></td>
                    <td data-title="Leave Type:"><?=isset($row->leave_type) ? $row->leave_type : '' ?></td>
                    <td data-title="From:"><?=isset($row->leave_from) ? date('d-m-Y',strtotime($row->leave_from)) : '' ?></td>
                    <td data-title="To:"><?=isset($row->leave_to) ? date('d-m-Y',strtotime($row->leave_to)) : '' ?></td>
                    <td data-title="No of days:"><?=isset($noleave) ? $noleave : '' ?></td>
                    <td data-title="Reason:"><?=isset($row->leave_remarks) ? $row->leave_remarks : '' ?></td>
                  </tr>
                </tbody>
              <?php endforeach; ?>
              </table>
              <ul class="pagination">
              <?php if ($rec[0]->jumlah > $limit){ ?>
              <?php for ($i=1;$i<=$page;$i++){ ?>
              <li class="paginate_button">&nbsp;<a href="?p=<?php echo $i?>&name=<?=$userid?>&id=<?=$regid?>"><?=$i?></a></li>
              <?php } ?>
              <li class="paginate_button previous"><a href="?p=<?php echo $page?>&name=<?=$userid?>&id=<?=$regid?>">Next</a></li>
              <?php } ?>
              </ul>
            </div>
            <!-- /.table-responsive --> 
          </div>
          <!-- /.panel-body --> 
        </div>
        <!-- /.panel --> 
      </div>
      <!-- /.col-lg-9 --> 
      
    </div>
    <!-- /.row --> 
  </div>
  <!-- /#page-wrapper --> 