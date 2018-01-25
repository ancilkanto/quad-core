(function ($) {

	var Shortcodes = vc.shortcodes;
    window.VcContainerView = vc.shortcode_view.extend({
        change_columns_layout:false,
        events:{
            'click > .controls .column_delete':'deleteShortcode',
            'click > .controls .column_add':'addElement',
            'click > .controls .column_edit':'editElement',
            'click > .controls .column_clone':'clone',
            'click > .controls .column_move':'moveElement'
        },
        ready:function (e) {
            window.ContainerView.__super__.ready.call(this, e);
            return this;
        },
        checkIsEmpty:function () {
            window.ContainerView.__super__.checkIsEmpty.call(this);
            this.setSorting();
        },
        moveElement:function (e) {
            e.preventDefault();
        }
    });

})(window.jQuery);