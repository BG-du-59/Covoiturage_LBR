<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>maps</title>
</head>

<body style="background-color: #161920;">
        <h1 style="color:#BDE4FC;">maps</h1>
        <form class="mt-4" method="POST" action="">
            <label for="address" class="block">
                <h2 style="color:#BDE4FC;">adresse</h2>
                <input type="name" id="address" name="address" autocomplete="address"/>
            </label>
            <div class="mt-6">
                <button type="submit" name="submit">afficher
            </div>
        </form>
        </div>
    </div>
    <?php 
        if (isset($_POST['submit'])){
            $address = $_POST['address'];
            $addressGPS = str_replace(" ", "+", $address);
        ?>
        <iframe src="https://maps.google.com/maps?&q=<?php echo $addressGPS; ?>&output=embed "
            width="100%" height="500"
            ></idframe>
        <?php } ?>
</body>
</html>

