$(function(){
        
    //avoiding conflicts with $
    $v = jQuery.noConflict();
    
    $v('.datetime').mask("99/99/9999 99:99",{placeholder:"dd/mm/yyyy hh:mm"});
    $v('.dateonly').mask("99/99/9999",{placeholder:"dd/mm/yyyy"});
    
    /* Search page tabs */
    $v('.tab-search').hide();
    $v('.tab-search').eq(0).show();
    $v('#nav-abas-search a').eq(0).addClass('selected');
    $v('#nav-abas-search a').click(function(i,e){
        $v('.tab-search').hide();
        $v('.tab-search').eq($v('#nav-abas-search a').index(this)).show();
        $v('#nav-abas-search a').removeClass('selected');
        $v(this).addClass('selected');
    });
    
    /*
     * Main Menu interaction
     */
    //ensure main options appearing when js is disabled
    $v('.sub-menu').hide();
    $v('.bt-menu').removeClass('has-submenu'); //makes display:block
    $v('.bt-menu i').show();
    //clicking when js is enabled
//    $v('.bt-menu').click(function(){
//            //reset 
//            $v('.bt-menu').removeClass('bt-menu-selected');
//            $v('.sub-menu').hide();
//            $v('.bt-menu i').fadeIn();
//            //is there any options for this?
//            if($v(this).prevAll('.sub-menu').length>0){
//                    //do the magic
//                    $v(this).addClass('bt-menu-selected');
//                    $v(this).prevAll('.sub-menu').fadeIn();
//                    $v(this).find('i').hide();
//            }
//    });
    
    /*
     * Fix image height on Ambiente page
     */
    var divW = $v('#mapa-ambiente').width();
    $v('#mapa-ambiente img').css('width',divW);
    var imgH = $v('#mapa-ambiente img').height();
    $v('#mapa-ambiente').css('height',imgH);
        
    /*
     * Ambiente editor
     */
    var isSelected = false;
    $v('#ambiente-pallet button').click(function(){
        isSelected = true;
        $v('#mapa-img').css('cursor','pointer');
    }); 
    
    $v('#mapa-img').click(function(e){
        if(isSelected){
           var mouseXY = [(e.pageX - $v(this).offset().left),(e.pageY - $v(this).offset().top)];
           $v('#mapa-ambiente')
           .append('<a class="localizacao" style="position:absolute;margin-left:' + (mouseXY[0]) + 'px; margin-top:' + (mouseXY[1]) + 'px" href="#" data-ratiox = "'+(mouseXY[0])/$v('#mapa-img').width()+'" data-ratioy = "'+(mouseXY[1])/$v('#mapa-img').height()+'"><i class="fa fa-map-marker"></i></a>');
           
           //add localizacao panel
            $v('#panel-location').fadeIn(); 
            
            $v.ajax({
                type:'POST',
                url:getBaseUrl()+'/equips/list/ajax',
                dataType:'json',
                cache:false,
                success:function(data){
                    var select = $v('#select-equip'), options = '';
                    select.empty();

                    for(var i=0; i<data.length; i++){
                        options += "<option value='"+data[i].id+"'>"+data[i].nome+"</option>";
                    }

                    select.append(options);
                }
            });
        }
        
    });
        
    $v(document).on('click', '#panel-location table .delete',function(event){
        if(confirm("Desvincular este equipamento?")){
            var rowIndex = $v('#panel-location table .delete').index(this);
            alert(rowIndex);
            var select = $v('#select-equip'), table = $v('#panel-location table');
            var selectedRow = table.find('tr').eq(rowIndex+1);
            var option = '';

            option = "<option value="+selectedRow.find('td').eq(0).text()+">"+selectedRow.find('td').eq(1).text()+"</option>";
            select.append(option);

            selectedRow.remove();
            
            // ORDENAR LISTA POR ORDEM ALFABÉTICA

        }
    });
    
    $v('#panel-location button#add-equip').click(function(){
        var select = $v('#panel-location select#select-equip');
        var table = $v('#panel-location table tbody');
        
        $v(table).append('<tr><td>'+select.val()+'</td><td>'+$v("#select-equip option:selected").text()+'</td><td><a href="#" class="delete"><i class="fa fa-remove"></i></a></td></tr>');
        $v("#select-equip option:selected").remove();
    });
    
    function ask_confirm(){
        return confirm('Deseja mesmo realizar esta operação?');
    }
    
    function getBaseUrl(){
        var pathArray = window.location.pathname.split('/');
        return (window.location.origin + pathArray[0] + '/' + pathArray[1]);
    }
    
    $v('#panel-location button#salvar').click(function(){
        var modeHid = $v("input[name='mode']").val();        
                        
        var table = $v('#panel-location table tbody');
        var idsEquips = [];
        table.find('tr').each(function(index,line){
            idsEquips[index] = $v(line).find('td').eq(0).text();
        });

        alert(idsEquips);

        if(modeHid != 'edit'){
            var ratioX, ratioY;
            ratioX = parseInt($v('#mapa-ambiente a').last().css('margin-left'))/$v('#mapa-img').width();
            ratioY = parseInt($v('#mapa-ambiente a').last().css('margin-top'))/$v('#mapa-img').height();
        }else{
            ratioY = null;
            ratioX = null;
        }
        
        var urlAjax = modeHid !== "edit" ? getBaseUrl()+'/admin/ambs/' + idAmb + '/locs/new/ajax' : getBaseUrl()+'/admin/ambs/' + idAmb + '/locs/edit/'+idLoc+'/ajax';
                
        $v.ajax({
            type:'POST',
            url:urlAjax,
            dataType:'json',
            cache:false,
            data:{'nome':$v('input#nome').val(),'descricao':$v('textarea#descricao_loc').val(),'equips':idsEquips,'ratioX':ratioX,'ratioY':ratioY},
            success:function(data){
                if(data == 1){
                    alert("Localização adicionada!");
                    $v('.dialog').hide();
                }
            }
        });
        
    });
    
    $v('#panel-location button#cancelar').click(function(){
        if(confirm("Deseja mesmo deletar esta nova localização?")){
            $v('#mapa-ambiente a').last().remove();
            $v('#panel-location').hide();
        }
    });
    
    //find mark on map
    $v(document).on('click','table#localizacoes i.fa-map-marker',function(e){
        //get id da localização
        var idLoc = e.target.id.substring(2);
        //set color no mapa
        $v("#mapa-ambiente a[id^='ml'] i").css('animation','none');
        
        $v('#mapa-ambiente a#ml'+idLoc+" i").css({
                animation:'markSelected 1s linear infinite'
                //textShadow:'1px 1px 5px #666'
        });
    });
    
    //rearranje markers when resize
    var resizeId;
    $v(window).resize(function(){
        //oldWidth = $v('#mapa-ambiente img').width();
        //oldHeight = $v('#mapa-ambiente img').height();
        clearTimeout(resizeId);
        resizeId = setTimeout(doneResizing, 500);        
    });
    
    function doneResizing(){
        
        /*
         * Fix image height on Ambiente page
         */
        var divW = $v('#mapa-ambiente').width();
        $v('#mapa-ambiente img').css('width',divW);
        var imgH = $v('#mapa-ambiente img').height();
        $v('#mapa-ambiente').css('height',imgH);
        
        $v('#mapa-ambiente a').each(function(i,a){    
            var x1 = ($v('#mapa-ambiente img').width())*(parseFloat($v(a).data('ratiox'))); //(l)*($v('#mapa-ambiente img').width())/oldWidth;
            var y1 = ($v('#mapa-ambiente img').height())*(parseFloat($v(a).data('ratioy')));//(t)*($v('#mapa-ambiente img').height())/oldHeight;

            $v(a).css("margin-left",x1+"px");
            $v(a).css("margin-top",y1+"px");
        });
        
    }
    
    doneResizing();
});

