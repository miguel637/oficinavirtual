!function(e){"use strict";"function"==typeof define&&define.amd?define(["jquery","tabulator","jquery-ui"],e):"undefined"!=typeof module&&module.exports?module.exports=e(require("jquery"),require("tabulator"),require("jquery-ui")):e(jQuery,Tabulator)}(function(e,t){e.widget("ui.tabulator",{_create:function(){var e=Object.assign({},this.options);delete e.create,delete e.disabled,this.table=new t(this.element[0],e);for(var o in t.prototype)"function"==typeof t.prototype[o]&&"_"!==o.charAt(0)&&(this[o]=this.table[o].bind(this.table))},_setOption:function(e,t){console.error("Tabulator jQuery wrapper does not support setting options after the table has been instantiated")},_destroy:function(e,t){this.table.destroy()}})});