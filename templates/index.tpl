<!-- Page Content -->
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

{if isset($smarty.session.notification)}

    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-{$smarty.session.notification.result}" role="alert">
                {$smarty.session.notification.message}
            </div> 
        </div>
    </div>
{/if}


               
<div class="row">
        {foreach from=$listeArticle item=$article}
        <div class="col-md-6">
            <div class="card" style="">
                <img src="img/{$article->getId()}.jpg" class="card-img-top" alt="{$article->getTitre()}" >
                <div class="card-body">
                    <h5 class="card-title">{$article->getTitre()}</h5>
                    <p class="card-text">{substr($article->getTexte(), 0, 150)}</p>
                    <a href="#" class="btn btn-primary">{$article->getDate()}</a>
                    {if $utilisateurConnect->isConnect == true}
                    <a href="Article.php?p=action=edit&Id={$article->getId()}" class="btn btn-primary">Modifier</a>
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
                    {/if}
                </div>
            </div>
        </div>
        {/foreach}
</div>

<div class="row mt-3">
    <div class="col-lg-12">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                    {for $index=1 to $nbPages}
                    <li class="page-item {if ($page == $index)}active{/if}"><a class="page-link" href="index.php?p={$index}">{$index}</a></li>
                    {/for}
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
            </ul>
        </nav>
    </div>
</div>

