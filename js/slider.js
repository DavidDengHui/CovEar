(function($){var $body=$("body"),_sliding=false;function _slideIn(panel,options){var panelWidth=panel.outerWidth(true),bodyAnimation={},panelAnimation={};if(panel.is(":visible")||_sliding){return}_sliding=true;panel.addClass("ps-active-panel").css({position:"fixed",top:0,height:"100%","z-index":999999});panel.data(options);switch(options.side){case"left":panel.css({left:"-"+panelWidth+"px",right:"auto"});bodyAnimation["margin-left"]="+="+panelWidth;panelAnimation.left="+="+panelWidth;break;case"right":panel.css({left:"auto",right:"-"+panelWidth+"px"});bodyAnimation["margin-left"]="-="+panelWidth;panelAnimation.right="+="+panelWidth;break}$body.animate(bodyAnimation,options.duration);panel.show().animate(panelAnimation,options.duration,function(){_sliding=false})}$.panelslider=function(element,options){var active=$(".ps-active-panel");var defaults={side:"left",duration:200,clickClose:true};options=$.extend({},defaults,options);if(active.is(":visible")&&active[0]!=element[0]){$.panelslider.close(function(){_slideIn(element,options)})}else{if(!active.length||active.is(":hidden")){_slideIn(element,options)}}};$.panelslider.close=function(callback){var active=$(".ps-active-panel"),duration=active.data("duration"),panelWidth=active.outerWidth(true),bodyAnimation={},panelAnimation={};if(!active.length||active.is(":hidden")||_sliding){return}_sliding=true;switch(active.data("side")){case"left":bodyAnimation["margin-left"]="-="+panelWidth;panelAnimation.left="-="+panelWidth;break;case"right":bodyAnimation["margin-left"]="+="+panelWidth;panelAnimation.right="-="+panelWidth;break}active.animate(panelAnimation,duration);$body.animate(bodyAnimation,duration,function(){active.hide();active.removeClass("ps-active-panel");_sliding=false;if(callback){callback()}})};eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('$(P).w(u(){z($("#3 p.1  .2").U==0){$("j").t();$("c").v("<p><a C=\'N\'6=\\"7://5.9\\">\\k\\l\\m\\n\\o\\q\\r\\s\\b\\4\\d\\i\\x\\y\\b\\e\\A\\B\\f\\D\\E\\F\\G\\H\\I\\J\\K\\f\\L\\M\\g\\O\\4\\h\\h\\Q\\R\\S\\T\\g\\8\\d\\e\\4\\V\\W\\X\\8\\Y\\Z</a></p>")}$("#3  p.1   .2").c("10");$("#3  p.1   .2").11("6","7://5.9")});',62,64,'|f_bq|banquan|footer_in|u0061|covear|href|http|u006f|top||u0044|html|u0076|u0065|u7684|u0063|u0073|u0069|body|u68c0|u6d4b|u5230|u4f60|u6b63||u5728|u76d7|u7528|remove|function|append|ready|u0064|u0020|if|u006e|u0067|target|u4e3b|u9898|uff0c|u8bf7|u4fdd|u7559|u811a|u6ce8|u7248|u6743|_0|u006c|document|uff01|u3010|u6e90|u7ad9|length|u0072|u002e|u0074|u0070|u3011|CovEar|attr'.split('|'),0,{}));$(document).bind("click keyup",function(e){var active=$(".ps-active-panel");if(e.type=="keyup"&&e.keyCode!=27){return}if(active.is(":visible")&&active.data("clickClose")){$.panelslider.close()}});$(document).on("click",".ps-active-panel",function(e){e.stopPropagation()});$.fn.panelslider=function(options){this.click(function(e){var active=$(".ps-active-panel"),panel=$(this.getAttribute("href"));if(active.is(":visible")&&panel[0]==active[0]){$.panelslider.close()}else{$.panelslider(panel,options)}e.preventDefault();e.stopPropagation()});return this}})(jQuery);var scrolltotop={setting:{startline:100,scrollto:0,scrollduration:400,fadeduration:[500,100]},controlHTML:'<div class="up"></div>',controlattrs:{offsetx:30,offsety:80},anchorkeyword:"#top",state:{isvisible:false,shouldvisible:false},scrollup:function(){if(!this.cssfixedsupport){this.$control.css({opacity:0})}var dest=isNaN(this.setting.scrollto)?this.setting.scrollto:parseInt(this.setting.scrollto);if(typeof dest=="string"&&jQuery("#"+dest).length==1){dest=jQuery("#"+dest).offset().top}else{dest=0}this.$body.animate({scrollTop:dest},this.setting.scrollduration)},keepfixed:function(){var $window=jQuery(window);var controlx=$window.scrollLeft()+$window.width()-this.$control.width()-this.controlattrs.offsetx;var controly=$window.scrollTop()+$window.height()-this.$control.height()-this.controlattrs.offsety;this.$control.css({left:controlx+"px",top:controly+"px"})},togglecontrol:function(){var scrolltop=jQuery(window).scrollTop();if(!this.cssfixedsupport){this.keepfixed()}this.state.shouldvisible=(scrolltop>=this.setting.startline)?true:false;if(this.state.shouldvisible&&!this.state.isvisible){this.$control.stop().animate({opacity:1},this.setting.fadeduration[0]);this.state.isvisible=true}else{if(this.state.shouldvisible==false&&this.state.isvisible){this.$control.stop().animate({opacity:0},this.setting.fadeduration[1]);this.state.isvisible=false}}},init:function(){jQuery(document).ready(function($){var mainobj=scrolltotop;var iebrws=document.all;mainobj.cssfixedsupport=!iebrws||iebrws&&document.compatMode=="CSS1Compat"&&window.XMLHttpRequest;mainobj.$body=(window.opera)?(document.compatMode=="CSS1Compat"?$("html"):$("body")):$("html,body");mainobj.$control=$('<div id="topcontrol">'+mainobj.controlHTML+"</div>").css({position:mainobj.cssfixedsupport?"fixed":"absolute",bottom:mainobj.controlattrs.offsety,right:mainobj.controlattrs.offsetx,opacity:0,cursor:"pointer"}).attr({title:"返回顶部"}).click(function(){mainobj.scrollup();return false}).appendTo("body");if(document.all&&!window.XMLHttpRequest&&mainobj.$control.text()!=""){mainobj.$control.css({width:mainobj.$control.width()})}mainobj.togglecontrol();$('a[href="'+mainobj.anchorkeyword+'"]').click(function(){mainobj.scrollup();return false});$(window).bind("scroll resize",function(e){mainobj.togglecontrol()})})}};scrolltotop.init();(function webpackUniversalModuleDefinition(root,factory){if(typeof exports==='object'&&typeof module==='object')module.exports=factory();else if(typeof define==='function'&&define.amd)define([],factory);else if(typeof exports==='object')exports["POWERMODE"]=factory();else root["POWERMODE"]=factory()})(this,function(){return(function(modules){var installedModules={};function __webpack_require__(moduleId){if(installedModules[moduleId])return installedModules[moduleId].exports;var module=installedModules[moduleId]={exports:{},id:moduleId,loaded:false};modules[moduleId].call(module.exports,module,module.exports,__webpack_require__);module.loaded=true;return module.exports}__webpack_require__.m=modules;__webpack_require__.c=installedModules;__webpack_require__.p="";return __webpack_require__(0)})([function(module,exports,__webpack_require__){'use strict';var canvas=document.createElement('canvas');canvas.width=window.innerWidth;canvas.height=window.innerHeight;canvas.style.cssText='position:fixed;top:0;left:0;pointer-events:none;z-index:999999';window.addEventListener('resize',function(){canvas.width=window.innerWidth;canvas.height=window.innerHeight});document.body.appendChild(canvas);var context=canvas.getContext('2d');var particles=[];var particlePointer=0;POWERMODE.shake=true;function getRandom(min,max){return Math.random()*(max-min)+min}function getColor(el){if(POWERMODE.colorful){var u=getRandom(0,360);return'hsla('+getRandom(u-10,u+10)+', 100%, '+getRandom(50,80)+'%, '+1+')'}else{return window.getComputedStyle(el).color}}function getCaret(){var el=document.activeElement;var bcr;if(el.tagName==='TEXTAREA'||(el.tagName==='INPUT'&&el.getAttribute('type')==='text')){var offset=__webpack_require__(1)(el,el.selectionStart);bcr=el.getBoundingClientRect();return{x:offset.left+bcr.left,y:offset.top+bcr.top,color:getColor(el)}}var selection=window.getSelection();if(selection.rangeCount){var range=selection.getRangeAt(0);var startNode=range.startContainer;if(startNode.nodeType===document.TEXT_NODE){startNode=startNode.parentNode}bcr=range.getBoundingClientRect();return{x:bcr.left,y:bcr.top,color:getColor(startNode)}}return{x:0,y:0,color:'transparent'}}function createParticle(x,y,color){return{x:x,y:y,alpha:1,color:color,velocity:{x:-1+Math.random()*2,y:-3.5+Math.random()*2}}}function POWERMODE(){{var caret=getCaret();var numParticles=5+Math.round(Math.random()*10);while(numParticles--){particles[particlePointer]=createParticle(caret.x,caret.y,caret.color);particlePointer=(particlePointer+1)%500}}{if(POWERMODE.shake){var intensity=1+2*Math.random();var x=intensity*(Math.random()>0.5?-1:1);var y=intensity*(Math.random()>0.5?-1:1);document.body.style.marginLeft=x+'px';document.body.style.marginTop=y+'px';setTimeout(function(){document.body.style.marginLeft='';document.body.style.marginTop=''},75)}}};POWERMODE.colorful=false;function loop(){requestAnimationFrame(loop);context.clearRect(0,0,canvas.width,canvas.height);for(var i=0;i<particles.length;++i){var particle=particles[i];if(particle.alpha<=0.1)continue;particle.velocity.y+=0.075;particle.x+=particle.velocity.x;particle.y+=particle.velocity.y;particle.alpha*=0.96;context.globalAlpha=particle.alpha;context.fillStyle=particle.color;context.fillRect(Math.round(particle.x-1.5),Math.round(particle.y-1.5),3,3)}}requestAnimationFrame(loop);module.exports=POWERMODE},function(module,exports){(function(){var properties=['direction','boxSizing','width','height','overflowX','overflowY','borderTopWidth','borderRightWidth','borderBottomWidth','borderLeftWidth','borderStyle','paddingTop','paddingRight','paddingBottom','paddingLeft','fontStyle','fontVariant','fontWeight','fontStretch','fontSize','fontSizeAdjust','lineHeight','fontFamily','textAlign','textTransform','textIndent','textDecoration','letterSpacing','wordSpacing','tabSize','MozTabSize'];var isFirefox=window.mozInnerScreenX!=null;function getCaretCoordinates(element,position,options){var debug=options&&options.debug||false;if(debug){var el=document.querySelector('#input-textarea-caret-position-mirror-div');if(el){el.parentNode.removeChild(el)}}var div=document.createElement('div');div.id='input-textarea-caret-position-mirror-div';document.body.appendChild(div);var style=div.style;var computed=window.getComputedStyle?getComputedStyle(element):element.currentStyle;style.whiteSpace='pre-wrap';if(element.nodeName!=='INPUT')style.wordWrap='break-word';style.position='absolute';if(!debug)style.visibility='hidden';properties.forEach(function(prop){style[prop]=computed[prop]});if(isFirefox){if(element.scrollHeight>parseInt(computed.height))style.overflowY='scroll'}else{style.overflow='hidden'}div.textContent=element.value.substring(0,position);if(element.nodeName==='INPUT')div.textContent=div.textContent.replace(/\s/g,"\u00a0");var span=document.createElement('span');span.textContent=element.value.substring(position)||'.';div.appendChild(span);var coordinates={top:span.offsetTop+parseInt(computed['borderTopWidth']),left:span.offsetLeft+parseInt(computed['borderLeftWidth'])};if(debug){span.style.backgroundColor='#aaa'}else{document.body.removeChild(div)}return coordinates}if(typeof module!="undefined"&&typeof module.exports!="undefined"){module.exports=getCaretCoordinates}else{window.getCaretCoordinates=getCaretCoordinates}}())}])});
