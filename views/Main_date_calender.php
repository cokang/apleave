<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Leave Calender</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>

	<!-- /.row -->
	<div class="row">

		<!-- /.col-lg-6 -->
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading"> </div>
				<!-- /.panel-heading -->
				<div class="panel-body">
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
							<tbody>
								<tr>
									<td data-title="Applicant Name:"><?=isset($row->v_UserName) ? $row->v_UserName : ''?></td>
									<td data-title="Leave Type:"><?=isset($row->leave_name) ? $row->leave_name : ''?></td>
									<td data-title="From:"><?=isset($row->leave_from) ? date("d-m-Y", strtotime($row->leave_from)) : ''?></td>
									<td data-title="To:"><?=isset($row->leave_to) ? date("d-m-Y", strtotime($row->leave_to)) : ''?></td>
									<td data-title="No of days:"><?=isset($row->noleave) ? $row->noleave : '' ?></td>
									<td data-title="Reason:"><?=isset($row->leave_remarks) ? $row->leave_remarks : ''?></td>
									<td><?= !(isset($row->leave_status)) ||  $row->leave_status == '' ? '<a href="'.base_url().'index.php/Controllers/print_out?id='.$row->id.'&userid='.$row->user_id.'&tab='.$this->input->get('tab').'" >Print</a>' : '' ?></td>
								</tr>
							</tbody>
							<?php endforeach; ?>
						</table>
						<ul class="pagination">
						<?php if ($rec[0]->jumlah > $limit){ ?>
							<?php for ($i=1;$i<=$page;$i++){ ?>
							<li class="paginate_button">&nbsp;<a href="?tabIndex=1&p=<?php echo $i?>&date_calendar=<?=$datecal?>&date_calendar_to=<?=$datecalto?>"><?=$i?></a></li>
							<?php } ?>
							<li class="paginate_button previous"><a href="?tabIndex=1&p=<?php echo $page?>&date_calendar=<?=$datecal?>&date_calendar_to=<?=$datecalto?>">Next</a></li>
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
