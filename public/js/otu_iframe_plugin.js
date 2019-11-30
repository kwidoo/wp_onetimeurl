

(function( $ ) {
	'use strict';
	
	var idleTime = 0;
	var changing = 0;
	var idleInterval;


	tinymce.init({
		selector: 'textarea',
		plugins: "media",
		extended_valid_elements: "iframe[class|src|width|height|name|align|frameborder|scrolling],video[controls|preload|poster|width|height|data-setup|class],source[width|src|type]",
		setup: function (editor) {			
		  	editor.on('init', function (e) {
				if (!idleInterval) {
					idleInterval = setInterval(timerIncrement, 500);
				}
				jQuery(document).mousemove(function (e) {
					idleTime = 0;
				});
				jQuery(document).keypress(function (e) {
					idleTime = 0;
				});
			});
		},
		
	});
	
	function timerIncrement() {
		idleTime = idleTime + 1;
		var editor = tinyMCE.get('content');
		if (!changing) {
			idleInterval = setInterval(timerIncrement, 50000);

			if (editor) {
				var result = XBBCODE.process({ text: editor.getContent({format: 'text'}) });
				editor.setContent(result.html, { format: 'html' });

				editor.on('PostProcess', function (e) {
					var content = jQuery(e.content);
					if (changing) {
						content.find('.otu_preview').each(function(){
							var src = jQuery(this).attr('src');
							var width = jQuery(this).attr('width');
							var height = jQuery(this).attr('height');
							var frameborder = jQuery(this).attr('frameborder');
							var allowfullscreen = jQuery(this).attr('allowfullscreen');
							var attrs = (width ? 'width='+width+' ' : '')+(height ? 'height='+height+' ' : '')+(frameborder ? 'frameborder='+frameborder+' ' : '')+(allowfullscreen ? 'allowfullscreen='+allowfullscreen+' ' : '');
							this.replaceWith('[otu_iframe '+attrs+']'+src+'[/otu_iframe]');
						});
						content.find('otu_file').each(function(){
							var src = jQuery(this).attr('src');
							this.replace('[otu]'+src+'[/otu]');
						});
						e.content = content.prop('outerHTML');
						changing = 0;
					}
					return e; 
				});	
				changing = 1;

			}
		}
		if (idleTime > 1) { // 60 sec
			if (editor) {
				if (editor.isNotDirty == false) {
					var result = XBBCODE.process({ text: editor.getContent({format: 'text'}) });
					if (result.html !== '') {
						editor.setContent(result.html, { format: 'html' });
					}
				} 
				idleTime = 0;
			}
		}
	}	 
})( jQuery );
