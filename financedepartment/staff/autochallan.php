<?php session_start();
?>
<?php 
error_reporting(0);
include 'Includes/dbcon.php';
include 'Includes/session.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="Includes/img/logo/attnlg.jpg" rel="icon">
<?php include 'Includes/title.php';?>
  <link href="../Includes/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../Includes/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="Includes/css/ruang-admin.min.css" rel="stylesheet">
   <!-- Vendor CSS Files -->
   <link href="Includes/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="Includes/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="Includes/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="Includes/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="Includes/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="Includes/assets/vendor/simple-datatables/style.css" rel="stylesheet">

 
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
      <?php include "Includes/sidebar.php";?>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
       <?php include "Includes/topbar.php";?>
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Auto Challan Section</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Auto Challan Section</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Auto Challan Section</h6>
                    <?php echo $statusMsg; ?>
                </div>
                <div class="card-body">

                   <?php
                 $query=mysqli_query($conn,"select * from student_info" );
                
                $ret=mysqli_fetch_array($query);
            
            if($ret > 0)
            {
                 ?> <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span><i class='fas fa-plus' style='font-size:20px'></i>Auto Generate Challan</button>
                  <?php
               }else
               {?>
                <button disabled type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span>No Student Found</button>
                  
                  <?php
               }?>
				 </div>
              </div>
 			</div>
          </div>
           <!-- Modal -->
  <div class="modal fade bd-example-modal-lg" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-content">
				<form method="POST" action="challangenerateauto.php">	
					<div class="modal-header">
						<h4 class="modal-title">Generate Challan</h4>
					</div>
					<div class="modal-body">
						 <div class="row">
						 
							</div>
                
               <div class="col-xl-12">
                        <label class="form-control-label">Select Program<span class="text-danger ml-2">*</span></label>
                         <?php
                        $qry= "SELECT * FROM program  ORDER BY pid ASC";
                        $result = $conn->query($qry);
                        $num = $result->num_rows;   
                        if ($num > 0){
                          echo ' <select required name="pcode"  class="form-control mb-3">';
                          echo'<option value="">--Select Class--</option>';
                          while ($rows = $result->fetch_assoc()){
                          echo'<option value="'.$rows['pcode'].'" >'.$rows['pcode'].'-'.$rows['pname'].'</option>';
                              }
                                 echo '</select>';
                            }
                           ?>  
                        </div>
                       
					   </div>
					 
              <div class="col-xs-7 col-sm-6 col-lg-12">
                <label>Due Date:</label><span class="text-danger ml-2">*</span>
                <input type="date" name="duedate" class="form-control"   required="required"/>
                   
              
              </div>
               <div class="col-xs-7 col-sm-6 col-lg-12">
                <label>Fee:</label><span class="text-danger ml-2">*</span>
                <input type="number" name="mfee" class="form-control"   required="required" />
                 
              </div>
              <div class="col-xs-7 col-sm-6 col-lg-12">
                <label>Other Charges:</label><span class="text-danger ml-2">*</span>
                <input type="number" name="otherfee" class="form-control"   required="required"/>
                  
              
              </div>
               <div class="col-xl-12">
                <label class="form-control-label">Challan Remarks<span class="text-danger ml-2"></span></label>
                <textarea name="remarks" class="form-control" style="height: 100px"  placeholder="Challan Remarks" oninput="this.value = this.value.toUpperCase()"></textarea>
                </div> 
                  
                
                       
              

					<div style="clear:both;"></div>
					<div class="modal-footer">
						
						<button name="save" class="btn btn-success" ><span class="glyphicon glyphicon-save"></span> Generate Challan</button>
				
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Abort</button>
        </div>
        	</div>
				</form>
          <div style="clear:both;"></div>
        <div class="col-xs-7 col-sm-6 col-lg-12">
                <label>Calculate Fee Per Month:</label><br>
               Program Duration<input type="number" class="form-control"  id="percent" />Program Cost <input type="number" id="num" class="form-control" />
               <button onclick="percentage_1()" >Calculate</button><br>
               <input type="text" id="value1" class="form-control"  readonly />
              </div>       
   
   <script type="text/javascript">
        function percentage_1() {

    // Method returns the element of percent id
    var percent = document.getElementById("percent").value;
    percent=12*percent;
    // Method returns the element of num id
    var num = document.getElementById("num").value;
    document.getElementById("value1")
        .value = (num /percent);
}



    </script>         
			</div>
      </div>
      
    </div>
  </div>
     <div class="row">
              <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Auto Challan Report</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>Auto#</th>
                        <th>Remarks</th>
                        <th>Date&time</th>
                        <th>Accepted</th>
                         <th>Rejected</th>
                         <th>Reg#</th>
                        <th>Name</th>
                      </tr>
                    </thead>
                   
                    <tbody>

                  <?php
                       $query = "Select * from autochallanreport order by dateandtime ASC;";
                      $rs = $conn->query($query);
                      $num = $rs->num_rows;
                      $sn=0;
                      $status="";
                      if($num > 0)
                      { 
                        while ($rows = $rs->fetch_assoc())
                          {
                             
                              
                            echo"
                              <tr>
                                 <td>".$rows['autoid']."</td>
                                 <td>".$rows['description']."</td>
                                 <td>".$rows['dateandtime']."</td>
                                 <td>".$rows['totalchallan']."</td>
                                 <td>".$rows['totalrejected']."</td>
                                 <td>".$rows['regnumber']."</td>
                                <td>".$rows['fname'].' '.$rows['lname']."</td>";
                                ?>
                          </tr>
                              
    <div class="modal fade bd-example-modal-lg" id="edit_modal<?php echo $rows['regnumber']?>" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content modal-lg">
				<form method="POST" action="update_challandate.php">	
					<div class="modal-header">
            <h4 class="modal-title">Student Challan Details</h4>
          </div>
            <div class="modal-body">
             <div class="row">
             <div class="col-xs-7 col-sm-6 col-lg-12">
                <label>Reg#</label><span class="text-danger ml-2">*</span>
                <input type="text" name="fname" class="form-control"   required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows['regnumber'];?>" disabled/>
                <input type="hidden" name="regnumber" class="form-control"   required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows['regnumber'];?>"/>
                <input type="hidden" name="challanid" class="form-control"   required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows['challanid'];?>"/>
              <input type="hidden" name="stdid" class="form-control"   required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows['stdid'];?>" />
              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>First Name</label><span class="text-danger ml-2">*</span>
                <input type="text" name="fname" class="form-control"   required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows['firstname'];?>" disabled/>
              <input type="hidden" name="fname" class="form-control"   required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows['firstname'];?>" />
              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Last Name</label><span class="text-danger ml-2">*</span>
                <input type="text" name="lname" class="form-control" required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows['lastname'];?>" disabled />
              <input type="hidden" name="lname" class="form-control" required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows['lastname'];?>"  />
              </div>
                <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Email</label><span class="text-danger ml-2">*</span>
                <input type="email" name="email" class="form-control"   required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows['email'];?>" disabled />
                 <input type="hidden" name="email" class="form-control"   required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows['email'];?>"  />
              
              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Contact</label><span class="text-danger ml-2">*</span>
                <input type="number" name="contact" class="form-control" required="required" value="<?php echo $rows['contact'];?>" disabled />
                <input type="hidden" name="contact" class="form-control" required="required" value="<?php echo $rows['contact'];?>" />
              
              </div>
              
               
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Student CNIC</label><span class="text-danger ml-2">*</span>
                <input type="number" name="stdcnic" class="form-control" value="<?php echo $rows['stdcnic'];?>"  required="required" disabled/>
                 <input type="hidden" name="stdcnic" class="form-control" value="<?php echo $rows['stdcnic'];?>"  required="required" />
              
              </div>
             
              
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Program Code</label><span class="text-danger ml-2">*</span>
                <input type="text" name="pcode" class="form-control"  value="<?php echo $rows['pcode'];?>" required="required" disabled/>
                <input type="hidden" name="pcode" class="form-control"  value="<?php echo $rows['pcode'];?>" required="required" />
              
              
              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Program Name</label><span class="text-danger ml-2">*</span>
                <input type="text" name="pname" class="form-control"  value="<?php echo $rows['pname'];?>" required="required" disabled/>
               <input type="hidden" name="pname" class="form-control"  value="<?php echo $rows['pname'];?>" required="required" />
              </div>
              
              
               <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Due Date:</label><span class="text-danger ml-2">*</span>
                <input type="date" name="duedate" class="form-control"  value="<?php echo $rows['duedate'];?>" />
                 
                   
              
              </div>
               <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Fee:</label><span class="text-danger ml-2">*</span>
                <input type="number" name="fee" class="form-control"  value="<?php echo $rows['fee'];?>" disabled/>
                 <input type="hidden" name="fee" class="form-control"  value="<?php echo $rows['fee'];?>" />
              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Other Charges:</label><span class="text-danger ml-2">*</span>
                 <input type="number" name="otherfee" class="form-control"  value="<?php echo $rows['otherfee'];?>" disabled/> 
                 <input type="hidden" name="otherfee" class="form-control"  value="<?php echo $rows['otherfee'];?>" />
              
              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Total Payable Amount:</label><span class="text-danger ml-2">*</span>
                 <input type="number" name="otherfee" class="form-control"  value="<?php echo $rows['fee']+$rows['otherfee'];?>" disabled/> 
                 <input type="hidden" name="totalamount" class="form-control"  value="<?php echo $rows['fee']+$rows['otherfee'];?>"/> 
                 <input type="hidden" name="totalamountfine" class="form-control"  value="<?php echo $rows['fee']+$rows['otherfee']+500;?>"/> 
              
              
              
              </div>
               <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Payment Status:</label><span class="text-danger ml-2">*</span>
                 <input type="text" name="otherfee" class="form-control"  value="<?php echo $rows['challanstatus'];?>" disabled/> 
                  
              
              </div>
              

               </div>
              
             </div>
              <div style="clear:both;"></div>
          <div class="modal-footer">
          <button name="update" class="btn btn-success" ><span class="glyphicon glyphicon-save"></span>Update</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button></div>
          
 
</form>


			</div>
		</div>
	</div>
			

                              <?php

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
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            </div>
        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
       <?php include "Includes/footer.php";?>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
<?php include 'script.php'?>
  
   
</body>

</html>