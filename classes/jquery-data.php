<?php
	require_once('_db_info.php');
	require_once('_db_info_old.php');
?>	

<?php 
	function get_paging($page_clicked,$final_total_pages)
	{
?>
		<?php
			if($final_total_pages==1)
			{ 
		?>
			<a href="#" page-number='1' class="page active">1</a>
			<span>&nbsp;of&nbsp;</span>
			<a href="#" class="page" page-number='<?php echo $final_total_pages; ?>'>
				<?php
					echo $final_total_pages;	
				?>
			</a>
		<?php

			} 
			 else if($final_total_pages==2)
			{
				if($page_clicked==1)
				{
		?>
				<a href="#" page-number='1' class="page active">1</a>
				<a href="#" page-number='2' class="page">2</a>	
		<?php	
				}
				else if($page_clicked==2)
				{
		?>		
				<a href="#" page-number='1' class="page">1</a>
				<a href="#" page-number='2' class="page active">2</a>
		<?php
				}
		?>
				<span>&nbsp;of&nbsp;</span>
				<a href="#" class="page" page-number='<?php echo $final_total_pages; ?>'>
				<?php
					echo $final_total_pages;	
				?>
			</a>
		<?php		
			}
			else if($final_total_pages == 3)
			{
				if($page_clicked==1)
				{
		?>
				<a href="#" page-number='1' class="page active">1</a>
				<a href="#" page-number='2' class="page">2</a>	
				<a href="#" page-number='3' class="page">3</a>
		<?php	
				}
				else if($page_clicked==2)
				{
		?>		
				<a href="#" page-number='1' class="page">1</a>
				<a href="#" page-number='2' class="page active">2</a>
				<a href="#" page-number='3' class="page">3</a>
		<?php
				}
				else if($page_clicked==3)
				{
		?>		
				<a href="#" page-number='1' class="page">1</a>
				<a href="#" page-number='2' class="page">2</a>
				<a href="#" page-number='3' class="page active">3</a>
		<?php
				}
		?>
				<span>&nbsp;of&nbsp;</span>
				<a href="#" class="page" page-number='<?php echo $final_total_pages; ?>'>
				<?php
					echo $final_total_pages;	
				?>
			</a>
		<?php
			}
			else if($final_total_pages >= 4)
			{
			if($page_clicked==1)
			{
		?>
				<a href="#" page-number='1' class="page active">1</a>
				<a href="#" page-number='2' class="page">2</a>
				<a href="#" page-number='3' class="page">3</a>
				<a href='#' page-number='4' class="page">4</a>
		<?php		
			}
			else if($page_clicked==2)
			{
		?>		
				<a href="#" page-number='1' class="page">1</a>
				<a href="#" page-number='2' class="page active">2</a>
				<a href="#" page-number='3' class="page">3</a>
				<a href='#' page-number='4' class="page">4</a>
		<?php
			}
			else if($page_clicked==3)
			{
		?>
				<a href="#" page-number='1' class="page">1</a>
				<a href="#" page-number='2' class="page">2</a>
				<a href="#" page-number='3' class="page active">3</a>
				<a href='#' page-number='4' class="page">4</a>
		<?php		
			}
			else if($page_clicked >= 4)
			{
		?>
				<a href="#" page-number='1' class="page">First</a>
				<a href="#" page-number='<?php echo $page_clicked-1; ?>' class="page">Prev</a>
				<a href="#" page-number='<?php echo $page_clicked-2; ?>' class="page"><?php echo $page_clicked-2; ?></a>
				<a href='#' page-number='<?php echo $page_clicked-1; ?>' class="page"><?php echo $page_clicked-1; ?></a>
				<a href='#' page-number='<?php echo $page_clicked; ?>' class="page active"><?php echo $page_clicked; ?></a>
		<?php
				if($page_clicked!=$final_total_pages)
				{
		?>		
					<a href='#' page-number='<?php echo $page_clicked+1; ?>' class="page"><?php echo $page_clicked+1; ?></a>
		<?php		
				}	
			}		
		?>
		<span>&nbsp;of&nbsp;</span>
		<a href="#" class="page" page-number='<?php echo $final_total_pages; ?>'>
			<?php
				echo $final_total_pages;	
			?>
		</a>
		<?php
			if($page_clicked!=$final_total_pages)
			{
		?>
				<a href="#" class="page" page-number='<?php echo $page_clicked+1; ?>'>Next</a>
		<?php
			} 
		}
		?>
<?php
	}
?>
<?php 
	function get_paging_latest_reports($page_clicked,$final_total_pages)
	{
?>
		<?php
			if($final_total_pages==1)
			{ 
		?>
			<a href="#" page-number='1' class="page active">1</a>
			<span>&nbsp;of&nbsp;</span>
			<a href="#" class="page" page-number='<?php echo $final_total_pages; ?>'>
				<?php
					echo $final_total_pages;	
				?>
			</a>
		<?php

			} 
			 else if($final_total_pages==2)
			{
				if($page_clicked==1)
				{
		?>
				<a href="#" page-number='1' class="page active">1</a>
				<a href="#" page-number='2' class="page">2</a>	
		<?php	
				}
				else if($page_clicked==2)
				{
		?>		
				<a href="#" page-number='1' class="page">1</a>
				<a href="#" page-number='2' class="page active">2</a>
		<?php
				}
		?>
				<span>&nbsp;of&nbsp;</span>
				<a href="#" class="page" page-number='<?php echo $final_total_pages; ?>'>
				<?php
					echo $final_total_pages;	
				?>
			</a>
		<?php		
			}
			else if($final_total_pages >= 3)
			{
			if($page_clicked==1)
			{
		?>
				<a href="#" page-number='1' class="page active">1</a>
				<a href="#" page-number='2' class="page">2</a>
				<a href="#" page-number='3' class="page">3</a>
				
		<?php		
			}
			else if($page_clicked==2)
			{
		?>		
				<a href="#" page-number='1' class="page">1</a>
				<a href="#" page-number='2' class="page active">2</a>
				<a href="#" page-number='3' class="page">3</a>
				
		<?php
			}
			
			else if($page_clicked >= 3)
			{
		?>
				<a href="#" page-number='1' class="page">First</a>
				<!-- <a href="#" page-number='<?php //echo $page_clicked-2; ?>' class="page"><?php //echo $page_clicked-2; ?></a> -->
				<a href='#' page-number='<?php echo $page_clicked-1; ?>' class="page"><?php echo $page_clicked-1; ?></a>
				<a href='#' page-number='<?php echo $page_clicked; ?>' class="page active"><?php echo $page_clicked; ?></a>
		<?php
				if($page_clicked!=$final_total_pages)
				{
		?>		
					<a href='#' page-number='<?php echo $page_clicked+1; ?>' class="page"><?php echo $page_clicked+1; ?></a>
		<?php		
				}	
			}		
		?>
		<span>&nbsp;of&nbsp;</span>
		<a href="#" class="page" page-number='<?php echo $final_total_pages; ?>'>
			<?php
				echo $final_total_pages;	
			?>
		</a>
		<?php
			if($page_clicked!=$final_total_pages)
			{
		?>
				<a href="#" class="page" page-number='<?php echo $page_clicked+1; ?>'>Next</a>
		<?php
			} 
		}
		?>
<?php
	}
?>
<?php if(isset($_POST['fill_company']))
	{
	require_once ('_db_info.php');
	$result=mysqli_query($con,"select cid from `proxy_ad` ");
	echo "Hello";
}
function getmonth($month)
{
	switch($month)
	{
		case 'Jan': return '01';
					break;
		case 'Feb': return '02';
					break;
		case 'Mar': return '03';
					break;
		case 'Apr': return '04';
					break;
		case 'May': return '05';
					break;
		case 'Jun': return '06';
					break;
		case 'Jul': return '07';
					break;
		case 'Aug': return '08';
					break;
		case 'Sep': return '09';
					break;
		case 'Oct': return '10';
					break;
		case 'Nov': return '11';
					break;
		case 'Dec': return '12';
					break;			
	}
}
 function db_to_dis($date_db)
{
    $date_array = explode("-", $date_db);
    return $date_array[2]."-".$date_array[1]."-".$date_array[0];
}
if(isset($_GET['indexing']))
{
	$str = '';
	$str_cname='';
	$str_date='';
	$str_meet='';
	$cname=$_GET['c_name'];
	$dp1=$_GET['date1'];
	$dp2=$_GET['date2'];
	$mtype=$_GET['meetType'];
	$page_clicked = $_GET['PageClick'];
	$reports_per_page = $_GET['ReportsPerPage'];
	
	$toggle=$_GET['toggle_value'];

	date_default_timezone_set("Asia/Kolkata");
	//echo "$reports_per_page";
	if($page_clicked==1)
		$first_limit = 0;
	else
		$first_limit = $reports_per_page*($page_clicked-1);
	$second_limit = $reports_per_page;
	$query = "select * , `pa`.`id` as `proxyaddid`, `pa`.`notice_link`  from `companies` `c` INNER JOIN `proxy_ad` `pa` ON `c`.`com_id`=`pa`.`com_id` ";
	$query_result_count= "select count(*) from `companies` `c` INNER JOIN `proxy_ad` `pa` ON `c`.`com_id`=`pa`.`com_id` ";
	if($cname != '')
	{
		$str_cname = " `c`.`com_name` LIKE '%$cname%' ";
		$str = $str_cname;
	}
	if($dp1 != '' && $dp2 != '')
	{
		$m1=substr($dp1, -8, 3);
		$m2=substr($dp2, -8, 3);
		$mon1=getmonth($m1);
		$mon2=getmonth($m2);
		$y1=substr($dp1, -4,4);
		$y2=substr($dp2, -4,4);
		$d1=substr($dp1, -11,2);
		$d2=substr($dp2, -11,2);
		$date1=$d1.'-'.$mon1.'-'.$y1;
		$date2=$d2.'-'.$mon2.'-'.$y2;
		$t1=strtotime($date1);
		$t2=strtotime($date2);
		$str_date =" `pa`.`meeting_date` between '$t1' and '$t2' ";

		if($cname != '')
			$str =$str." AND ".$str_date;
		else
			$str =$str.$str_date;
	}
	if($mtype != '' && $mtype != '0')
	{
		// if($mtype == 1)
		// 	$str_meet = '';
		// else
			$str_meet =" `pa`.`meeting_type`='$mtype'";
		if($dp1 != '' && $dp2 != '' && $mtype != 1)
			$str=$str." AND ".$str_meet;
		else if($cname!= '' && $mtype != 1)
			$str = $str."AND".$str_meet;
		else
			$str =$str.$str_meet;
	}
	if($str != '')
	{
		$query= $query." where ".$str." and `pa`.`released_on` <> 0 ";
		$query_result_count = $query_result_count." where ".$str." and `pa`.`released_on` <> 0 ";
	}
	else
	{
		$query.= " where `pa`.`released_on` <> 0 ";
		$query_result_count = $query_result_count." where `pa`.`released_on` <> 0 ";
	}
	if($toggle == 1 || $toggle == 2)
	{
		if($toggle == 1)
		{
			$query.=" order by `c`.`com_name` asc LIMIT $first_limit, $second_limit";
		}
		if($toggle == 2)
		{
			$query.=" order by `c`.`com_name` desc LIMIT $first_limit, $second_limit";
		}
	}
	else if($toggle == 3 || $toggle == 4)
	{
		if($toggle == 3)
		{
			$query.=" order by `pa`.`meeting_date` asc LIMIT $first_limit, $second_limit";
		}
		if($toggle == 4)
		{
			$query.=" order by `pa`.`meeting_date` desc LIMIT $first_limit, $second_limit";
		}
	}
	$result=mysqli_query($con,$query);
	$result_count = mysqli_query($con,$query_result_count);
	$row_total_results = mysqli_fetch_array($result_count);
	$total_results = $row_total_results[0];
	$number_pages = floor ($total_results/$reports_per_page);
	if($total_results/$reports_per_page > $number_pages)
		$final_total_pages = $number_pages+1;
	else
		$final_total_pages=$number_pages;	

	if(mysqli_num_rows($result))
	{
?>
		<div class="table-padd">
			<label>Page : </label>
			<span class="td-set">
				<?php get_paging($page_clicked,$final_total_pages); ?>
			</span>
			<span style="float:right;">
				<label>Per Page:</label>
				<select id='reports_per_page'>
					<?php 
					     $arr = array(15,30,45,60,75,90);
					     foreach ($arr as $value) 
					     {
					      if($reports_per_page==$value)
					       echo "<option selected>$value</option>"; 
					      else
					       echo "<option>$value</option>"; 
					     }
				    ?>
				</select>
			</span>
		</div>
		<div id="data">
			<div class="table-responsive">
				<table class="table table-striped">
					<tr>
						<th>Company Name<span style='cursor:pointer;' id='sort_company'>&nbsp;&nbsp;<i class='fa fa-sort'></i></span></th>
						<th>Meeting Date<span style='cursor:pointer;' id='sort_date'>&nbsp;&nbsp;<i class='fa fa-sort'></i></span></th>
						<th>Meeting Type</th>
						<th>Notice</th>
						<th>Full Reports</th>
					</tr>
					<?php
						while ($row=mysqli_fetch_assoc($result)) 
						{
					?>
							<tr>
								<td><a style='color:#333 !important;' href="buy-reports.php?reportid=<?php echo $row['proxyaddid']; ?>"><?php echo "$row[com_name]"; ?></a></td>
								<td><?php echo date('d-M-y ', $row['meeting_date']); ?></td>
								<?php 
									$meet_arr = array(
										1 => 'AGM',
										2 => 'EGM',
										3 => 'Postal Ballot',
										4 => 'CCM',
										5 => 'Other'
										);
									foreach ($meet_arr as $key => $value) {
										if($row['meeting_type']== $key)
											$meet = $value;
									}
								?>
								<td><?php echo $meet; ?></td>
								<td><a class='' target='_blank' href='<?php echo $row['notice_link']; ?>'>Read Notice</a></td>
								<td><a class="bcolor" href='buy-reports.php?reportid=<?php echo $row['proxyaddid']; ?>'>Purchase</a></td>
							</tr>
					<?php
						}
					?>
				</table>
			</div>
		</div>
		<div>
			<label>Page : </label>
			<span class="td-set">
				<?php get_paging($page_clicked,$final_total_pages); ?>
			</span>
		</div>
<?php
	}
}

if(isset($_GET['coverage_indexing']))
{
	require_once('_db_info_old.php');
	$year=date("Y");
	//echo $year;
	$date='31'.'-'.'3'.'-'.$year;
	//echo $date;
	$meet_date=strtotime($date);
	$str = '';
	$str_cname='';
	$str_date='';
	$str_meet='';
	$cname=$_GET['c_name'];
	$dp1=$_GET['date1'];
	$dp2=$_GET['date2'];
	$mtype=$_GET['meetType'];
	$toggle=$_GET['toggle_value'];
	$page_clicked = $_GET['PageClick'];
	$reports_per_page = $_GET['ReportsPerPage'];
	date_default_timezone_set("Asia/Kolkata");
	if($page_clicked==1)
		$first_limit = 0;
	else
		$first_limit = $reports_per_page*($page_clicked-1);
	$second_limit = $reports_per_page;
	$year=date("Y");
	//echo $year;
	$date=$year.'-03-31';
	$meet_date=$date;
	$query = "select `company_name`,`meeting_type`,`meeting_date`,`file_upload` from `tbladvisory`  where `meeting_date` <= '$meet_date' ";
	$query_result_count= "select count(*) from `tbladvisory` where `meeting_date` <= '$meet_date' ";
	if($cname != '')
	{
		$str_cname = "and `company_name` LIKE '%$cname%' ";
		$str = $str_cname;
	}
	if($dp1 != '' && $dp2 != '')
	{
		$m1=substr($dp1, -8, 3);
		$m2=substr($dp2, -8, 3);
		$mon1=getmonth($m1);
		$mon2=getmonth($m2);
		$y1=substr($dp1, -4,4);
		$y2=substr($dp2, -4,4);
		$d1=substr($dp1, -11,2);
		$d2=substr($dp2, -11,2);
		$date1=$y1.'-'.$mon1.'-'.$d1;
		$date2=$y2.'-'.$mon2.'-'.$d2;
		$str_date ="and `meeting_date` between '$date1' and '$date2' ";
		if($cname != '')
			$str =$str.$str_date;
		else
			$str =$str.$str_date;
	}
	if($mtype != '' && $mtype != '0')
	{
		$str_meet ="and `meeting_type`='$mtype'";
		if($dp1 != '' && $dp2 != '' && $mtype != 1)
			$str=$str.$str_meet;
		else if($cname!= '' && $mtype != 1)
			$str = $str.$str_meet;
		else
			$str =$str.$str_meet;
	}
	if($str != '')
	{
		$query= $query.$str;
		$query_result_count = $query_result_count.$str;
	}
	else
	{
		$query= $query;
		$query_result_count = $query_result_count;
	}
	if($toggle == 1 || $toggle == 2)
	{
		if($toggle == 1)
		{
			$query.=" order by `company_name` asc LIMIT $first_limit, $second_limit";
		}
		if($toggle == 2)
		{
			$query.=" order by `company_name` desc LIMIT $first_limit, $second_limit";
		}
	}
	else if($toggle == 3 || $toggle == 4)
	{
		if($toggle == 3)
		{
			$query.=" order by `meeting_date` asc LIMIT $first_limit, $second_limit";
		}
		if($toggle == 4)
		{
			$query.=" order by `meeting_date` desc LIMIT $first_limit, $second_limit";
		}
	}
	//echo $query_result_count;
	$result=mysqli_query($con_old,$query);
	$result_count = mysqli_query($con_old,$query_result_count);
	$row_total_results = mysqli_fetch_array($result_count);
	$total_results = $row_total_results[0];
	$number_pages = floor ($total_results/$reports_per_page);
	if($total_results/$reports_per_page > $number_pages)
		$final_total_pages = $number_pages+1;
	else
		$final_total_pages=$number_pages;
	//echo $final_total_pages;	
	if(mysqli_num_rows($result))
	{
?>
	<div class="table-padd">
		<label>Page : </label>
		<span class="td-set">
			<?php get_paging($page_clicked,$final_total_pages); ?>
		</span>
		<span style="float:right;">
			<label>Per Page:</label>
			<select id='reports_per_page'>
				<?php 
				     $arr = array(15,30,45,60,75,90);
				     foreach ($arr as $value) 
				     {
				      if($reports_per_page==$value)
				       echo "<option selected>$value</option>"; 
				      else
				       echo "<option>$value</option>"; 
				     }
			    ?>
			</select>
		</span>
	</div>
	<div id="data">
		<div class="table-responsive">
			<table class="table table-striped">
				<tr>
					<th>Company Name<span style='cursor:pointer;' id='sort_company'>&nbsp;&nbsp;<i class='fa fa-sort'></i></span></th>
					<th>Meeting Date<span style='cursor:pointer;' id='sort_date'>&nbsp;&nbsp;<i class='fa fa-sort'></i></span></th>
					<th>Meeting Type</th>
					<th>Full Reports</th>
				</tr>
				<?php
					while ($row=mysqli_fetch_assoc($result)) 
					{
				?>
						<tr>
							<td><a href="#" style="color:#333"><?php echo "$row[company_name]"; ?></a></td>
							<td><?php echo db_to_dis($row['meeting_date']); ?></td>
							<td><?php echo $row['meeting_type']; ?></td>
							<td><a target="_blank" class="bcolor" href='../admin/images_store/<?php echo $row['file_upload']; ?>'>View Report</a></td>
						</tr>
				<?php
					}
				?>
			</table>
		</div>
	</div>
	<div>
		<label>Page : </label>
		<span class="td-set">
			<?php get_paging($page_clicked,$final_total_pages); ?>
		</span>
	</div>
<?php
	}
} 
else if(isset($_GET['indexing_latest_reports']))
{
	$page_clicked = $_GET['PageClick'];

	$toggle=$_GET['toggle_value'];
	
	if($page_clicked==1)
		$first_limit = 0;
	else
		$first_limit = 10*($page_clicked-1);

	$second_limit = 10;
	$query ="select `c`.`com_name`, `pa`.`meeting_date` ,`pa`.`meeting_type`, `pa`.`id` as `proxyaddid` from `companies` `c` INNER JOIN `proxy_ad` `pa` ON `c`.`com_id`=`pa`.`com_id` where `pa`.`released_on` <> 0 ";
	if($toggle == 1 || $toggle == 2)
	{
		if($toggle == 1)
		{
			$query.=" order by `c`.`com_name` asc LIMIT $first_limit, $second_limit";
		}
		if($toggle == 2)
		{
			$query.=" order by `c`.`com_name` desc LIMIT $first_limit, $second_limit";
		}
	}
	else if($toggle == 3 || $toggle == 4)
	{
		if($toggle == 3)
		{
			$query.=" order by `pa`.`meeting_date` asc LIMIT $first_limit, $second_limit";
		}
		if($toggle == 4)
		{
			$query.=" order by `pa`.`meeting_date` desc LIMIT $first_limit, $second_limit";
		}
	}
	$result=mysqli_query($con,$query);
	$result_count = mysqli_query($con,"select count(*) from `proxy_ad` where `proxy_ad`.`released_on` <> 0");
	$row_total_results = mysqli_fetch_array($result_count);
	$total_results = $row_total_results[0];
	$number_pages = floor ($total_results/10);
	if($total_results/10 > $number_pages)
		$final_total_pages = $number_pages+1;
	else
		$final_total_pages=$number_pages;	
	//echo $first_limit;
	//echo $second_limit;
?>
	<div class="table-padd" style="margin-bottom: 15px;margin-top: 20px;">
		<label>Page : </label>
		<span class="td-call">
			<?php get_paging_latest_reports($page_clicked,$final_total_pages); ?>
		</span>
	</div>
	<div id="data" style="padding-right:28px;">
		<div class="table-responsive">
			<table class="table table-striped">
				<tr>
					<th>Company Name<span style='cursor:pointer;' id='sort_company1'>&nbsp;&nbsp;<i class='fa fa-sort'></i></span></th>
					<th>Meeting Date<span style='cursor:pointer;' id='sort_date1'>&nbsp;&nbsp;<i class='fa fa-sort'></i></span></th>
					<th>Meeting Type</th>
					
				</tr>
				<?php
					while ($row=mysqli_fetch_assoc($result)) 
					{
				?>
						<tr>
							<td><a style="color:#333 !important;" href="buy-reports.php?reportid=<?php echo $row['proxyaddid']; ?>"><?php echo "$row[com_name]"; ?></a></td>
							<td><?php echo date('d-M-y', $row['meeting_date']); ?></td>
							<?php 
								$meet_arr = array(
									1 => 'AGM',
									2 => 'EGM',
									3 => 'Postal Ballot',
									4 => 'CCM',
									5 => 'Other'
									);
								foreach ($meet_arr as $key => $value) {
									if($row['meeting_type']== $key)
										$meet = $value;
								}
							?>
							<td><?php echo $meet; ?></td>
						</tr>
				<?php
					}
				?>
			</table>
		</div>
	</div>
	
<?php	
}
else if(isset($_GET['govern_index']))
{
	require_once ('_db_info.php');
	$bse_code = $_GET['bse'];
	$com_name = $_GET['com_name'];
	$dp1 = $_GET['date1'];
	$dp2 = $_GET['date2'];
	$page_clicked = $_GET['PageClick'];
	$reports_per_page = $_GET['ReportsPerPage'];
	$toggle=$_GET['toggle_value'];
	date_default_timezone_set("Asia/Kolkata");
	//echo "$reports_per_page";
	if($page_clicked==1)
		$first_limit = 0;
	else
		$first_limit = $reports_per_page*($page_clicked-1);
	$second_limit = $reports_per_page;
	$query ="select `c`.`com_name`, `c`.`com_bse_code`,`cgs`.`publishing_date`,`cgs`.`sector` from `companies` `c` INNER JOIN `cgs` ON `c`.`com_id`=`cgs`.`com_id` ";
	//$query = "select * , `pa`.`id` , `pa`.`notice_link` as `proxyaddid` from `companies` `c` INNER JOIN `proxy_ad` `pa` ON `c`.`com_id`=`pa`.`com_id` ";
	$query_result_count= "select count(*) from `companies` `c` INNER JOIN `cgs` ON `c`.`com_id`=`cgs`.`com_id` ";
	$check_array = array();
	if($bse_code != '')
	{
		$str_bse = " `c`.`com_bse_code` LIKE '%$bse_code%' ";
		$check_array[] = $str_bse;
	}
	if($com_name !='')
	{
		$str_com_name = " `c`.`com_name` LIKE '%$com_name%' ";
		$check_array[] = $str_com_name;
	}
	if($dp1 != '' && $dp2 != '')
	{
		$m1=substr($dp1, -8, 3);
		$m2=substr($dp2, -8, 3);
		$mon1=getmonth($m1);
		$mon2=getmonth($m2);
		$y1=substr($dp1, -4,4);
		$y2=substr($dp2, -4,4);
		$d1=substr($dp1, -11,2);
		$d2=substr($dp2, -11,2);
		$date1=$d1.'-'.$mon1.'-'.$y1;
		$date2=$d2.'-'.$mon2.'-'.$y2;
		$t1=strtotime($date1);
		$t2=strtotime($date2);
		$str_date =" `cgs`.`publishing_date` between '$t1' and '$t2' ";
		$check_array[]=$str_date;
	}
	if(count($check_array)>0)
	{
		$final_checked_string = implode(" AND ", $check_array);
		$query= $query." where ".$final_checked_string;
		$query_result_count = $query_result_count." where ".$final_checked_string;
	}
	else
	{
		$query = $query;
		$query_result_count = $query_result_count;
	}
	if($toggle == 1 || $toggle == 2)
	{
		if($toggle == 1)
		{
			$query.=" order by `c`.`com_name` asc LIMIT $first_limit, $second_limit";
		}
		if($toggle == 2)
		{
			$query.=" order by `c`.`com_name` desc LIMIT $first_limit, $second_limit";
		}
	}
	else if($toggle == 3 || $toggle == 4)
	{
		if($toggle == 3)
		{
			$query.=" order by `cgs`.`publishing_date` asc LIMIT $first_limit, $second_limit";
		}
		if($toggle == 4)
		{
			$query.=" order by `cgs`.`publishing_date` desc LIMIT $first_limit, $second_limit";
		}
	}
	//echo $query_result_count;
	$result=mysqli_query($con,$query);
	$result_count = mysqli_query($con,$query_result_count);
	$row_total_results = mysqli_fetch_array($result_count);
	$total_results = $row_total_results[0];
	$number_pages = floor ($total_results/$reports_per_page);
	//echo $total_results;
	//echo ($total_results/$reports_per_page);
	if($total_results/$reports_per_page > $number_pages)
		$final_total_pages = $number_pages+1;
	else
		$final_total_pages=$number_pages;	
	//echo $final_total_pages;
	if(mysqli_num_rows($result))
	{
?>
		<div class="table-padd">
			<label>Page : </label>
			<span class="td-set">
				<a href="#" page-number='1' class="page active">1</a>
				<?php 
					if($final_total_pages>=2)
						echo "<a href='#'' page-number='2' class='page'>2</a>";
					if($final_total_pages>=3)
						echo "<a href='#'' page-number='3' class='page'>3</a>";
					if($final_total_pages>=4)
						echo "<a href='#'' page-number='4' class='page'>4</a>";
				?>
				<span>&nbsp;of&nbsp;</span>
				<a href="#" page-number='<?php echo $final_total_pages; ?>' class="page">
					<?php
						echo $final_total_pages;
					?>
				</a>
				<a href="#" class="page" page-number='2'>Next</a>
			</span>
			<span style="float:right;"><label>Per Page:</label>
				<select id='reports_per_page'>
					<option>15</option>
					<option>30</option>
					<option>45</option>
					<option>60</option>
					<option>75</option>
					<option>90</option>
				</select>
			</span>
		</div>
		<div id="data">
			<div class="table-responsive">
				<table class="table table-striped">
					<tr>
						<th>Company Name<span style='cursor:pointer;' id='sort_index_company'>&nbsp;&nbsp;<i class='fa fa-sort'></i></span></th>
						<th>BSE Code</th>
						<th>Sector</th>
						<th>Publishing Date<span style='cursor:pointer;' id='sort_index_date'>&nbsp;&nbsp;<i class='fa fa-sort'></i></span></th>
						<th>Full Reports</th>
					</tr>
					<?php
						while ($row=mysqli_fetch_assoc($result)) 
						{
					?>
							<tr>
								<td><a href="#"><?php echo "$row[com_name]"; ?></a></td>
								<td><?php echo $row['com_bse_code']; ?></td>
								<td><?php echo $row['sector']; ?></td>
								<td><?php echo date('d-M-y', $row['publishing_date']); ?></td>
								<td><button class="bcolor">Purchase</button></td>
							</tr>
					<?php
						}
					?>
				</table>
			</div>
		</div>
		<div>
			<label>Page : </label>
			<span class="td-set">
				<a href="#" page-number='1' class="page active">1</a>
				<?php 
					if($final_total_pages>=2)
						echo "<a href='#'' page-number='2' class='page'>2</a>";
					if($final_total_pages>=3)
						echo "<a href='#'' page-number='3' class='page'>3</a>";
					if($final_total_pages>=4)
						echo "<a href='#'' page-number='4' class='page'>4</a>";
				?>
				<span>&nbsp;of&nbsp;</span>
				<a href="#" page-number='<?php echo $final_total_pages; ?>' class="page">
					<?php
						echo $final_total_pages;
					?>
				</a>
				<a href="#" class="page" page-number='2'>Next</a>
			</span>
			
		</div>
<?php
	}

}
else if(isset($_GET['get_company_filter']))
{
	require_once ('_db_info.php');
	$cname=$_GET['c_name'];
	$page_clicked = $_GET['PageClick'];
	$reports_per_page = $_GET['ReportsPerPage'];
	//echo "$reports_per_page";
	if($page_clicked==1)
		$first_limit = 0;
	else
		$first_limit = $reports_per_page*($page_clicked-1)+1;
	$second_limit = $reports_per_page;
	date_default_timezone_set("Asia/Kolkata");
	$result=mysqli_query($con,"select * from `companies` where `com_name` LIKE '%$cname%' LIMIT $first_limit,$second_limit ");
	$result_count = mysqli_query($con,"select count(*) from `companies` where `com_name` LIKE '%$cname%' ");
	$row_total_results = mysqli_fetch_array($result_count);
	$total_results = $row_total_results[0];
	$number_pages = floor ($total_results/$reports_per_page);
	if($total_results/$reports_per_page > $number_pages)
		$final_total_pages = $number_pages+1;
	else
		$final_total_pages=$number_pages; ?>
	<div class='table-padd'>
		<label>Page : </label>
		<span class='td-set'>
			<?php	     get_paging($page_clicked,$final_total_pages);  ?>
		</span>
		<span style='float:right;'>
			<label>Per Page:</label>
			<select id='reports_per_page'>
			<?php
			    $arr = array(15,30,45,60,75,90);
			    foreach ($arr as $value) 
			    {
				     if($reports_per_page==$value)
				   	 	echo '<option selected>'.$value.'</option>'; 
				  	 else
				   		echo '<option>'.$value.'</option>'; 
				}
			?>	
			</select>
		</span>
	</div>
	<div id='data'>
	<div class='table-responsive'>
			<table class='table table-striped'>
				<tr>
					<th>Company Name</th>
					<th>Meeting Date</th>
					<th>Meeting Type</th>
					<th>Notice</th>
					<th>Full Reports</th>
				</tr>
	<?php			
					while ($row=mysqli_fetch_assoc($result)) {
					$result1=mysqli_query($con,"select * from `proxy_ad` where `com_id`= '$row[com_id]'");
					$row1=mysqli_fetch_assoc($result1);
				
				echo "<tr>
						<td><a href='#'>$row[com_name]</a></td>
						<td>".date('d-M-y', $row1['meeting_date'])."</td>
						<td>$row1[meeting_type]</td>
						<td></td>
						<td><button class='bcolor'>Purchase</button></td>
					  </tr>";
				
			}
			
		echo "</table>";
}
else if(isset($_GET['indexing_filter']))
{
	$page_clicked = $_GET['PageClick'];
	$reports_per_page = $_GET['ReportsPerPage'];
	$mtype=$_GET['meetType'];
	//echo "$reports_per_page";
	if($page_clicked==1)
		$first_limit = 0;
	else
		$first_limit = $reports_per_page*($page_clicked-1)+1;
	$second_limit = $reports_per_page;
	$query = "select `c`.`com_name`, `pa`.`meeting_date` ,`pa`.`meeting_type` from `companies` `c` INNER JOIN `proxy_ad` `pa` ON `c`.`com_id`=`pa`.`com_id` where `meeting_type`='$mtype' order by `c`.`com_id` LIMIT $first_limit , $second_limit";
	$result=mysqli_query($con,$query);
	$result_count = mysqli_query($con,"select count(*) from `proxy_ad` where `meeting_type`='$mtype'");
	$row_total_results = mysqli_fetch_array($result_count);
	$total_results = $row_total_results[0];
	$number_pages = floor ($total_results/$reports_per_page);
	if($total_results/$reports_per_page > $number_pages)
		$final_total_pages = $number_pages+1;
	else
		$final_total_pages=$number_pages;	
?>
	<div class="table-padd">
		<label>Page : </label>
		<span class="td-set">
			<?php get_paging($page_clicked,$final_total_pages); ?>
		</span>
		<span style="float:right;">
			<label>Per Page:</label>
			<select id='reports_per_page'>
				<?php 
				     $arr = array(15,30,45,60,75,90);
				     foreach ($arr as $value) 
				     {
				      if($reports_per_page==$value)
				       echo "<option selected>$value</option>"; 
				      else
				       echo "<option>$value</option>"; 
				     }
			    ?>
			</select>
		</span>
	</div>
	<div id="data">
		<div class="table-responsive">
			<table class="table table-striped">
				<tr>
					<th>Company Name</th>
					<th>Meeting Date</th>
					<th>Meeting Type</th>
					<th>Notice</th>
					<th>Full Reports</th>
				</tr>
				<?php
					while ($row=mysqli_fetch_assoc($result)) 
					{
				?>
						<tr>
							<td><a href="#"><?php echo "$row[com_name]"; ?></a></td>
							<td><?php echo date('d-M-y', $row['meeting_date']); ?></td>
							<td><?php echo "$row[meeting_type]"; ?></td>
							<td></td>
							<td><button class="bcolor">Purchase</button></td>
						</tr>
				<?php
					}
				?>
			</table>
		</div>
	</div>
	<div>
		<label>Page : </label>
		<span class="td-set">
			<?php get_paging($page_clicked,$final_total_pages); ?>
		</span>
		<span style="float:right"><a href="#">Archieved Reports</a></span>
	</div>
<?php
}
else if(isset($_GET['get_research_reports']))
{
	//echo "Hello";
	$query='';
	$query_result_count='';
	$tag_search=$_GET['tag_name'];
	$page_clicked=$_GET['PageClick'];
	if($page_clicked==1)
		$first_limit = 0;
	else
		$first_limit = 6*($page_clicked-1);
	$second_limit=6;
	if($tag_search != '' && $tag_search != 'All')
	{
		$query="select * from `govern_research` where `tags` like '%$tag_search%' LIMIT $first_limit,$second_limit";
		$query_result_count="select count(*) from `govern_research` where `tags`='$tag_search'";
	}
	else
	{
		$query="select * from `govern_research` order by `id` desc LIMIT $first_limit,$second_limit ";
		$query_result_count="select count(*) from `govern_research` order by `id` desc ";
	}
	//echo $query;
	//echo $tag_search;
	$result=mysqli_query($con,$query);
	$result_count = mysqli_query($con,$query_result_count);
	$row_total_results = mysqli_fetch_array($result_count);
	$total_results = $row_total_results[0];
	$number_pages = floor ($total_results/6);
	if($total_results/6 > $number_pages)
		$final_total_pages = $number_pages+1;
	else
		$final_total_pages=$number_pages;	
	//echo $final_total_pages;
	?>
	<div class="table-padd">
		<label>Page : </label>
		<span class="td-set">
			<?php get_paging($page_clicked,$final_total_pages); ?>
		</span>
	</div>
<?php
	$i=1;
    $num_rows = mysqli_num_rows($result);

	while($row=mysqli_fetch_assoc($result))
    {
    	$desc = substr($row['description'], 0,102); 
        if($i%2==1)
        {
            echo "<div class='row'>";
        }
        $pdf_link=$row['pdf_link'];
        echo "<div class='col-md-6' style='margin-bottom: 15px;'>
        <h4>$row[report_name]</h4>
        <p>$desc...</p>
        <div>
            <div style='float:left'><a class='bcolor' href='$pdf_link' target='blank'>View as PDF</a></div>
        </div>
        </div>";
        if($i%2==0)
        {
            echo "</div>";
        }
        $i++;
    }
    if($num_rows%2!=0)
    {
        echo "</div>";
    }
}
else if(isset($_GET['get_ses_news']))
{
	//echo "Hello";
	$query='';
	$query_result_count='';
	$tag_search=$_GET['tag_name'];
	$page_clicked=$_GET['PageClick'];
	if($page_clicked==1)
		$first_limit = 0;
	else
		$first_limit = 6*($page_clicked-1);
	$second_limit=6;
	if($tag_search != '' && $tag_search != 'All')
	{
		$query="select * from `web_ses_news` where `tags` like '%$tag_search%' order by `date` desc LIMIT $first_limit,$second_limit";
		$query_result_count="select count(*) from `web_ses_news` where `tags` like '%$tag_search%'";
	}
	else
	{
		$query="select * from `web_ses_news` order by `date` desc LIMIT $first_limit,$second_limit ";
		$query_result_count="select count(*) from `web_ses_news` order by `id` desc ";
	}
	//echo $query;
	//echo $tag_search;
	$result=mysqli_query($con,$query);
	$result_count = mysqli_query($con,$query_result_count);
	$row_total_results = mysqli_fetch_array($result_count);
	$total_results = $row_total_results[0];
	$number_pages = floor ($total_results/6);
	if($total_results/6 > $number_pages)
		$final_total_pages = $number_pages+1;
	else
		$final_total_pages=$number_pages;	
	//echo $final_total_pages;
	?>
	<div class="table-padd">
		<label>Page : </label>
		<span class="td-set">
			<?php get_paging($page_clicked,$final_total_pages); ?>
		</span>
	</div>
<?php
	$i=1;
    $num_rows = mysqli_num_rows($result);

	while($row=mysqli_fetch_assoc($result))
    {
    	$dp1=$row['date'];
        //echo $row['date'];
        $m1=substr($dp1, -5, 2);
		$mon1=getmonth1($m1);
		$y1=substr($dp1, -10,4);
		$d1=substr($dp1, -2,2);
        if($i%3==1)
        {
            echo "<div class='row' style='margin-top:20px;'>";
        }
        echo "<div class='col-md-4  '>
        <div class='date-set'>
			<span class='day-set'> $d1 </span>
			<span class='month-year-set'>$mon1, $y1</span>
		</div>
		<h4>".substr($row['heading'], 0,30)."...</h4>
		<p>".substr($row['description'], 0,100).".... </p>
		<div>
			<div style='float:left'><a target='_blank' href='$row[links]' class='bcolor'>Read More</a></div>
		</div>
		</div>";
        if($i%3==0)
        {
            echo '</div>';
        }
        $i++;
    }
    if($num_rows%3!=0)
    {
        echo '</div>';
    }
}
elseif (isset($_GET['sort_company_name']))
{
	require_once ('_db_info.php');
	$order = $_GET['order'];
	$str = '';
	$str_cname='';
	$str_date='';
	$str_meet='';
	$cname=$_GET['c_name'];
	$dp1=$_GET['date1'];
	$dp2=$_GET['date2'];
	$mtype=$_GET['meetType'];
	$page_clicked = $_GET['PageClick'];
	if($page_clicked=='')
		$page_clicked=1;
	$reports_per_page = $_GET['ReportsPerPage'];
	date_default_timezone_set("Asia/Kolkata");
	//echo "$reports_per_page";
	if($page_clicked==1)
		$first_limit = 0;
	else
		$first_limit = $reports_per_page*($page_clicked-1);
	$second_limit = $reports_per_page;
	$query = "select * , `pa`.`id` , `pa`.`notice_link` as `proxyaddid` from `companies` `c` INNER JOIN `proxy_ad` `pa` ON `c`.`com_id`=`pa`.`com_id` ";
	$query_result_count= "select count(*) from `companies` `c` INNER JOIN `proxy_ad` `pa` ON `c`.`com_id`=`pa`.`com_id` ";
	if($cname != '')
	{
		$str_cname = " `c`.`com_name` LIKE '%$cname%' ";
		$str = $str_cname;
	}
	if($dp1 != '' && $dp2 != '')
	{
		$m1=substr($dp1, -8, 3);
		$m2=substr($dp2, -8, 3);
		$mon1=getmonth($m1);
		$mon2=getmonth($m2);
		$y1=substr($dp1, -4,4);
		$y2=substr($dp2, -4,4);
		$d1=substr($dp1, -11,2);
		$d2=substr($dp2, -11,2);
		$date1=$d1.'-'.$mon1.'-'.$y1;
		$date2=$d2.'-'.$mon2.'-'.$y2;
		$t1=strtotime($date1);
		$t2=strtotime($date2);
		$str_date =" `pa`.`meeting_date` between '$t1' and '$t2' ";

		if($cname != '')
			$str =$str." AND ".$str_date;
		else
			$str =$str.$str_date;
	}
	if($mtype != '' && $mtype != '0')
	{
		if($mtype == 1)
			$str_meet = '';
		else
			$str_meet =" `pa`.`meeting_type`='$mtype'";
		if($dp1 != '' && $dp2 != '' && $mtype != 1)
			$str=$str." AND ".$str_meet;
		else if($cname!= '' && $mtype != 1)
			$str = $str."AND".$str_meet;
		else
			$str =$str.$str_meet;
	}
	if($str != '')
	{
		$query= $query." where ".$str." and `pa`.`released_on` <> 0 ";
		$query_result_count = $query_result_count." where ".$str." and `pa`.`released_on` <> 0 ";
	}
	else
	{
		$query.= " where `pa`.`released_on` <> 0 ";
		$query_result_count = $query_result_count." where `pa`.`released_on` <> 0 ";
	}
	if($order == "asc")
	{
		$query.=" order by `c`.`com_name` asc LIMIT $first_limit, $second_limit";
	}
	if($order == "desc")
	{
		$query.=" order by `c`.`com_name` desc LIMIT $first_limit, $second_limit";
	}
	$result=mysqli_query($con,$query);
	$result_count = mysqli_query($con,$query_result_count);
	$row_total_results = mysqli_fetch_array($result_count);
	$total_results = $row_total_results[0];
	$number_pages = floor ($total_results/$reports_per_page);
	if($total_results/$reports_per_page > $number_pages)
		$final_total_pages = $number_pages+1;
	else
		$final_total_pages=$number_pages;	

	if(mysqli_num_rows($result))
	{
?>
		<div class="table-padd">
			<label>Page : </label>
			<span class="td-set">
				<?php get_paging($page_clicked,$final_total_pages); ?>
			</span>
			<span style="float:right;">
				<label>Per Page:</label>
				<select id='reports_per_page'>
					<?php 
					     $arr = array(15,30,45,60,75,90);
					     foreach ($arr as $value) 
					     {
					      if($reports_per_page==$value)
					       echo "<option selected>$value</option>"; 
					      else
					       echo "<option>$value</option>"; 
					     }
				    ?>
				</select>
			</span>
		</div>
		<div id="data">
			<div class="table-responsive">
				<table class="table table-striped">
					<tr>
						<th>Company Name<span style='cursor:pointer;' id='sort_company'>&nbsp;&nbsp;<i class='fa fa-sort'></i></span></th>
						<th>Meeting Date<span style='cursor:pointer;' id='sort_date'>&nbsp;&nbsp;<i class='fa fa-sort'></i></span></th>
						<th>Meeting Type</th>
						<th>Notice</th>
						<th>Full Reports</th>
					</tr>
					<?php
						while ($row=mysqli_fetch_assoc($result)) 
						{
					?>
							<tr>
								<td><a href="#"><?php echo "$row[com_name]"; ?></a></td>
								<td><?php echo date('d-M-y ', $row['meeting_date']); ?></td>
								<?php 
									$meet_arr = array(
										1 => 'AGM',
										2 => 'EGM',
										3 => 'Postal Ballot',
										4 => 'CCM',
										5 => 'Other'
										);
									foreach ($meet_arr as $key => $value) {
										if($row['meeting_type']== $key)
											$meet = $value;
									}
								?>
								<td><?php echo $meet; ?></td>
								<td><a class='' target='_blank' href='<?php echo $row['notice_link']; ?>'>Read Notice</a></td>
								<td><a class="bcolor" href='buy-reports.php?reportid=<?php echo $row['proxyaddid']; ?>'>Purchase</a></td>
							</tr>
					<?php
						}
					?>
				</table>
			</div>
		</div>
		<div>
			<label>Page : </label>
			<span class="td-set">
				<?php get_paging($page_clicked,$final_total_pages); ?>
			</span>
		</div>
<?php
	}
}
else if(isset($_GET['get_block1']))
{
	echo "<div class='block-set-pillar-1 return_block'>
			<span style='font-size:16px;text-transform:uppercase; text-decoration: underline;'>Independence</span>
			<p style='margin-top:10px;text-align:justify;font-size:14px;'>We do not have any material association with listed firms. Our employees do not hold directorships at listed companies. This helps us maintain our independence and provide unbiased advice to clients. We do not accept assignments that may have a potential conflict with our objectives.</p>
		</div>";
}
else if(isset($_GET['get_block2']))
{
	echo "<div class='block-set-pillar-2 return_block'>
			<span style='font-size:16px;text-transform:uppercase; text-decoration: underline;'>Conflict Management</span>
			<p style='margin-top:10px;text-align:justify;font-size:14px;'>We provide governance advisory services to investors at listed companies. To remove any conflict of interests, we do not have any pecuniary or advisory relationship with listed companies. We have internal controls for interactions with listed firms and maintain a clear audit trail.</p>
		</div>";
}
else if(isset($_GET['get_block3']))
{
	echo "<div class='block-set-pillar-3 return_block'>
			<span style='font-size:16px;text-transform:uppercase; text-decoration: underline;'>Not For Profit</span>
			<p style='margin-top:10px;text-align:justify;font-size:14px;'>SES has adopted a not-for-profit business model to eliminate any perceived compromise with independence and to mitigate any potential conflict of interests. Our business model ensures that we place clients’ interests above our own and treat each client equally.</p>
		</div>";
}
else if(isset($_GET['get_block4']))
{
	echo "<div class='block-set-pillar-4 return_block'>
			<span style='font-size:16px;text-transform:uppercase; text-decoration: underline;'>Transparency</span>
			<p style='margin-top:10px;text-align:justify;font-size:14px;'>Our diverse and independent advisory board guides our policy making process which ensures that our policies are transparent and take opinions of all stakeholders into accounts. We disclose all non-material relationships with listed firms on our website and use only public information for analysis.</p>
		</div>";
}
else if(isset($_GET['get_all_blocks']))
{
	echo "	<div>
	            <div class='pillar-set grow' id='block1' style='cursor:pointer;'>
	        	    <span style='line-height:96px'>Independence</span>
	            </div>
	            <div class='pillar-set1 grow' id='block2' style='cursor:pointer;'>
	      	        <span style='line-height:0px;'>Conflict<br> Management</span>
	            </div>
        	</div>
        	<div>
             	<div class='pillar-set2 grow' id='block3' style='cursor:pointer;'>
              		<span style='line-height:96px'>Not for Profit</span>
             	</div>
             	<div class='pillar-set3 grow' id='block4' style='cursor:pointer;'>
              		<span style='line-height:0px;'>Transparency</span>
             	</div>
        	</div>";
}
else if(isset($_POST['proxy_ad']))
{
	$name = mysqli_escape_string($con,$_POST['username']);
	$email = mysqli_escape_string($con,$_POST['useremail']);

	if(mysqli_query($con,"insert into `web_proxy_add_viewer` (`name`,`email`) values('$name','$email')"))
	{
		echo json_encode(array('status'=>'ok'));
	}
	else
	{
		echo json_encode(array('status'=>'error'));
	}
}
function getmonth1($month)
	{
		switch($month)
		{
			case '1': return 'Jan';
						break;
			case '2': return 'Feb';
						break;
			case '3': return 'March';
						break;
			case '4': return 'April';
						break;
			case '5': return 'May';
						break;
			case '6': return 'June';
						break;
			case '7': return 'July';
						break;
			case '8': return 'Aug';
						break;
			case '9': return 'Sept';
						break;
			case '10': return 'Oct';
						break;
			case '11': return 'Nov';
						break;
			case '12': return 'Dec';
						break;			

		}
	}

?>			    