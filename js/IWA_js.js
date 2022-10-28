document.addEventListener('DOMContentLoaded', ()=>{

    const add_img_sell = document.querySelector('#add_img_sell');
    let nb_img = document.querySelectorAll('.img').length;

    remove_img_event();

    if ( add_img_sell ) {

        add_img_sell.onclick = (e) => {

            e.preventDefault();

            let frame;

            jQuery(function($){

                if ( frame ) {
                    frame.open();
                    return;
                }
                
                frame = wp.media({
                    title: 'Select or Upload Media Of Your Chosen Persuasion',
                    button: {
                    text: 'Use this media'
                    },
                    multiple: false 
                });
                
                frame.on( 'select', function() {

                    if ( document.querySelector('#have_img') == null ) {

                        let input_have_img = `
                        
                            <input type="text" class="hidden" id="have_img" name="have_img" value="${nb_img}" />

                        `;

                        document.querySelector('.img_champs .contains').innerHTML += input_have_img;

                    }
                    
                    let attachment = frame.state().get('selection').first().toJSON();
            
                    add_img(attachment.url,nb_img);
                    remove_img_event();

                    nb_img++;

                    console.log(nb_img);
                    document.querySelector('#have_img').value = nb_img;
                    console.log(document.querySelector('#have_img').setAttribute('value',nb_img));

                });
            
                frame.open();
                
            
            });

        }

    }

})

function remove_img_event () {

    let deleteImg = document.querySelectorAll('.deleteImg');

    console.log(deleteImg);

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