<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popcorn Chaos — Films au Hasard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Permanent+Marker&family=Nunito:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/popcornChaos/public/assets/css/style.css">
    <?php if (!empty($cssPage)) { ?>
        <link rel="stylesheet" href="<?= $cssPage ?>">
    <?php } ?>
</head>
<body>
<!-- Ambient sparks -->
<div class="sparks" aria-hidden="true">
    <div class="spark" style="left:8%;  height:80px;  background:var(--orange); animation-delay:0s;    animation-duration:3.8s;"></div>
    <div class="spark" style="left:22%; height:50px;  background:var(--green);  animation-delay:1.2s;  animation-duration:4.5s;"></div>
    <div class="spark" style="left:40%; height:100px; background:var(--yellow); animation-delay:0.5s;  animation-duration:3.2s;"></div>
    <div class="spark" style="left:55%; height:60px;  background:var(--purple); animation-delay:2s;    animation-duration:5s;"></div>
    <div class="spark" style="left:72%; height:90px;  background:var(--red);    animation-delay:0.8s;  animation-duration:4.1s;"></div>
    <div class="spark" style="left:88%; height:55px;  background:var(--green);  animation-delay:1.7s;  animation-duration:3.6s;"></div>
</div>
<?php include '../app/Views/layouts/header.php' ?>

<main>
    <?php include $content ?>
</main>
<?php include 'footer.php' ?>
</body>
</html>