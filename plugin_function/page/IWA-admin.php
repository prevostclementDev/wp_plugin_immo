<?php
       
       defined('ABSPATH') or die("nothing ;)");

       function generate_reservation_iwa_page(){

            $option = unserialize(get_option('reservation'));

            if ( isset($_GET['deleteReservation']) && isset($_GET['email']) ) {

                foreach($option as $key => $reservation) {

                    if ( $reservation['post_id'] == $_GET['deleteReservation'] && $reservation['email'] == $_GET['email'] ) {

                        unset($option[$key]);

                    }

                }

                update_option('reservation', serialize($option));
                wp_redirect( get_site_url().'/wp-admin/admin.php?page=reservation' ); 
                exit();
            }

            echo '<h1> Les réservations </h1><hr>';

            if ( $option == false || count($option) == 0 ) {

                echo "<h2>Pas de réservation</h2>";

            } else {

            ?>
            
                <div class="containerReservation">
                    <?php
                    
                        foreach($option as $reservation) {

                            $value_bien = unserialize(get_post_meta($reservation['post_id'],'_info_sell',true));

                            ?>

                            <div class="reservation">
                                <img src="<?= $value_bien['prestige_1']['img'] ?>" alt="">
                                <p class="nomDuBien"><?= $value_bien['name_sell'] ?></p>
                                <p class="date"><?= $reservation['date'] ?></p>
                                <p class="clientName"><?= $reservation['nom'] ?></p>
                                <p class="clientMail"><?= $reservation['email'] ?></p>
                                <a href="?page=reservation&deleteReservation=<?= $reservation['post_id']."&email=".$reservation['email'] ?>">Supprimer</a>
                            </div>

                            <?php

                        }

                    ?>
                </div>

            <?php

            }

        }