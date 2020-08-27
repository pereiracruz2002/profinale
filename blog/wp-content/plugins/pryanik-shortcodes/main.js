(function() {

    tinymce.PluginManager.add('shortcodes', function( editor )
    {
        editor.addButton('shortcodes', {
            text: 'Shortcodes',
            icon: 'icon dashicons-art',
            type: 'menubutton',
            menu: [
            /*-----------------------------------------------------------------------------------*/
            /*
            /*  Columns
            /*
            /*-----------------------------------------------------------------------------------*/             
            {
            text: 'Columns',
                onclick: function() {
                    editor.windowManager.open( {
                        title: 'Insert Columns',
                        body: [
                            {
                                type: 'listbox',
                                name: 'column_size',
                                label: 'Column Size',
                                'values': [
                                    {text: 'Two Columns', value: 'one_half'},
                                    {text: 'Three Columns', value: 'one_third'},
                                    {text: 'Four Columns', value: 'one_fourth'},
                                    {text: 'Five Columns', value: 'one_fifth'}
                                ]
                            }
                        ],
                        onsubmit: function( e ) {
                            var size = String(e.data.column_size);
                            switch(size) {
                                case 'one_half':
                                    editor.insertContent( '[' + e.data.column_size + '_col_first] column content goes here [/' + e.data.column_size + '_col_first] <br>');
                                    editor.insertContent( '[' + e.data.column_size + '_col_last] column content goes here [/' + e.data.column_size + '_col_last]');
                                    break;
                                case 'one_third':
                                    editor.insertContent( '[' + e.data.column_size + '_col_first] column content goes here [/' + e.data.column_size + '_col_first]');
                                    editor.insertContent( '[' + e.data.column_size + '_col] column content goes here [/' + e.data.column_size + '_col]');
                                    editor.insertContent( '[' + e.data.column_size + '_col_last] column content goes here [/' + e.data.column_size + '_col_last]');
                                    break;
                                case 'one_fourth':
                                    editor.insertContent( '[' + e.data.column_size + '_col_first] column content goes here [/' + e.data.column_size + '_col_first]');
                                    editor.insertContent( '[' + e.data.column_size + '_col] column content goes here [/' + e.data.column_size + '_col]');
                                    editor.insertContent( '[' + e.data.column_size + '_col] column content goes here [/' + e.data.column_size + '_col]');
                                    editor.insertContent( '[' + e.data.column_size + '_col_last] column content goes here [/' + e.data.column_size + '_col_last]');
                                    break;
                                case 'one_fifth':
                                    editor.insertContent( '[' + e.data.column_size + '_col_first] column content goes here [/' + e.data.column_size + '_col_first]');
                                    editor.insertContent( '[' + e.data.column_size + '_col] column content goes here [/' + e.data.column_size + '_col]');
                                    editor.insertContent( '[' + e.data.column_size + '_col] column content goes here [/' + e.data.column_size + '_col]');
                                    editor.insertContent( '[' + e.data.column_size + '_col] column content goes here [/' + e.data.column_size + '_col]');
                                    editor.insertContent( '[' + e.data.column_size + '_col_last] column content goes here [/' + e.data.column_size + '_col_last]');
                                    break;
                            }
                        }
                    });
                }
            },
            /*-----------------------------------------------------------------------------------*/
            /*
            /*  Alerts
            /*
            /*-----------------------------------------------------------------------------------*/             
            {
            text: 'Alerts',
                onclick: function() {
                    editor.windowManager.open( {
                        title: 'Insert Alert',
                        body: [
                            {
                                type: 'listbox',
                                name: 'alert_type',
                                label: 'Alert Type',
                                'values': [
                                    {text: 'Success - Green', value: 'success'},
                                    {text: 'Info - Blue', value: 'info'},
                                    {text: 'Warning - Yellow', value: 'warning'},
                                    {text: 'Danger - Red', value: 'danger'}
                                ]
                            },
                            {
                                type: 'checkbox',
                                name: 'dismiss',
                                label: 'Should it be dismissable?',
                            }
                        ],
                        onsubmit: function( e ) {
                            var dismiss = String(e.data.dismiss);
                            if( dismiss === 'true' ) {
                                editor.insertContent( '[alert_' + e.data.alert_type + '_dismiss] Alert text goes here [/alert_' + e.data.alert_type + '_dismiss]');
                            } else {
                                editor.insertContent( '[alert_' + e.data.alert_type + '] Alert text goes here [/alert_' + e.data.alert_type + ']');
                            }
                        }
                    });
                }
            },
            /*-----------------------------------------------------------------------------------*/
            /*
            /*  Tabs
            /*
            /*-----------------------------------------------------------------------------------*/             
            {
            text: 'Tabs',
                onclick: function() {
                    editor.windowManager.open( {
                        title: 'Insert Tabs',
                        body: [
                            {
                                type: 'textbox',
                                name: 'tabs_num',
                                label: 'Number of Tabs',
                                value: ''
                            }
                        ],
                        onsubmit: function( e ) {
                            var num = String(e.data.tabs_num);
                            editor.insertContent( '[tab_headers num="' + num + '"]');
                            for ( var i = 1; i <= num; i++ ) {
                                editor.insertContent( '[tab_content title="Tab ' + i + '"] Tab ' + i + ' content goes here [/tab_content]');
                            }
                            editor.insertContent( '[/tab_headers]');
                        }
                    });
                }
            },
            /*-----------------------------------------------------------------------------------*/
            /*
            /*  Toggles
            /*
            /*-----------------------------------------------------------------------------------*/             
            {
            text: 'Toggles',
                onclick: function() {
                    editor.windowManager.open( {
                        title: 'Insert Toggle',
                        body: [
                            {
                                type: 'textbox',
                                name: 'toggles_num',
                                label: 'Number of Toggles',
                                value: ''
                            }
                        ],
                        onsubmit: function( e ) {
                            var num = String(e.data.toggles_num);
                            editor.insertContent( '[accordion]');
                            for ( var i = 1; i <= num; i++ ) {
                                editor.insertContent( '[panel num = "' + i + '" title="Tilte ' + i + '"] Toggle content goes here [/panel]');
                            }
                            editor.insertContent( '[/accordion]');
                        }
                    });
                }
            },
            /*-----------------------------------------------------------------------------------*/
            /*
            /*  Buttons
            /*
            /*-----------------------------------------------------------------------------------*/             
            {
            text: 'Buttons',
                onclick: function() {
                    editor.windowManager.open( {
                        title: 'Insert Button',
                        body: [
                            {
                                type: 'textbox',
                                name: 'title',
                                label: 'Button Title',
                                value: ''
                            },
                            {
                                type: 'textbox',
                                name: 'url',
                                label: 'Button URL',
                                value: ''
                            },
                            {
                                type: 'listbox',
                                name: 'color',
                                label: 'Button Color',
                                'values': [
                                    {text: 'Default', value: 'default'},
                                    {text: 'Skin Color', value: 'primary'},
                                    {text: 'Green', value: 'success'},
                                    {text: 'Blue', value: 'info'},
                                    {text: 'Yellow', value: 'warning'},
                                    {text: 'Red', value: 'danger'},
                                    {text: 'Disabled', value: 'disabled'}
                                ]
                            },
                            {
                                type: 'listbox',
                                name: 'size',
                                label: 'Button Size',
                                'values': [
                                    {text: 'Extra Small', value: 'btn-xs'},
                                    {text: 'Small', value: 'btn-sm'},
                                    {text: 'Default', value: ''},
                                    {text: 'Large', value: 'btn-lg'}
                                ]
                            },
                            {
                                type: 'textbox',
                                name: 'icon',
                                label: 'Font Awesome Icon',
                                value: '',
                                tooltip: "Check the Font Awesome icon list, use icon id only. e.g, 'adjust' instead 'fa-adjust'."
                            },
                            {
                                type: 'listbox',
                                name: 'icon_align',
                                label: 'Icon Alignment',
                                'values': [
                                    {text: 'Left', value: 'left'},
                                    {text: 'Right', value: 'right'}
                                ]
                            },
                            {
                                type: 'listbox',
                                name: 'rotate',
                                label: 'Rotate Icon',
                                'values': [
                                    {text: 'Normal', value: ' '},
                                    {text: 'Rotate 90', value: 'fa-rotate-90'},
                                    {text: 'Rotate 180', value: 'fa-rotate-180'},
                                    {text: 'Rotate 270', value: 'fa-rotate-270'},
                                    {text: 'Flip Horizontal', value: 'fa-flip-horizontal'},
                                    {text: 'Flip Vertical', value: 'fa-flip-vertical'}
                                ]
                            },
                            {
                                type: 'checkbox',
                                name: 'target',
                                label: 'Open link in new tab',
                                value: 'false'
                            }
                        ],
                        onsubmit: function( e ) {
                            var title = String(e.data.title);
                            var url = String(e.data.url);
                            var color = String(e.data.color);
                            var size = String(e.data.size);
                            var icon = String(e.data.icon);
                            var icon_align = String(e.data.icon_align);
                            var rotate = String(e.data.rotate);
                            var target = String(e.data.target);
                            if (target === 'true' ){
                                editor.insertContent( '[button title="'+ title +'" url="'+ url +'" color="'+ color +'" size="'+ size +'" icon="'+ icon +'" icon_align="'+ icon_align +'" rotate="'+ rotate + '" target="_blank"/]');
                            }else{
                                editor.insertContent( '[button title="'+ title +'" url="'+ url +'" color="'+ color +'" size="'+ size +'" icon="'+ icon +'" icon_align="'+ icon_align +'" rotate="'+ rotate + '" target="_self"/]');
                            }
                        }
                    });
                }
            },
             /*-----------------------------------------------------------------------------------*/
            /*
            /*  Dividers
            /*
            /*-----------------------------------------------------------------------------------*/             
            {
            text: 'Dividers',
                onclick: function() {
                    editor.windowManager.open( {
                        title: 'Insert Divider',
                        body: [
                            {
                                type: 'textbox',
                                name: 'title',
                                label: 'Divider Title',
                                value: ''
                            },
                            {
                                type: 'listbox',
                                name: 'style',
                                label: 'Divider Style',
                                'values': [
                                    {text: 'Style 1', value: 'style1'},
                                    {text: 'Style 2', value: 'style2'},
                                    {text: 'Style 3', value: 'style3'},
                                    {text: 'Style 4', value: 'style4'},
                                    {text: 'Style 5', value: 'style5'}
                                ]
                            },
                            {
                                type: 'listbox',
                                name: 'align',
                                label: 'Title Alignment',
                                'values': [
                                    {text: 'Left', value: 'left'},
                                    {text: 'Center', value: 'center'},
                                    {text: 'Right', value: 'right'}
                                ]
                            }
                        ],
                        onsubmit: function( e ) {
                            var title = String(e.data.title);
                            var style = String(e.data.style);
                            var align = String(e.data.align);
                            editor.insertContent( '[divider title="'+ title +'" style="'+ style +'" align="'+ align +'"/]');
                        }
                    });
                }
            },
             /*-----------------------------------------------------------------------------------*/
            /*
            /*  Services
            /*
            /*-----------------------------------------------------------------------------------*/
            {
            text: 'Service Box',
                onclick: function() {
                    editor.windowManager.open( {
                        title: 'Insert Service Box',
                        body: [
                            {
                                type: 'textbox',
                                name: 'title',
                                label: 'Service Title',
                                value: ''
                            },
                            {
                                type: 'textbox',
                                name: 'url',
                                label: 'Service URL',
                                value: ''
                            },
                            {
                                type: 'textbox',
                                name: 'icon',
                                label: 'Font Awesome Icon',
                                value: '',
                                tooltip: "Check the Font Awesome icon list, use icon id only. e.g, 'adjust' instead 'fa-adjust'."
                            },
                            {
                                type: 'listbox',
                                name: 'size',
                                label: 'Icon Size',
                                'values': [
                                    {text: '1x', value: ' '},
                                    {text: '2x', value: '2x'},
                                    {text: '3x', value: '3x'},
                                    {text: '4x', value: '4x'},
                                    {text: '5x', value: '5x'}
                                ]
                            },
                            {
                                type: 'listbox',
                                name: 'rotate',
                                label: 'Rotate Icon',
                                'values': [
                                    {text: 'Normal', value: ' '},
                                    {text: 'Rotate 90', value: 'fa-rotate-90'},
                                    {text: 'Rotate 180', value: 'fa-rotate-180'},
                                    {text: 'Rotate 270', value: 'fa-rotate-270'},
                                    {text: 'Flip Horizontal', value: 'fa-flip-horizontal'},
                                    {text: 'Flip Vertical', value: 'fa-flip-vertical'}
                                ]
                            },
                            {
                                type: 'listbox',
                                name: 'background_style',
                                label: 'Background style',
                                'values': [
                                    {text: 'None', value: ' '},
                                    {text: 'Rounded', value: 'round'},
                                    {text: 'Square', value: 'square'}
                                ]
                            },
                            {
                                type: 'textbox',
                                name: 'border_width',
                                label: 'Border Width',
                                value: '0'
                            },
                            {
                                type: 'textbox',
                                name: 'border_color',
                                label: 'Border Color',
                                value: '#ddd'
                            },
                            {
                                type: 'textbox',
                                name: 'background_color',
                                label: 'Background Color',
                                value: '#ddd'
                            },
                            {
                                type: 'textbox',
                                name: 'icon_color',
                                label: 'Icon Color',
                                value: '#222'
                            }
                        ],
                        onsubmit: function( e ) {
                            var title = String(e.data.title);
                            var url = String(e.data.url);
                            var text_align = String(e.data.text_align);
                            var icon = String(e.data.icon);
                            var icon_align = String(e.data.icon_align);
                            var size = String(e.data.size);
                            var rotate = String(e.data.rotate);
                            var background_style = String(e.data.background_style);
                            var border_width = String(e.data.border_width);
                            var border_color = String(e.data.border_color);
                            var background_color = String(e.data.background_color);
                            var icon_color = String(e.data.icon_color);
                            editor.insertContent( '[service title="'+ title +'" url="'+ url +'" text_align="'+ text_align +'" icon="'+ icon +'" icon_align="'+ icon_align +'" size="'+ size +'" rotate="'+ rotate +'" background_style="'+ background_style +'" border_width="'+ border_width +'" border_color="'+ border_color +'" background_color="'+ background_color +'" icon_color="'+ icon_color +'"] column content goes here [/service]');
                        }
                    });
                }
            }
            ]
        });
    });
})();