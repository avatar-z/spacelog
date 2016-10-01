<!doctype php>
<html>
<head>
<meta charset="utf-8">
</head>
<title>
This is the Space Log of E
</title>
<div style="background:#bdc3c7; width:100%; height:100%; position:fixed; z-index:-2">
</div>
<body leftmargin="0" topmargin="0">
<div style="width:100%; height:auto;">
<p align="center"><br/>This is E's Space Log!</p>
</div>
<div style="width:100%; height:auto;">
<div align="center">
<table border="0">
  <tbody>
    <tr>
      <th scope="row" style="width:100px;">&nbsp;</th>
      <td style="width:400px;">
      <?php 
	  	if(isset($_GET['do'])){
			switch($_GET['do']){
				case 'insert':include("/Units/unit_insert.php");break;
				case 'search':include("/Units/unit_search.php");break;
				case 'review':include("/Units/unit_review.php");break;
				case 'statistic':include("/Units/unit_statistic.php");break;
				case 'edit':include("/Units/unit_edit.php");break;
				case 'delete':include("/Units/unit_delete.php");break;
			}
		}
		else if(isset($_GET['submit'])){
			switch($_GET['submit']){
				case 'insert':include("/Units/unit_insert.php");break;
				case 'search':include("/Units/unit_search.php");break;
				case 'review':include("/Units/unit_review.php");break;
				case 'statistic':include("/Units/unit_statistic.php");break;
				case 'delete':include("/Units/unit_edit.php");break;
				case 'edit':include("/Units/unit_delete.php");break;
			}
		}
		else{
			include("/Units/unit_index.php");
		}
	  ?>
      </td>
      <td style="width:200px;"><?php include("/Units/unit_sidebar.php"); ?></td>
    </tr>
    <tr>
      <th scope="row" style="width:100px;">&nbsp;</th>
      <td style="width:400px;">&nbsp;</td>
      <td style="width:200px;">&nbsp;</td>
    </tr>
  </tbody>
</table>
</div>
</div>
</body>
</html>