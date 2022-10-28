<?php

    defined('ABSPATH') or die("nothing ;)");

    function meta_bien($post){
        $val = unserialize(get_post_meta($post->ID,'_info_sell',true));

        $img = unserialize(get_post_meta($post->ID,'_sell_carousel',true));
        ?>
            <label for="name_sell">Nom du bien :</label>
            <input type="text" name="name_sell" id="name_sell" value='<?=$val[0]?>'>
            <br><br>    
            <label for="price_sell">Prix du bien :</label>
            <input type="number" name="price_sell" id="price_sell" value='<?=$val[1]?>'>

            <div class="img_champs">

                <h4>Images du carousel :</h4>

                <div class="contains">

                    <?php
                    
                        if ( $img ) {

                            foreach($img as $key => $value){
                                ?>
                                    <div class="img" src_attr="<?=$value?>">
                                        <img src="<?=$value?>" alt="" class="img_carousel_sell">
                                        <input type="text" class="hidden" name="img_carousel_<?=$key?>" value="<?=$value?>">
                                        <button type="button" class="deleteImg" dlt_attr="<?=$value?>">Supprimer</button>
                                    </div>
                                <?php
                            }
    
                            echo ' <input type="text" class="hidden" id="have_img" name="have_img" value="'.count($img).'" />';

                        } else {

                            echo "Veuillez choisir des images";

                        }

                    ?>

                </div>

                <button id="add_img_sell">Ajouter une image</button>

            </div>

        <?php
    }

    function init_metabox(){

        add_meta_box('info_bien_loc', 'Les informations du biens', 'meta_bien', 'loc');
        add_meta_box('info_bien_sell', 'Les informations du biens', 'meta_bien', 'sell');

    }

    function save_metabox($post_id){

        if (isset($_POST['have_img'])) {

            $array_img = array();
            $i = $_POST['have_img'] - 1;

            for ( $i; $i >= 0; $i-- ) {

                if (isset($_POST['img_carousel_'.$i])) {

                    $array_img[$i] = $_POST['img_carousel_'.$i];

                }

            }

            update_post_meta($post_id, '_sell_carousel', serialize($array_img));

        }

        if(isset($_POST['name_sell'])) {

            $add_value = serialize([$_POST['name_sell'],$_POST['price_sell']]);
            update_post_meta($post_id, '_info_sell', $add_value);

        }

    }

    add_action('add_meta_boxes','init_metabox');
    add_action('save_post','save_metabox');