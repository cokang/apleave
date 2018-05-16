<div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Leave Calender</h1>
      </div>
      <!-- /.col-lg-12 --> 
    </div>
    <!-- /.row --> 
    
    <!-- /.row --> 
    
    <!-- /.row --> 
    
    <!-- /.row -->
    <div class="row"> 
      
      <!-- /.col-lg-6 -->
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading"> </div>
          <!-- /.panel-heading -->
          <div class="panel-body">
            <form method="POST" action="">
            <div class="form-group col-lg-3" id="to_date">
              <label>Date</label>
              <input name="date_calendar" id="date_calendar" type="text" class="form-control" value="<?=isset($datecal) ? $datecal : ''?>" onchange="submit()" />
            </div>
            </form>
            <div class="table-responsive">
              <table class="table" id="no-more-tables">
                <thead>
                 <tr bgcolor="#eee">
                    <th>Applicant Name</th>
                    <th>Leave Type</th>
                    <th>From</th>
                    <th>To</th>
                    <th>No of days</th>
                    <th>Reason</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <?php foreach ($datecalendar as $row): ?>
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
                    <td data-title="Applicant Name:"><?=isset($row->v_UserName) ? $row->v_UserName : ''?></td>
                    <td data-title="Leave Type:"><?=isset($row->leave_name) ? $row->leave_name : ''?></td>
                    <td data-title="From:"><?=isset($row->leave_from) ? $row->leave_from : ''?></td>
                    <td data-title="To:"><?=isset($row->leave_to) ? $row->leave_to : ''?></td>
                    <td data-title="No of days:"><?=isset($noleave) ? $noleave : '' ?></td>
                    <td data-title="Reason:"><?=isset($row->leave_remarks) ? $row->leave_remarks : ''?></td>
                    <td><?= !(isset($row->leave_status)) ||  $row->leave_status == '' ? '<a href="'.base_url().'index.php/Controllers/print_out?id='.$row->id.'&userid='.$row->user_id.'" >Print</a>' : '' ?></td>
                  </tr>
                </tbody>
                <?php endforeach; ?>
              </table>
              <ul class="pagination">
              <?php if ($rec[0]->jumlah > $limit){ ?>
              <?php for ($i=1;$i<=$page;$i++){ ?>
              <li class="paginate_button">&nbsp;<a href="?tabIndex=1&p=<?php echo $i?>&date_calendar=<?=$datecal?>"><?=$i?></a></li>
              <?php } ?>
              <li class="paginate_button previous"><a href="?tabIndex=1&p=<?php echo $page?>&date_calendar=<?=$datecal?>">Next</a></li>
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