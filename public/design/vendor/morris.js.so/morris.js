(function(){function t(t,i){for(var e in i)d.call(i,e)&&(t[e]=i[e]);function s(){this.constructor=t}return s.prototype=i.prototype,t.prototype=new s,t.__super__=i.prototype,t}var S,L,i,e,s,o,n,r,h,a,l,p=[].slice,u=function(t,i){return function(){return t.apply(i,arguments)}},d={}.hasOwnProperty,c=[].indexOf||function(t){for(var i=0,e=this.length;i<e;i++)if(i in this&&this[i]===t)return i;return-1};function f(){}function g(t){this.hasToShow=u(this.hasToShow,this),this.resizeHandler=u(this.resizeHandler,this);var n=this;if("string"==typeof t.element?this.el=S(document.getElementById(t.element)):this.el=S(t.element),null==this.el||0===this.el.length)throw new Error("Graph container element not found");"static"===this.el.css("position")&&this.el.css("position","relative"),this.options=S.extend({},this.gridDefaults,this.defaults||{},t),"string"==typeof this.options.units&&(this.options.postUnits=t.units),this.raphael=new Raphael(this.el[0]),this.elementWidth=null,this.elementHeight=null,this.dirty=!1,this.selectFrom=null,this.init&&this.init(),this.setData(this.options.data),this.el.bind("mousemove",function(t){var i,e,s=n.el.offset(),o=t.pageX-s.left;return n.selectFrom?(i=n.data[n.hitTest(Math.min(o,n.selectFrom))]._x,e=n.data[n.hitTest(Math.max(o,n.selectFrom))]._x-i,n.selectionRect.attr({x:i,width:e})):n.fire("hovermove",o,t.pageY-s.top)}),this.el.bind("mouseleave",function(t){return n.selectFrom&&(n.selectionRect.hide(),n.selectFrom=null),n.fire("hoverout")}),this.el.bind("touchstart touchmove touchend",function(t){var i=t.originalEvent.touches[0]||t.originalEvent.changedTouches[0],e=n.el.offset();return n.fire("hovermove",i.pageX-e.left,i.pageY-e.top)}),this.el.bind("click",function(t){var i=n.el.offset();return n.fire("gridclick",t.pageX-i.left,t.pageY-i.top)}),this.options.rangeSelect&&(this.selectionRect=this.raphael.rect(0,0,0,this.el.innerHeight()).attr({fill:this.options.rangeSelectColor,stroke:!1}).toBack().hide(),this.el.bind("mousedown",function(t){var i=n.el.offset();return n.startRange(t.pageX-i.left)}),this.el.bind("mouseup",function(t){var i=n.el.offset();return n.endRange(t.pageX-i.left),n.fire("hovermove",t.pageX-i.left,t.pageY-i.top)})),this.options.resize&&S(window).bind("resize",function(t){return null!=n.timeoutId&&window.clearTimeout(n.timeoutId),n.timeoutId=window.setTimeout(n.resizeHandler,100)}),this.el.css("-webkit-tap-highlight-color","rgba(0,0,0,0)"),this.postInit&&this.postInit()}function y(t){null==t&&(t={}),this.options=S.extend({},L.Hover.defaults,t),this.el=S("<div class='"+this.options.class+"'></div>"),this.el.hide(),this.options.parent.append(this.el)}function m(t){if(this.hilight=u(this.hilight,this),this.onHoverOut=u(this.onHoverOut,this),this.onHoverMove=u(this.onHoverMove,this),this.onGridClick=u(this.onGridClick,this),!(this instanceof L.Line))return new L.Line(t);m.__super__.constructor.call(this,t)}function x(t){var i;if(!(this instanceof L.Area))return new L.Area(t);i=S.extend({},r,t),this.cumulative=!i.behaveLikeLine,"auto"===i.fillOpacity&&(i.fillOpacity=i.behaveLikeLine?.8:1),x.__super__.constructor.call(this,i)}function v(t){if(this.onHoverOut=u(this.onHoverOut,this),this.onHoverMove=u(this.onHoverMove,this),this.onGridClick=u(this.onGridClick,this),!(this instanceof L.Bar))return new L.Bar(t);v.__super__.constructor.call(this,S.extend({},t,{parseTime:!1}))}function w(t){this.resizeHandler=u(this.resizeHandler,this),this.select=u(this.select,this),this.click=u(this.click,this);var i=this;if(!(this instanceof L.Donut))return new L.Donut(t);if(this.options=S.extend({},this.defaults,t),"string"==typeof t.element?this.el=S(document.getElementById(t.element)):this.el=S(t.element),null===this.el||0===this.el.length)throw new Error("Graph placeholder not found.");void 0!==t.data&&0!==t.data.length&&(this.raphael=new Raphael(this.el[0]),this.options.resize&&S(window).bind("resize",function(t){return null!=i.timeoutId&&window.clearTimeout(i.timeoutId),i.timeoutId=window.setTimeout(i.resizeHandler,100)}),this.setData(t.data))}function b(t,i,e,s,o,n,r,h,a,l){this.cx=t,this.cy=i,this.inner=e,this.outer=s,this.color=r,this.backgroundColor=h,this.index=a,this.raphael=l,this.deselect=u(this.deselect,this),this.select=u(this.select,this),this.sin_p0=Math.sin(o),this.cos_p0=Math.cos(o),this.sin_p1=Math.sin(n),this.cos_p1=Math.cos(n),this.is_long=n-o>Math.PI?1:0,this.path=this.calcSegment(this.inner+3,this.inner+this.outer-5),this.selectedPath=this.calcSegment(this.inner+3,this.inner+this.outer),this.hilight=this.calcArc(this.inner)}L=window.Morris={},S=jQuery,L.EventEmitter=(f.prototype.on=function(t,i){return null==this.handlers&&(this.handlers={}),null==this.handlers[t]&&(this.handlers[t]=[]),this.handlers[t].push(i),this},f.prototype.fire=function(){var t,i,e,s,o,n=arguments[0],r=2<=arguments.length?p.call(arguments,1):[];if(null!=this.handlers&&null!=this.handlers[n]){for(o=[],i=0,e=(s=this.handlers[n]).length;i<e;i++)t=s[i],o.push(t.apply(null,r));return o}},f),L.commas=function(t){var i,e,s,o;return null!=t?(s=t<0?"-":"",i=Math.abs(t),s+=(e=Math.floor(i).toFixed(0)).replace(/(?=(?:\d{3})+$)(?!^)/g,","),(o=i.toString()).length>e.length&&(s+=o.slice(e.length)),s):"-"},L.pad2=function(t){return(t<10?"0":"")+t},L.Grid=(s=L.EventEmitter,t(g,s),g.prototype.gridDefaults={dateFormat:null,axes:!0,grid:!0,gridLineColor:"#aaa",gridStrokeWidth:.5,gridTextColor:"#888",gridTextSize:12,gridTextFamily:"sans-serif",gridTextWeight:"normal",hideHover:!1,yLabelFormat:null,xLabelAngle:0,numLines:5,padding:25,parseTime:!0,postUnits:"",preUnits:"",ymax:"auto",ymin:"auto 0",goals:[],goalStrokeWidth:1,goalLineColors:["#666633","#999966","#cc6666","#663333"],events:[],eventStrokeWidth:1,eventLineColors:["#005a04","#ccffbb","#3a5f0b","#005502"],rangeSelect:null,rangeSelectColor:"#eef",resize:!1},g.prototype.setData=function(s,t){var i,e,o,n,r,h,a,l,p,u,d,c,f,g,y,m,x,v,w,b,M;if(null==t&&(t=!0),null==(this.options.data=s)||0===s.length)return this.data=[],this.raphael.clear(),void(null!=this.hover&&this.hover.hide());if(y=this.cumulative?0:null,m=this.cumulative?0:null,0<this.options.goals.length&&(a=Math.min.apply(Math,this.options.goals),h=Math.max.apply(Math,this.options.goals),m=null!=m?Math.min(m,a):a,y=null!=y?Math.max(y,h):h),this.data=function(){var t,i,e=[];for(r=t=0,i=s.length;t<i;r=++t)p=s[r],(l={src:p}).label=p[this.options.xkey],this.options.parseTime?(l.x=L.parseDate(l.label),this.options.dateFormat?l.label=this.options.dateFormat(l.x):"number"==typeof l.label&&(l.label=new Date(l.label).toString())):(l.x=r,this.options.xLabelFormat&&(l.label=this.options.xLabelFormat(l))),c=0,l.y=function(){var t,i,e=this.options.ykeys,s=[];for(n=t=0,i=e.length;t<i;n=++t)g=e[n],"string"==typeof(x=p[g])&&(x=parseFloat(x)),null!=x&&"number"!=typeof x&&(x=null),null!=x&&this.hasToShow(n)&&(this.cumulative?c+=x:null!=y?(y=Math.max(x,y),m=Math.min(x,m)):y=m=x),this.cumulative&&null!=c&&(y=Math.max(c,y),m=Math.min(c,m)),s.push(x);return s}.call(this),e.push(l);return e}.call(this),this.options.parseTime&&(this.data=this.data.sort(function(t,i){return(t.x>i.x)-(i.x>t.x)})),this.xmin=this.data[0].x,this.xmax=this.data[this.data.length-1].x,this.events=[],0<this.options.events.length){if(this.options.parseTime)for(v=0,w=(b=this.options.events).length;v<w;v++)(i=b[v])instanceof Array?(o=i[0],d=i[1],this.events.push([L.parseDate(o),L.parseDate(d)])):this.events.push(L.parseDate(i));else this.events=this.options.events;e=S.map(this.events,function(t){return t}),this.xmax=Math.max(this.xmax,Math.max.apply(Math,e)),this.xmin=Math.min(this.xmin,Math.min.apply(Math,e))}return this.xmin===this.xmax&&(--this.xmin,this.xmax+=1),this.ymin=this.yboundary("min",m),this.ymax=this.yboundary("max",y),this.ymin===this.ymax&&(m&&--this.ymin,this.ymax+=1),!0!==(M=this.options.axes)&&"both"!==M&&"y"!==M&&!0!==this.options.grid||(this.options.ymax===this.gridDefaults.ymax&&this.options.ymin===this.gridDefaults.ymin?(this.grid=this.autoGridLines(this.ymin,this.ymax,this.options.numLines),this.ymin=Math.min(this.ymin,this.grid[0]),this.ymax=Math.max(this.ymax,this.grid[this.grid.length-1])):(u=(this.ymax-this.ymin)/(this.options.numLines-1),this.grid=function(){var t,i,e=[];for(f=t=this.ymin,i=this.ymax;0<u?t<=i:i<=t;f=t+=u)e.push(f);return e}.call(this))),this.dirty=!0,t?this.redraw():void 0},g.prototype.yboundary=function(t,i){var e,s=this.options["y"+t];return"string"==typeof s?"auto"===s.slice(0,4)?5<s.length?(e=parseInt(s.slice(5),10),null==i?e:Math[t](i,e)):null!=i?i:0:parseInt(s,10):s},g.prototype.autoGridLines=function(t,i,e){var s,o,n=i-t,r=Math.floor(Math.log(n)/Math.log(10)),h=Math.pow(10,r),a=Math.floor(t/h)*h,l=Math.ceil(i/h)*h,p=(l-a)/(e-1);return 1===h&&1<p&&Math.ceil(p)!==p&&(p=Math.ceil(p),l=a+p*(e-1)),a<0&&0<l&&(a=Math.floor(t/p)*p,l=Math.ceil(i/p)*p),p<1?(s=Math.floor(Math.log(p)/Math.log(10)),function(){var t,i=[];for(o=t=a;0<p?t<=l:l<=t;o=t+=p)i.push(parseFloat(o.toFixed(1-s)));return i}()):function(){var t,i=[];for(o=t=a;0<p?t<=l:l<=t;o=t+=p)i.push(o);return i}()},g.prototype._calc=function(){var s,t,o,n,i,e,r,h=this.el.width(),a=this.el.height();if((this.elementWidth!==h||this.elementHeight!==a||this.dirty)&&(this.elementWidth=h,this.elementHeight=a,this.dirty=!1,this.left=this.options.padding,this.right=this.elementWidth-this.options.padding,this.top=this.options.padding,this.bottom=this.elementHeight-this.options.padding,!0!==(e=this.options.axes)&&"both"!==e&&"y"!==e||(i=function(){for(var t=this.grid,i=[],e=0,s=t.length;e<s;e++)o=t[e],i.push(this.measureText(this.yAxisFormat(o)).width);return i}.call(this),this.options.horizontal?this.bottom-=Math.max.apply(Math,i):this.left+=Math.max.apply(Math,i)),!0!==(r=this.options.axes)&&"both"!==r&&"x"!==r||(s=this.options.horizontal?-90:-this.options.xLabelAngle,t=function(){var t,i,e=[];for(n=t=0,i=this.data.length;0<=i?t<i:i<t;n=0<=i?++t:--t)e.push(this.measureText(this.data[n].label,s).height);return e}.call(this),this.options.horizontal?this.left+=Math.max.apply(Math,t):this.bottom-=Math.max.apply(Math,t)),this.width=Math.max(1,this.right-this.left),this.height=Math.max(1,this.bottom-this.top),this.options.horizontal?(this.dx=this.height/(this.xmax-this.xmin),this.dy=this.width/(this.ymax-this.ymin),this.yStart=this.left,this.yEnd=this.right,this.xStart=this.top,this.xEnd=this.bottom,this.xSize=this.height,this.ySize=this.width):(this.dx=this.width/(this.xmax-this.xmin),this.dy=this.height/(this.ymax-this.ymin),this.yStart=this.bottom,this.yEnd=this.top,this.xStart=this.left,this.xEnd=this.right,this.xSize=this.width,this.ySize=this.height),this.calc))return this.calc()},g.prototype.transY=function(t){return this.options.horizontal?this.left+(t-this.ymin)*this.dy:this.bottom-(t-this.ymin)*this.dy},g.prototype.transX=function(t){return 1===this.data.length?(this.xStart+this.xEnd)/2:this.xStart+(t-this.xmin)*this.dx},g.prototype.redraw=function(){if(this.raphael.clear(),this._calc(),this.drawGrid(),this.drawGoals(),this.drawEvents(),this.draw)return this.draw()},g.prototype.measureText=function(t,i){var e,s;return null==i&&(i=0),e=(s=this.raphael.text(100,100,t).attr("font-size",this.options.gridTextSize).attr("font-family",this.options.gridTextFamily).attr("font-weight",this.options.gridTextWeight).rotate(i)).getBBox(),s.remove(),e},g.prototype.yAxisFormat=function(t){return this.yLabelFormat(t,0)},g.prototype.yLabelFormat=function(t,i){return"function"==typeof this.options.yLabelFormat?this.options.yLabelFormat(t,i):""+this.options.preUnits+L.commas(t)+this.options.postUnits},g.prototype.getYAxisLabelX=function(){return this.left-this.options.padding/2},g.prototype.drawGrid=function(){var t,i,e,s,o,n,r,h,a;if(!1!==this.options.grid||!0===(n=this.options.axes)||"both"===n||"y"===n){for(t=this.options.horizontal?this.getXAxisLabelY():this.getYAxisLabelX(),a=[],s=0,o=(r=this.grid).length;s<o;s++)i=r[s],e=this.transY(i),!0!==(h=this.options.axes)&&"both"!==h&&"y"!==h||(this.options.horizontal?this.drawXAxisLabel(e,t,this.yAxisFormat(i)):this.drawYAxisLabel(t,e,this.yAxisFormat(i))),this.options.grid?(e=Math.floor(e)+.5,this.options.horizontal?a.push(this.drawGridLine("M"+e+","+this.xStart+"V"+this.xEnd)):a.push(this.drawGridLine("M"+this.xStart+","+e+"H"+this.xEnd))):a.push(void 0);return a}},g.prototype.drawGoals=function(){for(var t,i,e,s=this.options.goals,o=[],n=e=0,r=s.length;e<r;n=++e)i=s[n],t=this.options.goalLineColors[n%this.options.goalLineColors.length],o.push(this.drawGoal(i,t));return o},g.prototype.drawEvents=function(){for(var t,i,e,s=this.events,o=[],n=e=0,r=s.length;e<r;n=++e)i=s[n],t=this.options.eventLineColors[n%this.options.eventLineColors.length],o.push(this.drawEvent(i,t));return o},g.prototype.drawGoal=function(t,i){var e=Math.floor(this.transY(t))+.5,s=this.options.horizontal?"M"+e+","+this.xStart+"V"+this.xEnd:"M"+this.xStart+","+e+"H"+this.xEnd;return this.raphael.path(s).attr("stroke",i).attr("stroke-width",this.options.goalStrokeWidth)},g.prototype.drawEvent=function(t,i){var e,s,o,n;return t instanceof Array?(e=t[0],o=t[1],e=Math.floor(this.transX(e))+.5,o=Math.floor(this.transX(o))+.5,this.options.horizontal?this.raphael.rect(this.yStart,e,this.yEnd-this.yStart,o-e).attr({fill:i,stroke:!1}).toBack():this.raphael.rect(e,this.yEnd,o-e,this.yStart-this.yEnd).attr({fill:i,stroke:!1}).toBack()):(n=Math.floor(this.transX(t))+.5,s=this.options.horizontal?"M"+this.yStart+","+n+"H"+this.yEnd:"M"+n+","+this.yStart+"V"+this.yEnd,this.raphael.path(s).attr("stroke",i).attr("stroke-width",this.options.eventStrokeWidth))},g.prototype.drawYAxisLabel=function(t,i,e){return this.raphael.text(t,i,e).attr("font-size",this.options.gridTextSize).attr("font-family",this.options.gridTextFamily).attr("font-weight",this.options.gridTextWeight).attr("fill",this.options.gridTextColor).attr("text-anchor","end")},g.prototype.drawGridLine=function(t){return this.raphael.path(t).attr("stroke",this.options.gridLineColor).attr("stroke-width",this.options.gridStrokeWidth)},g.prototype.startRange=function(t){return this.hover.hide(),this.selectFrom=t,this.selectionRect.attr({x:t,width:0}).show()},g.prototype.endRange=function(t){var i,e;if(this.selectFrom)return e=Math.min(this.selectFrom,t),i=Math.max(this.selectFrom,t),this.options.rangeSelect.call(this.el,{start:this.data[this.hitTest(e)].x,end:this.data[this.hitTest(i)].x}),this.selectFrom=null},g.prototype.resizeHandler=function(){return this.timeoutId=null,this.raphael.setSize(this.el.width(),this.el.height()),this.redraw()},g.prototype.hasToShow=function(t){return!0===this.options.shown||!0===this.options.shown[t]},g),L.parseDate=function(t){var i,e,s,o,n,r,h,a,l,p,u;return"number"==typeof t?t:(e=t.match(/^(\d+) Q(\d)$/),o=t.match(/^(\d+)-(\d+)$/),n=t.match(/^(\d+)-(\d+)-(\d+)$/),h=t.match(/^(\d+) W(\d+)$/),a=t.match(/^(\d+)-(\d+)-(\d+)[ T](\d+):(\d+)(Z|([+-])(\d\d):?(\d\d))?$/),l=t.match(/^(\d+)-(\d+)-(\d+)[ T](\d+):(\d+):(\d+(\.\d+)?)(Z|([+-])(\d\d):?(\d\d))?$/),e?new Date(parseInt(e[1],10),3*parseInt(e[2],10)-1,1).getTime():o?new Date(parseInt(o[1],10),parseInt(o[2],10)-1,1).getTime():n?new Date(parseInt(n[1],10),parseInt(n[2],10)-1,parseInt(n[3],10)).getTime():h?(4!==(p=new Date(parseInt(h[1],10),0,1)).getDay()&&p.setMonth(0,1+(4-p.getDay()+7)%7),p.getTime()+6048e5*parseInt(h[2],10)):a?a[6]?(r=0,"Z"!==a[6]&&(r=60*parseInt(a[8],10)+parseInt(a[9],10),"+"===a[7]&&(r=0-r)),Date.UTC(parseInt(a[1],10),parseInt(a[2],10)-1,parseInt(a[3],10),parseInt(a[4],10),parseInt(a[5],10)+r)):new Date(parseInt(a[1],10),parseInt(a[2],10)-1,parseInt(a[3],10),parseInt(a[4],10),parseInt(a[5],10)).getTime():l?(u=parseFloat(l[6]),i=Math.floor(u),s=Math.round(1e3*(u-i)),l[8]?(r=0,"Z"!==l[8]&&(r=60*parseInt(l[10],10)+parseInt(l[11],10),"+"===l[9]&&(r=0-r)),Date.UTC(parseInt(l[1],10),parseInt(l[2],10)-1,parseInt(l[3],10),parseInt(l[4],10),parseInt(l[5],10)+r,i,s)):new Date(parseInt(l[1],10),parseInt(l[2],10)-1,parseInt(l[3],10),parseInt(l[4],10),parseInt(l[5],10),i,s).getTime()):new Date(parseInt(t,10),0,1).getTime())},L.Hover=(y.defaults={class:"morris-hover morris-default-style"},y.prototype.update=function(t,i,e,s){return t?(this.html(t),this.show(),this.moveTo(i,e,s)):this.hide()},y.prototype.html=function(t){return this.el.html(t)},y.prototype.moveTo=function(t,i,e){var s,o=this.options.parent.innerWidth(),n=this.options.parent.innerHeight(),r=this.el.outerWidth(),h=this.el.outerHeight(),a=Math.min(Math.max(0,t-r/2),o-r);return null!=i?!0===e?(s=i-h/2)<0&&(s=0):(s=i-h-10)<0&&n<(s=i+10)+h&&(s=n/2-h/2):s=n/2-h/2,this.el.css({left:a+"px",top:parseInt(s)+"px"})},y.prototype.show=function(){return this.el.show()},y.prototype.hide=function(){return this.el.hide()},y),L.Line=(o=L.Grid,t(m,o),m.prototype.init=function(){if("always"!==this.options.hideHover)return this.hover=new L.Hover({parent:this.el}),this.on("hovermove",this.onHoverMove),this.on("hoverout",this.onHoverOut),this.on("gridclick",this.onGridClick)},m.prototype.defaults={lineWidth:3,pointSize:4,lineColors:["#0b62a4","#7A92A3","#4da74d","#afd8f8","#edc240","#cb4b4b","#9440ed"],pointStrokeWidths:[1],pointStrokeColors:["#ffffff"],pointFillColors:[],smooth:!0,shown:!0,xLabels:"auto",xLabelFormat:null,xLabelMargin:24,hideHover:!1,trendLine:!1,trendLineWidth:2,trendLineColors:["#689bc3","#a2b3bf","#64b764"]},m.prototype.calc=function(){return this.calcPoints(),this.generatePaths()},m.prototype.calcPoints=function(){for(var o,n,t=this.data,i=[],e=0,s=t.length;e<s;e++)(o=t[e])._x=this.transX(o.x),o._y=function(){for(var t=o.y,i=[],e=0,s=t.length;e<s;e++)null!=(n=t[e])?i.push(this.transY(n)):i.push(n);return i}.call(this),i.push(o._ymax=Math.min.apply(Math,[this.bottom].concat(function(){for(var t=o._y,i=[],e=0,s=t.length;e<s;e++)null!=(n=t[e])&&i.push(n);return i}())));return i},m.prototype.hitTest=function(t){var i,e,s,o;if(0===this.data.length)return null;for(i=e=0,s=(o=this.data.slice(1)).length;e<s&&!(t<(o[i]._x+this.data[i]._x)/2);i=++e);return i},m.prototype.onGridClick=function(t,i){var e=this.hitTest(t);return this.fire("click",e,this.data[e].src,t,i)},m.prototype.onHoverMove=function(t,i){var e=this.hitTest(t);return this.displayHoverForRow(e)},m.prototype.onHoverOut=function(){if(!1!==this.options.hideHover)return this.displayHoverForRow(null)},m.prototype.displayHoverForRow=function(t){var i;return null!=t?((i=this.hover).update.apply(i,this.hoverContentForRow(t)),this.hilight(t)):(this.hover.hide(),this.hilight())},m.prototype.hoverContentForRow=function(t){var i,e,s,o,n,r=this.data[t],h=S("<div class='morris-hover-row-label'>").text(r.label);for(h=h.prop("outerHTML"),i=s=0,o=(n=r.y).length;s<o;i=++s)e=n[i],!1!==this.options.labels[i]&&(h+="<div class='morris-hover-point' style='color: "+this.colorFor(r,i,"label")+"'>\n  "+this.options.labels[i]+":\n  "+this.yLabelFormat(e,i)+"\n</div>");return"function"==typeof this.options.hoverCallback&&(h=this.options.hoverCallback(t,this.options,h,r.src)),[h,r._x,r._ymax]},m.prototype.generatePaths=function(){var o,n,r,h;return this.paths=function(){var t,i,e,s=[];for(n=t=0,i=this.options.ykeys.length;0<=i?t<i:i<t;n=0<=i?++t:--t)h="boolean"==typeof this.options.smooth?this.options.smooth:(e=this.options.ykeys[n],0<=c.call(this.options.smooth,e)),1<(o=function(){for(var t=this.data,i=[],e=0,s=t.length;e<s;e++)void 0!==(r=t[e])._y[n]&&i.push({x:r._x,y:r._y[n]});return i}.call(this)).length?s.push(L.Line.createPath(o,h,this.bottom)):s.push(null);return s}.call(this)},m.prototype.draw=function(){var t;if(!0!==(t=this.options.axes)&&"both"!==t&&"x"!==t||this.drawXAxis(),this.drawSeries(),!1===this.options.hideHover)return this.displayHoverForRow(this.data.length-1)},m.prototype.drawXAxis=function(){var t,o,i,e,s,n,r,h,a,l,p,u,d=this,c=this.bottom+this.options.padding/2,f=null,g=null,y=this.options.parseTime?1===this.data.length&&"auto"===this.options.xLabels?[[this.data[0].label,this.data[0].x]]:L.labelSeries(this.xmin,this.xmax,this.width,this.options.xLabels,this.options.xLabelFormat):function(){for(var t=this.data,i=[],e=0,s=t.length;e<s;e++)o=t[e],i.push([o.label,o.x]);return i}.call(this);for(y.reverse(),s=[],i=0,e=y.length;i<e;i++)t=y[i],s.push((n=t[0],r=t[1],p=l=a=h=void 0,p=d.drawXAxisLabel(d.transX(r),c,n),u=p.getBBox(),p.transform("r"+-d.options.xLabelAngle),h=p.getBBox(),p.transform("t0,"+h.height/2+"..."),0!==d.options.xLabelAngle&&(l=-.5*u.width*Math.cos(d.options.xLabelAngle*Math.PI/180),p.transform("t"+l+",0...")),h=p.getBBox(),(null==f||f>=h.x+h.width||null!=g&&g>=h.x)&&0<=h.x&&h.x+h.width<d.el.width()?(0!==d.options.xLabelAngle&&(a=1.25*d.options.gridTextSize/Math.sin(d.options.xLabelAngle*Math.PI/180),g=h.x-a),f=h.x-d.options.xLabelMargin):p.remove()));return s},m.prototype.drawSeries=function(){var t,i,e,s,o,n;for(this.seriesPoints=[],t=i=s=this.options.ykeys.length-1;s<=0?i<=0:0<=i;t=s<=0?++i:--i)this.hasToShow(t)&&((!1!==this.options.trendLine&&!0===this.options.trendLine||!0===this.options.trendLine[t])&&this._drawTrendLine(t),this._drawLineFor(t));for(n=[],t=e=o=this.options.ykeys.length-1;o<=0?e<=0:0<=e;t=o<=0?++e:--e)this.hasToShow(t)?n.push(this._drawPointFor(t)):n.push(void 0);return n},m.prototype._drawPointFor=function(t){var i,e,s,o,n,r;for(this.seriesPoints[t]=[],r=[],s=0,o=(n=this.data).length;s<o;s++)(i=null)!=(e=n[s])._y[t]&&(i=this.drawLinePoint(e._x,e._y[t],this.colorFor(e,t,"point"),t)),r.push(this.seriesPoints[t].push(i));return r},m.prototype._drawLineFor=function(t){var i=this.paths[t];if(null!==i)return this.drawLinePath(i,this.colorFor(null,t,"line"),t)},m.prototype._drawTrendLine=function(t){for(var i,e,s,o,n,r,h,a=0,l=0,p=0,u=0,d=0,c=this.data,f=0,g=c.length;f<g;f++)r=(n=c[f]).x,void 0!==(h=n.y[t])&&(d+=1,a+=r,l+=h,p+=r*r,u+=r*h);return e=l/d-(i=(d*u-a*l)/(d*p-a*a))*a/d,(s=[{},{}])[0].x=this.transX(this.data[0].x),s[0].y=this.transY(this.data[0].x*i+e),s[1].x=this.transX(this.data[this.data.length-1].x),s[1].y=this.transY(this.data[this.data.length-1].x*i+e),o=L.Line.createPath(s,!1,this.bottom),this.raphael.path(o).attr("stroke",this.colorFor(null,t,"trendLine")).attr("stroke-width",this.options.trendLineWidth)},m.createPath=function(t,i,e){var s,o,n,r,h,a,l,p,u,d="";for(i&&(n=L.Line.gradients(t)),l={y:null},r=p=0,u=t.length;p<u;r=++p)null!=(s=t[r]).y&&(null!=l.y?i?(o=n[r],a=n[r-1],h=(s.x-l.x)/4,d+="C"+(l.x+h)+","+Math.min(e,l.y+h*a)+","+(s.x-h)+","+Math.min(e,s.y-h*o)+","+s.x+","+s.y):d+="L"+s.x+","+s.y:i&&null==n[r]||(d+="M"+s.x+","+s.y)),l=s;return d},m.gradients=function(t){for(var i,e,s,o,n=function(t,i){return(t.y-i.y)/(t.x-i.x)},r=[],h=o=0,a=t.length;o<a;h=++o)null!=(i=t[h]).y?(e=t[h+1]||{y:null},null!=(s=t[h-1]||{y:null}).y&&null!=e.y?r.push(n(s,e)):null!=s.y?r.push(n(s,i)):null!=e.y?r.push(n(i,e)):r.push(null)):r.push(null);return r},m.prototype.hilight=function(t){var i,e,s,o,n;if(null!==this.prevHilight&&this.prevHilight!==t)for(i=e=0,o=this.seriesPoints.length-1;0<=o?e<=o:o<=e;i=0<=o?++e:--e)this.seriesPoints[i][this.prevHilight]&&this.seriesPoints[i][this.prevHilight].animate(this.pointShrinkSeries(i));if(null!==t&&this.prevHilight!==t)for(i=s=0,n=this.seriesPoints.length-1;0<=n?s<=n:n<=s;i=0<=n?++s:--s)this.seriesPoints[i][t]&&this.seriesPoints[i][t].animate(this.pointGrowSeries(i));return this.prevHilight=t},m.prototype.colorFor=function(t,i,e){return"function"==typeof this.options.lineColors?this.options.lineColors.call(this,t,i,e):"point"===e?this.options.pointFillColors[i%this.options.pointFillColors.length]||this.options.lineColors[i%this.options.lineColors.length]:"line"===e?this.options.lineColors[i%this.options.lineColors.length]:this.options.trendLineColors[i%this.options.trendLineColors.length]},m.prototype.drawXAxisLabel=function(t,i,e){return this.raphael.text(t,i,e).attr("font-size",this.options.gridTextSize).attr("font-family",this.options.gridTextFamily).attr("font-weight",this.options.gridTextWeight).attr("fill",this.options.gridTextColor)},m.prototype.drawLinePath=function(t,i,e){return this.raphael.path(t).attr("stroke",i).attr("stroke-width",this.lineWidthForSeries(e))},m.prototype.drawLinePoint=function(t,i,e,s){return this.raphael.circle(t,i,this.pointSizeForSeries(s)).attr("fill",e).attr("stroke-width",this.pointStrokeWidthForSeries(s)).attr("stroke",this.pointStrokeColorForSeries(s))},m.prototype.pointStrokeWidthForSeries=function(t){return this.options.pointStrokeWidths[t%this.options.pointStrokeWidths.length]},m.prototype.pointStrokeColorForSeries=function(t){return this.options.pointStrokeColors[t%this.options.pointStrokeColors.length]},m.prototype.lineWidthForSeries=function(t){return this.options.lineWidth instanceof Array?this.options.lineWidth[t%this.options.lineWidth.length]:this.options.lineWidth},m.prototype.pointSizeForSeries=function(t){return this.options.pointSize instanceof Array?this.options.pointSize[t%this.options.pointSize.length]:this.options.pointSize},m.prototype.pointGrowSeries=function(t){if(0!==this.pointSizeForSeries(t))return Raphael.animation({r:this.pointSizeForSeries(t)+3},25,"linear")},m.prototype.pointShrinkSeries=function(t){return Raphael.animation({r:this.pointSizeForSeries(t)},25,"linear")},m),L.labelSeries=function(t,i,e,s,o){var n,r,h,a,l,p,u,d,c=200*(i-t)/e,f=new Date(t),g=L.LABEL_SPECS[s];if(void 0===g)for(p=0,u=(d=L.AUTO_LABEL_ORDER).length;p<u;p++)if(r=d[p],c>=(a=L.LABEL_SPECS[r]).span){g=a;break}for(void 0===g&&(g=L.LABEL_SPECS.second),o&&(g=S.extend({},g,{fmt:o})),n=g.start(f),h=[];(l=n.getTime())<=i;)t<=l&&h.push([g.fmt(n),l]),g.incr(n);return h},i=function(i){return{span:60*i*1e3,start:function(t){return new Date(t.getFullYear(),t.getMonth(),t.getDate(),t.getHours())},fmt:function(t){return L.pad2(t.getHours())+":"+L.pad2(t.getMinutes())},incr:function(t){return t.setUTCMinutes(t.getUTCMinutes()+i)}}},e=function(i){return{span:1e3*i,start:function(t){return new Date(t.getFullYear(),t.getMonth(),t.getDate(),t.getHours(),t.getMinutes())},fmt:function(t){return L.pad2(t.getHours())+":"+L.pad2(t.getMinutes())+":"+L.pad2(t.getSeconds())},incr:function(t){return t.setUTCSeconds(t.getUTCSeconds()+i)}}},L.LABEL_SPECS={decade:{span:1728e8,start:function(t){return new Date(t.getFullYear()-t.getFullYear()%10,0,1)},fmt:function(t){return""+t.getFullYear()},incr:function(t){return t.setFullYear(t.getFullYear()+10)}},year:{span:1728e7,start:function(t){return new Date(t.getFullYear(),0,1)},fmt:function(t){return""+t.getFullYear()},incr:function(t){return t.setFullYear(t.getFullYear()+1)}},month:{span:24192e5,start:function(t){return new Date(t.getFullYear(),t.getMonth(),1)},fmt:function(t){return t.getFullYear()+"-"+L.pad2(t.getMonth()+1)},incr:function(t){return t.setMonth(t.getMonth()+1)}},week:{span:6048e5,start:function(t){return new Date(t.getFullYear(),t.getMonth(),t.getDate())},fmt:function(t){return t.getFullYear()+"-"+L.pad2(t.getMonth()+1)+"-"+L.pad2(t.getDate())},incr:function(t){return t.setDate(t.getDate()+7)}},day:{span:864e5,start:function(t){return new Date(t.getFullYear(),t.getMonth(),t.getDate())},fmt:function(t){return t.getFullYear()+"-"+L.pad2(t.getMonth()+1)+"-"+L.pad2(t.getDate())},incr:function(t){return t.setDate(t.getDate()+1)}},hour:i(60),"30min":i(30),"15min":i(15),"10min":i(10),"5min":i(5),minute:i(1),"30sec":e(30),"15sec":e(15),"10sec":e(10),"5sec":e(5),second:e(1)},L.AUTO_LABEL_ORDER=["decade","year","month","week","day","hour","30min","15min","10min","5min","minute","30sec","15sec","10sec","5sec","second"],L.Area=(n=L.Line,t(x,n),r={fillOpacity:"auto",behaveLikeLine:!1},x.prototype.calcPoints=function(){for(var o,n,r,t=this.data,i=[],e=0,s=t.length;e<s;e++)(o=t[e])._x=this.transX(o.x),n=0,o._y=function(){for(var t=o.y,i=[],e=0,s=t.length;e<s;e++)r=t[e],this.options.behaveLikeLine?i.push(this.transY(r)):(n+=r||0,i.push(this.transY(n)));return i}.call(this),i.push(o._ymax=Math.max.apply(Math,o._y));return i},x.prototype.drawSeries=function(){var t,i,e,s,o,n,r,h;for(this.seriesPoints=[],h=[],e=0,s=(i=this.options.behaveLikeLine?function(){n=[];for(var t=0,i=this.options.ykeys.length-1;0<=i?t<=i:i<=t;0<=i?t++:t--)n.push(t);return n}.apply(this):function(){r=[];for(var t=o=this.options.ykeys.length-1;o<=0?t<=0:0<=t;o<=0?t++:t--)r.push(t);return r}.apply(this)).length;e<s;e++)t=i[e],this._drawFillFor(t),this._drawLineFor(t),h.push(this._drawPointFor(t));return h},x.prototype._drawFillFor=function(t){var i=this.paths[t];if(null!==i)return i=i+("L"+this.transX(this.xmax)+","+this.bottom+"L"+this.transX(this.xmin)+","+this.bottom)+"Z",this.drawFilledPath(i,this.fillForSeries(t))},x.prototype.fillForSeries=function(t){var i=Raphael.rgb2hsl(this.colorFor(this.data[t],t,"line"));return Raphael.hsl(i.h,this.options.behaveLikeLine?.9*i.s:.75*i.s,Math.min(.98,this.options.behaveLikeLine?1.2*i.l:1.25*i.l))},x.prototype.drawFilledPath=function(t,i){return this.raphael.path(t).attr("fill",i).attr("fill-opacity",this.options.fillOpacity).attr("stroke","none")},x),L.Bar=(h=L.Grid,t(v,h),v.prototype.init=function(){if(this.cumulative=this.options.stacked,"always"!==this.options.hideHover)return this.hover=new L.Hover({parent:this.el}),this.on("hovermove",this.onHoverMove),this.on("hoverout",this.onHoverOut),this.on("gridclick",this.onGridClick)},v.prototype.defaults={barSizeRatio:.75,barGap:3,barColors:["#0b62a4","#7a92a3","#4da74d","#afd8f8","#edc240","#cb4b4b","#9440ed"],barOpacity:1,barRadius:[0,0,0,0],xLabelMargin:50,horizontal:!1,shown:!0},v.prototype.calc=function(){var t;if(this.calcBars(),!1===this.options.hideHover)return(t=this.hover).update.apply(t,this.hoverContentForRow(this.data.length-1))},v.prototype.calcBars=function(){for(var o,n,t,i=this.data,e=[],s=t=0,r=i.length;t<r;s=++t)(o=i[s])._x=this.xStart+this.xSize*(s+.5)/this.data.length,e.push(o._y=function(){for(var t=o.y,i=[],e=0,s=t.length;e<s;e++)null!=(n=t[e])?i.push(this.transY(n)):i.push(null);return i}.call(this));return e},v.prototype.draw=function(){var t;return!0!==(t=this.options.axes)&&"both"!==t&&"x"!==t||this.drawXAxis(),this.drawSeries()},v.prototype.drawXAxis=function(){for(var t,i,e,s,o,n,r,h,a,l,p=this.options.horizontal?this.getYAxisLabelX():this.getXAxisLabelY(),u=null,d=null,c=[],f=l=0,g=this.data.length;0<=g?l<g:g<l;f=0<=g?++l:--l)n=this.data[this.data.length-1-f],i=this.options.horizontal?this.drawYAxisLabel(p,n._x-.5*this.options.gridTextSize,n.label):this.drawXAxisLabel(n._x,p,n.label),t=this.options.horizontal?0:this.options.xLabelAngle,a=i.getBBox(),i.transform("r"+-t),e=i.getBBox(),i.transform("t0,"+e.height/2+"..."),0!==t&&(o=-.5*a.width*Math.cos(t*Math.PI/180),i.transform("t"+o+",0...")),s=this.options.horizontal?(h=e.y,r=e.height,this.el.height()):(h=e.x,r=e.width,this.el.width()),(null==u||h+r<=u||null!=d&&h<=d)&&0<=h&&h+r<s?(0!==t&&(d=h-1.25*this.options.gridTextSize/Math.sin(t*Math.PI/180)),this.options.horizontal?c.push(u=h):c.push(u=h-this.options.xLabelMargin)):c.push(i.remove());return c},v.prototype.getXAxisLabelY=function(){return this.bottom+(this.options.xAxisLabelTopPadding||this.options.padding/2)},v.prototype.drawSeries=function(){var o,n,t,r,h,a,l,i,p,u,d,e,c,f,g,s,y,m=this.xSize/this.options.data.length;if(this.options.stacked)i=1;else for(t=s=i=0,y=this.options.ykeys.length-1;0<=y?s<=y:y<=s;t=0<=y?++s:--s)this.hasToShow(t)&&(i+=1);return o=(m*this.options.barSizeRatio-this.options.barGap*(i-1))/i,this.options.barSize&&(o=Math.min(o,this.options.barSize)),e=m-o*i-this.options.barGap*(i-1),l=e/2,g=this.ymin<=0&&0<=this.ymax?this.transY(0):null,this.bars=function(){var t,i,e=this.data,s=[];for(r=t=0,i=e.length;t<i;r=++t)p=e[r],h=0,s.push(function(){var t,i,e=p._y,s=[];for(u=t=0,i=e.length;t<i;u=++t)f=e[u],this.hasToShow(u)&&(null!==f?(n=g?(c=Math.min(f,g),Math.max(f,g)):(c=f,this.bottom),a=this.xStart+r*m+l,this.options.stacked||(a+=u*(o+this.options.barGap)),d=n-c,this.options.verticalGridCondition&&this.options.verticalGridCondition(p.x)&&(this.options.horizontal?this.drawBar(this.yStart,this.xStart+r*m,this.ySize,m,this.options.verticalGridColor,this.options.verticalGridOpacity,this.options.barRadius):this.drawBar(this.xStart+r*m,this.yEnd,m,this.ySize,this.options.verticalGridColor,this.options.verticalGridOpacity,this.options.barRadius)),this.options.stacked&&(c-=h),this.options.horizontal?(this.drawBar(c,a,d,o,this.colorFor(p,u,"bar"),this.options.barOpacity,this.options.barRadius),s.push(h-=d)):(this.drawBar(a,c,o,d,this.colorFor(p,u,"bar"),this.options.barOpacity,this.options.barRadius),s.push(h+=d))):s.push(null));return s}.call(this));return s}.call(this)},v.prototype.colorFor=function(t,i,e){var s,o;return"function"==typeof this.options.barColors?(s={x:t.x,y:t.y[i],label:t.label},o={index:i,key:this.options.ykeys[i],label:this.options.labels[i]},this.options.barColors.call(this,s,o,e)):this.options.barColors[i%this.options.barColors.length]},v.prototype.hitTest=function(t,i){var e;return 0===this.data.length?null:(e=this.options.horizontal?i:t,e=Math.max(Math.min(e,this.xEnd),this.xStart),Math.min(this.data.length-1,Math.floor((e-this.xStart)/(this.xSize/this.data.length))))},v.prototype.onGridClick=function(t,i){var e=this.hitTest(t,i);return this.fire("click",e,this.data[e].src,t,i)},v.prototype.onHoverMove=function(t,i){var e,s=this.hitTest(t,i);return(e=this.hover).update.apply(e,this.hoverContentForRow(s))},v.prototype.onHoverOut=function(){if(!1!==this.options.hideHover)return this.hover.hide()},v.prototype.hoverContentForRow=function(t){var i,e,s,o,n,r=this.data[t],h=S("<div class='morris-hover-row-label'>").text(r.label);for(h=h.prop("outerHTML"),i=s=0,o=(n=r.y).length;s<o;i=++s)e=n[i],!1!==this.options.labels[i]&&(h+="<div class='morris-hover-point' style='color: "+this.colorFor(r,i,"label")+"'>\n  "+this.options.labels[i]+":\n  "+this.yLabelFormat(e,i)+"\n</div>");return"function"==typeof this.options.hoverCallback&&(h=this.options.hoverCallback(t,this.options,h,r.src)),this.options.horizontal?[h,this.left+.5*this.width,e=this.top+(t+.5)*this.height/this.data.length,!0]:[h,this.left+(t+.5)*this.width/this.data.length]},v.prototype.drawXAxisLabel=function(t,i,e){return this.raphael.text(t,i,e).attr("font-size",this.options.gridTextSize).attr("font-family",this.options.gridTextFamily).attr("font-weight",this.options.gridTextWeight).attr("fill",this.options.gridTextColor)},v.prototype.drawBar=function(t,i,e,s,o,n,r){var h=Math.max.apply(Math,r),a=0===h||s<h?this.raphael.rect(t,i,e,s):this.raphael.path(this.roundedRect(t,i,e,s,r));return a.attr("fill",o).attr("fill-opacity",n).attr("stroke","none")},v.prototype.roundedRect=function(t,i,e,s,o){return null==o&&(o=[0,0,0,0]),["M",t,o[0]+i,"Q",t,i,t+o[0],i,"L",t+e-o[1],i,"Q",t+e,i,t+e,i+o[1],"L",t+e,i+s-o[2],"Q",t+e,i+s,t+e-o[2],i+s,"L",t+o[3],i+s,"Q",t,i+s,t,i+s-o[3],"Z"]},v),L.Donut=(a=L.EventEmitter,t(w,a),w.prototype.defaults={colors:["#0B62A4","#3980B5","#679DC6","#95BBD7","#B0CCE1","#095791","#095085","#083E67","#052C48","#042135"],backgroundColor:"#FFFFFF",labelColor:"#000000",formatter:L.commas,resize:!1},w.prototype.redraw=function(){var t,i,e,s,o,n,r,h,a,l,p,u,d,c,f,g,y,m,x,v,w,b;for(this.raphael.clear(),i=this.el.width()/2,e=this.el.height()/2,u=(Math.min(i,e)-10)/3,d=p=0,g=(x=this.values).length;d<g;d++)p+=x[d];for(h=5/(2*u),t=1.9999*Math.PI-h*this.data.length,o=n=0,this.segments=[],s=c=0,y=(v=this.values).length;c<y;s=++c)a=n+h+v[s]/p*t,(l=new L.DonutSegment(i,e,2*u,u,n,a,this.data[s].color||this.options.colors[o%this.options.colors.length],this.options.backgroundColor,o,this.raphael)).render(),this.segments.push(l),l.on("hover",this.select),l.on("click",this.click),n=a,o+=1;for(this.text1=this.drawEmptyDonutLabel(i,e-10,this.options.labelColor,15,800),this.text2=this.drawEmptyDonutLabel(i,10+e,this.options.labelColor,14),r=Math.max.apply(Math,this.values),b=[],f=o=0,m=(w=this.values).length;f<m;f++){if(w[f]===r){this.select(o);break}b.push(o+=1)}return b},w.prototype.setData=function(t){var o;return this.data=t,this.values=function(){for(var t=this.data,i=[],e=0,s=t.length;e<s;e++)o=t[e],i.push(parseFloat(o.value));return i}.call(this),this.redraw()},w.prototype.click=function(t){return this.fire("click",t,this.data[t])},w.prototype.select=function(t){for(var i,e=this.segments,s=0,o=e.length;s<o;s++)e[s].deselect();return this.segments[t].select(),i=this.data[t],this.setLabels(i.label,this.options.formatter(i.value,i))},w.prototype.setLabels=function(t,i){var e,s,o,n,r=2*(Math.min(this.el.width()/2,this.el.height()/2)-10)/3,h=1.8*r,a=r/2,l=r/3;return this.text1.attr({text:t,transform:""}),e=this.text1.getBBox(),s=Math.min(h/e.width,a/e.height),this.text1.attr({transform:"S"+s+","+s+","+(e.x+e.width/2)+","+(e.y+e.height)}),this.text2.attr({text:i,transform:""}),o=this.text2.getBBox(),n=Math.min(h/o.width,l/o.height),this.text2.attr({transform:"S"+n+","+n+","+(o.x+o.width/2)+","+o.y})},w.prototype.drawEmptyDonutLabel=function(t,i,e,s,o){var n=this.raphael.text(t,i,"").attr("font-size",s).attr("fill",e);return null!=o&&n.attr("font-weight",o),n},w.prototype.resizeHandler=function(){return this.timeoutId=null,this.raphael.setSize(this.el.width(),this.el.height()),this.redraw()},w),L.DonutSegment=(l=L.EventEmitter,t(b,l),b.prototype.calcArcPoints=function(t){return[this.cx+t*this.sin_p0,this.cy+t*this.cos_p0,this.cx+t*this.sin_p1,this.cy+t*this.cos_p1]},b.prototype.calcSegment=function(t,i){var e=this.calcArcPoints(t),s=e[0],o=e[1],n=e[2],r=e[3],h=this.calcArcPoints(i),a=h[0],l=h[1],p=h[2],u=h[3];return"M"+s+","+o+"A"+t+","+t+",0,"+this.is_long+",0,"+n+","+r+"L"+p+","+u+"A"+i+","+i+",0,"+this.is_long+",1,"+a+","+l+"Z"},b.prototype.calcArc=function(t){var i=this.calcArcPoints(t),e=i[0],s=i[1],o=i[2],n=i[3];return"M"+e+","+s+"A"+t+","+t+",0,"+this.is_long+",0,"+o+","+n},b.prototype.render=function(){var t=this;return this.arc=this.drawDonutArc(this.hilight,this.color),this.seg=this.drawDonutSegment(this.path,this.color,this.backgroundColor,function(){return t.fire("hover",t.index)},function(){return t.fire("click",t.index)})},b.prototype.drawDonutArc=function(t,i){return this.raphael.path(t).attr({stroke:i,"stroke-width":2,opacity:0})},b.prototype.drawDonutSegment=function(t,i,e,s,o){return this.raphael.path(t).attr({fill:i,stroke:e,"stroke-width":3}).hover(s).click(o)},b.prototype.select=function(){if(!this.selected)return this.seg.animate({path:this.selectedPath},150,"<>"),this.arc.animate({opacity:1},150,"<>"),this.selected=!0},b.prototype.deselect=function(){if(this.selected)return this.seg.animate({path:this.path},150,"<>"),this.arc.animate({opacity:0},150,"<>"),this.selected=!1},b)}).call(this);