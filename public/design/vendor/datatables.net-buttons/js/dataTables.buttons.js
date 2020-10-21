!function(e){"function"==typeof define&&define.amd?define(["jquery","datatables.net"],function(t){return e(t,window,document)}):"object"==typeof exports?module.exports=function(t,n){return t=t||window,n&&n.fn.dataTable||(n=require("datatables.net")(t,n).$),e(n,t,t.document)}:e(jQuery,window,document)}(function(y,_,x,k){"use strict";var i,o=y.fn.dataTable,e=0,h=0,c=o.ext.buttons,A=function(t,n){void 0===n&&(n={}),!0===n&&(n={}),y.isArray(n)&&(n={buttons:n}),this.c=y.extend(!0,{},A.defaults,n),n.buttons&&(this.c.buttons=n.buttons),this.s={dt:new o.Api(t),buttons:[],listenKeys:"",namespace:"dtb"+e++},this.dom={container:y("<"+this.c.dom.container.tag+"/>").addClass(this.c.dom.container.className)},this._constructor()};y.extend(A.prototype,{action:function(t,n){var e=this._nodeToButton(t);return n===k?e.conf.action:(e.conf.action=n,this)},active:function(t,n){var e=this._nodeToButton(t),o=this.c.dom.button.active,i=y(e.node);return n===k?i.hasClass(o):(i.toggleClass(o,n===k||n),this)},add:function(t,n){var e=this.s.buttons;if("string"==typeof n){for(var o=n.split("-"),i=this.s,s=0,r=o.length-1;s<r;s++)i=i.buttons[+o[s]];e=i.buttons,n=+o[o.length-1]}return this._expandButton(e,t,!1,n),this._draw(),this},container:function(){return this.dom.container},disable:function(t){var n=this._nodeToButton(t);return y(n.node).addClass(this.c.dom.button.disabled),this},destroy:function(){y("body").off("keyup."+this.s.namespace);for(var t=this.s.buttons.slice(),n=0,e=t.length;n<e;n++)this.remove(t[n].node);this.dom.container.remove();var o=this.s.dt.settings()[0];for(n=0,e=o.length;n<e;n++)if(o.inst===this){o.splice(n,1);break}return this},enable:function(t,n){if(!1===n)return this.disable(t);var e=this._nodeToButton(t);return y(e.node).removeClass(this.c.dom.button.disabled),this},name:function(){return this.c.name},node:function(t){var n=this._nodeToButton(t);return y(n.node)},processing:function(t,n){var e=this._nodeToButton(t);return n===k?y(e.node).hasClass("processing"):(y(e.node).toggleClass("processing",n),this)},remove:function(t){var n=this._nodeToButton(t),e=this._nodeToHost(t),o=this.s.dt;if(n.buttons.length)for(var i=n.buttons.length-1;0<=i;i--)this.remove(n.buttons[i].node);n.conf.destroy&&n.conf.destroy.call(o.button(t),o,y(t),n.conf),this._removeKey(n.conf),y(n.node).remove();var s=y.inArray(n,e);return e.splice(s,1),this},text:function(t,n){function e(t){return"function"==typeof t?t(r,a,o.conf):t}var o=this._nodeToButton(t),i=this.c.dom.collection.buttonLiner,s=o.inCollection&&i&&i.tag?i.tag:this.c.dom.buttonLiner.tag,r=this.s.dt,a=y(o.node);return n===k?e(o.conf.text):(o.conf.text=n,s?a.children(s).html(e(n)):a.html(e(n)),this)},_constructor:function(){var e=this,t=this.s.dt,o=t.settings()[0],n=this.c.buttons;o._buttons||(o._buttons=[]),o._buttons.push({inst:this,name:this.c.name});for(var i=0,s=n.length;i<s;i++)this.add(n[i]);t.on("destroy",function(t,n){n===o&&e.destroy()}),y("body").on("keyup."+this.s.namespace,function(t){var n;x.activeElement&&x.activeElement!==x.body||(n=String.fromCharCode(t.keyCode).toLowerCase(),-1!==e.s.listenKeys.toLowerCase().indexOf(n)&&e._keypress(n,t))})},_addKey:function(t){t.key&&(this.s.listenKeys+=y.isPlainObject(t.key)?t.key.key:t.key)},_draw:function(t,n){t||(t=this.dom.container,n=this.s.buttons),t.children().detach();for(var e=0,o=n.length;e<o;e++)t.append(n[e].inserter),t.append(" "),n[e].buttons&&n[e].buttons.length&&this._draw(n[e].collection,n[e].buttons)},_expandButton:function(t,n,e,o){for(var i=this.s.dt,s=y.isArray(n)?n:[n],r=0,a=s.length;r<a;r++){var l,c,u=this._resolveExtends(s[r]);u&&(y.isArray(u)?this._expandButton(t,u,e,o):(l=this._buildButton(u,e))&&(o!==k?(t.splice(o,0,l),o++):t.push(l),l.conf.buttons&&(c=this.c.dom.collection,l.collection=y("<"+c.tag+"/>").addClass(c.className).attr("role","menu"),l.conf._collection=l.collection,this._expandButton(l.buttons,l.conf.buttons,!0,o)),u.init&&u.init.call(i.button(l.node),i,y(l.node),u),0))}},_buildButton:function(n,t){function e(t){return"function"==typeof t?t(r,u,n):t}var o=this.c.dom.button,i=this.c.dom.buttonLiner,s=this.c.dom.collection,r=this.s.dt;if(t&&s.button&&(o=s.button),t&&s.buttonLiner&&(i=s.buttonLiner),n.available&&!n.available(r,n))return!1;function a(t,n,e,o){o.action.call(n.button(e),t,n,e,o),y(n.table().node()).triggerHandler("buttons-action.dt",[n.button(e),n,e,o])}var l,c=n.tag||o.tag,u=y("<"+c+"/>").addClass(o.className).attr("tabindex",this.s.dt.settings()[0].iTabIndex).attr("aria-controls",this.s.dt.table().node().id).on("click.dtb",function(t){t.preventDefault(),!u.hasClass(o.disabled)&&n.action&&a(t,r,u,n),u.blur()}).on("keyup.dtb",function(t){13===t.keyCode&&!u.hasClass(o.disabled)&&n.action&&a(t,r,u,n)});"a"===c.toLowerCase()&&u.attr("href","#"),"button"===c.toLowerCase()&&u.attr("type","button"),i.tag?(l=y("<"+i.tag+"/>").html(e(n.text)).addClass(i.className),"a"===i.tag.toLowerCase()&&l.attr("href","#"),u.append(l)):u.html(e(n.text)),!1===n.enabled&&u.addClass(o.disabled),n.className&&u.addClass(n.className),n.titleAttr&&u.attr("title",e(n.titleAttr)),n.attr&&u.attr(n.attr),n.namespace||(n.namespace=".dt-button-"+h++);var d=this.c.dom.buttonContainer,f=d&&d.tag?y("<"+d.tag+"/>").addClass(d.className).append(u):u;return this._addKey(n),{conf:n,node:u.get(0),inserter:f,buttons:[],inCollection:t,collection:null}},_nodeToButton:function(t,n){for(var e=0,o=(n=n||this.s.buttons).length;e<o;e++){if(n[e].node===t)return n[e];if(n[e].buttons.length){var i=this._nodeToButton(t,n[e].buttons);if(i)return i}}},_nodeToHost:function(t,n){for(var e=0,o=(n=n||this.s.buttons).length;e<o;e++){if(n[e].node===t)return n;if(n[e].buttons.length){var i=this._nodeToHost(t,n[e].buttons);if(i)return i}}},_keypress:function(o,i){var s;i._buttonsHandled||(s=function(t){for(var n=0,e=t.length;n<e;n++)!function(t,n){if(t.key)if(t.key===o)i._buttonsHandled=!0,y(n).click();else if(y.isPlainObject(t.key)){if(t.key.key!==o)return;if(t.key.shiftKey&&!i.shiftKey)return;if(t.key.altKey&&!i.altKey)return;if(t.key.ctrlKey&&!i.ctrlKey)return;if(t.key.metaKey&&!i.metaKey)return;i._buttonsHandled=!0,y(n).click()}}(t[n].conf,t[n].node),t[n].buttons.length&&s(t[n].buttons)})(this.s.buttons)},_removeKey:function(t){var n,e,o;t.key&&(n=y.isPlainObject(t.key)?t.key.key:t.key,e=this.s.listenKeys.split(""),o=y.inArray(n,e),e.splice(o,1),this.s.listenKeys=e.join(""))},_resolveExtends:function(e){function t(t){for(var n=0;!y.isPlainObject(t)&&!y.isArray(t);){if(t===k)return;if("function"==typeof t){if(!(t=t(i,e)))return!1}else if("string"==typeof t){if(!c[t])throw"Unknown button type: "+t;t=c[t]}if(30<++n)throw"Buttons: Too many iterations"}return y.isArray(t)?t:y.extend({},t)}var n,o,i=this.s.dt;for(e=t(e);e&&e.extend;){if(!c[e.extend])throw"Cannot extend unknown button type: "+e.extend;var s=t(c[e.extend]);if(y.isArray(s))return s;if(!s)return!1;var r=s.className;e=y.extend({},s,e),r&&e.className!==r&&(e.className=r+" "+e.className);var a=e.postfixButtons;if(a){for(e.buttons||(e.buttons=[]),n=0,o=a.length;n<o;n++)e.buttons.push(a[n]);e.postfixButtons=null}var l=e.prefixButtons;if(l){for(e.buttons||(e.buttons=[]),n=0,o=l.length;n<o;n++)e.buttons.splice(n,0,l[n]);e.prefixButtons=null}e.extend=s.extend}return e}}),A.background=function(t,n,e,o){e===k&&(e=400),o=o||x.body,t?y("<div/>").addClass(n).css("display","none").insertAfter(o).fadeIn(e):y("div."+n).fadeOut(e,function(){y(this).removeClass(n).remove()})},A.instanceSelector=function(t,i){if(!t)return y.map(i,function(t){return t.inst});var s=[],r=y.map(i,function(t){return t.name}),a=function(t){var n;if(y.isArray(t))for(var e=0,o=t.length;e<o;e++)a(t[e]);else"string"==typeof t?-1!==t.indexOf(",")?a(t.split(",")):-1!==(n=y.inArray(y.trim(t),r))&&s.push(i[n].inst):"number"==typeof t&&s.push(i[t].inst)};return a(t),s},A.buttonSelector=function(t,n){for(var u=[],d=function(t,n,e){for(var o,i,s=0,r=n.length;s<r;s++)(o=n[s])&&(i=e!==k?e+s:s+"",t.push({node:o.node,name:o.conf.name,idx:i}),o.buttons&&d(t,o.buttons,i+"-"))},f=function(t,n){var e=[];d(e,n.s.buttons);var o,i=y.map(e,function(t){return t.node});if(y.isArray(t)||t instanceof y)for(r=0,a=t.length;r<a;r++)f(t[r],n);else if(null===t||t===k||"*"===t)for(r=0,a=e.length;r<a;r++)u.push({inst:n,node:e[r].node});else if("number"==typeof t)u.push({inst:n,node:n.s.buttons[t].node});else if("string"==typeof t)if(-1!==t.indexOf(","))for(var s=t.split(","),r=0,a=s.length;r<a;r++)f(y.trim(s[r]),n);else if(t.match(/^\d+(\-\d+)*$/)){var l=y.map(e,function(t){return t.idx});u.push({inst:n,node:e[y.inArray(t,l)].node})}else if(-1!==t.indexOf(":name")){var c=t.replace(":name","");for(r=0,a=e.length;r<a;r++)e[r].name===c&&u.push({inst:n,node:e[r].node})}else y(i).filter(t).each(function(){u.push({inst:n,node:this})});else{"object"!=typeof t||!t.nodeName||-1!==(o=y.inArray(t,i))&&u.push({inst:n,node:i[o]})}},e=0,o=t.length;e<o;e++){var i=t[e];f(n,i)}return u},A.defaults={buttons:["copy","excel","csv","pdf","print"],name:"main",tabIndex:0,dom:{container:{tag:"div",className:"dt-buttons"},collection:{tag:"div",className:"dt-button-collection"},button:{tag:"ActiveXObject"in _?"a":"button",className:"dt-button",active:"active",disabled:"disabled"},buttonLiner:{tag:"span",className:""}}},A.version="1.5.4",y.extend(c,{collection:{text:function(t){return t.i18n("buttons.collection","Collection")},className:"buttons-collection",action:function(t,n,e,o){var i=e,s=y(e).parents("div.dt-button-collection"),r=i.position(),a=y(n.table().container()),l=!1,c=i;s.length&&(l=y(".dt-button-collection").position(),c=s,y("body").trigger("click.dtb-collection")),c.parents("body")[0]!==x.body&&(c=x.body.lastChild),o._collection.find(".dt-button-collection-title").remove(),o._collection.prepend('<div class="dt-button-collection-title">'+o.collectionTitle+"</div>"),o._collection.addClass(o.collectionLayout).css("display","none").insertAfter(c).fadeIn(o.fade);var u,d,f,h,b,p,g,m=o._collection.css("position");l&&"absolute"===m?o._collection.css({top:l.top,left:l.left}):"absolute"===m?(o._collection.css({top:r.top+i.outerHeight(),left:r.left}),u=a.offset().top+a.height(),d=r.top+i.outerHeight()+o._collection.outerHeight()-u,f=r.top-o._collection.outerHeight(),(a.offset().top-f<d||o.dropup)&&o._collection.css("top",r.top-o._collection.outerHeight()-5),o._collection.hasClass(o.rightAlignClassName)&&o._collection.css("left",r.left+i.outerWidth()-o._collection.outerWidth()),h=r.left+o._collection.outerWidth(),(b=a.offset().left+a.width())<h&&o._collection.css("left",r.left-(h-b)),(p=i.offset().left+o._collection.outerWidth())>y(_).width()&&o._collection.css("left",r.left-(p-y(_).width()))):((g=o._collection.height()/2)>y(_).height()/2&&(g=y(_).height()/2),o._collection.css("marginTop",-1*g)),o.background&&A.background(!0,o.backgroundClassName,o.fade,c);function v(){o._collection.fadeOut(o.fade,function(){o._collection.detach()}),y("div.dt-button-background").off("click.dtb-collection"),A.background(!1,o.backgroundClassName,o.fade,c),y("body").off(".dtb-collection"),n.off("buttons-action.b-internal")}setTimeout(function(){y("div.dt-button-background").on("click.dtb-collection",function(){}),y("body").on("click.dtb-collection",function(t){var n=y.fn.addBack?"addBack":"andSelf";y(t.target).parents()[n]().filter(o._collection).length||v()}).on("keyup.dtb-collection",function(t){27===t.keyCode&&v()}),o.autoClose&&n.on("buttons-action.b-internal",function(){v()})},10)},background:!0,collectionLayout:"",collectionTitle:"",backgroundClassName:"dt-button-background",rightAlignClassName:"dt-button-right",autoClose:!1,fade:400,attr:{"aria-haspopup":!0}},copy:function(t,n){return c.copyHtml5?"copyHtml5":c.copyFlash&&c.copyFlash.available(t,n)?"copyFlash":void 0},csv:function(t,n){return c.csvHtml5&&c.csvHtml5.available(t,n)?"csvHtml5":c.csvFlash&&c.csvFlash.available(t,n)?"csvFlash":void 0},excel:function(t,n){return c.excelHtml5&&c.excelHtml5.available(t,n)?"excelHtml5":c.excelFlash&&c.excelFlash.available(t,n)?"excelFlash":void 0},pdf:function(t,n){return c.pdfHtml5&&c.pdfHtml5.available(t,n)?"pdfHtml5":c.pdfFlash&&c.pdfFlash.available(t,n)?"pdfFlash":void 0},pageLength:function(t){function i(t){return t.i18n("buttons.pageLength",{"-1":"Show all rows",_:"Show %d rows"},t.page.len())}var n=t.settings()[0].aLengthMenu,e=y.isArray(n[0])?n[0]:n,o=y.isArray(n[0])?n[1]:n;return{extend:"collection",text:i,className:"buttons-page-length",autoClose:!0,buttons:y.map(e,function(s,t){return{text:o[t],className:"button-page-length",action:function(t,n){n.page.len(s).draw()},init:function(t,n,e){function o(){i.active(t.page.len()===s)}var i=this;t.on("length.dt"+e.namespace,o),o()},destroy:function(t,n,e){t.off("length.dt"+e.namespace)}}}),init:function(t,n,e){var o=this;t.on("length.dt"+e.namespace,function(){o.text(i(t))})},destroy:function(t,n,e){t.off("length.dt"+e.namespace)}}}}),o.Api.register("buttons()",function(n,e){e===k&&(e=n,n=k),this.selector.buttonGroup=n;var t=this.iterator(!0,"table",function(t){if(t._buttons)return A.buttonSelector(A.instanceSelector(n,t._buttons),e)},!0);return t._groupSelector=n,t}),o.Api.register("button()",function(t,n){var e=this.buttons(t,n);return 1<e.length&&e.splice(1,e.length),e}),o.Api.registerPlural("buttons().active()","button().active()",function(n){return n===k?this.map(function(t){return t.inst.active(t.node)}):this.each(function(t){t.inst.active(t.node,n)})}),o.Api.registerPlural("buttons().action()","button().action()",function(n){return n===k?this.map(function(t){return t.inst.action(t.node)}):this.each(function(t){t.inst.action(t.node,n)})}),o.Api.register(["buttons().enable()","button().enable()"],function(n){return this.each(function(t){t.inst.enable(t.node,n)})}),o.Api.register(["buttons().disable()","button().disable()"],function(){return this.each(function(t){t.inst.disable(t.node)})}),o.Api.registerPlural("buttons().nodes()","button().node()",function(){var n=y();return y(this.each(function(t){n=n.add(t.inst.node(t.node))})),n}),o.Api.registerPlural("buttons().processing()","button().processing()",function(n){return n===k?this.map(function(t){return t.inst.processing(t.node)}):this.each(function(t){t.inst.processing(t.node,n)})}),o.Api.registerPlural("buttons().text()","button().text()",function(n){return n===k?this.map(function(t){return t.inst.text(t.node)}):this.each(function(t){t.inst.text(t.node,n)})}),o.Api.registerPlural("buttons().trigger()","button().trigger()",function(){return this.each(function(t){t.inst.node(t.node).trigger("click")})}),o.Api.registerPlural("buttons().containers()","buttons().container()",function(){var i=y(),s=this._groupSelector;return this.iterator(!0,"table",function(t){if(t._buttons)for(var n=A.instanceSelector(s,t._buttons),e=0,o=n.length;e<o;e++)i=i.add(n[e].container())}),i}),o.Api.register("button().add()",function(t,n){var e,o=this.context;return!o.length||(e=A.instanceSelector(this._groupSelector,o[0]._buttons)).length&&e[0].add(n,t),this.button(this._groupSelector,t)}),o.Api.register("buttons().destroy()",function(){return this.pluck("inst").unique().each(function(t){t.destroy()}),this}),o.Api.registerPlural("buttons().remove()","buttons().remove()",function(){return this.each(function(t){t.inst.remove(t.node)}),this}),o.Api.register("buttons.info()",function(t,n,e){var o=this;return!1===t?(y("#datatables_buttons_info").fadeOut(function(){y(this).remove()}),clearTimeout(i),i=null):(i&&clearTimeout(i),y("#datatables_buttons_info").length&&y("#datatables_buttons_info").remove(),t=t?"<h2>"+t+"</h2>":"",y('<div id="datatables_buttons_info" class="dt-button-info"/>').html(t).append(y("<div/>")["string"==typeof n?"html":"append"](n)).css("display","none").appendTo("body").fadeIn(),e!==k&&0!==e&&(i=setTimeout(function(){o.buttons.info(!1)},e))),this}),o.Api.register("buttons.exportData()",function(t){if(this.context.length)return l(new o.Api(this.context[0]),t)}),o.Api.register("buttons.exportInfo()",function(t){return{filename:n(t=t||{}),title:r(t),messageTop:a(this,t.message||t.messageTop,"top"),messageBottom:a(this,t.messageBottom,"bottom")}});var n=function(t){var n="*"===t.filename&&"*"!==t.title&&t.title!==k&&null!==t.title&&""!==t.title?t.title:t.filename;return"function"==typeof n&&(n=n()),n===k||null===n?null:(-1!==n.indexOf("*")&&(n=y.trim(n.replace("*",y("head > title").text()))),(n=n.replace(/[^a-zA-Z0-9_\u00A1-\uFFFF\.,\-_ !\(\)]/g,""))+(s(t.extension)||""))},s=function(t){return null===t||t===k?null:"function"==typeof t?t():t},r=function(t){var n=s(t.title);return null===n?null:-1!==n.indexOf("*")?n.replace("*",y("head > title").text()||"Exported data"):n},a=function(t,n,e){var o=s(n);if(null===o)return null;var i=y("caption",t.table().container()).eq(0);return"*"!==o?o:i.css("caption-side")!==e?null:i.length?i.text():""},C=y("<textarea/>")[0],l=function(e,t){var o=y.extend(!0,{},{rows:null,columns:"",modifier:{search:"applied",order:"applied"},orthogonal:"display",stripHtml:!0,stripNewlines:!0,decodeEntities:!0,trim:!0,format:{header:function(t){return n(t)},footer:function(t){return n(t)},body:function(t){return n(t)}},customizeData:null},t),n=function(t){return"string"!=typeof t||(t=(t=t.replace(/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi,"")).replace(/<!\-\-.*?\-\->/g,""),o.stripHtml&&(t=t.replace(/<[^>]*>/g,"")),o.trim&&(t=t.replace(/^\s+|\s+$/g,"")),o.stripNewlines&&(t=t.replace(/\n/g," ")),o.decodeEntities&&(C.innerHTML=t,t=C.value)),t},i=e.columns(o.columns).indexes().map(function(t){var n=e.column(t).header();return o.format.header(n.innerHTML,t,n)}).toArray(),s=e.table().footer()?e.columns(o.columns).indexes().map(function(t){var n=e.column(t).footer();return o.format.footer(n?n.innerHTML:"",t,n)}).toArray():null,r=y.extend({},o.modifier);e.select&&"function"==typeof e.select.info&&r.selected===k&&e.rows(o.rows,y.extend({selected:!0},r)).any()&&y.extend(r,{selected:!0});for(var a=e.rows(o.rows,r).indexes().toArray(),l=e.cells(a,o.columns),c=l.render(o.orthogonal).toArray(),u=l.nodes().toArray(),d=i.length,f=[],h=0,b=0,p=0<d?c.length/d:0;b<p;b++){for(var g=[d],m=0;m<d;m++)g[m]=o.format.body(c[h],b,m,u[h]),h++;f[b]=g}var v={header:i,footer:s,body:f};return o.customizeData&&o.customizeData(v),v};return y.fn.dataTable.Buttons=A,y.fn.DataTable.Buttons=A,y(x).on("init.dt plugin-init.dt",function(t,n){var e;"dt"!==t.namespace||(e=n.oInit.buttons||o.defaults.buttons)&&!n._buttons&&new A(n,e).container()}),o.ext.feature.push({fnInit:function(t){var n=new o.Api(t),e=n.init().buttons||o.defaults.buttons;return new A(n,e).container()},cFeature:"B"}),A});