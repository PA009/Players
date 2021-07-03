<?php
    //connect to database
    require_once 'database2.php';
    $conn = db_connect();

    include_once 'top2.php';
?>

    <main class="conatiner">
        <div class="row">
            <div class="col">
                <h1 class="mt-5 pt-5">Its Empty here</h1>
                <p>Looks like this page was not found.Maybe it was moved or renamed</p>
                <a href="main.php" class="btn btn-outline-secondary">Back to homepage</a>
            </div>

            <div class="col">
               <img src="404.png" alt="404 Error" style="width:800px">
            </div>
        </div>
    </main>
<?php
    include_once 'footer2.php';
?>