var Luxicar_Gallery, luxicar_tp_gallery, luxicar_tp_gallery_button;

jQuery(document).ready(function() {
  Luxicar_Gallery.init();
});

jQuery(document).ajaxSuccess(function() {
  Luxicar_Gallery.init();
});

luxicar_tp_gallery = '';

luxicar_tp_gallery_button = '';

Luxicar_Gallery = {
  init: function() {
    jQuery('.luxicar-tp-gallery-box').on('click', '.luxicar-tp-gallery-config', function(event) {
      event.preventDefault();
      luxicar_tp_gallery_button = jQuery(this);
      if (luxicar_tp_gallery) {
        luxicar_tp_gallery.open();
        return;
      }
      luxicar_tp_gallery = wp.media.frames.luxicar_tp_gallery = wp.media({
        title: 'Gallery config',
        button: {
          text: 'Use'
        },
        library: {
          type: 'image'
        },
        multiple: true
      });
      luxicar_tp_gallery.on('open', function() {
        var ids, selection;
        ids = luxicar_tp_gallery_button.parents('.luxicar-tp-gallery-box').find('input.luxicar-tp-gallery').val();
        if ('' !== ids) {
          selection = luxicar_tp_gallery.state().get('selection');
          ids = ids.split(',');
          jQuery(ids).each(function(index, element) {
            var attachment;
            attachment = wp.media.attachment(element);
            attachment.fetch();
            selection.add(attachment ? [attachment] : []);
          });
        }
      });
      luxicar_tp_gallery.on('select', function() {
        var result, selection;
        result = [];
        selection = luxicar_tp_gallery.state().get('selection');
        selection.map(function(attachment) {
          attachment = attachment.toJSON();
          return result.push(attachment.id);
        });
        if (result.length > 0) {
          result = result.join(',');
          luxicar_tp_gallery_button.parents('.luxicar-tp-gallery-box').find('input.luxicar-tp-gallery').val(result);
        }
      });
      luxicar_tp_gallery.open();
    });
  }
};
