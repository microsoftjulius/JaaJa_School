!function(e,t){"object"==typeof exports&&"undefined"!=typeof module?t(exports,require("@fullcalendar/core"),require("@fullcalendar/daygrid")):"function"==typeof define&&define.amd?define(["exports","@fullcalendar/core","@fullcalendar/daygrid"],t):t((e=e||self).FullCalendarTimeGrid={},e.FullCalendar,e.FullCalendarDayGrid)}(this,function(e,y,l){"use strict";var i=function(e,t){return(i=Object.setPrototypeOf||{__proto__:[]}instanceof Array&&function(e,t){e.__proto__=t}||function(e,t){for(var r in t)t.hasOwnProperty(r)&&(e[r]=t[r])})(e,t)};function t(e,t){function r(){this.constructor=e}i(e,t),e.prototype=null===t?Object.create(t):(r.prototype=t.prototype,new r)}var r,n=function(){return(n=Object.assign||function(e){for(var t,r=1,i=arguments.length;r<i;r++)for(var n in t=arguments[r])Object.prototype.hasOwnProperty.call(t,n)&&(e[n]=t[n]);return e}).apply(this,arguments)},a=(t(o,r=y.FgEventRenderer),o.prototype.attachSegs=function(e,t){for(var r=this.timeGrid.groupSegsByCol(e),i=0;i<r.length;i++)r[i]=this.sortEventSegs(r[i]);this.segsByCol=r,this.timeGrid.attachSegsByCol(r,this.timeGrid.fgContainerEls)},o.prototype.detachSegs=function(e){e.forEach(function(e){y.removeElement(e.el)}),this.segsByCol=null},o.prototype.computeSegSizes=function(e){var t=this.timeGrid,r=this.segsByCol,i=t.colCnt;if(t.computeSegVerticals(e),r)for(var n=0;n<i;n++)this.computeSegHorizontals(r[n])},o.prototype.assignSegSizes=function(e){var t=this.timeGrid,r=this.segsByCol,i=t.colCnt;if(t.assignSegVerticals(e),r)for(var n=0;n<i;n++)this.assignSegCss(r[n])},o.prototype.computeEventTimeFormat=function(){return{hour:"numeric",minute:"2-digit",meridiem:!1}},o.prototype.computeDisplayEventEnd=function(){return!0},o.prototype.renderSegHtml=function(e,t){var r,i,n,o,s,a=this.context.view,l=e.eventRange,d=l.def,c=l.ui,h=d.allDay,u=a.computeEventDraggable(d,c),p=e.isStart&&a.computeEventStartResizable(d,c),g=e.isEnd&&a.computeEventEndResizable(d,c),f=this.getSegClasses(e,u,p||g,t),m=y.cssToStr(this.getSkinCss(c));return f.unshift("fc-time-grid-event"),y.isMultiDayRange(l.range)?(e.isStart||e.isEnd)&&(r=e.start,i=e.end,n=this._getTimeText(r,i,h),o=this._getTimeText(r,i,h,this.fullTimeFormat),s=this._getTimeText(r,i,h,null,!1)):(n=this.getTimeText(l),o=this.getTimeText(l,this.fullTimeFormat),s=this.getTimeText(l,null,!1)),'<a class="'+f.join(" ")+'"'+(d.url?' href="'+y.htmlEscape(d.url)+'"':"")+(m?' style="'+m+'"':"")+'><div class="fc-content">'+(n?'<div class="fc-time" data-start="'+y.htmlEscape(s)+'" data-full="'+y.htmlEscape(o)+'"><span>'+y.htmlEscape(n)+"</span></div>":"")+(d.title?'<div class="fc-title">'+y.htmlEscape(d.title)+"</div>":"")+"</div>"+(g?'<div class="fc-resizer fc-end-resizer"></div>':"")+"</a>"},o.prototype.computeSegHorizontals=function(e){var t,r,i=function(e){var t,r,i,n=[];for(t=0;t<e.length;t++){for(r=e[t],i=0;i<n.length&&s(r,n[i]).length;i++);r.level=i,(n[i]||(n[i]=[])).push(r)}return n}(e);if(function(e){var t,r,i,n,o;for(t=0;t<e.length;t++)for(r=e[t],i=0;i<r.length;i++)for((n=r[i]).forwardSegs=[],o=t+1;o<e.length;o++)s(n,e[o],n.forwardSegs)}(i),t=i[0]){for(r=0;r<t.length;r++)!function e(t){var r,i,n=t.forwardSegs,o=0;if(void 0===t.forwardPressure){for(r=0;r<n.length;r++)i=n[r],e(i),o=Math.max(o,1+i.forwardPressure);t.forwardPressure=o}}(t[r]);for(r=0;r<t.length;r++)this.computeSegForwardBack(t[r],0,0)}},o.prototype.computeSegForwardBack=function(e,t,r){var i,n=e.forwardSegs;if(void 0===e.forwardCoord)for(n.length?(this.sortForwardSegs(n),this.computeSegForwardBack(n[0],t+1,r),e.forwardCoord=n[0].backwardCoord):e.forwardCoord=1,e.backwardCoord=e.forwardCoord-(e.forwardCoord-r)/(t+1),i=0;i<n.length;i++)this.computeSegForwardBack(n[i],0,e.forwardCoord)},o.prototype.sortForwardSegs=function(e){var t=e.map(d),r=[{field:"forwardPressure",order:-1},{field:"backwardCoord",order:1}].concat(this.context.view.eventOrderSpecs);return t.sort(function(e,t){return y.compareByFieldSpecs(e,t,r)}),t.map(function(e){return e._seg})},o.prototype.assignSegCss=function(e){for(var t=0,r=e;t<r.length;t++){var i=r[t];y.applyStyle(i.el,this.generateSegCss(i)),0<i.level&&i.el.classList.add("fc-time-grid-event-inset"),i.eventRange.def.title&&i.bottom-i.top<30&&i.el.classList.add("fc-short")}},o.prototype.generateSegCss=function(e){var t,r,i=this.context.options.slotEventOverlap,n=e.backwardCoord,o=e.forwardCoord,s=this.timeGrid.generateSegVerticalCss(e),a=this.timeGrid.isRtl;return i&&(o=Math.min(1,n+2*(o-n))),r=a?(t=1-o,n):(t=n,1-o),s.zIndex=e.level+1,s.left=100*t+"%",s.right=100*r+"%",i&&e.forwardPressure&&(s[a?"marginLeft":"marginRight"]=20),s},o);function o(e){var t=r.call(this,e.context)||this;return t.timeGrid=e,t.fullTimeFormat=y.createFormatter({hour:"numeric",minute:"2-digit",separator:t.context.options.defaultRangeSeparator}),t}function s(e,t,r){void 0===r&&(r=[]);for(var i,n,o=0;o<t.length;o++)i=e,n=t[o],i.bottom>n.top&&i.top<n.bottom&&r.push(t[o]);return r}function d(e){var t=y.buildSegCompareObj(e);return t.forwardPressure=e.forwardPressure,t.backwardCoord=e.backwardCoord,t}var c,h=(t(u,c=a),u.prototype.attachSegs=function(e,t){this.segsByCol=this.timeGrid.groupSegsByCol(e),this.timeGrid.attachSegsByCol(this.segsByCol,this.timeGrid.mirrorContainerEls),this.sourceSeg=t.sourceSeg},u.prototype.generateSegCss=function(e){var t,r=c.prototype.generateSegCss.call(this,e),i=this.sourceSeg;return i&&i.col===e.col&&(t=c.prototype.generateSegCss.call(this,i),r.left=t.left,r.right=t.right,r.marginLeft=t.marginLeft,r.marginRight=t.marginRight),r},u);function u(){return null!==c&&c.apply(this,arguments)||this}var p,g=(t(f,p=y.FillRenderer),f.prototype.attachSegs=function(e,t){var r,i=this.timeGrid;return"bgEvent"===e?r=i.bgContainerEls:"businessHours"===e?r=i.businessContainerEls:"highlight"===e&&(r=i.highlightContainerEls),i.attachSegsByCol(i.groupSegsByCol(t),r),t.map(function(e){return e.el})},f.prototype.computeSegSizes=function(e){this.timeGrid.computeSegVerticals(e)},f.prototype.assignSegSizes=function(e){this.timeGrid.assignSegVerticals(e)},f);function f(e){var t=p.call(this,e.context)||this;return t.timeGrid=e,t}var m,v=[{hours:1},{minutes:30},{minutes:15},{seconds:30},{seconds:15}],S=(t(C,m=y.DateComponent),C.prototype.processOptions=function(){var e,t=this.opt("slotDuration"),r=this.opt("snapDuration"),t=y.createDuration(t),r=r?y.createDuration(r):t,i=y.wholeDivideDurations(t,r);null===i&&(r=t,i=1),this.slotDuration=t,this.snapDuration=r,this.snapsPerSlot=i,e=this.opt("slotLabelFormat"),Array.isArray(e)&&(e=e[e.length-1]),this.labelFormat=y.createFormatter(e||{hour:"numeric",minute:"2-digit",omitZeroMinute:!0,meridiem:"short"}),e=this.opt("slotLabelInterval"),this.labelInterval=e?y.createDuration(e):this.computeLabelInterval(t)},C.prototype.computeLabelInterval=function(e){for(var t,r,i=v.length-1;0<=i;i--)if(t=y.createDuration(v[i]),null!==(r=y.wholeDivideDurations(t,e))&&1<r)return t;return e},C.prototype.render=function(e){var t=e.cells;this.colCnt=t.length,this.renderSlats(e.dateProfile),this.renderColumns(e.cells,e.dateProfile),this.renderBusinessHours(e.businessHourSegs),this.renderDateSelection(e.dateSelectionSegs),this.renderFgEvents(e.fgEventSegs),this.renderBgEvents(e.bgEventSegs),this.renderEventSelection(e.eventSelection),this.renderEventDrag(e.eventDrag),this.renderEventResize(e.eventResize)},C.prototype.destroy=function(){m.prototype.destroy.call(this),this.renderSlats.unrender(),this.renderColumns.unrender()},C.prototype.updateSize=function(e){var t=this.fillRenderer,r=this.eventRenderer,i=this.mirrorRenderer;(e||this.isSlatSizesDirty)&&(this.buildSlatPositions(),this.isSlatSizesDirty=!1),(e||this.isColSizesDirty)&&(this.buildColPositions(),this.isColSizesDirty=!1),t.computeSizes(e),r.computeSizes(e),i.computeSizes(e),t.assignSizes(e),r.assignSizes(e),i.assignSizes(e)},C.prototype._renderSlats=function(e){var t=this.theme;this.slatContainerEl.innerHTML='<table class="'+t.getClass("tableGrid")+'">'+this.renderSlatRowHtml(e)+"</table>",this.slatEls=y.findElements(this.slatContainerEl,"tr"),this.slatPositions=new y.PositionCache(this.el,this.slatEls,!1,!0),this.isSlatSizesDirty=!0},C.prototype.renderSlatRowHtml=function(e){for(var t,r,i,n=this.dateEnv,o=this.theme,s=this.isRtl,a="",l=y.startOfDay(e.renderRange.start),d=e.minTime,c=y.createDuration(0);y.asRoughMs(d)<y.asRoughMs(e.maxTime);)t=n.add(l,d),r=null!==y.wholeDivideDurations(c,this.labelInterval),i='<td class="fc-axis fc-time '+o.getClass("widgetContent")+'">'+(r?"<span>"+y.htmlEscape(n.format(t,this.labelFormat))+"</span>":"")+"</td>",a+='<tr data-time="'+y.formatIsoTimeString(t)+'"'+(r?"":' class="fc-minor"')+">"+(s?"":i)+'<td class="'+o.getClass("widgetContent")+'"></td>'+(s?i:"")+"</tr>",d=y.addDurations(d,this.slotDuration),c=y.addDurations(c,this.slotDuration);return a},C.prototype._renderColumns=function(e,t){var r=this.theme,i=this.dateEnv,n=this.view,o=new l.DayBgRow(this.context);this.rootBgContainerEl.innerHTML='<table class="'+r.getClass("tableGrid")+'">'+o.renderHtml({cells:e,dateProfile:t,renderIntroHtml:this.renderProps.renderBgIntroHtml})+"</table>",this.colEls=y.findElements(this.el,".fc-day, .fc-disabled-day");for(var s=0;s<this.colCnt;s++)this.publiclyTrigger("dayRender",[{date:i.toDate(e[s].date),el:this.colEls[s],view:n}]);this.isRtl&&this.colEls.reverse(),this.colPositions=new y.PositionCache(this.el,this.colEls,!0,!1),this.renderContentSkeleton(),this.isColSizesDirty=!0},C.prototype._unrenderColumns=function(){this.unrenderContentSkeleton()},C.prototype.renderContentSkeleton=function(){var e,t=[];t.push(this.renderProps.renderIntroHtml());for(var r=0;r<this.colCnt;r++)t.push('<td><div class="fc-content-col"><div class="fc-event-container fc-mirror-container"></div><div class="fc-event-container"></div><div class="fc-highlight-container"></div><div class="fc-bgevent-container"></div><div class="fc-business-container"></div></div></td>');this.isRtl&&t.reverse(),e=this.contentSkeletonEl=y.htmlToElement('<div class="fc-content-skeleton"><table><tr>'+t.join("")+"</tr></table></div>"),this.colContainerEls=y.findElements(e,".fc-content-col"),this.mirrorContainerEls=y.findElements(e,".fc-mirror-container"),this.fgContainerEls=y.findElements(e,".fc-event-container:not(.fc-mirror-container)"),this.bgContainerEls=y.findElements(e,".fc-bgevent-container"),this.highlightContainerEls=y.findElements(e,".fc-highlight-container"),this.businessContainerEls=y.findElements(e,".fc-business-container"),this.isRtl&&(this.colContainerEls.reverse(),this.mirrorContainerEls.reverse(),this.fgContainerEls.reverse(),this.bgContainerEls.reverse(),this.highlightContainerEls.reverse(),this.businessContainerEls.reverse()),this.el.appendChild(e)},C.prototype.unrenderContentSkeleton=function(){y.removeElement(this.contentSkeletonEl)},C.prototype.groupSegsByCol=function(e){for(var t=[],r=0;r<this.colCnt;r++)t.push([]);for(r=0;r<e.length;r++)t[e[r].col].push(e[r]);return t},C.prototype.attachSegsByCol=function(e,t){for(var r,i,n=0;n<this.colCnt;n++)for(r=e[n],i=0;i<r.length;i++)t[n].appendChild(r[i].el)},C.prototype.getNowIndicatorUnit=function(){return"minute"},C.prototype.renderNowIndicator=function(e,t){if(this.colContainerEls){for(var r,i=this.computeDateTop(t),n=[],o=0;o<e.length;o++){var s=y.createElement("div",{className:"fc-now-indicator fc-now-indicator-line"});s.style.top=i+"px",this.colContainerEls[e[o].col].appendChild(s),n.push(s)}0<e.length&&((r=y.createElement("div",{className:"fc-now-indicator fc-now-indicator-arrow"})).style.top=i+"px",this.contentSkeletonEl.appendChild(r),n.push(r)),this.nowIndicatorEls=n}},C.prototype.unrenderNowIndicator=function(){this.nowIndicatorEls&&(this.nowIndicatorEls.forEach(y.removeElement),this.nowIndicatorEls=null)},C.prototype.getTotalSlatHeight=function(){return this.slatContainerEl.getBoundingClientRect().height},C.prototype.computeDateTop=function(e,t){return t=t||y.startOfDay(e),this.computeTimeTop(y.createDuration(e.valueOf()-t.valueOf()))},C.prototype.computeTimeTop=function(e){var t,r,i=this.slatEls.length,n=this.props.dateProfile,o=(e.milliseconds-y.asRoughMs(n.minTime))/y.asRoughMs(this.slotDuration),o=Math.max(0,o);return o=Math.min(i,o),t=Math.floor(o),r=o-(t=Math.min(t,i-1)),this.slatPositions.tops[t]+this.slatPositions.getHeight(t)*r},C.prototype.computeSegVerticals=function(e){for(var t,r,i=this.opt("timeGridEventMinHeight"),n=0;n<e.length;n++)t=e[n],r=this.props.cells[t.col].date,t.top=this.computeDateTop(t.start,r),t.bottom=Math.max(t.top+i,this.computeDateTop(t.end,r))},C.prototype.assignSegVerticals=function(e){for(var t,r=0;r<e.length;r++)t=e[r],y.applyStyle(t.el,this.generateSegVerticalCss(t))},C.prototype.generateSegVerticalCss=function(e){return{top:e.top,bottom:-e.bottom}},C.prototype.buildPositionCaches=function(){this.buildColPositions(),this.buildSlatPositions()},C.prototype.buildColPositions=function(){this.colPositions.build()},C.prototype.buildSlatPositions=function(){this.slatPositions.build()},C.prototype.positionToHit=function(e,t){var r=this.dateEnv,i=this.snapsPerSlot,n=this.slatPositions,o=this.colPositions,s=o.leftToIndex(e),a=n.topToIndex(t);if(null!=s&&null!=a){var l=n.tops[a],d=n.getHeight(a),c=(t-l)/d,h=a*i+Math.floor(c*i),u=this.props.cells[s].date,p=y.addDurations(this.props.dateProfile.minTime,y.multiplyDuration(this.snapDuration,h)),g=r.add(u,p);return{col:s,dateSpan:{range:{start:g,end:r.add(g,this.snapDuration)},allDay:!1},dayEl:this.colEls[s],relativeRect:{left:o.lefts[s],right:o.rights[s],top:l,bottom:l+d}}}},C.prototype._renderEventDrag=function(e){e&&(this.eventRenderer.hideByHash(e.affectedInstances),e.isEvent?this.mirrorRenderer.renderSegs(e.segs,{isDragging:!0,sourceSeg:e.sourceSeg}):this.fillRenderer.renderSegs("highlight",e.segs))},C.prototype._unrenderEventDrag=function(e){e&&(this.eventRenderer.showByHash(e.affectedInstances),this.mirrorRenderer.unrender(e.segs,{isDragging:!0,sourceSeg:e.sourceSeg}),this.fillRenderer.unrender("highlight"))},C.prototype._renderEventResize=function(e){e&&(this.eventRenderer.hideByHash(e.affectedInstances),this.mirrorRenderer.renderSegs(e.segs,{isResizing:!0,sourceSeg:e.sourceSeg}))},C.prototype._unrenderEventResize=function(e){e&&(this.eventRenderer.showByHash(e.affectedInstances),this.mirrorRenderer.unrender(e.segs,{isResizing:!0,sourceSeg:e.sourceSeg}))},C.prototype._renderDateSelection=function(e){e&&(this.opt("selectMirror")?this.mirrorRenderer.renderSegs(e,{isSelecting:!0}):this.fillRenderer.renderSegs("highlight",e))},C.prototype._unrenderDateSelection=function(e){this.mirrorRenderer.unrender(e,{isSelecting:!0}),this.fillRenderer.unrender("highlight")},C);function C(e,t,r){var i=m.call(this,e,t)||this;i.isSlatSizesDirty=!1,i.isColSizesDirty=!1,i.renderSlats=y.memoizeRendering(i._renderSlats);var n=i.eventRenderer=new a(i),o=i.fillRenderer=new g(i);i.mirrorRenderer=new h(i);var s=i.renderColumns=y.memoizeRendering(i._renderColumns,i._unrenderColumns);return i.renderBusinessHours=y.memoizeRendering(o.renderSegs.bind(o,"businessHours"),o.unrender.bind(o,"businessHours"),[s]),i.renderDateSelection=y.memoizeRendering(i._renderDateSelection,i._unrenderDateSelection,[s]),i.renderFgEvents=y.memoizeRendering(n.renderSegs.bind(n),n.unrender.bind(n),[s]),i.renderBgEvents=y.memoizeRendering(o.renderSegs.bind(o,"bgEvent"),o.unrender.bind(o,"bgEvent"),[s]),i.renderEventSelection=y.memoizeRendering(n.selectByInstanceId.bind(n),n.unselectByInstanceId.bind(n),[i.renderFgEvents]),i.renderEventDrag=y.memoizeRendering(i._renderEventDrag,i._unrenderEventDrag,[s]),i.renderEventResize=y.memoizeRendering(i._renderEventResize,i._unrenderEventResize,[s]),i.processOptions(),t.innerHTML='<div class="fc-bg"></div><div class="fc-slats"></div><hr class="fc-divider '+i.theme.getClass("widgetHeader")+'" style="display:none" />',i.rootBgContainerEl=t.querySelector(".fc-bg"),i.slatContainerEl=t.querySelector(".fc-slats"),i.bottomRuleEl=t.querySelector(".fc-divider"),i.renderProps=r,i}var E,b=(t(D,E=y.Splitter),D.prototype.getKeyInfo=function(){return{allDay:{},timed:{}}},D.prototype.getKeysForDateSpan=function(e){return e.allDay?["allDay"]:["timed"]},D.prototype.getKeysForEventDef=function(e){return e.allDay?y.hasBgRendering(e)?["timed","allDay"]:["allDay"]:["timed"]},D);function D(){return null!==E&&E.apply(this,arguments)||this}var w,R=y.createFormatter({week:"short"}),G=(t(T,w=y.View),T.prototype.destroy=function(){w.prototype.destroy.call(this),this.timeGrid.destroy(),this.dayGrid&&this.dayGrid.destroy(),this.scroller.destroy()},T.prototype.renderSkeletonHtml=function(){var e=this.theme;return'<table class="'+e.getClass("tableGrid")+'">'+(this.opt("columnHeader")?'<thead class="fc-head"><tr><td class="fc-head-container '+e.getClass("widgetHeader")+'">&nbsp;</td></tr></thead>':"")+'<tbody class="fc-body"><tr><td class="'+e.getClass("widgetContent")+'">'+(this.opt("allDaySlot")?'<div class="fc-day-grid"></div><hr class="fc-divider '+e.getClass("widgetHeader")+'" />':"")+"</td></tr></tbody></table>"},T.prototype.getNowIndicatorUnit=function(){return this.timeGrid.getNowIndicatorUnit()},T.prototype.unrenderNowIndicator=function(){this.timeGrid.unrenderNowIndicator()},T.prototype.updateSize=function(e,t,r){w.prototype.updateSize.call(this,e,t,r),this.timeGrid.updateSize(e),this.dayGrid&&this.dayGrid.updateSize(e)},T.prototype.updateBaseSize=function(e,t,r){var i,n,o,s,a=this;this.axisWidth=y.matchCellWidths(y.findElements(this.el,".fc-axis")),this.timeGrid.colEls?(s=y.findElements(this.el,".fc-row").filter(function(e){return!a.scroller.el.contains(e)}),this.timeGrid.bottomRuleEl.style.display="none",this.scroller.clear(),s.forEach(y.uncompensateScroll),this.dayGrid&&(this.dayGrid.removeSegPopover(),(i=this.opt("eventLimit"))&&"number"!=typeof i&&(i=5),i&&this.dayGrid.limitRows(i)),r||(n=this.computeScrollerHeight(t),this.scroller.setHeight(n),((o=this.scroller.getScrollbarWidths()).left||o.right)&&(s.forEach(function(e){y.compensateScroll(e,o)}),n=this.computeScrollerHeight(t),this.scroller.setHeight(n)),this.scroller.lockOverflow(o),this.timeGrid.getTotalSlatHeight()<n&&(this.timeGrid.bottomRuleEl.style.display=""))):r||(n=this.computeScrollerHeight(t),this.scroller.setHeight(n))},T.prototype.computeScrollerHeight=function(e){return e-y.subtractInnerElHeight(this.el,this.scroller.el)},T.prototype.computeDateScroll=function(e){var t=this.timeGrid.computeTimeTop(e);return(t=Math.ceil(t))&&t++,{top:t}},T.prototype.queryDateScroll=function(){return{top:this.scroller.getScrollTop()}},T.prototype.applyDateScroll=function(e){void 0!==e.top&&this.scroller.setScrollTop(e.top)},T.prototype.axisStyleAttr=function(){return null!=this.axisWidth?'style="width:'+this.axisWidth+'px"':""},T);function T(e,t,r,i){var o=w.call(this,e,t,r,i)||this;o.splitter=new b,o.renderHeadIntroHtml=function(){var e,t=o.theme,r=o.dateEnv,i=o.props.dateProfile.renderRange,n=y.diffDays(i.start,i.end);return o.opt("weekNumbers")?(e=r.format(i.start,R),'<th class="fc-axis fc-week-number '+t.getClass("widgetHeader")+'" '+o.axisStyleAttr()+">"+y.buildGotoAnchorHtml(o,{date:i.start,type:"week",forceOff:1<n},y.htmlEscape(e))+"</th>"):'<th class="fc-axis '+t.getClass("widgetHeader")+'" '+o.axisStyleAttr()+"></th>"},o.renderTimeGridBgIntroHtml=function(){return'<td class="fc-axis '+o.theme.getClass("widgetContent")+'" '+o.axisStyleAttr()+"></td>"},o.renderTimeGridIntroHtml=function(){return'<td class="fc-axis" '+o.axisStyleAttr()+"></td>"},o.renderDayGridBgIntroHtml=function(){return'<td class="fc-axis '+o.theme.getClass("widgetContent")+'" '+o.axisStyleAttr()+"><span>"+y.getAllDayHtml(o)+"</span></td>"},o.renderDayGridIntroHtml=function(){return'<td class="fc-axis" '+o.axisStyleAttr()+"></td>"},o.el.classList.add("fc-timeGrid-view"),o.el.innerHTML=o.renderSkeletonHtml(),o.scroller=new y.ScrollComponent("hidden","auto");var n=o.scroller.el;o.el.querySelector(".fc-body > tr > td").appendChild(n),n.classList.add("fc-time-grid-container");var s,a=y.createElement("div",{className:"fc-time-grid"});return n.appendChild(a),o.timeGrid=new S(o.context,a,{renderBgIntroHtml:o.renderTimeGridBgIntroHtml,renderIntroHtml:o.renderTimeGridIntroHtml}),o.opt("allDaySlot")&&(o.dayGrid=new l.DayGrid(o.context,o.el.querySelector(".fc-day-grid"),{renderNumberIntroHtml:o.renderDayGridIntroHtml,renderBgIntroHtml:o.renderDayGridBgIntroHtml,renderIntroHtml:o.renderDayGridIntroHtml,colWeekNumbersVisible:!1,cellWeekNumbersVisible:!1}),s=o.el.querySelector(".fc-divider"),o.dayGrid.bottomCoordPadding=s.getBoundingClientRect().height),o}G.prototype.usesMinMaxTime=!0;var H,P=(t(I,H=y.DateComponent),I.prototype.destroy=function(){H.prototype.destroy.call(this),this.calendar.unregisterInteractiveComponent(this)},I.prototype.render=function(e){var t=e.dateProfile,r=e.dayTable,i=this.dayRanges=this.buildDayRanges(r,t,this.dateEnv);this.timeGrid.receiveProps(n({},this.slicer.sliceProps(e,t,null,this.timeGrid,i),{dateProfile:t,cells:r.cells[0]}))},I.prototype.renderNowIndicator=function(e){this.timeGrid.renderNowIndicator(this.slicer.sliceNowDate(e,this.timeGrid,this.dayRanges),e)},I.prototype.buildPositionCaches=function(){this.timeGrid.buildPositionCaches()},I.prototype.queryHit=function(e,t){var r=this.timeGrid.positionToHit(e,t);if(r)return{component:this.timeGrid,dateSpan:r.dateSpan,dayEl:r.dayEl,rect:{left:r.relativeRect.left,right:r.relativeRect.right,top:r.relativeRect.top,bottom:r.relativeRect.bottom},layer:0}},I);function I(e,t){var r=H.call(this,e,t.el)||this;return r.buildDayRanges=y.memoize(x),r.slicer=new B,r.timeGrid=t,e.calendar.registerInteractiveComponent(r,{el:r.timeGrid.el}),r}function x(e,t,r){for(var i=[],n=0,o=e.headerDates;n<o.length;n++){var s=o[n];i.push({start:r.add(s,t.minTime),end:r.add(s,t.maxTime)})}return i}var z,B=(t(_,z=y.Slicer),_.prototype.sliceRange=function(e,t){for(var r=[],i=0;i<t.length;i++){var n=y.intersectRanges(e,t[i]);n&&r.push({start:n.start,end:n.end,isStart:n.start.valueOf()===e.start.valueOf(),isEnd:n.end.valueOf()===e.end.valueOf(),col:i})}return r},_);function _(){return null!==z&&z.apply(this,arguments)||this}var k,F=(t(M,k=G),M.prototype.destroy=function(){k.prototype.destroy.call(this),this.header&&this.header.destroy(),this.simpleTimeGrid.destroy(),this.simpleDayGrid&&this.simpleDayGrid.destroy()},M.prototype.render=function(e){k.prototype.render.call(this,e);var t=this.props.dateProfile,r=this.buildDayTable(t,this.dateProfileGenerator),i=this.splitter.splitProps(e);this.header&&this.header.receiveProps({dateProfile:t,dates:r.headerDates,datesRepDistinctDays:!0,renderIntroHtml:this.renderHeadIntroHtml}),this.simpleTimeGrid.receiveProps(n({},i.timed,{dateProfile:t,dayTable:r})),this.simpleDayGrid&&this.simpleDayGrid.receiveProps(n({},i.allDay,{dateProfile:t,dayTable:r,nextDayThreshold:this.nextDayThreshold,isRigid:!1}))},M.prototype.renderNowIndicator=function(e){this.simpleTimeGrid.renderNowIndicator(e)},M);function M(e,t,r,i){var n=k.call(this,e,t,r,i)||this;return n.buildDayTable=y.memoize(O),n.opt("columnHeader")&&(n.header=new y.DayHeader(n.context,n.el.querySelector(".fc-head-container"))),n.simpleTimeGrid=new P(n.context,n.timeGrid),n.dayGrid&&(n.simpleDayGrid=new l.SimpleDayGrid(n.context,n.dayGrid)),n}function O(e,t){var r=new y.DaySeries(e.renderRange,t);return new y.DayTable(r,!1)}var N=y.createPlugin({defaultView:"timeGridWeek",views:{timeGrid:{class:F,allDaySlot:!0,slotDuration:"00:30:00",slotEventOverlap:!0},timeGridDay:{type:"timeGrid",duration:{days:1}},timeGridWeek:{type:"timeGrid",duration:{weeks:1}}}});e.AbstractTimeGridView=G,e.TimeGrid=S,e.TimeGridSlicer=B,e.TimeGridView=F,e.buildDayRanges=x,e.buildDayTable=O,e.default=N,Object.defineProperty(e,"__esModule",{value:!0})});