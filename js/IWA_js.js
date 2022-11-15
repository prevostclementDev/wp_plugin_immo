jQuery(function($) {

    const add_img_sell = document.querySelector('#add_img_sell');
    const add_img_prestige_1 = document.querySelector('#add_img_prestige_1');
    const add_img_prestige_2 = document.querySelector('#add_img_prestige_2');
    let nb_img = document.querySelectorAll('.img').length;
    let open_by = "";
    let prestige_number = "";

    remove_img_event();

    let frame;

    frame = wp.media({
        title: 'Select or Upload Media Of Your Chosen Persuasion',
        button: {
        text: 'Use this media'
        },
        multiple: false 
    });
    
    frame.on( 'select', function() {

        let attachment = frame.state().get('selection').first().toJSON();
        
        if ( open_by == "add_img_sell" ) {

            if ( document.querySelector('#have_img') == null ) {

                let input_have_img = `
                
                    <input type="text" class="hidden" id="have_img" name="have_img" value="${nb_img}" />
    
                `;
    
                document.querySelector('.img_champs .contains').innerHTML += input_have_img;
    
            }
    
            add_img(attachment.url,nb_img);
            remove_img_event();
    
            nb_img++;
    
            document.querySelector('#have_img').value = nb_img;

        }

        if ( open_by == "add_img_prestige" ) {

            document.querySelector('#img_prestige_'+prestige_number).value = attachment.url;
            document.querySelector('.apercu_'+prestige_number).innerHTML = `<img src='${attachment.url}' alt=''>`;

        }

    });

    if ( add_img_sell ) {

        add_img_sell.onclick = (e) => {

            open_by = "add_img_sell";

            e.preventDefault();
            frame.open();

        }

    }

    if ( add_img_prestige_1 ) {

        add_img_prestige_1.onclick = (e) => {

            open_by = "add_img_prestige";
            prestige_number = "1";

            e.preventDefault();
            frame.open();

        }

    }

    if ( add_img_prestige_2 ) {

        add_img_prestige_2.onclick = (e) => {

            open_by = "add_img_prestige";
            prestige_number = "2";

            e.preventDefault();
            frame.open();

        }

    }

    function remove_img_event () {

        let deleteImg = document.querySelectorAll('.deleteImg');

        deleteImg.forEach( (e) => {

            e.onclick = (e) => {

                e.preventDefault();

                let src = e.target.getAttribute('dlt_attr');
                let img = document.querySelector(`.img[src_attr="${src}"]`);
                img.remove();

            }


        })

    }

    function add_img (url,nb_img) {

        const contains_img_champs = document.querySelector('.img_champs .contains');

        previous = `
                        
            <div class="img" src_attr="${url}">
                <button class="deleteImg" dlt_attr="${url}">Supprimer</button>
                <img src="${url}" alt="" class="img_carousel_sell">
                <input type="text" class="hidden" id="img_carousel_${nb_img}" name="img_carousel_${nb_img}" value="${url}" />
            </div>

        `;
                
        contains_img_champs.innerHTML += previous;

    }

});