<?php

    defined('ABSPATH') or die("nothing ;)");

    function meta_bien($post){
        $val = unserialize(get_post_meta($post->ID,'_info_sell',true));
        ?>
            <label for="name_sell">Nom du bien :</label>
            <input type="text" name="name_sell" id="name_sell" value='<?php if ( isset($val["name_sell"]) ) { echo $val["name_sell"]; } ?>'>
            <br><br>  
            <label for="desc_sell">Déscription du bien :</label><br>
            <?php wp_editor( $val['desc_sell'], "desc_sell" , array('textarea_name'=>'desc_sell') ); ?>
            <br><br>   
            <label for="price_sell">Prix du bien :</label>
            <input type="number" name="price_sell" id="price_sell" value='<?php if ( isset($val["price_sell"]) ) { echo $val["price_sell"]; } ?>'>

            <div class="img_champs">

                <h4>Images du carousel :</h4>

                <div class="contains">

                    <?php
                    
                        if ( $val["imgArray"] ) {

                            foreach($val["imgArray"] as $key => $value){
                                ?>
                                    <div class="img" src_attr="<?=$value?>">
                                        <img src="<?=$value?>" alt="" class="img_carousel_sell">
                                        <input type="text" class="hidden" name="img_carousel_<?=$key?>" value="<?=$value?>">
                                        <button type="button" class="deleteImg" dlt_attr="<?=$value?>">Supprimer</button>
                                    </div>
                                <?php
                            }
    
                            echo ' <input type="text" class="hidden" id="have_img" name="have_img" value="'.count($val["imgArray"]).'" />';

                        } else {

                            echo "Veuillez choisir des images";

                        }

                    ?>

                </div>

                <button id="add_img_sell">Ajouter une image</button>

            </div>

            <br><br>
            <label for="price_sell">Nombre de salle(s) de bain(s) :</label><br>
            <input type="number" name="nb_bath" id="nb_bath" value='<?php if ( isset($val["nb_bath"]) ) { echo $val["nb_bath"]; } ?>'>

            <br><br>
            <label for="price_sell">Nombre de chambre(s) :</label><br>
            <input type="number" name="nb_bedroom" id="nb_bedroom" value='<?php if ( isset($val["nb_bedroom"]) ) { echo $val["nb_bedroom"]; } ?>'>

            <br><br>
            <label for="price_sell">Surface en m2 :</label><br>
            <input type="number" name="surface" id="surface" value='<?php if ( isset($val["surface"]) ) { echo $val["surface"]; } ?>'>

            <div class="prestigeImg" style="margin-top: 30px;">
            
                <div class="first">
                    <label for="price_sell">Titre image prestige 1 :</label>
                    <input type="text" name="title_prestige_1" id="title_prestige_1" value='<?php if ( isset($val["prestige_1"]['title']) ) { echo $val["prestige_1"]['title']; } ?>'>
                    <input type="text" class="hidden" name="img_prestige_1" id="img_prestige_1" value="<?php if ( isset($val["prestige_1"]['img']) ) { echo $val["prestige_1"]['img']; } ?>">
                    <br><div class="apercu_1 apercu_prestige_img" style="margin-top: 15px;">
                    <?php if ( isset($val["prestige_1"]['img']) ) { ?>
                            <img src="<?=$val["prestige_1"]['img']?>" alt="">
                        <?php } ?>
                    </div>
                    <button id="add_img_prestige_1">Ajouter l'image</button>
                </div>

                <div class="second">
                    <label for="price_sell">Titre image prestige 2 :</label>
                    <input type="text" name="title_prestige_2" id="title_prestige_2" value='<?php if ( isset($val["prestige_2"]['title']) ) { echo $val["prestige_2"]['title']; } ?>'>
                    <input type="text" class="hidden" name="img_prestige_2" id="img_prestige_2" value="<?php if ( isset($val["prestige_2"]['img']) ) { echo $val["prestige_2"]['img']; } ?>">
                    <br><div class="apercu_2 apercu_prestige_img" style="margin-top: 15px;">
                        <?php if ( isset($val["prestige_2"]['img']) ) { ?>
                            <img src="<?=$val["prestige_2"]['img']?>" alt="">
                        <?php } ?>
                    </div>
                    <button id="add_img_prestige_2">Ajouter l'image</button>
                </div>

            </div>

        <?php
    }

    function init_metabox(){

        add_meta_box('info_bien_loc', 'Les informations du biens', 'meta_bien', 'loc');
        add_meta_box('info_bien_sell', 'Les informations du biens', 'meta_bien', 'sell');

    }

    function save_metabox($post_id){

        $unserializeArray = [

            "imgArray" => [],
            "name_sell" => false,
            "desc_sell" => false,
            "price_sell" => false,
            "nb_bath" => false,
            "nb_bedroom" => false,
            "surface" => false,
            "prestige_1" => [
                "title" => false,
                "img" => false
            ],
            "prestige_2" => [
                "title" => false,
                "img" => false
            ]

        ];

        if (isset($_POST['have_img'])) {

            $i = $_POST['have_img'] - 1;

            for ( $i; $i >= 0; $i-- ) {

                if (isset($_POST['img_carousel_'.$i])) {

                    $unserializeArray["imgArray"][$i] = $_POST['img_carousel_'.$i];

                }

            }

        }

        if(isset($_POST['name_sell'])) {

            $unserializeArray["name_sell"] = $_POST['name_sell'];
            $unserializeArray["desc_sell"] = $_POST['desc_sell'];
            $unserializeArray["price_sell"] = $_POST['price_sell'];
            $unserializeArray["nb_bath"] = $_POST['nb_bath'];
            $unserializeArray["nb_bedroom"] = $_POST['nb_bedroom'];
            $unserializeArray["surface"] = $_POST['surface'];
            $unserializeArray["prestige_1"] = [
                "title" => $_POST['title_prestige_1'],
                "img" => $_POST['img_prestige_1']
            ];
            $unserializeArray["prestige_2"] = [
                "title" => $_POST['title_prestige_2'],
                "img" => $_POST['img_prestige_2']
            ];

            $add_value = serialize($unserializeArray);
            update_post_meta($post_id, '_info_sell', $add_value);

        }

    }

    add_action('add_meta_boxes','init_metabox');
    add_action('save_post','save_metabox');