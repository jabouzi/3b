<html>
<head>
<title><?=$title?></title>
</head>
<body>
<h1><?=$heading?></h1>


<ol>

<?php foreach($todo as $item):?>
<li><?=$item?></li>
<?php endforeach; ?>
</ol>

</body>
</html>
