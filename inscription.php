<?php
    include_once('db/connexiondb.php');

    if(!empty($_POST)){
        extract($_POST);
        $valid = (boolean) true;

        if(isset($_POST['inscription'])){
            $prénom = (String) trim($prénom);
            $nom = (String) trim($nom);
            $email = (String) trim($email);
            $genre = (String) trim($genre);
            $jour = (int) $jour;
            $mois = (int) $mois;
            $annee =  (int) $annee;
            $lieu_naissance = (int) $lieu_naissance;
            $date_naissance = (String) null;
            $adresse = (String) trim($adresse);
            $numero = (int) $numero;
            $code_postal = (int) $code_postal;
            $localite = (String) trim($localite);
            $pays = (String) trim($pays);
            $telephone = (int) $telephone;
            $gsm = (int) $gsm;
            $fax = (int) $fax;

                if(empty($prénom)){
                    $valid = false;
                    $err_prénom = "Veuillez renseigner ce champs!";
                }

                if(empty($nom)){
                    $valid = false;
                    $err_nom = "Veuillez renseigner ce champs!";
                }

                if(empty($email)){
                    $valid = false;
                    $err_email = "Veuillez renseigner ce champs!";
                }

                if(empty($genre)){
                    $valid = false;
                }

                if($jour <= 0 || $jour < 31){
                    $valid = false;
                    $err_jour = "Veuillez renseigner ce champs!";
                }

                if($mois <= 0 || $mois < 12){
                    $valid = false;
                    $err_mois = "Veuillez renseigner ce champs!";
                }

                if($annee <= 1960 || $annee < 2002){
                    $valid = false;
                    $err_annee = "Veuillez renseigner ce champs!";
                }

                if(!checkdate($mois, $jour, $annee)){
                    $valid = false;
                    $err_date="Date fausse";
                } else {
                    $date_naissance = $annee . '-' . $mois . '-' . $jour;
                }

                $verif_lieu = array(1, 2, 3);

                if(in_array($lieu_naissance, $verif_lieu)){
                    $valid = false;
                    $err_lieu = "Veuillez renseigner ce champs!";
                    }
                if(empty($adresse)){
                    $valid = false;
                    $err_adresse = "Veuillez renseigner ce champs!";
                }
                if(empty($numero)){
                    $valid = false;
                    $err_numero = "Veuillez renseigner ce champs!";
                }
                if(empty($code_postal)){
                    $valid = false;
                    $err_code_postal = "Veuillez renseigner ce champs!";
                }
                if(empty($localite)){
                    $valid = false;
                    $err_localite = "Veuillez renseigner ce champs!";
                }
                if(empty($pays)){
                    $valid = false;
                    $err_pays = "Veuillez renseigner ce champs!";

                if(empty($telephone)){
                    $valid = false;
                }
                if(empty($gsm)){
                    $valid = false;
                }
                if(empty($fax)){
                    $valid = false;
                }

                }
                if($valid) {
                    $date_inscription = date("Y-m-d");

                    $req = $BDD->prepare("INSERT INTO inscription(prénom, nom, email, genre, date_naissance, lieu_naissance, adresse, numero, code_postal, localite, pays, telephone, gsm, fax, date_inscription VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                    $req->execute(array($prénom, $nom, $email, $genre, $date_naissance, $lieu_naissance, $adresse, $numero, $code_postal, $localite, $pays, $telephone, $gsm, $fax, $date_inscription));
                    }
                }   
            }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
        <title>Inscription</title>
    </head>
    <body>
        <?php
            require_once('menu.php'); 
        ?>
        <h1>Inscription</h1>
        <form method="post">
            <section>
                <div>
                    <?php
                        if(isset($err_prénom)){
                            echo $err_prénom;                        
                        } 
                    ?>
                    <input type="text" name="prénom" placeholder="Prénom*">
                </div>
                <div>
                    <?php
                        if(isset($err_nom)){
                            echo $err_nom;                        
                        } 
                    ?>
                    <input type="text" name="nom" placeholder="Nom*">
                </div>
                <div>
                    <?php
                        if(isset($err_email)){
                            echo $err_email;                        
                        } 
                    ?>
                    <input type="text" name="email" placeholder="Adresse E-mail*">
                </div>
                <div>
                    <?php
                        if(isset($err_genre)){
                            echo $err_genre;                        
                        } 
                    ?>
                    <select name="genre">
                        <option style="display:none"></option>
                        <option value="2">Femme</option>
                        <option value="3">Homme</option>
                        <option value="4">Autre</option>
                    </select>
                </div>                
                <div>

                    <?php
                        if(isset($err_date)){
                            echo $err_date;                        
                        } 
                    ?>
                    <select name="jour">
                        <?php 
                            for($i = 1; $i<= 31; $i++){
                        ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <select name="mois">
                        <?php 
                            for($i = 1; $i<= 12; $i++){
                        ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <select name="annee">
                        <?php 
                            for($i = 1960; $i<= 2002; $i++){
                        ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>                
                <div>
                    <?php
                        if(isset($err_lieu)){
                            echo $err_lieu;                        
                        } 
                    ?>
                    <input type="text" name="lieu_naissance" placeholder="Lieu de naissance">
                </div>
                <div>
                    <?php
                        if(isset($err_adresse)){
                            echo $err_adresse;
                        }
                    ?>
                    <input type="text" name="adresse" placeholder="Adresse*">
                </div>
                <div>
                    <?php
                        if(isset($err_numero)){
                            echo $err_numero;
                        }
                    ?>
                    <input type="text" name="numero" placeholder="N°*">
                </div>
                <div>
                    <?php
                        if(isset($err_code_postal)){
                            echo $err_code_postal;
                        }
                    ?>
                    <input type="text" name="code_postal" placeholder="Code Postal*">
                </div>
                <div>
                    <?php
                        if(isset($err_localite)){
                            echo $err_localite;
                        }
                    ?>
                    <input type="text" name="localite" placeholder="Localité*">
                </div>
                <div>
                    <?php
                        if(isset($err_pays)){
                            echo $err_pays;
                        }
                    ?>
                    <input type="text" name="pays" placeholder="Pays">
                </div>
                <div>
                    <?php
                        if(isset($err_telephone)){
                            echo $err_telephone;
                        }
                    ?>
                    <input type="text" name="telephone" placeholder="Téléphone">
                </div>
                <div>
                    <?php
                        if(isset($err_gsm)){
                            echo $err_gsm;
                        }
                    ?>
                    <input type="text" name="gsm" placeholder="GSM">
                </div>
                <div>
                    <?php
                        if(isset($err_fax)){
                            echo $err_fax;
                        }
                    ?>
                    <input type="text" name="fax" placeholder="Fax">
                </div>
            </section>
            <input type="submit" name="inscription" value="S'inscrire">
            <input type="button" onclick="history.back()" value="Retour">
        </form>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </body>
</html>