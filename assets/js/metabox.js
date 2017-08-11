var Luxicar_Toolkit_Plus, ltp_gallery, ltp_gallery_button, ltp_icon_field;

jQuery(document).ready(function() {
  Luxicar_Toolkit_Plus.init_field_datetime();
  Luxicar_Toolkit_Plus.init_field_gallery();
});

jQuery(document).ajaxSuccess(function() {
  Luxicar_Toolkit_Plus.init_field_datetime();
  Luxicar_Toolkit_Plus.init_field_gallery();
});

ltp_icon_field = '';

ltp_gallery = '';

ltp_gallery_button = '';

Luxicar_Toolkit_Plus = {
  init_field_gallery: function() {
    jQuery('.ltp-ui-gallery-wrap').on('click', '.ltp-ui-gallery-button', function(event) {
      event.preventDefault();
      ltp_gallery_button = jQuery(this);
      if (ltp_gallery) {
        ltp_gallery.open();
        return;
      }
      ltp_gallery = wp.media.frames.ltp_gallery = wp.media({
        title: 'Gallery config',
        button: {
          text: 'Use'
        },
        library: {
          type: 'image'
        },
        multiple: true
      });
      ltp_gallery.on('open', function() {
        var ids, selection;
        ids = ltp_gallery_button.parents('.ltp-ui-gallery-wrap').find('input.ltp-ui-gallery').val();
        if ('' !== ids) {
          selection = ltp_gallery.state().get('selection');
          ids = ids.split(',');
          jQuery(ids).each(function(index, element) {
            var attachment;
            attachment = wp.media.attachment(element);
            attachment.fetch();
            selection.add(attachment ? [attachment] : []);
          });
        }
      });
      ltp_gallery.on('select', function() {
        var result, selection;
        result = [];
        selection = ltp_gallery.state().get('selection');
        selection.map(function(attachment) {
          attachment = attachment.toJSON();
          return result.push(attachment.id);
        });
        if (result.length > 0) {
          result = result.join(',');
          ltp_gallery_button.parents('.ltp-ui-gallery-wrap').find('input.ltp-ui-gallery').val(result);
        }
      });
      ltp_gallery.open();
    });
  },
  select_icon: function(event, obj, icon) {
    event.preventDefault();
    ltp_icon_field.val(icon);
    window.tb_remove();
  },
  open_icons: function(event, obj) {
    event.preventDefault();
    window.tb_show(obj.attr('title'), obj.attr('href'), '');
    ltp_icon_field = obj.parent().find('.ltp-icon');
  },
  filter_icons: function(event, obj) {
    var filter, regex;
    event.preventDefault();
    filter = obj.val();
    if (!filter) {
      jQuery("#ltp-list-icon .ltp-ui-icon-item").show();
      return false;
    }
    regex = new RegExp(filter, "i");
    jQuery("#ltp-list-icon .ltp-ui-icon-item span").each(function(index, element) {
      if (jQuery(this).text().search(regex) < 0) {
        jQuery(this).parents('.ltp-ui-icon-item').hide();
      } else {
        jQuery(this).parents('.ltp-ui-icon-item').show();
      }
    });
  },
  remove_icon: function(event, obj) {
    event.preventDefault();
    obj.parent().find('.ltp-icon').val('');
  },
  init_field_datetime: function() {
    if (jQuery('.ltp-datetime').length > 0) {
      jQuery('.ltp-datetime').each(function(index, element) {
        jQuery(element).datetimepicker({
          lang: 'en',
          timepicker: jQuery(element).data('timepicker'),
          datepicker: jQuery(element).data('datepicker'),
          format: jQuery(element).data('format'),
          i18n: {
            en: {
              months: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
              dayOfWeek: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"]
            }
          }
        });
      });
    }
  }
};
