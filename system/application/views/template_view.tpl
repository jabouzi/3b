<html>
<head>
<title>{$test.title}</title>
</head>
<body>
<h1>{$test.heading}</h1>


{foreach from=$test.todo item=todo}
 <li>{$todo}</li>
{/foreach}


</body>
</html>
