<?php
$servername = "localhost";
$username = "root";
$password ="";
$database ="application";


             //creating my connection
$connection = new mysqli($servername, $username, $password, $database); 

$name ="";
$email ="";
$phone="";
$address ="";

$errorMessage ="";
$successMessage ="";


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name =$_POST["name"];
    $email =$_POST["email"];
    $phone =$_POST["phone"];
    $address =$_POST["address"];
    $sort = $_POST['sort'];

    do{
        if (empty($name) || empty($email) || empty($phone) || empty($address)){
            $errorMessage = "All fields are required";
            break;
        }

        //ADD THE NEW CLIEANT TO THE DATABASE
        $sql = "INSERT INTO clientsss (name, email, phone, address)". 
                "VALUES ('$name','$email','$phone','$address')";
        $result =$connection->query($sql);

        if(!$result){
            $errorMessage = "Invalid query:" .$connection->error;
            break;
        }

        $name ="";
        $email ="";
        $phone ="";
        $address ="";

        $successMessage = "Client added correctly";

        header("location:/crud_application/index.php");
        exit;
    }while (false);
}

?>
 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-color: #e6eeff;
            justify-content: center;
            align-items: center;
            place-items: center;
            ;">

    <div class=""
    style="            
            /* border-collapse: collapse; */
            /* border-radius: 8px;
            max-width: 40%;
            max-height: 80%;
            background-color: white;
            margin-left:23em;
            margin-top:4em;
            margin-buttom:4em;
            padding: 0.5em;
            box-shadow: 0 3px 7px #1aa3ff; */
            /* display: grid; */
            /* justify-content: center;
            align-items: center;
            place-items: center; */

            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            background: white;
            border-radius: 10px;
            box-shadow: 10px 10px 15px rgba(0,0,0,0.05); 
            ">
        




        <?php
            if(!empty($errorMessage)){
                echo"
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
            }
        ?>



            
        <form method="post" style="padding: 0 40px;
                             box-sizing: border-box;">
        <h4 style="text-align: left;
                    padding: 10px 0;
                    margin-top: 40px;
                    " > New Person to Add</h4>

                    <div class="">
                <label class="col-sm-3 col-form-label">Name</label>
                 <div class="col-sm-14">
                        <input type="text" class="form-control" name="name" value="<?php echo $name;?>">
                </div>
            </div>
               
            <div class="">
                <label class="col-sm-3 col-form-label">Email</label>
                 <div class="col-sm-14">
                        <input type="email" class="form-control" name="email" value="<?php echo $email;?>">
                </div>
            </div>
            
            <div class="">
                <label class="col-sm-3 col-form-label">Phone</label>
                 <div class="col-sm-14">
                        <input type="text" max="10" class="form-control" name="phone" value="<?php echo $phone;?>">
                </div>
            </div>

            <div class="">
                <label class="col-sm-3 col-form-label">Address</label>
                 <div class="col-sm-14">
                        <input type="text" class="form-control" name="address" value="<?php echo $address;?>">
                </div>
            </div>


            
            <?php
             if(!empty($successMessage)){
                echo"
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>$successMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
                ";}
            ?>



                
            <div style="
                    display:flex;
                    justify-content:space-between;
                    margin-top:10px;
                    margin-bottom:50px;
                    gap:12px;
                    text-align: center;
                    ">
                <div >
                    <button type="submit" class="btn btn-info btn-sm">Submit</button>
                </div>
                <div>
                    <a class="btn btn-danger btn-sm" href="/crud_application/index.php" role="button">Cancel</a>
                </div>
            </div>
            
        </form>
        </div>
        
    </div>
    
   

    
</body>
</html>