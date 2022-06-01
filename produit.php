<?php 
    /** 
     * Page produit
     * 
     * Cette page affiche le produit, ses photos, son prix, ses informations complémentaires et s'il sont en solde, leur réduction et leur nouveau prix .
     * 
     * @author     François Guillerm
     * @author     Alexis TOURRENC--LECERF
     * @author     Amandine Chantôme
    */
?>
<!DOCTYPE html>
<html>

<head lang="fr">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plushop|Magasin spécialisé dans la vente de peluche</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<!-- FORMAT DU FICHIER PRODUIT : référence/nom/description/prix/nouveauté/solde/stock/taille/marque/autre -->

<body>

    <?php
        include_once "php/chercher_produit.php";
        include_once "php/verif_isset_empty.php";
        include_once "php/open_file.php";
    ?>

    <?php include "header.php"; ?>

    <div class="container product">
        <div class="flexbox-contenu">

            <?php
                $id = $_GET['pdt']; // Cette instruction sert à récuperer l'élément dérrière le "pdt="
                verif_isset_empty($id, "page_erreur.php"); // S'il est vide on redirige vers la page d'erreur
                $id_tab = explode('-', $id); // On récupère un tableau contenant id sans "-"

                $csv = open_file("data/produits.csv", "csv", "page_erreur.php"); // On ouvre le fichier csv, s'il y a une erreur on redirige vers la page d'erreur

                $produit = chercher_produit($csv, $id); // On recherche le produit dans le csv
                if($produit == -1) { // Si le produit n'existe pas
                    
                    header("location: page_erreur.php"); // On redirige vers la page d'erreur
                }
            ?>

            <div id="produit">
                <section id="main" >

                    <div id="choix">
                        <?php
                            $i = 1;

                            while(file_exists("img/$id_tab[0]/$id_tab[1]/$id_tab[2]/$id-$i.jpg")) { // on vérifie que les images existent bien
                                echo("<div class='div-choix-image'><img src='img/$id_tab[0]/$id_tab[1]/$id_tab[2]/$id-$i.jpg' alt='img/$id_tab[0]/$id_tab[1]/$id_tab[2]/$id-$i' class='choix-image'></div>"); // on affiche les images sur le côté de l'image principale
                                $i++;
                            }
                        ?>
                    </div>

                    <div id="image">
                        <?php echo("<img src='img/$id_tab[0]/$id_tab[1]/$id_tab[2]/$id-1.jpg' alt='img/$id_tab[0]/$id_tab[1]/$id_tab[2]/$id-1.png' id='image-principale'>"); // on affiche l'image principale
                        ?> 
                    </div>

                    <div id="mainInfo">
                        <div class="infos">
                            <!-- ON AFFICHE LES INFORMATIONS DU PRODUIT  -->
                            <div class="nom"><?php echo($produit['nom']); ?><br></div>
                            <?php 
                                if(intval($produit['solde']) != 0){ // On teste si le produit est en solde
                                    $nv_prix = $produit['prix'] * (1-($produit['solde']/100)); // On créé le nouveau prix pour le produit
                                    echo("<div class='prix'>". "<i class='ancien_prix'>".$produit['prix'] ."€</i><i class='solde'>-". $produit['solde'] ."%</i></div>"); // On affiche l'ancien prix, puis la réduction du produit
                                    echo("<div class='nv_prix'>"  .  round($nv_prix, 2)  . "€</div>"); // On affiche le nouveau prix
                                    
                                }
                                else{ // Sinon
                                    echo("<div class='prix'>".$produit['prix']."€</div>"); // On affiche le prix
                                }
                            ?>
                            <!-- ON CRÉÉ UN FORMULAIRE POUR AJOUTER LE PRODUIT AU PANIER  -->
                            <form action="panier.php" method="post">
                                <input type="hidden" name="nom" value="<?php echo($produit['nom']); ?>" readonly>
                                <input type="hidden" name="prix" value="<?php echo($produit['prix']); ?> €" readonly>
                                <input type="hidden" name="solde" value="<?php echo($produit['solde']); ?>" readonly>
                                <input type="hidden" name="action" value="ajout" readonly><br>
                                Quantité:
                                <div id="zone-ajout-panier">
                                        <button type="button" id="modif-ajout" readonly>-</button>
                                        <input type="text" name="quantite" id="quantite" value="1" readonly>
                                        <button type="button" id="modif-ajout" readonly>+</button>
                                        <br><br>
                                </div>
                                <button type="submit" class="button-48" role="button" value="Ajouter au panier">Ajouter au panier</button>
                            </form>
                                <br>
                            <!-- ON AFFICHE LA DESCRIPTION DU PRODUIT  -->
                            <div id="description"><?php echo($produit['desc']); ?></div>
                        </div>
                    </div>

                </section>

                <section id="suppInfo">
                    <h2>Informations supplémentaires</h2>
                    <div>
                        Marque : <?php echo($produit['marque']); ?><br>
                        Dimensions : <?php echo($produit['dim']); ?><br>
                        Taille : <?php echo($produit['taille']); ?><br>
                    </div>
                </section>

                <!-- Nous avions pensé à mettre en place un système de suggestions mais n'avons pas eu le temps de le mettre en place -->
                <!-- <section id="sugg">
                    <h2>Suggestions</h2>
                    <div id="sugg-produits">
                        <img src="./img/monkey.jpg" alt="monkey">
                        <img src="./img/monkey.jpg" alt="monkey">
                        <img src="./img/monkey.jpg" alt="monkey">
                        <img src="./img/monkey.jpg" alt="monkey">
                        <img src="./img/monkey.jpg" alt="monkey">
                        <img src="./img/monkey.jpg" alt="monkey">
                    </div>
                </section> -->
            </div>
        </div>
    </div>
    
    <?php include "footer.php"; ?>

    <script src="./js/change_quantite.js?v=2"></script>
    <script src="./js/change_image_page_produit.js?v=2"></script>

</body>

</html>