<?php
    //connect to database
    require_once 'database2.php';
    $conn = db_connect();

    include_once 'top2.php';
?>

    <main class="conatiner">
        <div class="row">
            <div class="col">
                <h1 class="mt-5 pt-5">We're So sorry</h1>
                <p>Something unexpected just happened.</p>
                <a href="main.php" class="btn btn-outline-secondary">Back to homepage</a>
            </div>

            <div class="col">
               <img src="error.png" alt="unexpected Error" style="width:800px">
            </div>
        </div>
    </main>
<?php
    include_once 'footer2.php';
?>