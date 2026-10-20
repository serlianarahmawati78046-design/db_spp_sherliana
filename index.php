<html>
    <head>
        <title>Form Login</title>
    <style>
    body{
        background: url('src/berrycute.jpeg');
        background-size: cover;
        margin: 0;
        font-family: 'Open Sans', sans-serif ;
    }

        fieldset{
        margin: 100 auto;
        width: 320px;
        height: 400px;  
        border: 2px solid white;
        border-radius: 15px;
        background-color: white;
        }

        label{
        font-family: tahoma;
        color: red;
        }

        input{
        position: center;
        margin: 5px;
        padding: 10px;
        width: 300px;
        height: 40px;
        border: 1px solid white;
        border-radius: 10px;
        }

        select{
        position: center;
        margin: 5px;
        padding: 10px;
        width: 300px;
        height: 40px;
        border: 1px solid white;
        border-radius: 10px;  
        }

        #submit
        {
           color: white;
           background-color: #f8a7c6; 
        }

        #input
        {
            background-color: #cc699b;
        }
    </style>
    </head>
    <body>

        <h1 align="center"> <b> SPP </b> ONLINE </h1>
        <form action="login_validasi.php" method="post"> 
        <fieldset>
        <?php
        if(isset($_GET['pesan'])){
            if($_GET['pesan']=="gagal"){
                echo "<div class='alert'>Username dan Password tidak sesuai !</div>";
            }
        }
        ?>
            <legend align="center"> <img src= "src/logostrawbarry.jpeg" width="89" height="89"> </legend>
            <table> 
                <p align="center"> <b> LOGIN </b>
                    <tr> <td> <input name="username" type="text" placeholder="Username" id="input"></td> </tr>
                    <tr> <td> <input name="password" type="password" placeholder="Password" id="input"> </td> </tr>

            </td> </tr>
                <tr></tr>
                <tr><td> <input name="login" type="submit" value="LOGIN" id="submit"></td></tr>
                <tr> <td> </tr></td>
                <tr><td> </tr></td>
                <tr><td align="center"><a href="bayar.php">CEK PEMBAYARAN</a></tr></td>
                </p>    
            </table>
        </fieldset>
        </form>
    </body>
</html>
