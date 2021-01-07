<?php
/* Smarty version 3.1.34-dev-7, created on 2021-01-01 17:08:03
  from 'D:\work\wamp\www\Projet 1\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5fef56f3272766_75383809',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f80b428823f6c2d7483e269d52dc3118392172f9' => 
    array (
      0 => 'D:\\work\\wamp\\www\\Projet 1\\templates\\index.tpl',
      1 => 1609520881,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fef56f3272766_75383809 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center mt-5">
            <form class="form-inline" id="rechercheForm" method="GET" action="recherche.php" >
                <label class="sr-only" for="recherche">Recherche</label>
                <input type="text" class="form-control mb-2 mr-sm-2 " id="recherche" name="recherche" placeholder="Rechercher un article" value="">
                <button type="submit" class="btn btn-primary mb-2" name="submitRecherche">Rechercher</button>
            </form>
        </div>
    </div>
</div>  

<div class="row">
    <div class="col-lg-12 text-center">
        <h1 class="mt-5">Page d'accueil</h1>
        <p class="lead">Complete with pre-defined file paths and responsive navigation!</p>
        <ul class="list-unstyled">
            <li>Bootstrap</li>
            <li>jQuery 3.5.1</li>
        </ul>
    </div>
</div>

<?php if ((isset($_SESSION['notification']))) {?>

    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-<?php echo $_SESSION['notification']['result'];?>
" role="alert">
                <?php echo $_SESSION['notification']['message'];?>

            </div> 
        </div>
    </div>
<?php }?>


               
<div class="row">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['listeArticle']->value, 'article');
$_smarty_tpl->tpl_vars['article']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['article']->value) {
$_smarty_tpl->tpl_vars['article']->do_else = false;
?>
        <div class="col-md-6">
            <div class="card" style="">
                <img src="img/<?php echo $_smarty_tpl->tpl_vars['article']->value->getId();?>
.jpg" class="card-img-top" alt="<?php echo $_smarty_tpl->tpl_vars['article']->value->getTitre();?>
" >
                <div class="card-body">
                    <h5 class="card-title"><?php echo $_smarty_tpl->tpl_vars['article']->value->getTitre();?>
</h5>
                    <p class="card-text"><?php echo substr($_smarty_tpl->tpl_vars['article']->value->getTexte(),0,150);?>
</p>
                    <a href="#" class="btn btn-primary"><?php echo $_smarty_tpl->tpl_vars['article']->value->getDate();?>
</a>
                    <?php if ($_smarty_tpl->tpl_vars['utilisateurConnect']->value->isConnect == true) {?>
                    <a href="Article.php?p=action=edit&Id=<?php echo $_smarty_tpl->tpl_vars['article']->value->getId();?>
" class="btn btn-primary">Modifier</a>
                    <div class="col-md-12">
                    <form id="articleForm" method="POST" action="Comment.php" enctype="multipart/form-data">
                    <div class="col-lg-12">
                    <div class="form-group">
                        <label for="nom">Commentaire:</label>
                        <input type="text" class="form-control" id="message" name="message"  placeholder="" required>
                    </div>
                </div>
                <div class="col-lg-12">
                    <button type="submit" id="submit" name="submit" class="btn btn-primary">Créer mon Commentaire</button>
                </div>
            </form>
        </div>
                    <?php }?>
                </div>
            </div>
        </div>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</div>

<div class="row mt-3">
    <div class="col-lg-12">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                    <?php
$_smarty_tpl->tpl_vars['index'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['index']->step = 1;$_smarty_tpl->tpl_vars['index']->total = (int) ceil(($_smarty_tpl->tpl_vars['index']->step > 0 ? $_smarty_tpl->tpl_vars['nbPages']->value+1 - (1) : 1-($_smarty_tpl->tpl_vars['nbPages']->value)+1)/abs($_smarty_tpl->tpl_vars['index']->step));
if ($_smarty_tpl->tpl_vars['index']->total > 0) {
for ($_smarty_tpl->tpl_vars['index']->value = 1, $_smarty_tpl->tpl_vars['index']->iteration = 1;$_smarty_tpl->tpl_vars['index']->iteration <= $_smarty_tpl->tpl_vars['index']->total;$_smarty_tpl->tpl_vars['index']->value += $_smarty_tpl->tpl_vars['index']->step, $_smarty_tpl->tpl_vars['index']->iteration++) {
$_smarty_tpl->tpl_vars['index']->first = $_smarty_tpl->tpl_vars['index']->iteration === 1;$_smarty_tpl->tpl_vars['index']->last = $_smarty_tpl->tpl_vars['index']->iteration === $_smarty_tpl->tpl_vars['index']->total;?>
                    <li class="page-item <?php if (($_smarty_tpl->tpl_vars['page']->value == $_smarty_tpl->tpl_vars['index']->value)) {?>active<?php }?>"><a class="page-link" href="index.php?p=<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['index']->value;?>
</a></li>
                    <?php }
}
?>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
            </ul>
        </nav>
    </div>
</div>

<?php }
}
