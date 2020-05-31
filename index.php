<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- <link rel = "stylesheet" type = "text/css"  href = "style.css" /> -->
    <title>PhoneBook Website</title>
  </head>
  <body>
  
  <div >
  <h1 class="form-row justify-content-center">Add New Number</h1>
    <form action="phonebook.php" method="POST">
        <div class="form-row justify-content-center">
            <div class="col-auto">
                <label for="Name"><b>Name</b></label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Name">
            </div>
            <div class="col-auto">
                <label for="date"><b>Date of Birth</b></label>
                <input type="date" name="date" class="form-control" id="date" placeholder="dd/mm/yyyy">
            </div>
            <div class="col-auto">
            <p class="number">
                <label for="phone"><b>Mobile Number</b></label>
                <input type="tel" name="phone" class="form-control" id="phone" placeholder="+91 XXXXXXXXXX">
               
			   </p> 
            </div>
            <div class="col-auto">
                <label for="email"><b>Email</b></label>
                <input type="email" name="email" class="form-control" id="email" placeholder="abc@gmail.com">
                
				</div><br>
            <div class="col-auto">
                <button type="submit" name="save" class="btn btn-info">Save</button>
            </div>
        </div> 
    </form>
  </div>

  <?php 
require_once("phonebook.php") ?>

  <div class="container">
    <?php if(isset($_SESSION['msg'])): ?>
        <div class="<?=$_SESSION['alert']; ?>">
         <?= $_SESSION['msg']; 
         unset($_SESSION['ms']); ?>
         </div>
    <?php endif; ?>

        <h3 class="form-row justify-content-center"><b>Contacts</b></h3>  
        

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Date of Birth</th>
                    <th>Mobile Number</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <form action="phonebook.php" method="POST">
            <?php 
            //for displaying user's data
            $sQuery="SELECT * FROM contacts LIMIT 20";
            $result=$conn->query($sQuery);

            $x=1;


            while($row=$result->fetch_assoc()): ?>

                <tr>
                
                    <td><?=$row['id']; ?></td>
                    <td><?=$row['name']; ?></td>
                    <td><?=$row['date']; ?></td>
                    <td><?=$row['phone']; ?></td>
                    <td><?=$row['email']; ?></td>
                    <td style="width:15%">
                        <button type="submit" name="remove" value="<?= $row['id']; ?>" class="btn btn-danger">Remove</button>

                        <button type="button" name="edit" value="<?=$x; $x++;?>" class="btn btn-primary">Edit</button>
                    </td>
                </tr>

            <?php endwhile; ?>
            </form>
            </tbody>   
         </table>
     </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
 
    <script type="text/javascript">
    $(document).ready(function(){
        setTimeout(function(){
            $(".alert").remove();
        },2000);

        $(".btn-primary").click(function() {
            $(".table").find('tr').eq(this.value).each(function(){
                $("#name").val($(this).find('td').eq(1).text());
                $("#date").val($(this).find('td').eq(2).text());
                $("#phone").val($(this).find('td').eq(3).text());
                $("#email").val($(this).find('td').eq(4).text());
                $(".btn-info").val($(this).find('td').eq(0).text());
            });
            $(".btn-info").attr("name","edit");
        });
    });



    </script>
   </body>
</html>