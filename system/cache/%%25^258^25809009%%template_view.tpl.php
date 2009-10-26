<?php /* Smarty version 2.6.22, created on 2009-06-04 14:47:06
         compiled from template_view.tpl */ ?>
<html>
<head>
<title><?php echo $this->_tpl_vars['test']['title']; ?>
</title>
</head>
<body>
<h1><?php echo $this->_tpl_vars['test']['heading']; ?>
</h1>


<?php $_from = $this->_tpl_vars['test']['todo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['todo']):
?>
 <li><?php echo $this->_tpl_vars['todo']; ?>
</li>
<?php endforeach; endif; unset($_from); ?>


</body>
</html>