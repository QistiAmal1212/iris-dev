$((function(){"use strict";var e=document.querySelectorAll(".bs-stepper"),n=$(".select2"),t=document.querySelectorAll(".horizontal-wizard"),r=document.querySelectorAll(".vertical-wizard"),i=document.querySelectorAll(".modern-wizard"),o=document.querySelectorAll(".modern-vertical-wizard");if(void 0!==typeof e&&null!==e)for(var c=0;c<e.length;++c)e[c].addEventListener("show.bs-stepper",(function(e){for(var n=e.detail.indexStep,t=$(e.target).find(".step").length-1,r=$(e.target).find(".step"),i=0;i<n;i++){r[i].classList.add("crossed");for(var o=n;o<t;o++)r[o].classList.remove("crossed")}if(0==e.detail.to){for(var c=n;c<t;c++)r[c].classList.remove("crossed");r[0].classList.remove("crossed")}}));if(n.each((function(){var e=$(this);e.wrap('<div class="position-relative"></div>'),e.select2({placeholder:"Select value",dropdownParent:e.parent()})})),void 0!==typeof t&&null!==t){var l=[];t.forEach(((e,n)=>{l[n]=new Stepper(e),$(e).find(".btn-next").on("click",(function(e){l[n].next()})),$(e).find(".btn-prev").on("click",(function(){l[n].previous()}))}))}if(void 0!==typeof r&&null!==r){var a=[];r.forEach(((e,n)=>{a[n]=new Stepper(e,{linear:!1}),$(e).find(".btn-next").on("click",(function(){a[n].next()})),$(e).find(".btn-prev").on("click",(function(){a[n].previous()}))}))}if(void 0!==typeof i&&null!==i){var d=[];i.forEach(((e,n)=>{d[n]=new Stepper(e,{linear:!1}),$(e).find(".btn-next").on("click",(function(){d[n].next()})),$(e).find(".btn-prev").on("click",(function(){d[n].previous()}))}))}if(void 0!==typeof o&&null!==o){var f=[];o.forEach(((e,n)=>{f[n]=new Stepper(e,{linear:!1}),$(e).find(".btn-next").on("click",(function(){f[n].next()})),$(e).find(".btn-prev").on("click",(function(){f[n].previous()}))}))}}));
