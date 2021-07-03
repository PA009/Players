<?php
    //connect to database
    require_once 'database2.php';
    $conn = db_connect();

    //If this page is fetched via a get request
    //then display record with confirmation buuton
     if($_SERVER['REQUEST_METHOD']== 'GET')
     {
        $id = filter_var($_GET['player_id'],FILTER_SANITIZE_NUMBER_INT);

        $sql = "SELECT*FROM player WHERE player_id=". $id;

        $player = db_queryOne($sql,$conn);

        $firstname = $player['firstname'];
        $lastname = $player['lastname'];
        $Jerseynumber = $player['Jerseynumber'];
        $position = $player['position'];
        

        include_once 'top2.php';  
?>
        <h1 class="text-center mt-5 display-1 text-warning"><i class="bi bi-x-circle"></i>
        <h1 class="text-center mt-5">Are you Sure you want to delete this Player record?</h1>
        <div class="row mt-5 justify-content-center">
            <form class="col-6 mb-5" action="player-delete.php" method="POST" >
                        
                    <div class = "row mb-4 ">
                            <label class="col-2 col-form-label fs-6 " for="firstname">First Name</label>
                            <div class="col-10">
                                <input readonly class="form-control dorn-control-lg" type="text"name="firstname" value="<?php echo $firstname; ?>">
                            </div>
                        </div>
        
                        <div class = "row mb-4 ">
                            <label class="col-2 col-form-label fs-6" for="lastname">Last Name</label>
                                <div class="col-10">
                                    <input readonly class="form-control dorn-control-lg" type="text"name="lastname" value="<?php echo $lastname; ?>">
                                </div>
                        </div>
        
                        <div class = "row mb-4 ">
                            <label class="col-2 col-form-label fs-6" for="Jerseynumber">Jerseynumber</label>
                                <div class="col-10">
                                    <input readonly class="form-control dorn-control-lg" type="text"name="Jerseynumber" value="<?php echo $Jerseynumber; ?>">
                                </div>
                        </div>
        
                        <div class = "row mb-4 ">
                            <label class="col-2 col-form-label fs-6" for="position">Position Of Player</label>
                            <div class="col-10">
                            <input readonly class="form-control dorn-control-lg" type="text"name="position" value="<?php echo $position; ?>">
                            </div>
                        </div>
        
                        <div class="d-grid">
                        <input readonly class="form-control dorn-control-lg" type="hidden"name="player_id" value="<?php echo $id; ?>">
                            <button class="btn btn-danger btn-lg mr-2">Delete Forever</button>
                        </div> 
                        </form>  
                    </div>

        </div>
<?php
     }
     else 
     if ($_SERVER['REQUEST_METHOD']== 'POST')
     {
        //If this page is fetched via POST request
        //then acually delete the record 

        $id = filter_var($_POST['player_id'],FILTER_SANITIZE_NUMBER_INT);
        echo "id is $id";
         
        $sql = "DELETE FROM player WHERE player_id=".$id;
        $cmd = $conn->prepare($sql);
        $cmd-> execute();

        header("Location: players.php");
     }

?>