!function(){
	var	t={
			391:function(){
				!function(t){
					const	r=t("#range-sliders .range-slider"),
							n=t("#range-sliders .input-slider"),
							e=(t,r=0,n=0,e=255,o="#f00")=>{
								const i=(r-n)/(e-n)*100;
							},
							o=()=>{
								r.off("change input").on("change input",(function(r){
									r.preventDefault(),
									r.stopPropagation();
									const	n=t(this),
											o=Number(n.val()),
											i=Number(n.attr("min")),
											a=Number(n.attr("max")),
											c=n.data("color");
									e(n,o,i,a,c),
									n.next().val(t(this).val())
								})),
								n.off("input").on("input",(function(r){
									r.preventDefault(),
									r.stopPropagation();
									const n=t(this);
									let o=Number(n.val());
									const	i=Number(n.attr("min")),
											a=Number(n.attr("max"));
									o>a&&(o=a,n.val(o)),
									o<i&&(o=i,n.val(o));
									const	c=n.prev(),
											u=c.data("color");
									e(c,o,i,a,u),
									c.val(o)
								}))
							};
							t((function(){
								["range-slider"].forEach((function(r){
									const	n=t(`#${r}`),
											o=Number(n.val()),
											i=Number(n.attr("min")),
											a=Number(n.attr("max")),
											c=n.data("color");
									e(n,o,i,a,c)
								})),
								o()
							}))
				}
				(jQuery)
			},
			163:function(t,r,n){
				"use strict";
				t.exports=n.p+"css/style.css"
			}
		},
		r={};
	function n(e){
		var o=r[e];
		if(void 0!==o)
			return o.exports;
		var i=r[e]={exports:{}};
		return t[e](i,i.exports,n),i.exports
	}
	n.n=function(t){
		var r=t&&t.__esModule?function(){return t.default}:function(){return t};
		return n.d(r,{a:r}),r
	},
	n.d=function(t,r){
		for(var e in r)
			n.o(r,e)&&!n.o(t,e)&&Object.defineProperty(t,e,{enumerable:!0,get:r[e]})
	},
	n.g=function(){
		if("object"==typeof globalThis)
			return globalThis;
		try{
			return this||new Function("return this")()
		}
		catch(t){
			if("object"==typeof window)
				return window
		}
	}(),
	n.o=function(t,r){
		return Object.prototype.hasOwnProperty.call(t,r)
	},
	function(){
		var t;
		n.g.importScripts&&(t=n.g.location+"");
		var r=n.g.document;
		if(!t&&r&&(r.currentScript&&(t=r.currentScript.src),!t)){
			var e=r.getElementsByTagName("script");
			e.length&&(t=e[e.length-1].src)
		}
		if(!t)
			throw new Error("Automatic publicPath is not supported in this browser");
		t=t.replace(/#.*$/,"").replace(/\?.*$/,"").replace(/\/[^\/]+$/,"/"),
		n.p=t+"../"
	}(),
	function(){
		"use strict";
		n(163),
		n(391)
	}()
}();