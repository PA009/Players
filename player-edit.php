<?php
    //connect to database
    require_once 'database2.php';
    $conn = db_connect();
?>

<?php
    include_once 'top2.php';
    //if(post)
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        //-use same field forms as before
        
        $firstname = trim(filter_var($_POST['firstname'],FILTER_SANITIZE_STRING));
        $lastname = trim(filter_var($_POST['lastname'],FILTER_SANITIZE_STRING));
        $Jerseynumber = trim(filter_var($_POST['Jerseynumber'],FILTER_SANITIZE_NUMBER_INT));
        $position = trim(filter_var($_POST['position'],FILTER_SANITIZE_STRING));
        $id = trim(filter_var($_POST['player_id'],FILTER_SANITIZE_NUMBER_INT));

        //-run Update statement 

        $sql = "UPDATE player SET firstname=:firstname, ";
        $sql .= "lastname=:lastname, Jerseynumber=:Jerseynumber, position=:position ";
        $sql .= "WHERE player_id=:id";

        //create a command object and fill the parameter with the form values

        $cmd = $conn->prepare($sql);
        $cmd-> bindParam(':firstname', $firstname, PDO::PARAM_STR, 50);
        $cmd-> bindParam(':lastname', $lastname, PDO::PARAM_STR, 50);
        $cmd-> bindParam(':Jerseynumber', $Jerseynumber, PDO::PARAM_INT);
        $cmd-> bindParam(':position', $position, PDO::PARAM_STR, 100);
        $cmd-> bindParam(':id', $id, PDO::PARAM_INT);

        //execute the command

        $cmd-> execute();
        //-redirect to players.php
        header("Location: players.php");
    }
    //if(GET)
    //-get id from url
   else 
   if($_SERVER['REQUEST_METHOD']== 'GET')
     {
        $id = filter_var($_GET['player_id'],FILTER_SANITIZE_NUMBER_INT);
        
        //-query db for 1 record
        $sql = "SELECT*FROM player WHERE player_id=". $id;

        $player = db_queryOne($sql,$conn);

    
        $firstname = $player['firstname'];
        $lastname = $player['lastname'];
        $Jerseynumber = $player['Jerseynumber'];
        $position = $player['position'];
     }
?>

<h1 class="text-center mt-5 display-1 text-warning">
        <h1 class="text-center mt-5">Edit player <i class="bi bi-pencil-square"></i></h1>
        <div class="row mt-5 justify-content-center">
            <form class="col-6 mb-5" action="player-edit.php" method="POST" novalidate>
                        
                    <div class = "row mb-4 ">
                            <label class="col-2 col-form-label fs-6 " for="firstname">First Name</label>
                            <div class="col-10">
                                <input class="form-control dorn-control-lg" type="text"name="firstname" value="<?php echo $firstname; ?>">
                            </div>
                        </div>
        
                        <div class = "row mb-4 ">
                            <label class="col-2 col-form-label fs-6" for="lastname">Last Name</label>
                                <div class="col-10">
                                    <input class="form-control dorn-control-lg" type="text"name="lastname" value="<?php echo $lastname; ?>">
                                </div>
                        </div>
        
                        <div class = "row mb-4 ">
                            <label class="col-2 col-form-label fs-6" for="Jerseynumber">Jerseynumber</label>
                                <div class="col-10">
                                    <input class="form-control dorn-control-lg" type="text"name="Jerseynumber" value="<?php echo $Jerseynumber; ?>">
                                </div>
                        </div>
        
                        <div class = "row mb-4 ">
                            <label class="col-2 col-form-label fs-6" for="position">Position Of Player</label>
                            <div class="col-10">
                                <select name="position" id="" class="form-select form-select-lg">
                                <!--  <option value="batsmen">Batsmen</option>-->
                                <?php
                                    $sql = "SELECT playerposition FROM position ORDER BY playerposition";
                                    $position = db_queryAll($sql,$conn);
                                    echo json_encode($position[0]['playerposition']);

                                    foreach($position as $playerposition)
                                    {
                                        echo "<option value=" . $playerposition["playerposition"] .">" .ucfirst($playerposition["playerposition"]) . "</option>";
                                    }
                                ?>
                                </select>
                            </div>
                        </div>
        
                        <div class="d-grid">
                        <input readonly class="form-control dorn-control-lg" type="hidden"name="player_id" value="<?php echo $id; ?>">
                            <button class="btn btn-success btn-lg mr-2">Update Game</button>
                        </div> 
                        </form>  
                    </div>

        </div>

            
<?php
    include_once 'footer2.php';
?>