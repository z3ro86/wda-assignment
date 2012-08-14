<!DOCTYPE HTML PUBLIC
"-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html401/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <title>Winestore Search</title>
</head>
<body bgcolor="white">
	<div id='searchForm'>
	<p>Use the form below to search for wines in the database</p>
	<br />
		<form action="winestore_query.php" method="GET">
		<?php
		require('db.php');
				//(1) open db connection
				$connection = mysql_connect(DB_HOST,DB_USER,DB_PW);
				mysql_select_db("winestore",$connection);
		?>
		<table align="left">
			<tr><td><b>Wine Store Search</b></td></tr>
			<tr><td>Wine Name: </td>					<td><input type="text" name="wineName" /></td></tr>
			<tr><td>Winery Name: </td>					<td><input type="text" name="wineryName" /></td></tr>
			<tr><td>Enter a region to browse :</td> 
				<td><?php 
				//(2) run query on winestore
				$sql = "select * from region";
				$result = mysql_query($sql);
				
				echo "<select name=\"regionName\">";
					while ($row = mysql_fetch_array($result)) {
						echo "<option value='".$row['region_id']. "'>".$row['region_name']."</option>";
					}
				echo "</select>";
				?></td>
			</tr>
			<tr><td>Enter a grape variety to browse :</td> 
				<td><?php
				//(2) run query on winestore
				$sql1 = "select * from grape_variety";
				$result = mysql_query($sql1);
				
				echo "<select name=\"regionName\">";
					while ($row = mysql_fetch_array($result)) {
						echo "<option value='".$row['variety_id']. "'>".$row['variety']."</option>";
					}
				echo "</select>";
				?></td>
			</tr>
			<tr><td>Enter a range of years to browse :</td> 
				<td>From
				<?php
				//(2) run query on winestore
				$sql3 = "SELECT DISTINCT year FROM wine ORDER BY year DESC";
				$sql4 = "SELECT DISTINCT year FROM wine ORDER BY year ASC";
				$upper = mysql_query($sql3);
				$lower = mysql_query($sql4);
				
				echo "<select name=\"yearRangeUpper\">";
					echo "<option>Upper</option>";
					while ($row = mysql_fetch_array($upper)) {
					echo "<option value='".$row['year']."'>".$row['year']."</option>";
					}
				echo "</select> To"; 
				echo "<select name=\"yearRangeLower\">";
					echo "<option>Lower</option>";
					while ($row = mysql_fetch_array($lower)) {
					echo "<option value='".$row['year']."'>".$row['year']."</option>";
					}
				echo "</select>";
				//(3) close connection
				mysql_close($connection);
				?></td>
			</tr>
			<tr><td>Minimum number of wine in stock: </td>	<td><input type="text" name="minWineStock" /></td></tr>
			<tr><td>Minimum number of wine ordered: </td>	<td><input type="text" name="minWineOrdered" /></td></tr>
			<tr><td>Wine cost: </td>						<td><input type="text" name="minWineCost" /> - 
																<input type="text" name="maxWineCost" />
															</td></tr>
			<tr><td></td><td><input type="submit" value="Search"></td></tr>
		</form>
</body>
</html>
