<?php if( $this->input->get()=="taken_action" ){?>
<?php $action_pending = "";$taken_action="active";?>
<?php }else{ ?>
<?php $action_pending = "active";$taken_action="";?>
<?php } ?>
<head>
<style type="text/css">

    .calendar{
          text-align: center;
    }
    .calendar .highlight {
		width: 2em;
      border-radius: 50%;
      background-color: #154360;
        color: white;
        text-decoration: none;
      display: inline-block;
        padding: 3px 3px;
    }
    .highlight:hover {
        background-color: #ddd;
        color: black;
    }
    .test{
      background-color: #4B0082;
      font-size: 12px;
      color: white;
    }
    .test2{
      background-color: #FFB6C1;
      font-size: 12px;
      color: black;
    }
.sapik {
  height: 300px;
  overflow-y: scroll;
  overflow-x: hidden;
}
</style>
</head>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Leave Calendar</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->

	<!-- /.row -->
	<div class="row">

		<!-- /.col-lg-6 -->
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="padding: 0px 0px 0px 0px; border-bottom: 0px solid transparent;">
					<div class="tab">
						<button id="tablinks" class="tablinks <?=$action_pending;?>" onclick="tabs_navigation(event, 'pending')">List Search</button>
						<button id="defaultOpen" class="tablinks <?=$taken_action;?>" onclick="tabs_navigation(event, 'taken_action')">Calendar</button>
					</div>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">

					<div id="pending" class="tabcontent <?=$action_pending;?>">
						<div class="table-responsive">
						<form method="POST" action="">
						<div class="form-group col-lg-3" id="from_date">
							<label>Date From</label>
							<input name="date_calendar" id="date_calendar" type="text" class="form-control" value="<?=isset($datecal) ? $datecal : ''?>" onchange="submit()" autocomplete="off" />
						</div>
						<div class="form-group col-lg-3" id="to_date">
							<label>Date To</label>
							<input name="date_calendar_to" id="date_calendar_to" type="text" class="form-control" value="<?=isset($datecalto) ? $datecalto : ''?>" onchange="submit()" autocomplete="off" />
						</div>
						<div class="form-group col-lg-3" id="to_date">
							<label>Name</label>
							<input name="staffname" id="staffname" type="text" class="form-control" value="<?=isset($staffname) ? $staffname : ''?>" onchange="submit()" autocomplete="off" />
						</div>
						<div class="form-group col-lg-3" id="to_date">
							<label>APSB NO</label>
							<input name="apsbno" id="apsbno" type="text" class="form-control" value="<?=isset($apsbno) ? $apsbno : ''?>" onchange="submit()" autocomplete="off" />
						</div>
					</form>
					<div class="table-responsive">
						<table class="table" id="no-more-tables">
							<thead>
								<tr bgcolor="#eee">
									<th>#</th>
									<th>Applicant Name</th>
									<th>Leave Type</th>
									<th>From</th>
									<th>To</th>
									<th>No of days</th>
									<th>Reason</th>
									<th>MC Image</th>
									<th>&nbsp;</th>
								</tr>
							</thead>
							<?php foreach ($datecalendar as $row): ?>
							<tbody>
								<tr>
									<td><?=($start+1)?></td>
									<td data-title="Applicant Name:"><?=isset($row->v_UserName) ? $row->v_UserName : ''?></td>
									<td data-title="Leave Type:"><?=isset($row->leave_name) ? $row->leave_name : ''?></td>
									<td data-title="From:"><?=isset($row->leave_from) ? date("d-m-Y", strtotime($row->leave_from)) : ''?></td>
									<td data-title="To:"><?=isset($row->leave_to) ? date("d-m-Y", strtotime($row->leave_to)) : ''?></td>
									<td data-title="No of days:"><?=isset($row->noleave) ? $row->noleave : '' ?></td>
									<td data-title="Reason:"><?=isset($row->leave_remarks) ? $row->leave_remarks : ''?></td>
									<td><?php if($row->leave_name=='Sick Leave'){ ?><a href="<?php echo base_url(); ?>sick_leave_img/<?=isset($row->file_name) ? $row->file_name : 'No_image_available.jpg'?>"  class="btn btn-info btn"><span class="glyphicon glyphicon-picture"></span> </a><?php }?></td>
									<!-- <td><?php if($row->leave_name=='Sick Leave'){ ?><a href="<?php echo base_url(); ?>sick_leave_img/<?=isset($row->file_name) ? $row->file_name : 'No_image_available.jpg'?>" data-fancybox class="btn btn-info btn"><span class="glyphicon glyphicon-picture"></span> </a><?php }?></td> -->
									<td><?= !(isset($row->leave_status)) ||  $row->leave_status == '' ? '<a href="'.base_url().'index.php/Controllers/print_out?id='.$row->id.'&userid='.$row->user_id.'&tab='.$this->input->get('tab').'" >Print</a>' : '' ?></td>
								</tr>
							</tbody>
							<?php $start++ ?>
							<?php endforeach; ?>
						</table>
						<ul class="pagination">
						<?php if ($rec[0]->jumlah > $limit){ ?>
							<li><a href="?tabIndex=1&p=1&date_calendar=<?=$datecal?>&date_calendar_to=<?=$datecalto?>&staffname=<?=$staffname?>&apsbno=<?=$apsbno?>"> <i class="fa fa-chevron-circle-left" style="color:green"></i> First Page </a></li>
							<li><a href="?tabIndex=1&p=<?=($this->input->get('p') > 1 ? $this->input->get('p')-1 : 1)?>&date_calendar=<?=$datecal?>&date_calendar_to=<?=$datecalto?>&staffname=<?=$staffname?>&apsbno=<?=$apsbno?>">Prev</a></li>
							<!-- <?php for ($i=1;$i<=$page;$i++){ ?>
							<li class="paginate_button">&nbsp;<a href="?tabIndex=1&p=<?php echo $i?>&date_calendar=<?=$datecal?>&date_calendar_to=<?=$datecalto?>"><?=$i?></a></li>
							<?php } ?> -->
							<li><a href=""><?=($this->input->get('p') ? $this->input->get('p') : 1)?></a></li>
							<li class="paginate_button previous"><a href="?tabIndex=1&p=<?php echo $page?>&date_calendar=<?=$datecal?>&date_calendar_to=<?=$datecalto?>&staffname=<?=$staffname?>&apsbno=<?=$apsbno?>">Next</a></li>
							<li><a href="?tabIndex=1&p=<?php echo ceil($rec[0]->jumlah/$limit);?>&date_calendar=<?=$datecal?>&date_calendar_to=<?=$datecalto?>&staffname=<?=$staffname?>&apsbno=<?=$apsbno?>"> Last Page <i class="fa fa-chevron-circle-right" style="color:red;"></i></a></li>
						<?php } ?>
						</ul>
						</div>
					</div>
					</div>

					<div id="taken_action" class="tabcontent <?=$taken_action;?>">
						<div class="table-responsive">
                			<?php echo $kal; ?>
 							 </div>
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

<!-- #modal Dialog -->
<div  id="myModal">
	<div class="sapik" id="responsecontainer"></div>
</div>

<script>
function tabs_navigation(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
  console.log(tablinks);
}
// Get the element with id="defaultOpen" and click on it
<?php if ($this->input->post('date_calendar')) { ?>
document.getElementById("tablinks").click();
console.log("testdate");

<?php } elseif($this->input->get('date_calendar')=='') {?>
document.getElementById("defaultOpen").click();console.log("test");
<?php }?>

function tengokcuti(status,date){
	//var james='ewqe';
	//alert(date);
    $.ajax({    //create an ajax request to display.php
        type: "GET",
        url: "<?=base_url();?>index.php/Controllers/cutidetails?date="+date+"&status="+status,
        dataType: "html",   //expect html to be returned
        success: function(response){
         $("#myModal").dialog();
		$('.ui-dialog').css('height', '50%');
		$('.ui-dialog').css('top', '285px');
		$('.ui-dialog-content').css('overflow', 'hidden');
		$('#ui-id-1').html(status+" "+date);
        // $("a.close-modal").css("top","1.5px");
        // $("a.close-modal").css("right","1.5px");
         $("#responsecontainer").html(response);
        }

    });
        }
</script>

