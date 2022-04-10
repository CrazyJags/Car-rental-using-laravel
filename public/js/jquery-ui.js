(function(e){if(typeof define==="function"&&define.amd){define(["jquery"],e)}else{e(jQuery)}})(function(e){e.ui=e.ui||{};var t=e.ui.version="1.12.1";var n=0;var r=Array.prototype.slice;e.cleanData=function(t){return function(n){var r,i,s;for(s=0;(i=n[s])!=null;s++){try{r=e._data(i,"events");if(r&&r.remove){e(i).triggerHandler("remove")}}catch(o){}}t(n)}}(e.cleanData);e.widget=function(t,n,r){var i,s,o;var u={};var a=t.split(".")[0];t=t.split(".")[1];var f=a+"-"+t;if(!r){r=n;n=e.Widget}if(e.isArray(r)){r=e.extend.apply(null,[{}].concat(r))}e.expr[":"][f.toLowerCase()]=function(t){return!!e.data(t,f)};e[a]=e[a]||{};i=e[a][t];s=e[a][t]=function(e,t){if(!this._createWidget){return new s(e,t)}if(arguments.length){this._createWidget(e,t)}};e.extend(s,i,{version:r.version,_proto:e.extend({},r),_childConstructors:[]});o=new n;o.options=e.widget.extend({},o.options);e.each(r,function(t,r){if(!e.isFunction(r)){u[t]=r;return}u[t]=function(){function e(){return n.prototype[t].apply(this,arguments)}function i(e){return n.prototype[t].apply(this,e)}return function(){var t=this._super;var n=this._superApply;var s;this._super=e;this._superApply=i;s=r.apply(this,arguments);this._super=t;this._superApply=n;return s}}()});s.prototype=e.widget.extend(o,{widgetEventPrefix:i?o.widgetEventPrefix||t:t},u,{constructor:s,namespace:a,widgetName:t,widgetFullName:f});if(i){e.each(i._childConstructors,function(t,n){var r=n.prototype;e.widget(r.namespace+"."+r.widgetName,s,n._proto)});delete i._childConstructors}else{n._childConstructors.push(s)}e.widget.bridge(t,s);return s};e.widget.extend=function(t){var n=r.call(arguments,1);var i=0;var s=n.length;var o;var u;for(;i<s;i++){for(o in n[i]){u=n[i][o];if(n[i].hasOwnProperty(o)&&u!==undefined){if(e.isPlainObject(u)){t[o]=e.isPlainObject(t[o])?e.widget.extend({},t[o],u):e.widget.extend({},u)}else{t[o]=u}}}}return t};e.widget.bridge=function(t,n){var i=n.prototype.widgetFullName||t;e.fn[t]=function(s){var o=typeof s==="string";var u=r.call(arguments,1);var a=this;if(o){if(!this.length&&s==="instance"){a=undefined}else{this.each(function(){var n;var r=e.data(this,i);if(s==="instance"){a=r;return false}if(!r){return e.error("cannot call methods on "+t+" prior to initialization; "+"attempted to call method '"+s+"'")}if(!e.isFunction(r[s])||s.charAt(0)==="_"){return e.error("no such method '"+s+"' for "+t+" widget instance")}n=r[s].apply(r,u);if(n!==r&&n!==undefined){a=n&&n.jquery?a.pushStack(n.get()):n;return false}})}}else{if(u.length){s=e.widget.extend.apply(null,[s].concat(u))}this.each(function(){var t=e.data(this,i);if(t){t.option(s||{});if(t._init){t._init()}}else{e.data(this,i,new n(s,this))}})}return a}};e.Widget=function(){};e.Widget._childConstructors=[];e.Widget.prototype={widgetName:"widget",widgetEventPrefix:"",defaultElement:"<div>",options:{classes:{},disabled:false,create:null},_createWidget:function(t,r){r=e(r||this.defaultElement||this)[0];this.element=e(r);this.uuid=n++;this.eventNamespace="."+this.widgetName+this.uuid;this.bindings=e();this.hoverable=e();this.focusable=e();this.classesElementLookup={};if(r!==this){e.data(r,this.widgetFullName,this);this._on(true,this.element,{remove:function(e){if(e.target===r){this.destroy()}}});this.document=e(r.style?r.ownerDocument:r.document||r);this.window=e(this.document[0].defaultView||this.document[0].parentWindow)}this.options=e.widget.extend({},this.options,this._getCreateOptions(),t);this._create();if(this.options.disabled){this._setOptionDisabled(this.options.disabled)}this._trigger("create",null,this._getCreateEventData());this._init()},_getCreateOptions:function(){return{}},_getCreateEventData:e.noop,_create:e.noop,_init:e.noop,destroy:function(){var t=this;this._destroy();e.each(this.classesElementLookup,function(e,n){t._removeClass(n,e)});this.element.off(this.eventNamespace).removeData(this.widgetFullName);this.widget().off(this.eventNamespace).removeAttr("aria-disabled");this.bindings.off(this.eventNamespace)},_destroy:e.noop,widget:function(){return this.element},option:function(t,n){var r=t;var i;var s;var o;if(arguments.length===0){return e.widget.extend({},this.options)}if(typeof t==="string"){r={};i=t.split(".");t=i.shift();if(i.length){s=r[t]=e.widget.extend({},this.options[t]);for(o=0;o<i.length-1;o++){s[i[o]]=s[i[o]]||{};s=s[i[o]]}t=i.pop();if(arguments.length===1){return s[t]===undefined?null:s[t]}s[t]=n}else{if(arguments.length===1){return this.options[t]===undefined?null:this.options[t]}r[t]=n}}this._setOptions(r);return this},_setOptions:function(e){var t;for(t in e){this._setOption(t,e[t])}return this},_setOption:function(e,t){if(e==="classes"){this._setOptionClasses(t)}this.options[e]=t;if(e==="disabled"){this._setOptionDisabled(t)}return this},_setOptionClasses:function(t){var n,r,i;for(n in t){i=this.classesElementLookup[n];if(t[n]===this.options.classes[n]||!i||!i.length){continue}r=e(i.get());this._removeClass(i,n);r.addClass(this._classes({element:r,keys:n,classes:t,add:true}))}},_setOptionDisabled:function(e){this._toggleClass(this.widget(),this.widgetFullName+"-disabled",null,!!e);if(e){this._removeClass(this.hoverable,null,"ui-state-hover");this._removeClass(this.focusable,null,"ui-state-focus")}},enable:function(){return this._setOptions({disabled:false})},disable:function(){return this._setOptions({disabled:true})},_classes:function(t){function i(i,s){var o,u;for(u=0;u<i.length;u++){o=r.classesElementLookup[i[u]]||e();if(t.add){o=e(e.unique(o.get().concat(t.element.get())))}else{o=e(o.not(t.element).get())}r.classesElementLookup[i[u]]=o;n.push(i[u]);if(s&&t.classes[i[u]]){n.push(t.classes[i[u]])}}}var n=[];var r=this;t=e.extend({element:this.element,classes:this.options.classes||{}},t);this._on(t.element,{remove:"_untrackClassesElement"});if(t.keys){i(t.keys.match(/\S+/g)||[],true)}if(t.extra){i(t.extra.match(/\S+/g)||[])}return n.join(" ")},_untrackClassesElement:function(t){var n=this;e.each(n.classesElementLookup,function(r,i){if(e.inArray(t.target,i)!==-1){n.classesElementLookup[r]=e(i.not(t.target).get())}})},_removeClass:function(e,t,n){return this._toggleClass(e,t,n,false)},_addClass:function(e,t,n){return this._toggleClass(e,t,n,true)},_toggleClass:function(e,t,n,r){r=typeof r==="boolean"?r:n;var i=typeof e==="string"||e===null,s={extra:i?t:n,keys:i?e:t,element:i?this.element:e,add:r};s.element.toggleClass(this._classes(s),r);return this},_on:function(t,n,r){var i;var s=this;if(typeof t!=="boolean"){r=n;n=t;t=false}if(!r){r=n;n=this.element;i=this.widget()}else{n=i=e(n);this.bindings=this.bindings.add(n)}e.each(r,function(r,o){function u(){if(!t&&(s.options.disabled===true||e(this).hasClass("ui-state-disabled"))){return}return(typeof o==="string"?s[o]:o).apply(s,arguments)}if(typeof o!=="string"){u.guid=o.guid=o.guid||u.guid||e.guid++}var a=r.match(/^([\w:-]*)\s*(.*)$/);var f=a[1]+s.eventNamespace;var l=a[2];if(l){i.on(f,l,u)}else{n.on(f,u)}})},_off:function(t,n){n=(n||"").split(" ").join(this.eventNamespace+" ")+this.eventNamespace;t.off(n).off(n);this.bindings=e(this.bindings.not(t).get());this.focusable=e(this.focusable.not(t).get());this.hoverable=e(this.hoverable.not(t).get())},_delay:function(e,t){function n(){return(typeof e==="string"?r[e]:e).apply(r,arguments)}var r=this;return setTimeout(n,t||0)},_hoverable:function(t){this.hoverable=this.hoverable.add(t);this._on(t,{mouseenter:function(t){this._addClass(e(t.currentTarget),null,"ui-state-hover")},mouseleave:function(t){this._removeClass(e(t.currentTarget),null,"ui-state-hover")}})},_focusable:function(t){this.focusable=this.focusable.add(t);this._on(t,{focusin:function(t){this._addClass(e(t.currentTarget),null,"ui-state-focus")},focusout:function(t){this._removeClass(e(t.currentTarget),null,"ui-state-focus")}})},_trigger:function(t,n,r){var i,s;var o=this.options[t];r=r||{};n=e.Event(n);n.type=(t===this.widgetEventPrefix?t:this.widgetEventPrefix+t).toLowerCase();n.target=this.element[0];s=n.originalEvent;if(s){for(i in s){if(!(i in n)){n[i]=s[i]}}}this.element.trigger(n,r);return!(e.isFunction(o)&&o.apply(this.element[0],[n].concat(r))===false||n.isDefaultPrevented())}};e.each({show:"fadeIn",hide:"fadeOut"},function(t,n){e.Widget.prototype["_"+t]=function(r,i,s){if(typeof i==="string"){i={effect:i}}var o;var u=!i?t:i===true||typeof i==="number"?n:i.effect||n;i=i||{};if(typeof i==="number"){i={duration:i}}o=!e.isEmptyObject(i);i.complete=s;if(i.delay){r.delay(i.delay)}if(o&&e.effects&&e.effects.effect[u]){r[t](i)}else if(u!==t&&r[u]){r[u](i.duration,i.easing,s)}else{r.queue(function(n){e(this)[t]();if(s){s.call(r[0])}n()})}}});var i=e.widget;var s=e.ui.keyCode={BACKSPACE:8,COMMA:188,DELETE:46,DOWN:40,END:35,ENTER:13,ESCAPE:27,HOME:36,LEFT:37,PAGE_DOWN:34,PAGE_UP:33,PERIOD:190,RIGHT:39,SPACE:32,TAB:9,UP:38};var o=e.ui.ie=!!/msie [\w.]+/.exec(navigator.userAgent.toLowerCase());var u=false;e(document).on("mouseup",function(){u=false});var a=e.widget("ui.mouse",{version:"1.12.1",options:{cancel:"input, textarea, button, select, option",distance:1,delay:0},_mouseInit:function(){var t=this;this.element.on("mousedown."+this.widgetName,function(e){return t._mouseDown(e)}).on("click."+this.widgetName,function(n){if(true===e.data(n.target,t.widgetName+".preventClickEvent")){e.removeData(n.target,t.widgetName+".preventClickEvent");n.stopImmediatePropagation();return false}});this.started=false},_mouseDestroy:function(){this.element.off("."+this.widgetName);if(this._mouseMoveDelegate){this.document.off("mousemove."+this.widgetName,this._mouseMoveDelegate).off("mouseup."+this.widgetName,this._mouseUpDelegate)}},_mouseDown:function(t){if(u){return}this._mouseMoved=false;this._mouseStarted&&this._mouseUp(t);this._mouseDownEvent=t;var n=this,r=t.which===1,i=typeof this.options.cancel==="string"&&t.target.nodeName?e(t.target).closest(this.options.cancel).length:false;if(!r||i||!this._mouseCapture(t)){return true}this.mouseDelayMet=!this.options.delay;if(!this.mouseDelayMet){this._mouseDelayTimer=setTimeout(function(){n.mouseDelayMet=true},this.options.delay)}if(this._mouseDistanceMet(t)&&this._mouseDelayMet(t)){this._mouseStarted=this._mouseStart(t)!==false;if(!this._mouseStarted){t.preventDefault();return true}}if(true===e.data(t.target,this.widgetName+".preventClickEvent")){e.removeData(t.target,this.widgetName+".preventClickEvent")}this._mouseMoveDelegate=function(e){return n._mouseMove(e)};this._mouseUpDelegate=function(e){return n._mouseUp(e)};this.document.on("mousemove."+this.widgetName,this._mouseMoveDelegate).on("mouseup."+this.widgetName,this._mouseUpDelegate);t.preventDefault();u=true;return true},_mouseMove:function(t){if(this._mouseMoved){if(e.ui.ie&&(!document.documentMode||document.documentMode<9)&&!t.button){return this._mouseUp(t)}else if(!t.which){if(t.originalEvent.altKey||t.originalEvent.ctrlKey||t.originalEvent.metaKey||t.originalEvent.shiftKey){this.ignoreMissingWhich=true}else if(!this.ignoreMissingWhich){return this._mouseUp(t)}}}if(t.which||t.button){this._mouseMoved=true}if(this._mouseStarted){this._mouseDrag(t);return t.preventDefault()}if(this._mouseDistanceMet(t)&&this._mouseDelayMet(t)){this._mouseStarted=this._mouseStart(this._mouseDownEvent,t)!==false;this._mouseStarted?this._mouseDrag(t):this._mouseUp(t)}return!this._mouseStarted},_mouseUp:function(t){this.document.off("mousemove."+this.widgetName,this._mouseMoveDelegate).off("mouseup."+this.widgetName,this._mouseUpDelegate);if(this._mouseStarted){this._mouseStarted=false;if(t.target===this._mouseDownEvent.target){e.data(t.target,this.widgetName+".preventClickEvent",true)}this._mouseStop(t)}if(this._mouseDelayTimer){clearTimeout(this._mouseDelayTimer);delete this._mouseDelayTimer}this.ignoreMissingWhich=false;u=false;t.preventDefault()},_mouseDistanceMet:function(e){return Math.max(Math.abs(this._mouseDownEvent.pageX-e.pageX),Math.abs(this._mouseDownEvent.pageY-e.pageY))>=this.options.distance},_mouseDelayMet:function(){return this.mouseDelayMet},_mouseStart:function(){},_mouseDrag:function(){},_mouseStop:function(){},_mouseCapture:function(){return true}});var f=e.widget("ui.slider",e.ui.mouse,{version:"1.12.1",widgetEventPrefix:"slide",options:{animate:false,classes:{"ui-slider":"ui-corner-all","ui-slider-handle":"ui-corner-all","ui-slider-range":"ui-corner-all ui-widget-header"},distance:0,max:100,min:0,orientation:"horizontal",range:false,step:1,value:0,values:null,change:null,slide:null,start:null,stop:null},numPages:5,_create:function(){this._keySliding=false;this._mouseSliding=false;this._animateOff=true;this._handleIndex=null;this._detectOrientation();this._mouseInit();this._calculateNewMax();this._addClass("ui-slider ui-slider-"+this.orientation,"ui-widget ui-widget-content");this._refresh();this._animateOff=false},_refresh:function(){this._createRange();this._createHandles();this._setupEvents();this._refreshValue()},_createHandles:function(){var t,n,r=this.options,i=this.element.find(".ui-slider-handle"),s="<span tabindex='0'></span>",o=[];n=r.values&&r.values.length||1;if(i.length>n){i.slice(n).remove();i=i.slice(0,n)}for(t=i.length;t<n;t++){o.push(s)}this.handles=i.add(e(o.join("")).appendTo(this.element));this._addClass(this.handles,"ui-slider-handle","ui-state-default");this.handle=this.handles.eq(0);this.handles.each(function(t){e(this).data("ui-slider-handle-index",t).attr("tabIndex",0)})},_createRange:function(){var t=this.options;if(t.range){if(t.range===true){if(!t.values){t.values=[this._valueMin(),this._valueMin()]}else if(t.values.length&&t.values.length!==2){t.values=[t.values[0],t.values[0]]}else if(e.isArray(t.values)){t.values=t.values.slice(0)}}if(!this.range||!this.range.length){this.range=e("<div>").appendTo(this.element);this._addClass(this.range,"ui-slider-range")}else{this._removeClass(this.range,"ui-slider-range-min ui-slider-range-max");this.range.css({left:"",bottom:""})}if(t.range==="min"||t.range==="max"){this._addClass(this.range,"ui-slider-range-"+t.range)}}else{if(this.range){this.range.remove()}this.range=null}},_setupEvents:function(){this._off(this.handles);this._on(this.handles,this._handleEvents);this._hoverable(this.handles);this._focusable(this.handles)},_destroy:function(){this.handles.remove();if(this.range){this.range.remove()}this._mouseDestroy()},_mouseCapture:function(t){var n,r,i,s,o,u,a,f,l=this,c=this.options;if(c.disabled){return false}this.elementSize={width:this.element.outerWidth(),height:this.element.outerHeight()};this.elementOffset=this.element.offset();n={x:t.pageX,y:t.pageY};r=this._normValueFromMouse(n);i=this._valueMax()-this._valueMin()+1;this.handles.each(function(t){var n=Math.abs(r-l.values(t));if(i>n||i===n&&(t===l._lastChangedValue||l.values(t)===c.min)){i=n;s=e(this);o=t}});u=this._start(t,o);if(u===false){return false}this._mouseSliding=true;this._handleIndex=o;this._addClass(s,null,"ui-state-active");s.trigger("focus");a=s.offset();f=!e(t.target).parents().addBack().is(".ui-slider-handle");this._clickOffset=f?{left:0,top:0}:{left:t.pageX-a.left-s.width()/2,top:t.pageY-a.top-s.height()/2-(parseInt(s.css("borderTopWidth"),10)||0)-(parseInt(s.css("borderBottomWidth"),10)||0)+(parseInt(s.css("marginTop"),10)||0)};if(!this.handles.hasClass("ui-state-hover")){this._slide(t,o,r)}this._animateOff=true;return true},_mouseStart:function(){return true},_mouseDrag:function(e){var t={x:e.pageX,y:e.pageY},n=this._normValueFromMouse(t);this._slide(e,this._handleIndex,n);return false},_mouseStop:function(e){this._removeClass(this.handles,null,"ui-state-active");this._mouseSliding=false;this._stop(e,this._handleIndex);this._change(e,this._handleIndex);this._handleIndex=null;this._clickOffset=null;this._animateOff=false;return false},_detectOrientation:function(){this.orientation=this.options.orientation==="vertical"?"vertical":"horizontal"},_normValueFromMouse:function(e){var t,n,r,i,s;if(this.orientation==="horizontal"){t=this.elementSize.width;n=e.x-this.elementOffset.left-(this._clickOffset?this._clickOffset.left:0)}else{t=this.elementSize.height;n=e.y-this.elementOffset.top-(this._clickOffset?this._clickOffset.top:0)}r=n/t;if(r>1){r=1}if(r<0){r=0}if(this.orientation==="vertical"){r=1-r}i=this._valueMax()-this._valueMin();s=this._valueMin()+r*i;return this._trimAlignValue(s)},_uiHash:function(e,t,n){var r={handle:this.handles[e],handleIndex:e,value:t!==undefined?t:this.value()};if(this._hasMultipleValues()){r.value=t!==undefined?t:this.values(e);r.values=n||this.values()}return r},_hasMultipleValues:function(){return this.options.values&&this.options.values.length},_start:function(e,t){return this._trigger("start",e,this._uiHash(t))},_slide:function(e,t,n){var r,i,s=this.value(),o=this.values();if(this._hasMultipleValues()){i=this.values(t?0:1);s=this.values(t);if(this.options.values.length===2&&this.options.range===true){n=t===0?Math.min(i,n):Math.max(i,n)}o[t]=n}if(n===s){return}r=this._trigger("slide",e,this._uiHash(t,n,o));if(r===false){return}if(this._hasMultipleValues()){this.values(t,n)}else{this.value(n)}},_stop:function(e,t){this._trigger("stop",e,this._uiHash(t))},_change:function(e,t){if(!this._keySliding&&!this._mouseSliding){this._lastChangedValue=t;this._trigger("change",e,this._uiHash(t))}},value:function(e){if(arguments.length){this.options.value=this._trimAlignValue(e);this._refreshValue();this._change(null,0);return}return this._value()},values:function(t,n){var r,i,s;if(arguments.length>1){this.options.values[t]=this._trimAlignValue(n);this._refreshValue();this._change(null,t);return}if(arguments.length){if(e.isArray(arguments[0])){r=this.options.values;i=arguments[0];for(s=0;s<r.length;s+=1){r[s]=this._trimAlignValue(i[s]);this._change(null,s)}this._refreshValue()}else{if(this._hasMultipleValues()){return this._values(t)}else{return this.value()}}}else{return this._values()}},_setOption:function(t,n){var r,i=0;if(t==="range"&&this.options.range===true){if(n==="min"){this.options.value=this._values(0);this.options.values=null}else if(n==="max"){this.options.value=this._values(this.options.values.length-1);this.options.values=null}}if(e.isArray(this.options.values)){i=this.options.values.length}this._super(t,n);switch(t){case"orientation":this._detectOrientation();this._removeClass("ui-slider-horizontal ui-slider-vertical")._addClass("ui-slider-"+this.orientation);this._refreshValue();if(this.options.range){this._refreshRange(n)}this.handles.css(n==="horizontal"?"bottom":"left","");break;case"value":this._animateOff=true;this._refreshValue();this._change(null,0);this._animateOff=false;break;case"values":this._animateOff=true;this._refreshValue();for(r=i-1;r>=0;r--){this._change(null,r)}this._animateOff=false;break;case"step":case"min":case"max":this._animateOff=true;this._calculateNewMax();this._refreshValue();this._animateOff=false;break;case"range":this._animateOff=true;this._refresh();this._animateOff=false;break}},_setOptionDisabled:function(e){this._super(e);this._toggleClass(null,"ui-state-disabled",!!e)},_value:function(){var e=this.options.value;e=this._trimAlignValue(e);return e},_values:function(e){var t,n,r;if(arguments.length){t=this.options.values[e];t=this._trimAlignValue(t);return t}else if(this._hasMultipleValues()){n=this.options.values.slice();for(r=0;r<n.length;r+=1){n[r]=this._trimAlignValue(n[r])}return n}else{return[]}},_trimAlignValue:function(e){if(e<=this._valueMin()){return this._valueMin()}if(e>=this._valueMax()){return this._valueMax()}var t=this.options.step>0?this.options.step:1,n=(e-this._valueMin())%t,r=e-n;if(Math.abs(n)*2>=t){r+=n>0?t:-t}return parseFloat(r.toFixed(5))},_calculateNewMax:function(){var e=this.options.max,t=this._valueMin(),n=this.options.step,r=Math.round((e-t)/n)*n;e=r+t;if(e>this.options.max){e-=n}this.max=parseFloat(e.toFixed(this._precision()))},_precision:function(){var e=this._precisionOf(this.options.step);if(this.options.min!==null){e=Math.max(e,this._precisionOf(this.options.min))}return e},_precisionOf:function(e){var t=e.toString(),n=t.indexOf(".");return n===-1?0:t.length-n-1},_valueMin:function(){return this.options.min},_valueMax:function(){return this.max},_refreshRange:function(e){if(e==="vertical"){this.range.css({width:"",left:""})}if(e==="horizontal"){this.range.css({height:"",bottom:""})}},_refreshValue:function(){var t,n,r,i,s,o=this.options.range,u=this.options,a=this,f=!this._animateOff?u.animate:false,l={};if(this._hasMultipleValues()){this.handles.each(function(r){n=(a.values(r)-a._valueMin())/(a._valueMax()-a._valueMin())*100;l[a.orientation==="horizontal"?"left":"bottom"]=n+"%";e(this).stop(1,1)[f?"animate":"css"](l,u.animate);if(a.options.range===true){if(a.orientation==="horizontal"){if(r===0){a.range.stop(1,1)[f?"animate":"css"]({left:n+"%"},u.animate)}if(r===1){a.range[f?"animate":"css"]({width:n-t+"%"},{queue:false,duration:u.animate})}}else{if(r===0){a.range.stop(1,1)[f?"animate":"css"]({bottom:n+"%"},u.animate)}if(r===1){a.range[f?"animate":"css"]({height:n-t+"%"},{queue:false,duration:u.animate})}}}t=n})}else{r=this.value();i=this._valueMin();s=this._valueMax();n=s!==i?(r-i)/(s-i)*100:0;l[this.orientation==="horizontal"?"left":"bottom"]=n+"%";this.handle.stop(1,1)[f?"animate":"css"](l,u.animate);if(o==="min"&&this.orientation==="horizontal"){this.range.stop(1,1)[f?"animate":"css"]({width:n+"%"},u.animate)}if(o==="max"&&this.orientation==="horizontal"){this.range.stop(1,1)[f?"animate":"css"]({width:100-n+"%"},u.animate)}if(o==="min"&&this.orientation==="vertical"){this.range.stop(1,1)[f?"animate":"css"]({height:n+"%"},u.animate)}if(o==="max"&&this.orientation==="vertical"){this.range.stop(1,1)[f?"animate":"css"]({height:100-n+"%"},u.animate)}}},_handleEvents:{keydown:function(t){var n,r,i,s,o=e(t.target).data("ui-slider-handle-index");switch(t.keyCode){case e.ui.keyCode.HOME:case e.ui.keyCode.END:case e.ui.keyCode.PAGE_UP:case e.ui.keyCode.PAGE_DOWN:case e.ui.keyCode.UP:case e.ui.keyCode.RIGHT:case e.ui.keyCode.DOWN:case e.ui.keyCode.LEFT:t.preventDefault();if(!this._keySliding){this._keySliding=true;this._addClass(e(t.target),null,"ui-state-active");n=this._start(t,o);if(n===false){return}}break}s=this.options.step;if(this._hasMultipleValues()){r=i=this.values(o)}else{r=i=this.value()}switch(t.keyCode){case e.ui.keyCode.HOME:i=this._valueMin();break;case e.ui.keyCode.END:i=this._valueMax();break;case e.ui.keyCode.PAGE_UP:i=this._trimAlignValue(r+(this._valueMax()-this._valueMin())/this.numPages);break;case e.ui.keyCode.PAGE_DOWN:i=this._trimAlignValue(r-(this._valueMax()-this._valueMin())/this.numPages);break;case e.ui.keyCode.UP:case e.ui.keyCode.RIGHT:if(r===this._valueMax()){return}i=this._trimAlignValue(r+s);break;case e.ui.keyCode.DOWN:case e.ui.keyCode.LEFT:if(r===this._valueMin()){return}i=this._trimAlignValue(r-s);break}this._slide(t,o,i)},keyup:function(t){var n=e(t.target).data("ui-slider-handle-index");if(this._keySliding){this._keySliding=false;this._stop(t,n);this._change(t,n);this._removeClass(e(t.target),null,"ui-state-active")}}}})})