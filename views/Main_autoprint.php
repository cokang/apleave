 <div class="row" style="margin-top:-90px">
    <div class="col-lg-12">
      <?php $num=1;foreach($leaveacc as $row): ?>
      <?php if ($num == 1 OR $num%4 == 1){ ?>
      <h4 class="page-header">Leave account</h4>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->

  <!-- /.row -->
  <div class="col-lg-12" style="margin-top:-20px;margin-bottom:-20px">
      <div style="display:inline-block; width:80%; float:left;"><h6>Year Selected : <?= $fyear ?> <br /> Data Selected : <?= $check?> <br /> Department : <?=$dept_L?></h6></div>
      <div style="display:inline-block; float:left;"><h6> E - Eligible<br /> C - Carry<br />T - Taken<br />B - Balance</h6></div>
  </div>


  <!-- /.row -->
  <div class="row" >

    <!-- /.col-lg-6 -->
    <div class="col-lg-12" >
        <!-- /.panel-heading -->
        <div class="panel-body">
          <div class="table-responsive">
            <div id="subscribers_list">
              <table class="table" style="font-size:10px;">
                <tbody>
                  <?php } ?>
                  <tr class="warning">
                    <td style="width:10px;"><?=$num?></td>
                    <td><?=isset($row->v_UserName) ? $row->v_UserName : '' ?></td>
                  </tr>
                  <tr class="warning">
                    <td colspan="2">

                    <table cellpadding="5" cellspacing="5" border="1" style="text-align:center; width:100%">
                      <?php

                        $ALtaken = 0;
                        $SLtaken = 0;
                        $ELtaken = 0;
                        $UPLtaken = 0;
                        $EXLtaken = 0;
                        $FStaken = 0;
                        $FSEtaken = 0;
                        $MLtaken = 0;
                        $MLEtaken = 0;
                        $PLtaken = 0;
                        $PLEtaken = 0;
                        $MRLtaken = 0;
                        $MRLEtaken = 0;
                        $ULtaken = 0;
                        $ULEtaken = 0;
                        $STLtaken = 0;
                        $STLEtaken = 0;
                        $TLtaken = 0;
                        $TLEtaken = 0;
                        $HLtaken = 0;
                        $HLEtaken = 0;
                        $hajjstat = '';
                        foreach ($tleavetaken as $list){

                          $fromdate = $list->leave_from;
                          $todate = ($list->leave_to) ? $list->leave_to : $list->leave_from;

                          $begin = strtotime($fromdate);
                          $end   = strtotime($todate);

                            if ($list->v_hospitalcode == 'JB'){
                              $holiday_array = $JB_hol;
                            }
                            elseif($list->v_hospitalcode == 'MKA'){
                              $holiday_array = $MKA_hol;
                            }
                            elseif($list->v_hospitalcode == 'NS'){
                              $holiday_array = $NS_hol;
                            }
                            elseif($list->v_hospitalcode == 'SEL'){
                              $holiday_array = $SEL_hol;
                            }
                            elseif($list->v_hospitalcode == 'PHG'){
                              $holiday_array = $PHG_hol;
                            }
                            elseif($list->v_hospitalcode == 'KL'){
                              $holiday_array = $KL_hol;
                            }

                              $no_days  = 0;
                              $weekends = 0;
                              while ($begin <= $end) {
                                  $no_days++; // no of days in the given interval
                                  $what_day = date("N", $begin);
                                  //echo "$what_day".$what_day;
                                  if($list->v_hospitalcode == 'JB'){
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
                              if($list->user_id == $row->user_id){
                                if ($list->leave_type == '1'){  //annual leave
                                  $ALtaken += $noleave;
                                }
                                elseif($list->leave_type == '2'){  //sick leave
                                  $SLtaken += $noleave;
                                }
                                elseif($list->leave_type == '3'){  //emergency leave
                                  $ELtaken += $noleave;
                                }
                                elseif($list->leave_type == '4'){  //unpaid leave
                                  $UPLtaken += $noleave;
                                }
                                elseif($list->leave_type == '5'){  //unpaid leave
                                  $EXLtaken += $noleave;
                                }
                                elseif($list->leave_type == '6'){  //family sick leave
                                  if ($noleave <= $leave_type[5]->per_case_basis){
                                  $FStaken += $noleave;
                                  }
                                  else{
                                  $FStaken += $leave_type[5]->per_case_basis;
                                  $FSEtaken += ($noleave - $leave_type[5]->per_case_basis);
                                  }
                                }
                                elseif($list->leave_type == '7'){  //maternity leave
                                  if ($noleave <= $leave_type[6]->per_case_basis){
                                  $MLtaken += $noleave;
                                  }
                                  else{
                                  $MLtaken += $leave_type[6]->per_case_basis;
                                  $MLEtaken += ($noleave - $leave_type[6]->per_case_basis);
                                  }
                                }
                                elseif($list->leave_type == '8'){  //paternity leave
                                  if ($noleave <= $leave_type[7]->per_case_basis){
                                  $PLtaken += $noleave;
                                  }
                                  else{
                                  $PLtaken += $leave_type[7]->per_case_basis;
                                  $PLEtaken += ($noleave - $leave_type[7]->per_case_basis);
                                  }
                                }
                                elseif($list->leave_type == '9'){  //marriage leave
                                  if ($noleave <= $leave_type[8]->per_case_basis){
                                  $MRLtaken += $noleave;
                                  }
                                  else{
                                  $MRLtaken += $leave_type[8]->per_case_basis;
                                  $MRLEtaken += ($noleave - $leave_type[8]->per_case_basis);
                                  }
                                }
                                elseif($list->leave_type == '10'){  //unrecorded leave
                                  if ($noleave <= $leave_type[9]->per_case_basis){
                                  $ULtaken += $noleave;
                                  }
                                  else{
                                  $ULtaken += $leave_type[9]->per_case_basis;
                                  $ULEtaken += ($noleave - $leave_type[9]->per_case_basis);
                                  }
                                }
                                elseif($list->leave_type == '11'){  //study leave
                                  if ($noleave <= $leave_type[10]->per_case_basis){
                                  $STLtaken += $noleave;
                                  }
                                  else{
                                  $STLtaken += $leave_type[10]->per_case_basis;
                                  $STLEtaken += ($noleave - $leave_type[10]->per_case_basis);
                                  }
                                }
                                elseif($list->leave_type == '12'){  //transfer leave
                                  if ($noleave <= $leave_type[11]->per_case_basis){
                                  $TLtaken += $noleave;
                                  }
                                  else{
                                  $TLtaken += $leave_type[11]->per_case_basis;
                                  $TLEtaken += ($noleave - $leave_type[11]->per_case_basis);
                                  }
                                }
                                elseif($list->leave_type == '13'){  //hajj leave
                                  if ($noleave <= $leave_type[12]->per_case_basis){
                                  $HLtaken += $noleave;
                                  }
                                  else{
                                  $HLtaken += $leave_type[12]->per_case_basis;
                                  $HLEtaken += ($noleave - $leave_type[12]->per_case_basis);
                                  }
                                }
                              }
                        }
                        foreach ($hajj as $hajjlist){
                          if ($row->user_id == $hajjlist['user_id']){
                            if ($hajjlist['hajjdet'] == 1){
                              $hajjstat = 'Taken';
                            }
                          }
                        }
                        $sickB = (isset($row->sick_leave) ? $row->sick_leave : 0) - $SLtaken;
                        if ($sickB < 0){
                          $SLEtaken = abs($sickB);
                          $SLbalance = 0;
                        }
                        else{
                          $SLbalance = $sickB;
                        }
                        $annualB = (isset($row->annual_leave) ? $row->annual_leave : 0) + (isset($row->carry_fwd_leave) ? $row->carry_fwd_leave : 0) - $ALtaken - $ELtaken - $FSEtaken - $MLEtaken
                                      - $PLEtaken - $MRLEtaken - $ULEtaken - $STLEtaken - $TLEtaken - $HLEtaken - (isset($SLEtaken) ? $SLEtaken : 0);
                        if ($annualB < 0){
                          $ALEtaken = abs($annualB);
                          $ALbalance = 0;
                        }
                        else{
                          $ALbalance = $annualB;
                        }
                        $UPLbalance = $UPLtaken + (isset($ALEtaken) ? $ALEtaken : 0);
                        $EXLbalance = $EXLtaken;
                        $ELbalance = (isset($leave_type[2]->limit_days) ? $leave_type[2]->limit_days : 0) - $ELtaken;
                        $FSbalance = (isset($leave_type[5]->entitle_days) ? $leave_type[5]->entitle_days : 0) - $FStaken;
                        $MLbalance = (isset($leave_type[6]->entitle_days) ? $leave_type[6]->entitle_days : 0) - $MLtaken;
                        $PLbalance = (isset($leave_type[7]->entitle_days) ? $leave_type[7]->entitle_days : 0) - $PLtaken;
                        $MRLbalance = (isset($leave_type[8]->entitle_days) ? $leave_type[8]->entitle_days : 0) - $MRLtaken;
                        $ULbalance = (isset($leave_type[9]->entitle_days) ? $leave_type[9]->entitle_days : 0) - $ULtaken;
                        $STLbalance = (isset($leave_type[10]->entitle_days) ? $leave_type[10]->entitle_days : 0) - $STLtaken;
                        $TLbalance = (isset($leave_type[11]->entitle_days) ? $leave_type[11]->entitle_days : 0) - $TLtaken;
                        $HLbalance = ($hajjstat != '' ? $hajjstat : (isset($leave_type[12]->entitle_days) ? $leave_type[12]->entitle_days : 0) - $HLtaken);

                      ?>
                      <tr class="warning tblfont">
                          <th>Annual</th>
                          <th>Sick</th>
                          <th>Emergency</th>
                          <th>Unpaid</th>
                          <th>Extended Sick</th>
                          <th>Family Sick</th>
                          <th>Maternity</th>
                          <th>Paternity</th>
                          <th>Marriage</th>
                          <th>Unrecorded</th>
                          <th>Study</th>
                          <th>Transfer</th>
                          <th>Hajj</th>
                        </tr>
                        <tr>
                          <td>E - <?=isset($row->annual_leave) ? $row->annual_leave : 0 ?></td>
                          <td>E - <?=isset($row->sick_leave) ? $row->sick_leave : 0 ?></td>
                          <td>E - <?=isset($leave_type[2]->limit_days) ? $leave_type[2]->limit_days : 0?></td>
                          <td>T - <?=$UPLbalance?></td>
                          <td>T - <?=$EXLbalance?></td>
                          <td>E - <?=isset($leave_type[5]->entitle_days) ? $leave_type[5]->entitle_days : 0?></td>
                          <td>E - <?=isset($leave_type[6]->entitle_days) ? $leave_type[6]->entitle_days : 0?></td>
                          <td>E - <?=isset($leave_type[7]->entitle_days) ? $leave_type[7]->entitle_days : 0?></td>
                          <td>E - <?=isset($leave_type[8]->entitle_days) ? $leave_type[8]->entitle_days : 0?></td>
                          <td>E - <?=isset($leave_type[9]->entitle_days) ? $leave_type[9]->entitle_days : 0?></td>
                          <td>E - <?=isset($leave_type[10]->entitle_days) ? $leave_type[10]->entitle_days : 0?></td>
                          <td>E - <?=isset($leave_type[11]->entitle_days) ? $leave_type[11]->entitle_days : 0?></td>
                          <td>E - <?=isset($leave_type[12]->entitle_days) ? $leave_type[12]->entitle_days : 0?></td>
                        </tr>
                        <tr>
                          <td>C - <?=isset($row->carry_fwd_leave) ? $row->carry_fwd_leave : 0 ?></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>T - <?=$ALtaken?></td>
                          <td>T - <?=$SLtaken?></td>
                          <td>T - <?=$ELtaken?></td>
                          <td></td>
                          <td></td>
                          <td>T - <?=$FStaken + $FSEtaken?></td>
                          <td>T - <?=$MLtaken + $MLEtaken?></td>
                          <td>T - <?=$PLtaken + $PLEtaken?></td>
                          <td>T - <?=$MRLtaken + $MRLEtaken?></td>
                          <td>T - <?=$ULtaken + $ULEtaken?></td>
                          <td>T - <?=$STLtaken + $STLEtaken?></td>
                          <td>T - <?=$TLtaken + $TLEtaken?></td>
                          <td>T - <?=$HLtaken + $HLEtaken?></td>
                        </tr>
                        <tr>
                          <td>B - <?=$ALbalance?></td>
                          <td>B - <?=$SLbalance?></td>
                          <td>B - <?=$ELbalance?></td>
                          <td></td>
                          <td></td>
                          <td>B - <?=$FSbalance?></td>
                          <td>B - <?=$MLbalance?></td>
                          <td>B - <?=$PLbalance?></td>
                          <td>B - <?=$MRLbalance?></td>
                          <td>B - <?=$ULbalance?></td>
                          <td>B - <?=$STLbalance?></td>
                          <td>B - <?=$TLbalance?></td>
                          <td>B - <?=$HLbalance?></td>
                        </tr>
                    </table>

                    </td>

                  </tr>

                </tbody>
<?php if ($num % 4 == 0) { ?>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.panel-body -->
        </div>
        <!-- /.panel -->

        <div class="StartNewPage" id="breakpage"><span id="pagebreak"></span></div>
        <?php } ?>
        <?php $num++ ?>
        <?php endforeach; ?>
      </div>
      <!-- /.col-lg-6 -->

    </div>
    <!-- /.row -->
