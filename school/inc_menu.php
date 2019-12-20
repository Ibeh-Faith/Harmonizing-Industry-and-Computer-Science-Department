<div id="sidebar">			
	<ul>
		<li class=""><a href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
		
		</li>
        <li><a href="list.php"><i class="fa fa-envelope"></i> <span>Messages</span></a></li>
        <?php if($_SESSION['type'] == 'C') {?>
            <li><a href="company.php"><i class="fa fa-location-arrow"></i> <span>Send Message</span></a></li>
        <?php }else {?>
            <li><a href="school.php"><i class="fa fa-location-arrow"></i> <span>Send Message</span></a></li>
        <?php }?>

        <?php if($_SESSION['type'] == 'C') {?>
        <li><a href="report.php"><i class="fa fa-location-arrow"></i> <span>Send Report</span></a></li>
        <?php } ?>
        <?php if($_SESSION['type'] == 'S') { ?>
            <li><a href="report-list.php"><i class="fa fa-location-arrow"></i> <span>Reports</span></a></li>
        <?php } ?>
		<li><a href="logout.php"><i class="fa fa-power-off"></i> <span>Logout</span></a></li>
	</ul>
</div>