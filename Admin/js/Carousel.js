        let carousel_s_form = document.getElementById('carousel_s_form');
        let carousel_picture_inp = document.getElementById('carousel_picture_inp');      

        carousel_s_form.addEventListener('submit', function (event) {
            event.preventDefault();
            add_carousel();
        })

        function add_carousel() {
            let data = new FormData();       
            
            data.append('picture', carousel_picture_inp.files[0]);
            
            data.append('add_carousel', '');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/carousel_crud.php", true);

            xhr.onload = function () {
                var myModal = document.getElementById('carousel-s');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();
                if (this.responseText == 'inv_img') {
                    alert('error', 'Only JPG, JPEG, PNG and webp images are allowed!');
                }
                else if (this.responseText == 'inv_size') {
                    alert('error', 'Image should be less than 2MB!');
                }
                else if(this.responseText == 'upd_failed') {
                    alert('error', 'Image should be not uploaded');
                }
                else {
                    alert('success', 'New carousel added successfully');                    
                    carousel_picture_inp.value = '';
                    get_carousel();
                }
            }

            xhr.send(data);
        }

        function get_carousel(){
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/carousel_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
               document.getElementById('carousel-data').innerHTML = this.responseText;
            }

            xhr.send('get_carousel');
        }

        function remove_carousel(val){

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/carousel_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                if(this.responseText == 1){
                    alert('success', 'Carousel removed!');
                    get_carousel();
                }
                else{
                    alert('error','Server down!');
                }
            }

            xhr.send('remove_carousel='+val);
        }

        window.onload = function () {           
            get_carousel();
        }