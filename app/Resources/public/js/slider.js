(function($){
    $.fn.slider = function(option){
    var $bandeau;
    var $imgList;
    var largeur;
    var hauteur;
    var settings;
    var position;
    var timer;


        var defaultSettings = {
            autoplay : true,
            autoplayDirection : 'rigth',
            controls : true,
            duration: 1000,
            displayTime:2000,
            caption: false
        };
       settings = $.extend(defaultSettings, option);

        //recuper les image
        $imgList = this.find('img'); // on recupere les img enfant

        if($imgList.length==0){
            return this;
        }

        //on calcule la hauteur et la largeur de la 1 ere image
        largeur = $imgList.first().width();
        hauteur = $imgList.first().height();

        //on modifi this
        this.addClass('slider_container');
        this.width(largeur);
        this.height(hauteur);

        // on vide le slider_container et on ajoute un div bandeau
        this.html('<div class="slider_bandeau"></div>');

        $bandeau = this.find('.slider_bandeau');
        $bandeau.width(3 * largeur);
        $bandeau.height(hauteur);
        $bandeau.css('left','-'+largeur+ 'px');




        //si autoplay set interval
        if(settings.autoplay){
             startTimer();
        }

        //affichage de control
        if(settings.controls){
            this.append('<div class="prev_btn"></div>');
            this.append('<div class="next_btn"></div>');
        }

        this.mouseenter(function (){
          $(this).find('.prev_btn').show('fast');
          $(this).find('.next_btn').show('fast');
            clearInterval(timer);
        }).mouseleave(function (){
            $(this).find('.prev_btn').hide('fast');
            $(this).find('.next_btn').hide('fast');
            startTimer();
        });

        this.on('click','.prev_btn', function () {
           slideToRight()
        });

        this.on('click','.next_btn', function () {
            slideToLeft()
        });

        // caption
        if(settings.caption){
            this.append('<div class="slider_caption"></div>')
        }


        // posssition a zero et build bandeau
        position = 0;
        buildBandeau(position);

        // fonction qui construis le bandeau en function de la position
        function buildBandeau(pos){
            var next;
            var prev;

            if (pos==0){
                next = 1;
                prev = $imgList.length -1;
            }else if(pos == $imgList.length -1){
                next = 0;
                prev = pos -1;
            }else{
                next = pos +1;
                prev = pos -1;
            }
            $bandeau.html('');
            $bandeau.css('left','-'+largeur+ 'px');
            $bandeau.append($imgList.eq(prev));// eq => equal permet de recuper l elment numero temps
            $bandeau.append($imgList.eq(pos));
            $bandeau.append($imgList.eq(next));
            if($imgList.eq(pos).attr('title')!=null &&
                $imgList.eq(pos).attr('title')!=""){
                $('.slider_caption').html($imgList.eq(pos).attr('title'));
                $('.slider_caption').show('fast');
            }else{
                $('.slider_caption').hide('fast')
            }
        }

        function slideToLeft(){
            position++;
            if(position==$imgList.length){
                position =0;
            }
            $bandeau.animate({'left':'-='+largeur},
                settings.duration,
                function(){
                    buildBandeau(position);
                });
        }

        function slideToRight(){
            position--;
            if(position==-1){
                position = $imgList.length -1;
            }
            $bandeau.animate({'left':'+='+largeur},
                settings.duration,
                function(){
                    buildBandeau(position);
                });

        }

        function startTimer(){
            timer =  setInterval(function () {
                if(settings.autoplayDirection == 'right'){
                    slideToRight();
                }else{
                    slideToLeft();
                }
            },settings.displayTime);
        }

        return this;
    };


}(jQuery));



