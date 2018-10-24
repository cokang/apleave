<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Unpaid Leave</h1>
		</div>
	<!-- /.col-lg-12 --> 
	</div>

	<div class="row"> 
		<!-- /.col-lg-6 -->
		<div class="col-lg-6" style="width:80%">
			<div class="panel panel-default">
				<div class="panel-heading"> 
					<form method="">
						<div class="input-group"style="width:40%">
							<input type="text" class="form-control" placeholder="Search by Name or Apsb No" value="<?php echo $this->input->get('sc')?>" name="sc"/>
							<div class="input-group-btn">
								<button class="btn btn-primary" type="submit">
									<span class="fa fa-search"></span>
								</button>
							</div>
						</div>
					</form>		  
				</div>

				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Applied Date</th>
									<th>Department</th>
									<th>Action</th>
								</tr>
							</thead>
							<?php  if (!empty($unprocess_listing)) {?>
								<?php foreach($unprocess_listing as $row): ?>
							<tbody>
								<tr class="">
									<td><?=($start+1)?></td>
									<td>
										<a href="<?=base_url('index.php/Controllers/print_out?id='.$row->leave_id)?>&parent=<?=$this->input->get('parent')?>" >
											<?=isset($row->v_UserName) ? $row->v_UserName : '' ?>
										</a>
									</td>
									<td><?=isset($row->leave_from) ? $row->leave_from : '' ?></td>
									<td><?=isset($row->v_GroupID) ? $row->v_GroupID : '' ?></td>                    
									<td>
										<input type="checkbox" name="process[]" onchange="process_leave('<?=$row->leave_id;?>',this)">
									</td>
								</tr>
								<?php $start++ ?>
								<?php endforeach; ?>
							<?php }else { ?>
								<tr align="center" style="background:white;">
									<td colspan="5"><span style="color:red;">NO RECORDS FOUND FOR THIS EMPLOYEE.</span></td>
								</tr>
							<?php } ?>
							</tbody>
						</table>


						<ul class="pagination">
							<?php if ($jumlah > $limit){ ?>						
								<?php if ($this->input->get('p') != ''){ ?>
							<li><a href="?p=1&sc=<?=$this->input->get('sc')?>"> <i class="fa fa-chevron-circle-left" style="color:green"></i> First Page </a></li>
							<li><a href="?p=<?=($this->input->get('p') > 1 ? $this->input->get('p')-1 : 1)?>&sc=<?=$this->input->get('sc')?>">Prev</a></li> 
								<?php } ?>
							<li><a href=""><?=($this->input->get('p') ? $this->input->get('p') : 1)?></a></li>
							<li class="paginate_button previous"><a href="?p=<?php echo $page?>&sc=<?=$this->input->get('sc')?>">Next</a></li>
							<li><a href="?p=<?php echo ceil($jumlah/$limit);?>&sc=<?=$this->input->get('sc')?>"> Last Page <i class="fa fa-chevron-circle-right" style="color:red;"></i></a></li>				
							<?php } ?>
						</ul>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>