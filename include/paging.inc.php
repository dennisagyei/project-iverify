<?php 
function get_paged_sql($currentPage,$mySql,)
{
	
	$recordsPerPage = 5;
	
	$firstRec = $currentPage *  $recordsPerPage + 1;
	$lastRec = ($currentPage+1) *  $recordsPerPage;
	
	$mySql =  "select city from locations order by city";
	
	$pagesql = "select *
	from ( select a.*, RowNum as rNum
	from ( $mySql) a
	where RowNum <= $lastRec )
	where $firstRec <= rNum";
	
	$s = oci_parse($c, $pagesql);
	oci_bind_by_name($s, ":maxrow", $maxrow);
	oci_bind_by_name($s, ":minrow", $minrow);
	oci_execute($s);
	oci_fetch_all($s, $res);
}

?>