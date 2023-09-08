<?php session_start();

include 'Includes/dbcon.php';
include 'Includes/session.php';
extract($_POST);

 $query = "SELECT * FROM staff WHERE empcode = '".$_SESSION["empcode"]."'";
  $rs = $conn->query($query);
  $get = $rs->fetch_assoc();
$fullName = $get['firstname'].' '.$get['lastname'];
 
?>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		<title>Challan Pending Ledger</title>
		
<script>
function printPage() {
    window.print();
}
</script>

</head>
<body>
	<div class = "container">
		<div id = "header">
		<br/>

			<p style = "text-align: right; font-size:12pt; font-weight:bold;">Program Wise Pending Ledger Report</p>
        <div align="right" style="font-size:12pt;">
		<p style="text-align: right;font-size:12pt;"> <b style="color:black;text-align: right;">Date Prepared:</b>
		 <?php $date = date('d-m-y h:i:s');
echo "<b>".$date."</br>";?></p>
        </div>			
        <b style="font-size:14pt; font-weight:bold;"><div align="center">
            Program wise Pending Ledger<br>
            </div></b>
<style type="text/css">
                      form-group-row.input {
                        font-weight:bold;
                             
                       }

        </style>
        
<table class="table table-striped" style="align-content: left;">
						    <thead>
                  <tr>
                    <tr>
                        <th scope="col">Created On</th>
                        <th scope="col">Description</th>
                        <th scope="col">Amount Deposit</th>
                          
                       
                       </tr>
                    
                  </tr>
                </thead>
						  <tbody>
                   <?php
                   
                  $query2 = "SELECT * FROM `challan` where challanstatus='Pending' AND pcode='$pcode'  order by  challanid";

                    $rs2 = $conn->query($query2);
                      $num2 = $rs2->num_rows;
                      $sn=0;
                      if($num2 > 0)
                      { 
                        while ($rows2 = $rs2->fetch_assoc())
                          {
                             $totalfeepaid=$rows2['fee']+$rows2['otherfee'];
                          
                              
                            echo"
                                <tr >
                                 
                                <td>".$rows2['createdon']."</td>
                                <td>Amount Pending By:".' '.$rows2['regnumber'].' '."Name=".$rows2['firstname'].$rows2['lastname'].":Program:".$rows2['pname'].":<br>Contact#:<b>".$rows2['contact'].' ' ."</b>:Challan Remarks:".$rows2['challanremarks']."</td>
                                 <td>".$totalfeepaid."</td>
                                 
                                
                               
                                
                            ";
                            }
                      }
                      else
                      {
                           echo   
                           "<div class='alert alert-danger' role='alert'>
                            No Record Found!
                            </div>";
                      }
                      
                  
                

                            
                             ?>
                  <tr>

                 
                </tbody>
						  <style>
        /* Rounded border */
hr.rounded {
  border-top: 8px solid #000000;
  border-radius: 5px;
  color: black;
}
</style>
       
<hr class="rounded">
               <?php
                   $query21 = "SELECT sum(fee) as fee, sum(otherfee) as otherfee,pname,pcode FROM `challan` where challanstatus='Pending' AND pcode='$pcode' order by  challanid";
                   $rs21 = $conn->query($query21);
                   $paidbalance=$rs21->fetch_assoc();
                  $totalcollection=$paidbalance['fee']+$paidbalance['otherfee'];
                  echo"
                                <tr >
                                 
                                <td></td>
                                 <td><b>Total Challan Collection for Program:".' '.$paidbalance['pname'].'-'.$paidbalance['pcode']."</b></td>
                                <td><b>".$totalcollection."</b></td>
                             </tr>";
                             ?>
					  </table> 
                      <style>
        /* Rounded border */
hr.rounded {
  border-top: 8px solid #000000;
  border-radius: 5px;
  color: black;
}
</style>
       
<hr class="rounded">
    
             
             

<br />
<br />
<b style="color:black; font-size:15px;">
Prepared By: <?php echo $fullName;?><br>
Employee Code By: <?php echo $_SESSION['empcode'];?>
</b>


			</div>
	
	
	
	

	</div>
</body>


</html>