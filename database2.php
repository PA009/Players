<?php

    function db_queryAll($sql,$conn)
        {
            try
            {
                //global $conn;
                //run query and store the results
                $cmd = $conn->prepare($sql);
                $cmd -> execute();
                $players = $cmd->fetchAll();
                return $players;
            } catch (Exception $e)
            {
                header("Location: error2.php");
            }

        }
        
        function db_queryOne($sql,$conn)
        {
            try
            {
                //global $conn;
                //run query and store the results
                $cmd = $conn->prepare($sql);
                $cmd -> execute();
                $players = $cmd->fetch();

                return $players;
            } catch (Exception $e)
            {
                header("Location: error2.php");
            }
        }

        function db_connect()
        {
            $conn = new PDO('mysql:host=172.31.22.43;dbname=Parth200458024', 'Parth200458024' , 'opnH6ahN7T' );
            $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }

        function db_disconnect($conn){
            if(isset($conn))
            {
                $conn = null;   
            }
        }
?>
