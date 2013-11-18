(function ()
{
	// create MCShortcodes plugin
	tinymce.create("tinymce.plugins.MCShortcodes",
	{
		init: function ( ed, url )
		{
			ed.addCommand("mcPopup", function ( a, params )
			{
				var popup = params.identifier;
				
				// load thickbox
				tb_show("MC Studios Shortcodes", url + "/popup.php?popup=" + popup + "&width=" + 800);
			});
		},
		createControl: function ( btn, e )
		{
			if ( btn == "mc_button" )
			{	
				var a = this;
				
				var btn = e.createSplitButton('mc_button', {
                    title: "Insert Shortcode",
					image: MCShortcodes.plugin_folder +"/tinymce/images/icon.png",
					icons: false
                });

                btn.onRenderMenu.add(function (c, b)
				{					
					
					a.addWithPopup( b, "Buttons", "button" );
					a.addWithPopup( b, "Social", "social" );
					a.addWithPopup( b, "Alerts", "alert" );
					a.addWithPopup( b, "Quote", "quote" );
					a.addWithPopup( b, "Lists", "lists" );
					a.addWithPopup( b, "Columns", "columns" );
					a.addWithPopup( b, "TeamMember", "teammember" );
					a.addWithPopup( b, "Tabs", "tabs" );
					a.addWithPopup( b, "PriceTable", "pricetable" );
					a.addWithPopup( b, "Slider", "slider" );
					a.addWithPopup( b, "Separators", "separators" );
					a.addWithPopup( b, "Video", "video" );
					a.addWithPopup( b, "Toggle", "toggle" );
					//a.addWithPopup( b, "Testimonial", "testimonial" );
					a.addWithPopup( b, "GMap", "gmap" );
					a.addWithPopup( b, "ContactForm", "contactform" );
				});
                
                return btn;
			}
			
			return null;
		},
		addWithPopup: function ( ed, title, id ) {
			ed.add({
				title: title,
				onclick: function () {
					tinyMCE.activeEditor.execCommand("mcPopup", false, {
						title: title,
						identifier: id
					})
				}
			})
		},
		addImmediate: function ( ed, title, sc) {
			ed.add({
				title: title,
				onclick: function () {
					tinyMCE.activeEditor.execCommand( "mceInsertContent", false, sc )
				}
			})
		},
		getInfo: function () {
			return {
				longname: 'MC Shortcodes',
				author: 'MC Studios',
				authorurl: 'http://themeforest.net/user/MCStudios/',
				infourl: 'http://mcstudiosmx.com/',
				version: "1.0"
			}
		}
	});
	
	// add MCShortcodes plugin
	tinymce.PluginManager.add("MCShortcodes", tinymce.plugins.MCShortcodes);
})();