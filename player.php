<?php
    //connect to database
    require_once 'database2.php';
    $conn = db_connect();
?>

<?php
    include_once 'top2.php';
?>

    <h1 class="mt-5">Add New Player</h1>
      
    <form class="col-6 mb-5" action="save_player.php" method="POST" novalidate>
                
                <div class = "row mb-4 ">
                    <label class="col-2 col-form-label fs-6 " for="firstname">First Name</label>
                    <div class="col-10">
                        <input required class="form-control dorn-control-lg" type="text"name="firstname">
                    </div>
                </div>

                <div class = "row mb-4 ">
                    <label class="col-2 col-form-label fs-6" for="lastname">Last Name</label>
                        <div class="col-10">
                            <input required class="form-control dorn-control-lg" type="text"name="lastname">
                        </div>
                </div>

                <div class = "row mb-4 ">
                    <label class="col-2 col-form-label fs-6" for="Jerseynumber">Jerseynumber</label>
                        <div class="col-10">
                            <input required inputmode="numeric" pattern="[0-9]{3}"class="form-control dorn-control-lg" type="text"name="Jerseynumber">
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
                    <button class="btn btn-success btn-lg mr-2">submit</button>
                </div> 
                </form>  
            </div>
<?php
    include_once 'footer2.php';
?>