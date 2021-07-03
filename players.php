<?php
    //connect to database
    require_once 'database2.php';
    $conn = db_connect();
?>
<?PHP
    include_once 'top2.php';
    //create a query
    $sql = "SELECT * FROM player";
    $players = db_queryAll($sql,$conn);
?>
    <!--use the database results-->
    <table class="table table-secondary table-striped table-bordered border-secondary fs-5 mt-4">
  <thead>
    <tr>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Jersey No.</th>
      <th scope="col">Player Position</th>
      <th scope="col">Edit Player</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($players as $player)
  {?>
    <tr>
      <th scope="row"><?php echo $player['firstname'];?></th>
      <td><?php echo $player['lastname'];?></td>
      <td><?php echo $player['Jerseynumber'];?></td>
      <td><?php echo $player['position'];?></td>

      <td>
        <a href="player-edit.php?player_id=<?php echo $player['player_id']; ?>" class="btn btn-warning">Edit<i class="bi bi-pencil-square"></i></a>
      </td> 

      <td>
        <a href="player-delete.php?player_id=<?php echo $player['player_id']; ?>" class="btn btn-warning">Delete <i class="bi bi-trash"></i></a>
      </td> 
    </tr>
    <?php } ?>
  </tbody>
</table>
<?php
    //disconnect
    include_once 'footer2.php';
?>