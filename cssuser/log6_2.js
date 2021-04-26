
function wtslog6(alias,dbn,obj,event_name,event_conversion,event_invisibility){


   if (typeof window.wtsh == 'undefined'){
      var wtsh = {};
   }
   else {
       var wtsh = window.wtsh;
   }

   if (event_name){

      if (event_name.length > 255){
         event_name = event_name.substring(0,255);
      }
      event_name = event_name.replace(/^\s+|\s+$/g, '');
      var page_name = 'wts_evt_'+event_name;
      var page_group = 'wts_evt_'+event_name;
      var invisible = event_invisibility;
      var text_counter = 'event';
      var conv_n = event_conversion || '';
   }
   else {
      if (wtsh['invisible']=='#'){wtsh['invisible']='';}
      if (wtsh['page_name']=='#'){wtsh['page_name']='';}
      if (wtsh['page_group']=='#'){wtsh['page_group']='';}
      if (wtsh['conversion_number']=='#'){wtsh['conversion_number']='';}
      if (wtsh['text_counter']=='#'){wtsh['text_counter']='';}

      if (wtsh['page_name']=='#'){wtsh['page_name']='';}
      var page_name = wtsh['page_name'] ? wtsh['page_name'] : '';
      if (page_name){
         if (page_name.length > 255){
             page_name = page_name.substring(0,255);
         }
         page_name = page_name.replace(/^\s+|\s+$/g, '');
      }

      var page_group = wtsh['page_group'] ? wtsh['page_group'] : '';
      if (page_group){
         if (page_group.length > 255){
             page_group = page_group.substring(0,255);
         }
         page_group = page_group.replace(/^\s+|\s+$/g, '');
      }

      var conv_n = wtsh['conversion_number'] ? wtsh['conversion_number'] : '';

      var invisible = wtsh['invisible'] ? window.wtsh['invisible'] : '';

      var text_counter = wtsh['text_counter'] ? wtsh['text_counter'] : '';
      if (text_counter){
         text_counter = text_counter.replace(/^\s+|\s+$/g, '');
         if (text_counter != 'yes' && text_counter != 'no'){
            text_counter = 'no';
         }
      }
   }


   if (conv_n){
      if (conv_n.match(/\D/)){
         conv_n = 1;
      }
      else if (conv_n > 5){
         conv_n = 1;
      }
   }

   if (invisible){
      invisible = invisible.toLowerCase();
      invisible = invisible.replace(/^\s+|\s+$/g, '');
      if (invisible != 'yes' && invisible != 'no'){
         invisible = 'yes';
      }
   }


//   try{var wtsb=top.document;var wtsr=wtsb.referrer;var wtsu=document.URL;}
//   catch(e){var wtsb=document;var wtsr=wtsb.referrer;var wtsu=wtsb.URL;}

   var wtsu = '';
   var wtsr = '';

   if (event_name){
      wtsu = page_name;
   }
   else if (wtsh['custom'] == 'wix'){

      wtsu = wtsh['url'];

      if (! wtsh['referer'] || wtsh['referer'] == 'wix_none'){
         wtsr = '';
      }
      else if (wtsh['referer']){
         wtsr = wtsh['referer'];
      }

   }
   else {
      try{
         var wtsb=top.document;
         wtsr=wtsb.referrer;
         wtsu=document.URL;
      }
      catch(e){
         var wtsb=document;
         wtsr=wtsb.referrer;
         wtsu=wtsb.URL;
      }

      if (wtsr){
         if (wtsr.length > 510){
             wtsr = wtsr.substring(0,510);
         }
      }
      if (wtsu){
         if (wtsu.length > 255){
             wtsu = wtsu.substring(0,255);
         }
      }
   }

//   if (wtsh['url']){
//      wtsu = wtsh['url'];
//   }


   var test = 1;
   if (event_name){
      test = 0;
   }

   //////////////////////////// BUILD QUERY

   // wtsu and wtsr ar JS-generated and thus already URI-encoded

   wtsu = wtsu.replace(/::/g, '_2cln_');
   wtsr = wtsr.replace(/::/g, '_2cln_');

   if (event_name){
      page_name = 'event_'+page_name;
   }

   var prefix = 'https:' == document.location.protocol ? 'https://server2.web-stat.com' : 'http://server2.web-stat.com';

   var qry= alias+'::'+dbn+'::'+wtsr+'::'+invisible+'::'+text_counter+'::'+screen.width+'x'+screen.height+'::'+screen.colorDepth+'::'+wtsu+'::'+conv_n+'::'+encodeURIComponent(page_name)+'::'+encodeURIComponent(page_group)+'::'+encodeURIComponent(document.title)+'::'+Math.random()+'::'+wtsh['custom']+'::'+test+'::6.2::'+wtsh['params'];

   qry = qry.replace(/#/g, '%23');

   if (event_name){
      var img = new Image();
      if (obj){
         img.src = eval("prefix+'/count6.pl?'+qry");
         if (invisible == 'yes'){
            img.width = 0;
            img.height = 0;
         }
         document.body.appendChild(img);
         if (img.complete) { redirect(obj);}
         else {
            img.addEventListener('load', function() { redirect(obj);});

            img.addEventListener('error', function() { redirect(obj);});
         }

         //setTimeout(function(){redirect(obj)},2000);
         return false;
      }
      else {
         img.src = eval("prefix+'/count6.pl?'+qry");
         if (invisible == 'yes'){
            img.width = 0;
            img.height = 0;
         }
      }
   }
   else {

      newSpan = document.createElement("span");
      newSpan.setAttribute('id', 'wtstimer709589');
      newSpan.style.display="none";
      document.body.appendChild(newSpan);

      var wtscript = document.createElement("script"); 
      wtscript.setAttribute('type','text/javascript');
      wtscript.setAttribute('src', prefix+'/count6.pl?'+qry);

      document.body.appendChild(wtscript);

      var delay = 3000;
      setTimeout(function() {doPing(delay);}, delay);

      var myWait = setInterval(function () {if (document.getElementById('wts_ui_709589') != null) {clearInterval(myWait);updateCount();}}, 200);

   }

}


   if (typeof window.wtsh == 'undefined'){
      var wtsh = {};
   }
   else {
       var wtsh = window.wtsh;
   }



function redirect(obj){
   if (obj.target){ window.open(obj.href, obj.target); }else{ window.location = obj.href };
}


function doPing(delay) { 
   if (document.getElementById('wtstimer709589').innerHTML != ''){
      delay = delay+1000;
      sendPing(delay);
      if (delay < 60000){
         setTimeout(function() {doPing(delay);}, delay);
      }
   }
} 

function sendPing(delay) {
   // var prefix = 'https:' == document.location.protocol ? 'https://server2.web-stat.com' : 'http://server2.web-stat.com';
    var uniqueID = document.getElementById('wtstimer709589').innerHTML;
    if (uniqueID != ''){
       uniqueID = uniqueID+'::'+delay+'::test';
        // var msg =  prefix+'/ping_timer.pl?'+uniqueID;
         var msg = document.location.protocol+'//lb.web-stat.com/ping_timer.pl?'+uniqueID;
         ajaxRequest.open('GET', msg, true);
         ajaxRequest.send(null);
   }
}


function onBlur() {
   document.getElementById('wts_live_709589').innerHTML = 'off'
   document.getElementById('live_709589').style.top = '12px';
   document.getElementById('live_709589').style.marginLeft = '-4px';
   document.getElementById('live_709589').style.fontSize = '7px';
   document.getElementById('dot_709589').style.color='#C8322D';
   document.getElementById('live_709589').innerHTML = 'PAUSED';

};
function onFocus(){
   document.getElementById('wts_live_709589').innerHTML = 'on'
   document.getElementById('live_709589').style.top = '13px';
   document.getElementById('live_709589').style.marginLeft = '0px';
   document.getElementById('live_709589').style.fontSize = '9px';
   document.getElementById('dot_709589').style.color='#58C23D';
   document.getElementById('live_709589').innerHTML = 'LIVE';
   document.getElementById('delay_709589').innerHTML = '3000';
   updateCount();
};

function updateCount() {
   if (document.getElementById('wts_live_709589').innerHTML == 'on'){
      window.onblur = onBlur;
      window.onfocus= onFocus;
   }
   var delta_time =  document.getElementById('wts_delta_709589').innerHTML;
   var userID =  document.getElementById('wts_ui_709589').innerHTML;
   var msg = document.location.protocol+'//lb.web-stat.com/ping_display_timer.pl?5:709589:'+delta_time+':'+userID;
   ajaxRequest.onreadystatechange = stateChanged;
   ajaxRequest.open('GET', msg, true);
   ajaxRequest.send(null);
} 


// set up AJAX request
ajaxRequest=getXmlHttpObject();
if (ajaxRequest==null) {
   alert ("This browser does not support HTTP Request");
}

function getXmlHttpObject() {
   if (window.XMLHttpRequest) { return new XMLHttpRequest(); }
   if (window.ActiveXObject)  { return new ActiveXObject("Microsoft.XMLHTTP"); }
   return null;
}


function stateChanged() {

   if (ajaxRequest.readyState==4) {

      if (ajaxRequest.status==200) {

         var response = ajaxRequest.responseText.split("::");

         var previous_count = document.getElementById('last_count_709589').innerHTML;
         var previous_delay = document.getElementById('delay_709589').innerHTML;
         if (response[0] == 'OK'){

            // if there was a visitor, delay goes down (min = 3 sec). If not it goes up by 1 sec
            if (response[3] > previous_count && previous_delay > 3000){
               delay = previous_delay*1 - 1000;
            }
            else {
               delay = previous_delay*1 + 1000;
            }

            if (delay > 60000){ delay = 60000; }
            if (delay < 3000){ delay = 3000; }

            document.getElementById('wts_sticker_v_709589').innerHTML = response[1];
            document.getElementById('wts_sticker_o_709589').innerHTML = response[2];
            document.getElementById('last_count_709589').innerHTML = response[3];
            document.getElementById('delay_709589').innerHTML = delay;

            if (document.getElementById('wts_sticker_v_709589').offsetWidth > 50){
               document.getElementById('wts_sticker_v_709589').style.marginLeft = '30px';
               document.getElementById('holder_709589').style.textAlign = 'left';
            }

            if (document.getElementById('wts_live_709589').innerHTML == 'on' && document.getElementById('wts_prm_709589').innerHTML == 'premium'){
               document.getElementById('dot_709589').style.opacity='0';
               setTimeout(function() {showGreenDot(0.05);}, 200);
               setTimeout(function() {updateCount();}, delay);
            }

         }

      }
   }
}

function showGreenDot(opacity){
   document.getElementById('dot_709589').style.opacity=opacity;
   if (opacity < 1){
      opacity = opacity+0.05;
      setTimeout(function() {showGreenDot(opacity);}, 40);
   }

}


function silentErrorHandler() {return true;}
window.onerror=silentErrorHandler;

wtslog6('709589','5','','');


