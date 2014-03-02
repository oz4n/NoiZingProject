//slimScroll
(function(d){  jQuery.fn.extend({slimScroll:function(m){ var a=d.extend({  wheelStep:20,  width:"auto",  height:"250px",  size:"7px",  color:"#000",  position:"right",  distance:"1px",  start:"top",  opacity:0.4,  alwaysVisible:!1,  disableFadeOut:!1,  railVisible:!1,  railColor:"#333",  railOpacity:"0.2",  railClass:"slimScrollRail",  barClass:"slimScrollBar",  wrapperClass:"slimScrollDiv",  allowPageScroll:!1,  scroll:0,  touchScrollStep:200 },m); this.each(function(){  function e(i,d,e){var f=i;d&&(f=parseInt(c.css("top"))+i*parseInt(a.wheelStep)/ 100*c.outerHeight(),d=b.outerHeight()-c.outerHeight(),f=Math.min(Math.max(f,0),d),c.css({  top:f+"px" }));g=parseInt(c.css("top"))/(b.outerHeight()-c.outerHeight());f=g*(b[0].scrollHeight-b.outerHeight());e&&(f=i,i=f/b[0].scrollHeight*b.outerHeight(),c.css({ top:i+"px"}));b.scrollTop(f);n();j()  }  function t(){p=Math.max(b.outerHeight()/b[0].scrollHeight*b.outerHeight(),m);c.css({ height:p+"px"})  }  function n(){t();clearTimeout(u);g==~~g&&(k=a.allowPageScroll,v!=g&&b.trigger("slimscroll",0==~~g?"top":"bottom"));v=g;p>=b.outerHeight()?k=!0:(c.stop(!0,!0).fadeIn("fast"),a.railVisible&&h.stop(!0,!0).fadeIn("fast"))  }  function j(){a.alwaysVisible||(u=setTimeout(function(){ if((!a.disableFadeOut||!l)&&!q&&!r)c.fadeOut("slow"),h.fadeOut("slow")},1E3))  }  var l,q,r,u,w,p,g,v,m=30,k=!1,b=d(this);  if(b.parent().hasClass("slimScrollDiv"))scroll&&(c=b.parent().find(".slimScrollBar"),h=b.parent().find(".slimScrollRail"),e(b.scrollTop()+parseInt(scroll),!1,!0));  else{var y=d("<div></div>").addClass(a.wrapperClass).css({ position:"relative", overflow:"hidden", width:a.width, height:a.height});b.css({ overflow:"hidden", width:a.width, height:a.height});var h=d("<div></div>").addClass(a.railClass).css({ width:a.size, height:"100%", position:"absolute", top:0, display:a.alwaysVisible&&a.railVisible?"block":"none", "border-radius":a.size, background:a.railColor, opacity:a.railOpacity, zIndex:90}),c=d("<div></div>").addClass(a.barClass).css({ background:a.color, width:a.size, position:"absolute", top:0, opacity:a.opacity, display:a.alwaysVisible?"block":"none", "border-radius":a.size, BorderRadius:a.size, MozBorderRadius:a.size, WebkitBorderRadius:a.size, zIndex:99}),x="right"==a.position?{ right:a.distance}:{ left:a.distance}; h.css(x);c.css(x);b.wrap(y);b.parent().append(c);b.parent().append(h);c.draggable({ axis:"y", containment:"parent", start:function(){  r=!0 }, stop:function(){  r=!1;  j() }, drag:function(){  e(0,d(this).position().top,!1) }});h.hover(function(){ n()},function(){ j()});c.hover(function(){ q=!0},function(){ q=!1});b.hover(function(){ l=!0; n(); j()},function(){ l= !1; j()});b.bind("touchstart",function(a){ a.originalEvent.touches.length&&(w=a.originalEvent.touches[0].pageY)});b.bind("touchmove",function(b){ b.originalEvent.preventDefault(); b.originalEvent.touches.length&&e((w-b.originalEvent.touches[0].pageY)/a.touchScrollStep,!0)});var s=function(a){ if(l){  var a=a||window.event,b=0;  a.wheelDelta&&(b=-a.wheelDelta/120);  a.detail&&(b=a.detail/3);  e(b,!0);  a.preventDefault&&!k&&a.preventDefault();  k||(a.returnValue=!1) }};(function(){ window.addEventListener?(this.addEventListener("DOMMouseScroll",  s,!1),this.addEventListener("mousewheel",s,!1)):document.attachEvent("onmousewheel",s)})();t();"bottom"==a.start?(c.css({ top:b.outerHeight()-c.outerHeight()}),e(0,!0)):"object"==typeof a.start&&(e(d(a.start).position().top,null,!0),a.alwaysVisible||c.hide())  } }); return this}  });  jQuery.fn.extend({slimscroll:jQuery.fn.slimScroll  }) })(jQuery);
//msgbox
(function ($) {  var m = (jQuery.browser.msie && parseInt(jQuery.browser.version, 10) < 7 && parseInt(jQuery.browser.version, 10) > 4);  if ($.proxy === undefined) {$.extend({ proxy: function (a, b) {  if (a) {proxy = function () { return a.apply(b || this, arguments)}  };  return proxy }})  };  $.extend(jQuery.easing, {easeOutBack: function (x, t, b, c, d, s) { if (s == undefined) s = 1.70158; return c * ((t = t / d - 1) * t * ((s + 1) * t + s) + 1) + b}  });  $.extend($.expr[':'], {value: function (a) { return $(a).val()}  });  $.extend({MsgBoxObject: { defaults: {  name: 'jquery-msgbox',  zIndex: 10000,  width: 420,  height: 'auto',  background: '#FFFFFF',  modal: true,  overlay: {'background-color': '#000000','opacity': 0.5  },  showDuration: 200,  closeDuration: 100,  moveDuration: 500,  shake: {'distance': 10,'duration': 100,'transition': 'easeOutBack','loops': 2  },  form: {'active': false,'action': '#','method': 'post'  },  emergefrom: 'top' }, options: {}, esqueleto: {  msgbox: [],  wrapper: [],  form: [],  buttons: [],  inputs: [] }, visible: false, i: 0, animation: false, config: function (a) {  this.options = $.extend(true, this.options, a);  this.overlay.element.css(this.options.overlay);  this.overlay.options.hideOnClick = !this.options.modal;  this.esqueleto.msgbox.css({'width': this.options.width,'height': this.options.height,'background-color': this.options.background  });  this.moveBox() }, overlay: {  create: function (b) {this.options = b;this.element = $('<div id="' + new Date().getTime() + '"></div>');this.element.css($.extend({},{ 'position': 'fixed', 'top': 0, 'left': 0, 'opacity': 0, 'display': 'none', 'z-index': this.options.zIndex},this.options.style));this.element.click($.proxy(function (a) { if (this.options.hideOnClick) {  if ($.isFunction(this.options.callback)) {this.options.callback()  } else {this.hide()  } } a.preventDefault()},this));this.hidden = true;this.inject();return this  },  inject: function () {this.target = $(document.body);this.target.append(this.element);if (m) { this.element.css({  'position': 'absolute' }); var a = parseInt(this.element.css('zIndex')); if (!a) {  a = 1;  var b = this.element.css('position');  if (b == 'static' || !b) {this.element.css({ 'position': 'relative'})  }  this.element.css({'zIndex': a  }) } a = ( !! (this.options.zIndex || this.options.zIndex === 0) && a > this.options.zIndex) ? this.options.zIndex: a - 1; if (a < 0) {  a = 1 } this.shim = $('<iframe id="IF_' + new Date().getTime() + '" scrolling="no" frameborder=0 src=""></div>'); this.shim.css({  zIndex: a,  position: 'absolute',  top: 0,  left: 0,  border: 'none',  width: 0,  height: 0,  opacity: 0 }); this.shim.insertAfter(this.element); $('html, body').css({  'height': '100%',  'width': '100%',  'margin-left': 0,  'margin-right': 0 })}  },  resize: function (x, y) {this.element.css({ 'height': 0, 'width': 0});if (this.shim) this.shim.css({ 'height': 0, 'width': 0});var a = { x: $(document).width(), y: $(document).height()};this.element.css({ 'width': '100%', 'height': y ? y: a.y});if (this.shim) { this.shim.css({  'height': 0,  'width': 0 }); this.shim.css({  'position': 'absolute',  'left': 0,  'top': 0,  'width': this.element.width(),  'height': y ? y: a.y })}return this  },  show: function () {if (!this.hidden) return this;if (this.transition) this.transition.stop();this.target.bind('resize', $.proxy(this.resize, this));this.resize();if (this.shim) this.shim.css({ 'display': 'block'});this.hidden = false;this.transition = this.element.fadeIn(this.options.showDuration, $.proxy(function () { this.element.trigger('show')},this));return this  },  hide: function () {if (this.hidden) return this;if (this.transition) this.transition.stop();this.target.unbind('resize');if (this.shim) this.shim.css({ 'display': 'none'});this.hidden = true;this.transition = this.element.fadeOut(this.options.closeDuration, $.proxy(function () { this.element.trigger('hide'); this.element.css({  'height': 0,  'width': 0 })},this));return this  } }, create: function () {  this.options = $.extend(true, this.defaults, this.options);  this.overlay.create({style: this.options.overlay,hideOnClick: !this.options.modal,zIndex: this.options.zIndex - 1,showDuration: this.options.showDuration,closeDuration: this.options.closeDuration  });  this.esqueleto.msgbox = $('<div class="' + this.options.name + '"></div>');  this.esqueleto.msgbox.css({'display': 'none','position': 'absolute','top': 0,'left': 0,'width': this.options.width,'height': this.options.height,'z-index': this.options.zIndex,'word-wrap': 'break-word','-moz-box-shadow': '0 0 15px rgba(0, 0, 0, 0.5)','-webkit-box-shadow': '0 0 15px rgba(0, 0, 0, 0.5)','box-shadow': '0 0 15px rgba(0, 0, 0, 0.5)','-moz-border-radius': '3px','-webkit-border-radius': '3px','border-radius': '3px','background-color': this.options.background  });  this.esqueleto.wrapper = $('<div class="' + this.options.name + '-wrapper"></div>');  this.esqueleto.msgbox.append(this.esqueleto.wrapper);  this.esqueleto.form = $('<form action="' + this.options.formaction + '" method="post"></form>');  this.esqueleto.wrapper.append(this.esqueleto.form);  this.esqueleto.wrapper.css({height: (m ? 80 : 'auto'),'min-height': 80,'zoom': 1  });  $('body').append(this.esqueleto.msgbox);  this.addevents();  return this.esqueleto.msgbox }, addevents: function () {  $(window).bind('resize', $.proxy(function () {if (this.visible) { this.overlay.resize(); this.moveBox()}  },  this));  $(window).bind('scroll', $.proxy(function () {if (this.visible) { this.moveBox()}  },  this));  this.esqueleto.msgbox.bind('keydown', $.proxy(function (a) {if (a.keyCode == 27) { this.close(false)}  },  this));  this.esqueleto.form.bind('submit', $.proxy(function (a) {$('input[type=submit]:first, button[type=submit]:first, button:first', this.esqueleto.form).trigger('click');if (!options.form.active) { a.preventDefault()}  },  this));  this.overlay.element.bind('show', $.proxy(function () {$(this).triggerHandler('show')  },  this));  this.overlay.element.bind('hide', $.proxy(function () {$(this).triggerHandler('close')  },  this)) }, show: function (g, h, j) {  var k = ['alert', 'info', 'error', 'prompt', 'confirm'];  this.esqueleto.msgbox.queue(this.options.name, $.proxy(function (c) {h = $.extend(true, { type: 'alert', form: {  'active': false }},h || {});if (typeof h.buttons === "undefined") { if (h.type == 'confirm' || h.type == 'prompt') {  var d = [{type: 'submit',value: 'Accept'  },  {type: 'cancel',value: 'Cancel'  }] } else {  var d = [{type: 'submit',value: 'Accept'  }] }} else { var d = h.buttons};if (typeof h.inputs === "undefined" && h.type == 'prompt') { var f = [{  type: 'text',  name: 'prompt',  value: '' }]} else { var f = h.inputs};this.callback = $.isFunction(j) ? j: function (e) {};if (typeof f !== "undefined") { this.esqueleto.inputs = $('<div class="' + this.options.name + '-inputs"></div>'); this.esqueleto.form.append(this.esqueleto.inputs); $.each(f, $.proxy(function (i, a) {  if (a.type == 'checkbox') {iLabel = a.label ? '<label class="' + this.options.name + '-label">': '';fLabel = a.label ? a.label + '</label>': '';a.value = a.value === undefined ? '1': a.value;iName = a.name === undefined ? this.options.name + '-label-' + i: a.name;this.esqueleto.inputs.append($(iLabel + '<input type="' + a.type + '" style="display:inline; width:auto;" name="' + iName + '" value="' + a.value + '" autocomplete="off"/> ' + fLabel))  } else {iLabel = a.label ? '<label class="' + this.options.name + '-label">' + a.label: '';fLabel = a.label ? '</label>': '';a.value = a.value === undefined ? '': a.value;iRequired = a.required === undefined || a.required == false ? '': 'required="true"';iName = a.name === undefined ? this.options.name + '-label-' + i: a.name;this.esqueleto.inputs.append($(iLabel + '<input type="' + a.type + '" name="' + iName + '" value="' + a.value + '" autocomplete="off" ' + iRequired + '/>' + fLabel))  } }, this))}this.esqueleto.buttons = $('<div class="' + this.options.name + '-buttons"></div>');this.esqueleto.form.append(this.esqueleto.buttons);if (h.form.active) { this.esqueleto.form.attr('action', h.form.action === undefined ? '#': h.form.action); this.esqueleto.form.attr('method', h.form.method === undefined ? 'post': h.form.method); this.options.form.active = true} else { this.esqueleto.form.attr('action', '#'); this.esqueleto.form.attr('method', 'post'); this.options.form.active = false}if (h.type != 'prompt') { $.each(d, $.proxy(function (i, a) {  if (a.type == 'submit') {this.esqueleto.buttons.append($('<button type="submit" class="msg-btn">' + a.value + '</button>').bind('click', $.proxy(function (e) { this.close(a.value); e.preventDefault()},this)))  } else if (a.type == 'cancel') {this.esqueleto.buttons.append($('<button type="button" class="msg-btn">' + a.value + '</button>').bind('click', $.proxy(function (e) { this.close(false); e.preventDefault()},this)))  } }, this))} else if (h.type == 'prompt') { $.each(d, $.proxy(function (i, a) {  if (a.type == 'submit') {this.esqueleto.buttons.append($('<button type="submit" class="msg-btn">' + a.value + '</button>').bind('click', $.proxy(function (e) { if ($('input[required="true"]:not(:value)').length > 0) {  $('input[required="true"]:not(:value):first').focus();  this.shake() } else if (this.options.form.active) {  return true } else {  this.close(this.toArguments($('input', this.esqueleto.inputs))) } e.preventDefault()},this)))  } else if (a.type == 'cancel') {this.esqueleto.buttons.append($('<button type="button" class="msg-btn">' + a.value + '</button>').bind('click', $.proxy(function (e) { this.close(false); e.preventDefault()},this)))  } }, this))};this.esqueleto.form.prepend(g);$.each(k, $.proxy(function (i, e) { this.esqueleto.wrapper.removeClass(this.options.name + '-' + e)},this));this.esqueleto.wrapper.addClass(this.options.name + '-' + h.type);this.moveBox();this.visible = true;this.overlay.show();this.esqueleto.msgbox.css({ display: 'block', left: (($(document).width() - this.options.width) / 2)});this.moveBox();setTimeout($.proxy(function () {},this), this.options.moveDuration)  },  this));  this.i++;  if (this.i == 1) {this.esqueleto.msgbox.dequeue(this.options.name)  } }, toArguments: function (b) {  return $.map(b, function (a) {return $(a).val()  }) }, moveBox: function () {  var a = {x: $(window).width(),y: $(window).height()  };  var b = {x: $(window).scrollLeft(),y: $(window).scrollTop()  };  var c = this.esqueleto.msgbox.outerHeight();  var y = 0;  var x = 0;  y = b.x + ((a.x - this.options.width) / 2);  if (this.options.emergefrom == "bottom") {x = (b.y + a.y + 80)  } else {x = (b.y - c) - 80  }  if (this.visible) {if (this.animation) { this.animation.stop}this.animation = this.esqueleto.msgbox.animate({ left: y, top: b.y + ((a.y - c) / 2)},{ duration: this.options.moveDuration, queue: false, easing: 'easeOutBack'})  } else {this.esqueleto.msgbox.css({ top: x, left: y})  } }, close: function (a) {  this.esqueleto.msgbox.css({display: 'none',top: 0  });  this.visible = false;  if ($.isFunction(this.callback)) {this.callback.apply(this, $.makeArray(a))  }  setTimeout($.proxy(function () {this.i--;this.esqueleto.msgbox.dequeue(this.options.name)  },  this), this.options.closeDuration);  if (this.i == 1) {this.overlay.hide()  }  this.moveBox();  this.esqueleto.form.empty() }, shake: function () {  var x = this.options.shake.distance;  var d = this.options.shake.duration;  var t = this.options.shake.transition;  var o = this.options.shake.loops;  var l = this.esqueleto.msgbox.position().left;  var e = this.esqueleto.msgbox;  for (i = 0; i < o; i++) {e.animate({ left: l + x},d, t);e.animate({ left: l - x},d, t)  };  e.animate({left: l + x  },  d, t);  e.animate({left: l  },  d, t) }},msgbox: function (a, b, c) { if (typeof a == "object") {  $.MsgBoxObject.config(a) } else {  return $.MsgBoxObject.show(a, b, c) }}  });  $(function () {if (parseFloat($.fn.jquery) > 1.2) { $.MsgBoxObject.create()} else { throw "The jQuery version that was loaded is too old. MsgBox requires jQuery 1.3+";}  }) })(jQuery);
//msgGrowl
(function($) {  $.msgGrowl = function(config) { var defaults, options, container, msgGrowl, content, title, text, close; defaults = { type: '' ,  title: '' ,  text: '' ,  lifetime: 6500 ,  sticky: false ,  position: 'bottom-right' ,  closeTrigger: true ,  onOpen: function () {} ,  onClose: function () {}}; 		options = $.extend(defaults, config); 		container = $('.msgGrowl-container.' + options.position); 		if (!container.length) { container = $('<div>', {  'class': 'msgGrowl-container ' + options.position }).appendTo ('body');} 		msgGrowl = $('<div>', { 'class': 'msgGrowl ' + options.type}); 			content = $('<div>', { 'class': 'msgGrowl-content'}).appendTo (msgGrowl);	 			text = $('<span>', { text: options.text}).appendTo (content); 		if (options.closeTrigger) { close = $('<div>', {  'class': 'msgGrowl-close'  ,'click': function (e) { e.preventDefault (); $(this).parent ().fadeOut ('medium', function () {  $(this).remove ();  if (typeof options.onClose === 'function') {  options.onClose (); }});  } }).appendTo (msgGrowl);} 	if (options.title != '') { title = $('<h4>', {  text: options.title }).prependTo (content);} 		if (options.lifetime > 0 && !options.sticky) { setTimeout (function () {  if (typeof options.onClose === 'function') {options.onClose ();  }  msgGrowl.fadeOut ('medium', function () {$(this).remove ();  }); }, options.lifetime); } container.addClass (options.position); if (options.position.split ('-')[0] == 'top') { msgGrowl.prependTo (container).hide ().fadeIn ('slow');} else { msgGrowl.appendTo (container).hide ().fadeIn ('slow');	} if (typeof options.onOpen === 'function') { options.onOpen ();} } })(jQuery);
//autosize
(function(a){var j,b={className:"autosizejs",append:"",callback:!1},c="hidden",d="border-box",e="lineHeight",f='<textarea tabindex="-1" style="position:absolute; top:-9999px; left:-9999px; right:auto; bottom:auto; border:0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden;"/>',g=["fontFamily","fontSize","fontWeight","fontStyle","letterSpacing","textTransform","wordSpacing","textIndent"],h="oninput",i="onpropertychange",k=a(f).data("autosize",!0)[0];k.style.lineHeight="99px","99px"===a(k).css(e)&&g.push(e),k.style.lineHeight="",a.fn.autosize=function(e){return e=a.extend({},b,e||{}),k.parentNode!==document.body&&a(document.body).append(k),this.each(function(){function s(){j=b,k.className=e.className,a.each(g,function(a,b){k.style[b]=f.css(b)})}function t(){var a,d,g;j!==b&&s(),n||(n=!0,k.value=b.value+e.append,k.style.overflowY=b.style.overflowY,g=parseInt(b.style.height,10),k.style.width=f.width()+"px",k.scrollTop=0,k.scrollTop=9e4,a=k.scrollTop,a>m?(a=m,d="scroll"):l>a&&(a=l),a+=p,b.style.overflowY=d||c,g!==a&&(b.style.height=a+"px",r&&e.callback.call(b)),setTimeout(function(){n=!1},1))}var n,o,b=this,f=a(b),l=f.height(),m=parseInt(f.css("maxHeight"),10),p=0,q=b.value,r=a.isFunction(e.callback);f.data("autosize")||((f.css("box-sizing")===d||f.css("-moz-box-sizing")===d||f.css("-webkit-box-sizing")===d)&&(p=f.outerHeight()-f.height()),o="none"===f.css("resize")?"none":"horizontal",f.css({overflow:c,overflowY:c,wordWrap:"break-word",resize:o}).data("autosize",!0),m=m&&m>0?m:9e4,i in b?h in b?b[h]=b.onkeyup=t:b[i]=t:(b[h]=t,b.value="",b.value=q),a(window).resize(t),f.bind("autosize",t),t())})}})(window.jQuery||window.Zepto);