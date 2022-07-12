<html>
    <head>
        <title>Kasir</title>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </head>
    <body>

        <div class="mt-4 text-center">
            <h2>Pembayaran</h2>
        </div>
        
        <br>
        <?php
            $a="Keranjang 1";
            $b="Keranjang 2";
        ?>

        <div class="mt-4 text-center">
            <a href="pembayaran.php?keranjang=keranjang_1&atas=<?=$a?>"><button class="btn btn-primary" type="Submit">Keranjang 1</button></a>
            <a href="pembayaran.php?keranjang=keranjang_2&atas=<?=$b?>"><button class="btn btn-primary" type="Submit">Keranjang 2</button></a>
        </div>

        
        
    </body>
</html>