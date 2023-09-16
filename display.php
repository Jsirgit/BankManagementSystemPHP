

<!DOCTYPE html>
<html>
<head>
	<title>Customers Data</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />



        <style>
        	h1{
        		font-size: 40px;
        		padding: 22px;
        		color: #fff;
        		text-align: center;
        		font-family: "Comic Sans MS";
        	}
        	table{
        		border-collapse: collapse;
        		background-color: transparent;
        		margin: auto;
        	}
            
        	th,td{
        		border:3px solid white;
        		padding: 12px 12px;
        		text-align: center;
        		color: white;
        	}
        	th{
        		text-transform: uppercase;
        		font-size: 22px;
        	}
        	td{
        		font-size: 20px;
        	}
            td a img{
            	height: 50px;
            	width: 50px;
            }
            .data:hover{
                background-color: gray;
                color: black;
            }

        	.fa{
        		font-size: 24px;
        	}
        	.fa-share-square{
        		color:white;
        	}
        </style>
</head>
<body>

<div class="main-div">
	<h1>Trasfer Money</h1>
	<div class="center-div">
		<div class="table-responsive">
			<table>
				<thead>
					<tr>
						<th>Id</th>
						<th>Name</th>
						<th>EMail</th>
						<th>Balance</th>
						<th>Transfer</th>
					</tr>
				</thead>
				<tbody>

					<?php

                       include 'connection.php';

                       $selectquery = "select * from first";

                       $query = mysqli_query($con, $selectquery);

                       $nums = mysqli_num_rows($query);

                       while($res =  mysqli_fetch_assoc($query)){
                      ?>

                       <tr class="data">
                        <td><?php echo $res['id']; ?> </td>
                        <td><?php echo $res['name']; ?></td>
                        <td><?php echo $res['email']; ?></td>
                        <td><?php echo $res['balance']; ?></td>
                        <td><a href="transfermoney.php?id=<?php echo $res['id']; ?>"><i class="fa fa-share-square" aria-hidden="true"></i></a></td>
                       </tr>
                     
                     <?php

                       }

                    ?>
			    </tbody>
			</table>
		</div>
	</div>
</div>
</body>
</html>