<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head >
<body style="background-color: #e6eeff;
            justify-content: center;
            align-items: center;
            /* display: grid; */
            place-items: center;
            ">

<div class="modal-dialog" style="
            border-collapse: collapse;
            border-radius: 8px;
            max-width: 68%;
            max-height: 80%;
            background-color: white;
            margin-top:4em;
            margin-bottom:4em;
            padding: 0.5em;
            box-shadow: 0 3px 7px #1aa3ff;
            display: grid;
            justify-content: center;
            align-items: center;
            place-items: center;
            position: relative;
            /* overflow:auto; */
            
            
          " tabindex="-1">
  
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">My Friends</h5>
        <!-- <a class="btn btn-primary" href="/crud_application/create.php" role="button">New Client</a> -->
        <!-- Button trigger modal -->
        <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#exampleModal'>
                      New Client
                    </button>
                    
                    <!-- Modal -->
                    <div class='modal fade'  id='exampleModal'  tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                      <div class='modal-dialog'>
                        <div class='modal-content'>
                          <div class='modal-header'>
                            <h1 class='modal-title fs-5' id='exampleModalLabel'>Add Client(s)</h1>
                            <!-- <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button> -->
                          </div>
                          <div class='modal-body'>
                          DO YOU WANT TO ADD CLIENT(S) MANUALLY?
                          </div>
                          <div class='modal-footer'>
                          <a class='btn btn-danger btn-sm' href="/crud_application/create.php" role="button">Yes</a>
                          <a class='btn btn-danger btn-sm' href="/crud_application/spreadsheet.php" role="button">No</a>
                            <!-- <button type='button' class='btn btn-secondary btn-sm' data-bs-dismiss='modal'>Close</button> -->
                            
                          </div>
                        </div>
                      </div>
                    </div>
                    
      </div>
      <div class="modal-body">
      
        <br>





  <!-----------------Sorting------------------->
<div style="display:flex;">
<form action="" method="GET">
  <label for="orderBy">Sort by:</label>
  <select name="orderBy" id="orderBy" style="height:32px; ">
    <option value="idAsc">ID (ascending)</option>
    <option value="idDesc">ID (descending)</option>
    <option value="nameAsc">Name (ascending)</option>
    <option value="nameDesc">Name (descending)</option>
    <option value="emailAsc">Email (ascending)</option>
    <option value="emailDesc">Email (descending)</option>
  </select>
  <button type="submit" >Sort</button>
</form>



<form action="" method="POST" style="margin-left:5px;">
<label for="search">Search:</label>
<input type="text" id="search" name="search" placeholder="Search">
<button type="submit">Submit</button>

</form>

</div>




<table class="table">
<thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>

            </table>
        <div style=" width: 780px;
                    aspect-ratio: 4/2;
                    /* margin: auto; */
                    /* border: solid black 2px; */
                    /* overflow-x: scroll; */
                    /* overflow-y: scroll; */
                    white-space: nowrap;
                    scroll-snap-type: x mandatory;
                    height: 450px;
	                  overflow: auto;">
        <table class="table">
            
            <tbody >
            <?php
            $servername = "localhost";
            $username = "root";
            $password ="";
            $database ="application";


             //creating my connection
            $connection = new mysqli($servername, $username, $password, $database);

             //checking my connection
            if($connection->connect_error){
            die("Connection failed:". $connection->connect_error);

            }




          
// Define the sorting order for each column
$sortById = "id ASC";
$sortByIdDesc = "id DESC";
$sortByEmail = "email ASC";
$sortByEmailDesc = "email DESC";
$sortByName = "name ASC";
$sortByNameDesc = "name DESC";

// Define the default sorting order
$orderBy = $sortById;

// echo "Sorting".$_GET['orderBy'];
// Check if a sorting order was specified in the URL parameters
if (isset($_GET['orderBy'])) {
    switch ($_GET['orderBy']) {
        case 'idAsc':
            $orderBy = $sortById;
            break;
        case 'idDesc':
            $orderBy = $sortByIdDesc;
            break;
        case 'nameAsc':
            $orderBy = $sortByName;
            break;
        case 'nameDesc':
            $orderBy = $sortByNameDesc;
            break;
        case 'emailAsc':
            $orderBy = $sortByEmail;
            break;
        case 'emailDesc':
            $orderBy = $sortByEmailDesc;
            break;
        default:
            $orderBy = $sortById;
            break;
    }
}

// Create a mysqli object
$mysqli = new mysqli('localhost', 'root', '', 'application');

// Get the search term from a form
$search_term =  '';
if(isset($_POST['search'])){
  $search_term = $_POST['search'];
}
// print_r('search');
// Prepare a SQL statement
$stmt = $mysqli->prepare('SELECT * FROM clientsss WHERE name LIKE ? OR email LIKE ? ORDER BY '.$orderBy);

// Add wildcards to the search term
$search_term = '%' . $search_term . '%';

// Bind parameters to the statement
$stmt->bind_param('ss', $search_term, $search_term);

// Execute the statement
 $stmt->execute();

// // Fetch the results
//  $result = $stmt->get_result();


  

             //read all row from database
             $sql = "SELECT * FROM clientsss ORDER BY $orderBy";
             $result = $connection->query($sql);
             $stmt->execute();

// Fetch the results
$result = $stmt->get_result();

             if(!$result) {
                 die("Invailed query:". $connection->error);
             }
if ($result->num_rows > 0){
     //reading the data from each row
  while($row = $result->fetch_assoc()){
    echo"
        <tr>
        <td>$row[id]</td>
        <td>$row[name]</td>
        <td>$row[email]</td>
        <td>$row[address]</td>
                 <td>$row[created_at]</td>
                 <td>
                     <a class='btn btn-info btn-sm' href='/crud_application/edit.php?id=$row[id]'>Edit</a>


                     <!-- Button trigger modal -->
                     <button type='button' class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#exampleModal2'>
                       Delete
                     </button>
                     
                     <!-- Modal -->
                     <div class='modal fade'  id='exampleModal2'  tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                       <div class='modal-dialog'>
                         <div class='modal-content'>
                           <div class='modal-header'>
                             <h1 class='modal-title fs-5' id='exampleModalLabel'>DELETE</h1>
                             <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                           </div>
                           <div class='modal-body'>
                           DO YOU WANT TO DELETE THIS RECORD?
                           </div>
                           <div class='modal-footer'>
                             <button type='button' class='btn btn-secondary btn-sm' data-bs-dismiss='modal'>Close</button>
                             <a class='btn btn-danger btn-sm' href='/crud_application/delete.php?id=$row[id]'>Delete</a>
                           </div>
                         </div>
                       </div>
                     </div>
                     
                     
                    


                    
                 </td>
             </tr>
                 ";
             }
            }else{
              echo "No results found for'" .$search_term. "'";
            }
            $mysqli->close();

          
             ?>
             
             </tbody>
        </table>
        </div>
        
    </div>
    </div>
        
      </div>
     
    </div>
  </div>
</div>


</body>
</html>