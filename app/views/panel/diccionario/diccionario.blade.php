@extends('panel.layouts.base')

@section('content')

<article class="col-xs-12 col-sm-offset-3 col-sm-6 col-sm-offset-3 col-md-offset-3 col-md-6 col-md-offset-3 space_top_3">

    <div class="mdl-card__title">
        <h2 class="title-1">Diccionario</h2><br/>
    </div>

    {{Form::open(array('method' => 'GET', 'url' => '/panel/busca_trad/get', 'role' => 'form'))}}
    <div class="row">
        @if($tipo != null)

        @if($tipo == 1) 
        <div class="col-xs-offset-1 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-8 col-sm-offset-2 col-md-offset-3 col-md-6 col-md-offsetmd" style="text-align: center; padding-bottom: 20px;">
            <div style="display: inline-block;padding-right: 50px;">
                {{Form::radio('tipo', 1, true, array('class' => 'form-control'))}}
                <span style=" font-weight: bold!important;">Español</span>
            </div>
            <div style="display: inline-block;">
                {{Form::radio('tipo', 0, false, array('class' => 'form-control'))}}
                <span style=" font-weight: bold!important;">Aymara</span>
            </div>
        </div>
        @else
        <div class="col-xs-offset-1 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-8 col-sm-offset-2 col-md-offset-3 col-md-6 col-md-offsetmd" style="text-align: center; padding-bottom: 20px;">
            <div style="display: inline-block;padding-right: 50px;">
                {{Form::radio('tipo', 1, true, array('class' => 'form-control'))}}
                <span style=" font-weight: bold!important;">Español</span>
            </div>
            <div style="display: inline-block;">
                {{Form::radio('tipo', 0, false, array('class' => 'form-control'))}}
                <span style=" font-weight: bold!important;">Aymara</span>
            </div>
        </div>
        @endif

        @else
        <div class="col-xs-offset-1 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-8 col-sm-offset-2 col-md-offset-3 col-md-6 col-md-offsetmd" style="text-align: center; padding-bottom: 20px;">
            <div style="display: inline-block;padding-right: 50px;">
                {{Form::radio('tipo', 1, true, array('class' => 'form-control'))}}
                <span style=" font-weight: bold!important;">Español</span>
            </div>
            <div style="display: inline-block;">
                {{Form::radio('tipo', 0, false, array('class' => 'form-control'))}}
                <span style=" font-weight: bold!important;">Aymara</span>
            </div>
        </div>
        @endif

    </div>
    <div class="form-group">
       {{-- {{Form::label('Palabra:')}} --}}
       {{Form::text('palabra', '', array('id' => 'pal_busc','class' => 'form-control ', 'placeholder' => 'Introdúzca palabra a buscar'))}}
       <span class="help-block">{{ $errors->first('palabra') }}</span>
   </div>

{{-- <div class="form-group">
	<p>{{Form::submit('Buscar', array('class' => 'btn btn-default'))}}</p>
</div> --}}

{{Form::close()}}

</article>
<article class="col-xs-12 col-sm-offset-3 col-sm-6 col-sm-offset-3 col-md-offset-3 col-md-6 col-md-offset-3">
    <div class="demo-card-wide mdl-card mdl-shadow--2dp">
        <div class="loader">
         <center>
             {{-- <img class="loading-image" src="{{ URL::asset('img/otros/712.gif') }}" alt="loading.."> --}}
             <div id="p2" class="mdl-progress mdl-js-progress mdl-progress__indeterminate" style="margin: 20px 0;"></div>   
         </center>
        </div>
        <div id = "hits_S">
            {{--*/ $i = 0 /*--}}
            @foreach(Espapal::orderBy('palabra', 'asc')->get() as $objpalabra)

            <div class="container-2 color-text-1 padding-top-20 padding-box-1 border_abajo">

                <span class='mdl-card__title-text'>{{ $objpalabra->palabra }}</span><br />

                <span class='audio' onmouseover="PlaySound('miSon_{{ $i }}')" 
                onmouseout="StopSound('miSon_{{ $i }}')"><img src='{{ URL::asset("img/otros/speaker.png") }}' width="30" height="30"><audio id="miSon_{{ $i }}" src="{{ asset($objpalabra->aymapal()->getResults()->audio_src) }}"></audio></span>

                <span class='mdl-card__supporting-text-1'>{{ $objpalabra->aymapal()->getResults()->palabra }}</span>
                <div class="image"><img src='{{ asset($objpalabra->aymapal()->getResults()->imagen_src) }}' width="70" height="70"></div>
                {{--*/ $i++ /*--}}        

            </div>
            @endforeach
        </div>
</div>
</article>


<script type="text/javascript">
    $('.loader').hide();


    $( "#pal_busc" ).keyup(function() {

        var tipo = $('input[name=tipo]:checked').val();
        var palabra = $("#pal_busc").val();

        $.ajax({
            type: "GET",
            url: "{{ URL::to('/panel/ajax_busca_palabra') }}",
            dataType: "json",
            data: {
                "tipo" : tipo,
                "palabra" : palabra         
            },
            success: function(data){
                console.log(data);

                $("div.container-2").remove();
                $("div.image").remove();
                $("span.audio").remove();
                $("div.border_abajo").remove();
                $("span.audio_1").remove();
                $("span.palabra_1").remove();
                $("span.mdl-card__supporting-text-2").remove();
                
                for (var i = 0; i < data.hits.length; i++) {

                    
                    $("#hits_S").append("<div class='container-2 container-2_ancho color-text-1 padding-top-_20 padding-box-1' style='padding-top:0px!important;'><span class='palabra_1 mdl-card__title-text'>"+data.hits[i].palabra.palabra+"</span>");

                    $("#hits_S").append("<span  class='mdl-card__supporting-text-2'>"+data.hits[i].traduccion.palabra+"</span>");
                    
                    if(data.tipo == "0")
                    {
                        $("#hits_S").append("<span class='audio_1' onmouseover = 'PlaySound("+'"miSon_'+i+'"'+")' onmouseout = 'StopSound("+'"miSon_'+i+'"'+")'><img src='{{ URL::asset('img/otros/speaker.png') }}' width='30' height='30'/><audio id='miSon_"+i+"' src='{{ asset('"+data.hits[i].palabra.audio_src+"') }}'></audio></span>");

                        $("#hits_S").append("<div class='image'><img class='img_img' src='{{ asset('"+data.hits[i].palabra.imagen_src+"') }}'/></div>");

                    }

                    if(data.tipo == "1")
                    {
                        $("#hits_S").append("<span class='audio_1' onmouseover = 'PlaySound("+'"miSon_'+i+'_'+0+'"'+")' onmouseout = 'StopSound("+'"miSon_'+i+'_'+0+'"'+")'><img src='{{ URL::asset('img/otros/speaker.png') }}' width='30' height='30'/><audio id='miSon_"+i+"_"+0+"' src='{{ asset('"+data.hits[i].traduccion.audio_src+"') }}'></audio></span>");

                        $("#hits_S").append("<div class='image'><img class='img_img' src='{{ asset('"+data.hits[i].traduccion.imagen_src+"') }}'/></div>");
                    }
                    $("#hits_S").append("<div class='border_abajo' style='width:80%!important;margin: 0px auto!important'>");   
                }

            },
            beforeSend: function(){
                $('.loader').show()
            },
            complete: function(){
                $('.loader').hide();
            },
            failure: function(errMsg) {
            //alert(errMsg);
            console.log(errMsg);
        }

    });

    });

    $('input[type=radio][name=tipo]').on('change', function() {
       $("#pal_busc").val("");
       var tipo;

       switch($(this).val()) {
           case '1':
           tipo = $('input[name=tipo]:checked').val();
           break;
           case '0':
           tipo = $('input[name=tipo]:checked').val();
           break;
       }

       $.ajax({
        type: "GET",
        url: "{{ URL::to('/panel/ajax_tipo_palabra') }}",
        dataType: "json",
        data: {
            "tipo" : tipo       
        },
        success: function(data){
            console.log(data);
            
            $("div.container-2").remove();
            $("div.image").remove();
            $("span.audio").remove();
            $("div.border_abajo").remove();
            $("span.audio_1").remove();
            $("span.palabra_1").remove();
            $("span.mdl-card__supporting-text-2").remove();


            for (var i = 0; i < data.hits.length; i++) {

                $("#hits_S").append("<div class='container-2 container-2_ancho color-text-1 padding-top-_20 padding-box-1'><span class='palabra_1 mdl-card__title-text'>"+data.hits[i].palabra.palabra+"</span>");

                $("#hits_S").append("<span  class='mdl-card__supporting-text-2'>"+data.hits[i].traduccion.palabra+"</span>");

                if(data.tipo == "0")
                {

                    $("#hits_S").append("<span class='audio_1' onmouseover = 'PlaySound("+'"miSon_'+i+'"'+")' onmouseout = 'StopSound("+'"miSon_'+i+'"'+")'><img src='{{ URL::asset('img/otros/speaker.png') }}' width='30' height='30'/><audio id='miSon_"+i+"' src='{{ asset('"+data.hits[i].palabra.audio_src+"') }}'></audio></span>");

                    $("#hits_S").append("<div class='image'><img class='img_img' src='{{ asset('"+data.hits[i].palabra.imagen_src+"') }}'/></div>");

                }

                if(data.tipo == "1")
                {
                    $("#hits_S").append("<span class='audio_1' onmouseover = 'PlaySound("+'"miSon_'+i+'_'+0+'"'+")' onmouseout = 'StopSound("+'"miSon_'+i+'_'+0+'"'+")'><img src='{{ URL::asset('img/otros/speaker.png') }}' width='30' height='30'/><audio id='miSon_"+i+"_"+0+"' src='{{ asset('"+data.hits[i].traduccion.audio_src+"') }}'></audio></span>");

                    $("#hits_S").append("<div class='image'><img class='img_img' src='{{ asset('"+data.hits[i].traduccion.imagen_src+"') }}'/></div>");
                }
                $("#hits_S").append("<div class='border_abajo' style='width:80%!important; margin: 0px auto!important'>");    
            }
            
        },
        beforeSend: function(){
            $('.loader').show();
        },
        complete: function(){
            $('.loader').hide();
        },
        failure: function(errMsg) {
            //alert(errMsg);
            console.log(errMsg);
        }

    });

   });


    function PlaySound(soundobj) {
        console.log(soundobj);
        var thissound=document.getElementById(soundobj);
        thissound.play();
    }

    function StopSound(soundobj) {
        console.log(soundobj);
        var thissound=document.getElementById(soundobj);
        thissound.pause();
        thissound.currentTime = 0;
    }

</script>	

@stop