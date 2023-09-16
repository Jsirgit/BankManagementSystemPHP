<?php
include 'connection.php';

if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from first where id=$from";
    $query = mysqli_query($con,$sql);
    $sql1 = mysqli_fetch_array($query); 

    $sql = "SELECT * from first where id=$to";
    $query = mysqli_query($con,$sql);
    $sql2 = mysqli_fetch_array($query);


    if (($amount)<0)
   {
        echo '<script type="text/javascript">';
        echo ' alert("Oops! You Enter wrong values")';
        echo '</script>';
    }
    
    else if($amount > $sql1['balance']) 
    {
        
        echo '<script type="text/javascript">';
        echo " alert('Yo Don't Have Sufficient Balance')"; 
        echo '</script>';
    }
    
    else if($amount == 0){

         echo "<script type='text/javascript'>";
         echo "alert('Oops! Zero value cannot be transferred')";
         echo "</script>";
     }


      else {
        
                
                $newbalance = $sql1['balance'] - $amount;
                $sql = "UPDATE first set balance=$newbalance where id=$from";
                mysqli_query($con,$sql);
             

                
                $newbalance = $sql2['balance'] + $amount;
                $sql = "UPDATE first set balance=$newbalance where id=$to";
                mysqli_query($con,$sql);
                
                $sender = $sql1['name'];
                $receiver = $sql2['name'];
                $sql = "INSERT INTO second(`sender`, `receiver`, `balance`) VALUES ('$sender','$receiver','$amount')";
                $query=mysqli_query($con,$sql);

                if($query){
                     echo "<script> alert('Transaction Successful');
                                     window.location='history.php';
                           </script>";
                    
                }

                $newbalance= 0;
                $amount =0;
        }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <style type="text/css">
    	body{
            background: linear-gradient(
              rgba(35,43,56,0.7),
              rgba(35,43,56,0.7)
              ),url(image/img3.jpg);
            background-size: cover;
            background-attachment: fixed;
            }
        .heading{
            color: white;
            font-size: 40px;
            font-family: "Comic Sans MS";
        }
        .container table tr{
            background-color: transparent;
        }
        .container tr.data:hover{
            background-color: gray;
            color: black;
          } 
        .container table tr th{
            color: white;
            font-size: 25px;
        }

        .container table tr td{
            color: white;
            font-size: 19px;
        }
        .container label{
            color: white;
            padding: 10px;
            font-size: 23px;
            font-family: "montserrat";

        }

.btn{
  height: 50px;
  width: 170px;
  position: relative;
  color: white;
  font-size: 20px;
  font-family: "montserrat";
  text-decoration: none;
  border: 3px solid white;
  border-radius: 30px;
  text-transform: uppercase;
  overflow: hidden;
  transition: 1s all ease;
}
.btn::before{
  background: white;
  content: "";
  border-radius: 30px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
  z-index: -1;
  transition: all 0.6s ease;
}
.btn4::before{
  width: 100%;
  height: 0%;
  transform: translate(-50%,-50%) rotate(-45deg);
}
.btn4:hover::before{
  height: 380%;
}
.btn4:hover{
  border: 1px solid black;
  border-radius: 30px;
}
footer .footer{
             background-color: black;
             height: 40px; 
             margin-top: 50px;
             color: white;
             text-align: center;
             padding-top: 7px;
          }
</style>
</head>

<body>

<?php include 'nav.php';?>

    <div class="container">
        <h2 class="heading text-center pt-4">Transaction</h2>
    
            <?php
                include 'connection.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM  first where id=$sid";
                $result=mysqli_query($con,$sql);
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($con);
                }
                $res=mysqli_fetch_assoc($result);
            ?>
            <form method="post" name="tcredit" class="tabletext" ><br>
        <div>
            <table class="table table-striped table-condensed table-bordered">
                <tr>
                    <th class="text-center">Id</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Balance</th>
                </tr>

                 <tr class="data">
                    <td class="py-2"><?php echo $res['id'] ?></td>
                    <td class="py-2"><?php echo $res['name'] ?></td>
                    <td class="py-2"><?php echo $res['email'] ?></td>
                    <td class="py-2"><?php echo $res['balance'] ?></td>
                </tr>
            </table>
        </div>
        <br><br><br>
        <label><b>Transfer To:</b></label>

        <select name="to" class="form-control" required>
            <option value="" disabled selected>Choose</option>
            
            
            <?php
                include 'connection.php';
                
                $sid=$_GET['id'];
                
                $sql = "SELECT * FROM first where id!=$sid";
                
                $result=mysqli_query($con,$sql);
                
                if(!$result)
                {
                    echo "Error ".$sql."<br>".mysqli_error($con);
                }
                while($res = mysqli_fetch_assoc($result)) {
            ?>
                
                <option class="table" value="<?php echo $res['id'];?>" >
                
                    <?php echo $res['name'] ;?> (Balance: 
                    <?php echo $res['balance'] ;?> ) 
               
                </option>

            <?php 
                } 
            ?>

        <div>
        </select>
        <br>
        <br>
            
            <label><b>Amount:</b></label>
            <input type="number" class="form-control" name="amount" required>   
            <br><br>
            <div class="text-center">
               <button class="mt-3 btn btn4" name="submit" type="submit" id="myBtn">Transfer</button>
            </div>
        </form>
    </div>

    <footer>
      <div class="footer">
        <p>©2021 All Rights are Reserved   Made by <b>Gayatri Bhosale</b>  </p>
      </div>
  </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>