<?php
class Mycal {
   public function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->model('display_model');
		$this->ci->load->library('ap_leave');
        //$this->ci->ap_leave->do_something();

    }

    public function kal($year=null,$month=null,$group){

   $conf = array(

            'start_day' => 'monday',
            'show_next_prev' => true,
            'day_type' => 'short',
            'next_prev_url' => base_url().'index.php/Controllers/date_calender/'

    );
   $conf['template'] = '

        {table_open}<table border="1" cellpadding="0" cellspacing="0" class="table table-striped table-bordered calendar">{/table_open}

        {heading_row_start}<tr>{/heading_row_start}

        {heading_previous_cell}<th><a href="{previous_url}"><i class="fa fa-chevron-left fa-2x"></i></a></th>{/heading_previous_cell}
            {heading_title_cell}<th class="text-center" colspan="{colspan}">{heading}</th>{/heading_title_cell}
            {heading_next_cell}<th class="text-right"><a href="{next_url}"><i class="fa fa-chevron-right fa-2x"></i></a></th>{/heading_next_cell}

        {heading_row_end}</tr>{/heading_row_end}

        {week_row_start}<tr text-align="center">{/week_row_start}
        {week_day_cell}<td>{week_day}</td>{/week_day_cell}
        {week_row_end}</tr>{/week_row_end}

        {cal_row_start}<tr>{/cal_row_start}
        {cal_cell_start_today}<td>{/cal_cell_start_today}
        {cal_cell_start_other}<td class="other-month">{/cal_cell_start_other}

        {cal_cell_content}
            <div class="day_num">{day}</div>
            <div class="content">{content}</div>
        {/cal_cell_content}

        {cal_cell_content_today}
        <div class="day_num highlight">{day}</div>
        <div class="content">{content}</div>
        {/cal_cell_content_today}

        {cal_cell_no_content}<div class="day_num">{day}</div>{/cal_cell_no_content}
        {cal_cell_no_content_today} <div class="day_num highlight">{day}
        {/cal_cell_no_content_today}

        {cal_cell_blank}&nbsp;{/cal_cell_blank}

        {cal_cell_other}{day}{/cal_cel_other}

        {cal_cell_end}</td>{/cal_cell_end}
        {cal_cell_end_today}</td>{/cal_cell_end_today}
        {cal_cell_end_other}</td>{/cal_cell_end_other}
        {cal_row_end}</tr>{/cal_row_end}

        {table_close}</table>{/table_close}
';
    $this->ci->load->library('calendar', $conf);
    $events = $this->get_events($year, $month,$group);
    $kal = $this->ci->calendar->generate($year, $month, $events);
    return $kal;

}

public function get_events($year, $month,$group) {
    $calendar = array();
    $kejadian = array();

/*     $cars = array(
     array('year'=>'2019', 'month'=>'2', 'day'=>'13','date'=>'2019-02-13','data'=>'Approved'),
     array('year'=>'2019', 'month'=>'2', 'day'=>'13','date'=>'2019-02-13','data'=>'Pending'),
     array('year'=>'2019', 'month'=>'2', 'day'=>'16','date'=>'2019-02-16','data'=>'Pending'),
     array('year'=>'2019', 'month'=>'2', 'day'=>'22','date'=>'2019-02-22','data'=>'Pending'),
     array('year'=>'2019', 'month'=>'3', 'day'=>'11','date'=>'2019-03-11','data'=>'Pending'),
     array('year'=>'2019', 'month'=>'3', 'day'=>'11','date'=>'2019-03-11','data'=>'Approved'),
     array('year'=>'2019', 'month'=>'3', 'day'=>'10','date'=>'2019-03-10','data'=>'Approved'),

); */

$get_result=$this->ci->display_model->get_cuti($year,$month,$group);

//$results = $cars;
$results = $get_result;

//$sabtuahad=array('JB'=>array(5,6));
foreach ($results as $event) {
  if (($event['month']==$month)&&($event['year']==$year)){

		$begin = strtotime($event['date']);
		$end   = strtotime($event['leave_to']);
		 while ($begin <= $end) {
		if (date("m",$begin) == $month){
		//echo date("d",$begin)."<br>";
		$nilai=$this->ci->ap_leave->semak_cuti($begin,$event['v_hospitalcode'],$event['yn'],$event['leave_type']);
		//exit();
			     if (array_key_exists($nilai,$calendar)) {
              if ($event['data']=="Approved"){
				if (!in_array("Approved", $calendar[$nilai]['status'])) {
				  //$varr="'".$event['data']."'".","."'".strtotime($year.'-'.$month.'-'.$nilai)."'";
				  $varr="'".$event['data']."'".","."'".$nilai.'-'.$month.'-'.$year."'";
			      $calendar[$nilai]['button'][] = '<div onclick="tengokcuti('.$varr.')" class="test day">'. $event['data'] . '<div>';
				  $calendar[$nilai]['status'][] = "Approved";
				}

		  }
           elseif ($event['data']=="Pending") {
			   if (!in_array("Pending", $calendar[$nilai]['status'])) {
			      //$varr="'".$event['data']."'".","."'".strtotime($year.'-'.$month.'-'.$nilai)."'";
			      $varr="'".$event['data']."'".","."'".$nilai.'-'.$month.'-'.$year."'";
			      $calendar[$nilai]['button'][] = '<div  onclick="tengokcuti('.$varr.')" class="test2 day">'. $event['data'] . '<div>';
				  $calendar[$nilai]['status'][] = "Pending";
			   }

		  }
}

else {
           if ($event['data']=="Approved"){
			        //$varr="'".$event['data']."'".","."'".strtotime($year.'-'.$month.'-'.$nilai)."'";
			        $varr="'".$event['data']."'".","."'".$nilai.'-'.$month.'-'.$year."'";
			   	    $calendar[$nilai]['button'][] ='<div class="test day2" onclick="tengokcuti('.$varr.')">' . $event['data'] . '</div>';
				    $calendar[$nilai]['status'][] = "Approved";
            }
           else if ($event['data']=="Pending"){
			      // $varr="'".$event['data']."'".","."'".strtotime($year.'-'.$month.'-'.$nilai)."'";
			       $varr="'".$event['data']."'".","."'".$nilai.'-'.$month.'-'.$year."'";
			   	   $calendar[$nilai]['button'][] = '<div class="test2 day2" onclick="tengokcuti('.$varr.')">' . $event['data'] . '</div>';
				   $calendar[$nilai]['status'][] = "Pending";
            }

		   }
		}
$begin += 86400;
}
  }

}// exit();
//sort($event['day']['button']);
foreach($calendar as $key=>$event['day']){
//echo $key."<br>";
$kejadian[$key] = implode(" ",$event['day']['button']);
}

    return $kejadian;
}



}
