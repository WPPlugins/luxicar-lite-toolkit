/**
* Shortcodes v1.0.0
 * Design by Kopatheme 
 * Copyright 2015 KopaTheme, Inc.
 * Use to add shortcodes (text) in the content in post, page when clicked icon.
 * Designed and built for Luxicar Theme.
 */

(function() {
  grid = new Array(12);
  grid[0] = "[luxicar_col col=12]TEXT[/luxicar_col]<br/>";
  grid[1] = "[luxicar_col col=6]TEXT[/luxicar_col]<br/>";
  grid[1] += "[luxicar_col col=6]TEXT[/luxicar_col]<br/>";
  grid[2] = "[luxicar_col col=4]TEXT[/luxicar_col]<br/>";
  grid[2] += "[luxicar_col col=4]TEXT[/luxicar_col]<br/>";
  grid[2] += "[luxicar_col col=4]TEXT[/luxicar_col]<br/>";
  grid[3] = "[luxicar_col col=4]TEXT[/luxicar_col]<br/>";
  grid[3] += "[luxicar_col col=8]TEXT[/luxicar_col]<br/>";
  grid[4] = "[luxicar_col col=3]TEXT[/luxicar_col]<br/>";
  grid[4] += "[luxicar_col col=6]TEXT[/luxicar_col]<br/>";
  grid[4] += "[luxicar_col col=3]TEXT[/luxicar_col]<br/>";
  grid[5] = "[luxicar_col col=3]TEXT[/luxicar_col]<br/>";
  grid[5] += "[luxicar_col col=3]TEXT[/luxicar_col]<br/>";
  grid[5] += "[luxicar_col col=3]TEXT[/luxicar_col]<br/>";
  grid[5] += "[luxicar_col col=3]TEXT[/luxicar_col]<br/>";
  grid[6] = "[luxicar_col col=3]TEXT[/luxicar_col]<br/>";
  grid[6] += "[luxicar_col col=9]TEXT[/luxicar_col]<br/>";
  grid[7] = "[luxicar_col col=2]TEXT[/luxicar_col]<br/>";
  grid[7] += "[luxicar_col col=8]TEXT[/luxicar_col]<br/>";
  grid[7] += "[luxicar_col col=2]TEXT[/luxicar_col]<br/>";
  grid[8] = "[luxicar_col col=2]TEXT[/luxicar_col]<br/>";
  grid[8] += "[luxicar_col col=2]TEXT[/luxicar_col]<br/>";
  grid[8] += "[luxicar_col col=2]TEXT[/luxicar_col]<br/>";
  grid[8] += "[luxicar_col col=6]TEXT[/luxicar_col]<br/>";
  grid[9] = "[luxicar_col col=2]TEXT[/luxicar_col]<br/>";
  grid[9] += "[luxicar_col col=2]TEXT[/luxicar_col]<br/>";
  grid[9] += "[luxicar_col col=2]TEXT[/luxicar_col]<br/>";
  grid[9] += "[luxicar_col col=2]TEXT[/luxicar_col]<br/>";
  grid[9] += "[luxicar_col col=2]TEXT[/luxicar_col]<br/>";
  grid[9] += "[luxicar_col col=2]TEXT[/luxicar_col]<br/>";
  grid[10] = "[luxicar_col col=8]TEXT[/luxicar_col]<br/>";
  grid[10] += "[luxicar_col col=4]TEXT[/luxicar_col]<br/>";
  grid[11] = "[luxicar_col col=10]TEXT[/luxicar_col]<br/>";
  grid[11] += "[luxicar_col col=2]TEXT[/luxicar_col]<br/>";
  
  return tinymce.PluginManager.add("luxicar_shortcodes", function(editor) {

    return editor.addButton("luxicar_shortcodes", {
      type: "splitbutton",
      title: luxicar_toolkit.i18n.shortcodes,
      icon: "luxicar_shortcodes",
      menu : [
      {
        text: luxicar_toolkit.i18n.typography,
        icon: '',
        menu: [
        {
          text: luxicar_toolkit.i18n.blockquote,
          icon: '',
          menu: [
          {
            text: luxicar_toolkit.i18n.blockquote_style_1,
            icon: '',
              onclick: function() {
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_blockquote_1 class=\"kopa-blockquote s1\" author_avatar=\"http://placehold.it/80x80\" author_name=\"Author name\" author_infor=\"Author company\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_blockquote_1]");
              }
          },
          {
            text: luxicar_toolkit.i18n.blockquote_style_2,
            icon: '',
              onclick: function() {
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_blockquote_2 author_link=\"#\" author_avatar=\"http://placehold.it/100x100\" author_name=\"Author name\" author_infor=\"Author company\" author_rate=\"2\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_blockquote_2]");
              }
          },
          {
            text: luxicar_toolkit.i18n.blockquote_style_3,
            icon: '',
              onclick: function() {
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_blockquote_1 class=\"kopa-blockquote s3\" author_avatar=\"http://placehold.it/100x100\" author_name=\"Author name\" author_infor=\"Author company\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_blockquote_1]");
              }
          }
          ]
        },
        // Button
        {
          text: luxicar_toolkit.i18n.buttons,
          icon: '',
          menu: [
            // Normal Button
            {
              text: luxicar_toolkit.i18n.normal_buttons,
              icon: '',
              menu: [
                // Default
                {
                  text: luxicar_toolkit.i18n.default_button,
                  icon: '',
                  menu: [
                  {
                    text: luxicar_toolkit.i18n.small,
                    icon: '',
                    onclick: function() {
                        return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_button class=\"btn btn-sm btn-default btn-bg\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_button]");
                      }
                  },
                  {
                   text: luxicar_toolkit.i18n.normal,
                    icon: '',
                    onclick: function() {
                        return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_button class=\"btn btn-md btn-default btn-bg\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_button]");
                      }
                  },
                  {
                    text: luxicar_toolkit.i18n.large,
                    icon: '',
                    onclick: function() {
                        return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_button class=\"btn btn-lg btn-default btn-bg\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_button]");
                      }
                  }
                  ]
                },
                // Blue
                {
                  text: luxicar_toolkit.i18n.blue_button,
                  icon: '',
                  menu: [
                  {
                    text: luxicar_toolkit.i18n.small,
                    icon: '',
                    onclick: function() {
                        return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_button class=\"btn btn-sm btn-blue btn-bg\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_button]");
                      }
                  },
                  {
                   text: luxicar_toolkit.i18n.normal,
                    icon: '',
                    onclick: function() {
                        return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_button class=\"btn btn-md btn-blue btn-bg\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_button]");
                      }
                  },
                  {
                    text: luxicar_toolkit.i18n.large,
                    icon: '',
                    onclick: function() {
                        return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_button class=\"btn btn-lg btn-blue btn-bg\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_button]");
                      }
                  }
                  ]
                },
                // Orange
                {
                  text: luxicar_toolkit.i18n.orange_button,
                  icon: '',
                  menu: [
                  {
                    text: luxicar_toolkit.i18n.small,
                    icon: '',
                    onclick: function() {
                        return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_button class=\"btn btn-sm btn-orange btn-bg\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_button]");
                      }
                  },
                  {
                   text: luxicar_toolkit.i18n.normal,
                    icon: '',
                    onclick: function() {
                        return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_button class=\"btn btn-md btn-orange btn-bg\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_button]");
                      }
                  },
                  {
                    text: luxicar_toolkit.i18n.large,
                    icon: '',
                    onclick: function() {
                        return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_button class=\"btn btn-lg btn-orange btn-bg\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_button]");
                      }
                  }
                  ]
                },
                // Red
                {
                  text: luxicar_toolkit.i18n.red_button,
                  icon: '',
                  menu: [
                  {
                    text: luxicar_toolkit.i18n.small,
                    icon: '',
                    onclick: function() {
                        return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_button class=\"btn btn-sm btn-red btn-bg\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_button]");
                      }
                  },
                  {
                   text: luxicar_toolkit.i18n.normal,
                    icon: '',
                    onclick: function() {
                        return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_button class=\"btn btn-md btn-red btn-bg\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_button]");
                      }
                  },
                  {
                    text: luxicar_toolkit.i18n.large,
                    icon: '',
                    onclick: function() {
                        return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_button class=\"btn btn-lg btn-red btn-bg\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_button]");
                      }
                  }
                  ]
                },
                // Yellow
                {
                  text: luxicar_toolkit.i18n.yellow_button,
                  icon: '',
                  menu: [
                  {
                    text: luxicar_toolkit.i18n.small,
                    icon: '',
                    onclick: function() {
                        return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_button class=\"btn btn-sm btn-yellow btn-bg\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_button]");
                      }
                  },
                  {
                   text: luxicar_toolkit.i18n.normal,
                    icon: '',
                    onclick: function() {
                        return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_button class=\"btn btn-md btn-yellow btn-bg\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_button]");
                      }
                  },
                  {
                    text: luxicar_toolkit.i18n.large,
                    icon: '',
                    onclick: function() {
                        return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_button class=\"btn btn-lg btn-yellow btn-bg\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_button]");
                      }
                  }
                  ]
                },
                // Green
                {
                  text: luxicar_toolkit.i18n.green_button,
                  icon: '',
                  menu: [
                  {
                    text: luxicar_toolkit.i18n.small,
                    icon: '',
                    onclick: function() {
                        return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_button class=\"btn btn-sm btn-green btn-bg\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_button]");
                      }
                  },
                  {
                   text: luxicar_toolkit.i18n.normal,
                    icon: '',
                    onclick: function() {
                        return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_button class=\"btn btn-md btn-green btn-bg\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_button]");
                      }
                  },
                  {
                    text: luxicar_toolkit.i18n.large,
                    icon: '',
                    onclick: function() {
                        return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_button class=\"btn btn-lg btn-green btn-bg\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_button]");
                      }
                  }
                  ]
                }
              ]
            },
            // Icon Button
            {
              text: luxicar_toolkit.i18n.icon_buttons,
              icon: '',
              menu: [
                // Default
                {
                  text: luxicar_toolkit.i18n.default_button,
                  icon: '',
                    menu: [
                    {
                      text: luxicar_toolkit.i18n.small,
                      icon: '',
                      onclick: function() {
                          return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_button class=\"btn btn-sm btn-default btn-icon\" link=\"#\" target=\"\" icon=\"fa-video-camera\"] " + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_button]");
                        }
                    },
                    {
                     text: luxicar_toolkit.i18n.normal,
                      icon: '',
                      onclick: function() {
                          return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_button class=\"btn btn-md btn-default btn-icon\" link=\"#\" target=\"\" icon=\"fa-calendar\"] " + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_button]");
                        }
                    },
                    {
                      text: luxicar_toolkit.i18n.large,
                      icon: '',
                      onclick: function() {
                          return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_button class=\"btn btn btn-lg btn-default btn-icon\" link=\"#\" target=\"\" icon=\"fa-car\"] " + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_button]");
                        }
                    }
                  ]
                },
                // Blue
                {
                  text: luxicar_toolkit.i18n.blue_button,
                  icon: '',
                  menu: [
                  {
                    text: luxicar_toolkit.i18n.small,
                    icon: '',
                    onclick: function() {
                        return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_button class=\"btn btn-sm btn-blue btn-icon\" link=\"#\" target=\"\" icon=\"fa-video-camera\"] " + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_button]");
                      }
                  },
                  {
                   text: luxicar_toolkit.i18n.normal,
                    icon: '',
                    onclick: function() {
                        return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_button class=\"btn btn-md btn-blue btn-icon\" link=\"#\" target=\"\" icon=\"fa-calendar\"] " + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_button]");
                      }
                  },
                  {
                    text: luxicar_toolkit.i18n.large,
                    icon: '',
                    onclick: function() {
                        return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_button class=\"btn btn-lg btn-blue btn-icon\" link=\"#\" target=\"\" icon=\"fa-car\"] " + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_button]");
                      }
                  }
                  ]
                },
                // Orange
                {
                  text: luxicar_toolkit.i18n.orange_button,
                  icon: '',
                  menu: [
                  {
                    text: luxicar_toolkit.i18n.small,
                    icon: '',
                    onclick: function() {
                        return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_button class=\"btn btn-sm btn-orange btn-icon\" link=\"#\" target=\"\" icon=\"fa-video-camera\"] " + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_button]");
                      }
                  },
                  {
                   text: luxicar_toolkit.i18n.normal,
                    icon: '',
                    onclick: function() {
                        return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_button class=\"btn btn-md btn-orange btn-icon\" link=\"#\" target=\"\" icon=\"fa-calendar\"] " + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_button]");
                      }
                  },
                  {
                    text: luxicar_toolkit.i18n.large,
                    icon: '',
                    onclick: function() {
                        return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_button class=\"btn btn-lg btn-orange btn-icon\" link=\"#\" target=\"\" icon=\"fa-car\"] " + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_button]");
                      }
                  }
                  ]
                },
                // Green
                {
                  text: luxicar_toolkit.i18n.green_button,
                  icon: '',
                  menu: [
                  {
                    text: luxicar_toolkit.i18n.small,
                    icon: '',
                    onclick: function() {
                        return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_button class=\"btn btn-sm btn-green btn-icon\" link=\"#\" target=\"\" icon=\"fa-video-camera\"] " + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_button]");
                      }
                  },
                  {
                   text: luxicar_toolkit.i18n.normal,
                    icon: '',
                    onclick: function() {
                        return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_button class=\"btn btn-md btn-green btn-icon\" link=\"#\" target=\"\" icon=\"fa-calendar\"] " + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_button]");
                      }
                  },
                  {
                    text: luxicar_toolkit.i18n.large,
                    icon: '',
                    onclick: function() {
                        return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_button class=\"btn btn-lg btn-green btn-icon\" link=\"#\" target=\"\" icon=\"fa-car\"] " + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_button]");
                      }
                  }
                  ]
                },
                // Red
                {
                  text: luxicar_toolkit.i18n.red_button,
                  icon: '',
                  menu: [
                  {
                    text: luxicar_toolkit.i18n.small,
                    icon: '',
                    onclick: function() {
                        return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_button class=\"btn btn-sm btn-red btn-icon\" link=\"#\" target=\"\" icon=\"fa-video-camera\"] " + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_button]");
                      }
                  },
                  {
                   text: luxicar_toolkit.i18n.normal,
                    icon: '',
                    onclick: function() {
                        return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_button class=\"btn btn-md btn-red btn-icon\" link=\"#\" target=\"\" icon=\"fa-calendar\"] " + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_button]");
                      }
                  },
                  {
                    text: luxicar_toolkit.i18n.large,
                    icon: '',
                    onclick: function() {
                        return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_button class=\"btn btn-lg btn-red btn-icon\" link=\"#\" target=\"\" icon=\"fa-car\"] " + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_button]");
                      }
                  }
                  ]
                },
                // Yellow
                {
                  text: luxicar_toolkit.i18n.yellow_button,
                  icon: '',
                  menu: [
                  {
                    text: luxicar_toolkit.i18n.small,
                    icon: '',
                    onclick: function() {
                        return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_button class=\"btn btn-sm btn-yellow btn-icon\" link=\"#\" target=\"\" icon=\"fa-video-camera\"] " + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_button]");
                      }
                  },
                  {
                   text: luxicar_toolkit.i18n.normal,
                    icon: '',
                    onclick: function() {
                        return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_button class=\"btn btn-md btn-yellow btn-icon\" link=\"#\" target=\"\" icon=\"fa-calendar\"] " + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_button]");
                      }
                  },
                  {
                    text: luxicar_toolkit.i18n.large,
                    icon: '',
                    onclick: function() {
                        return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_button class=\"btn btn-lg btn-yellow btn-icon\" link=\"#\" target=\"\" icon=\"fa-car\"] " + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_button]");
                      }
                  }
                  ]
                }
              ]
            },
          ]
        },
        // Columns
        {
          text: luxicar_toolkit.i18n.column,
          icon: '',
          menu: [
            {
              text: "1/1",
              icon: '',
              onclick: function() {
                var shortcode;
                shortcode = "[luxicar_row]<br/>" + grid[0] + "[/luxicar_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: "1/2 - 1/2",
              icon: '',
              onclick: function() {
                var shortcode;
                shortcode = "[luxicar_row]<br/>" + grid[1] + "[/luxicar_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: "1/3 - 1/3 - 1/3",
              icon: '',
              onclick: function() {
                var shortcode;
                shortcode = "[luxicar_row]<br/>" + grid[2] + "[/luxicar_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: "1/3 - 2/3",
              icon: '',
              onclick: function() {
                var shortcode;
                shortcode = "[luxicar_row]<br/>" + grid[3] + "[/luxicar_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: "1/4 - 1/2 - 1/4",
              icon: '',
              onclick: function() {
                var shortcode;
                shortcode = "[luxicar_row]<br/>" + grid[4] + "[/luxicar_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: "1/4 - 1/4 - 1/4 - 1/4",
              icon: '',
              onclick: function() {
                var shortcode;
                shortcode = "[luxicar_row]<br/>" + grid[5] + "[/luxicar_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: "1/4 - 3/4",
              icon: '',
              onclick: function() {
                var shortcode;
                shortcode = "[luxicar_row]<br/>" + grid[6] + "[/luxicar_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: "1/6 - 4/6 - 1/6",
              icon: '',
              onclick: function() {
                var shortcode;
                shortcode = "[luxicar_row]<br/>" + grid[7] + "[/luxicar_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: "1/6 - 1/6 - 1/6 - 1/2",
              icon: '',
              onclick: function() {
                var shortcode;
                shortcode = "[luxicar_row]<br/>" + grid[8] + "[/luxicar_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: "1/6 - 1/6 - 1/6 - 1/6 - 1/6 - 1/6",
              icon: '',
              onclick: function() {
                var shortcode;
                shortcode = "[luxicar_row]<br/>" + grid[9] + "[/luxicar_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: "2/3 - 1/3",
              icon: '',
              onclick: function() {
                var shortcode;
                shortcode = "[luxicar_row]<br/>" + grid[10] + "[/luxicar_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: "5/6 - 1/6",
              icon: '',
              onclick: function() {
                var shortcode;
                shortcode = "[luxicar_row]<br/>" + grid[11] + "[/luxicar_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }
          ]
        },
        {
          text: luxicar_toolkit.i18n.dropcap,
          icon: '',
          menu: [
          {
              text: luxicar_toolkit.i18n.dropcap_transparent,
              icon: '',
              onclick: function() {
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_dropcap class=\"kopa-dropcap s1\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_dropcap]");
              }
            }, 
            {
              text: luxicar_toolkit.i18n.dropcap_background,
              icon: '',
              onclick: function() {
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_dropcap class=\"kopa-dropcap s2\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_dropcap]");
              }
            }
          ]
        },
        {
          text: luxicar_toolkit.i18n.fancy_heading,
          icon: '',
          menu: [
          {
            text: luxicar_toolkit.i18n.fancy_heading_left,
            icon: '',
            onclick: function() {
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_fancy_heading title=\"Title\" class=\"kopa-fancy-heading s1\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_fancy_heading]");
            }
          },
          {
            text: luxicar_toolkit.i18n.fancy_heading_center,
            icon: '',
            onclick: function() {
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_fancy_heading title=\"Title\" class=\"kopa-fancy-heading s2\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_fancy_heading]");
            }
          },
          {
            text: luxicar_toolkit.i18n.fancy_heading_center_icon,
            icon: '',
            onclick: function() {
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_fancy_heading title=\"Title\" icon=\"fa fa-car\" class=\"kopa-fancy-heading s3\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_fancy_heading]");
            }
          },
          ]
        },
        {
          text: luxicar_toolkit.i18n.partner,
          icon: '',
          menu: [
          {
            text: luxicar_toolkit.i18n.partner_1,
            icon: '',
            onclick: function() {
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_partner style=\"normal\" posts_per_page=\"6\"]");
            }
          },
          {
            text: luxicar_toolkit.i18n.partner_2,
            icon: '',
            onclick: function() {
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_partner style=\"small\" posts_per_page=\"6\"]");
            }
          },
          ]
        },
        {
          text: luxicar_toolkit.i18n.highlight,
          icon: '',
          menu: [
          {
              text: luxicar_toolkit.i18n.underline_hl,
              onclick: function() {
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_highlight class=\"hl-border\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_highlight]");
              }
          },
          {
              text: luxicar_toolkit.i18n.black_hl,
              onclick: function() {
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_highlight class=\"hl-bg-1\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_highlight]");
              }
          },
          {
              text: luxicar_toolkit.i18n.blue_hl,
              onclick: function() {
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_highlight class=\"hl-bg-2\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_highlight]");
              }
          }
          ]
        }
        ]
      },
      // common
    {
        text: luxicar_toolkit.i18n.common,
        icon: '',
        menu: [
        {
          text: luxicar_toolkit.i18n.alert,
          icon: '',
          menu: [
          {
            text: luxicar_toolkit.i18n.alert,
            icon: '',
            menu: [
            {
              text: luxicar_toolkit.i18n.alert_succes,
              onclick: function() {
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_alert class=\"alert alert-success alert-dismissible fade in\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_alert]");
              }
            },
            {
              text: luxicar_toolkit.i18n.alert_infor,
              onclick: function() {
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_alert class=\"alert alert-info alert-dismissible fade in\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_alert]");
              }
            },
            {
              text: luxicar_toolkit.i18n.alert_warning,
              onclick: function() {
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_alert class=\"alert alert-warning alert-dismissible fade in\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_alert]");
              }
            },
            {
              text: luxicar_toolkit.i18n.alert_error,
              onclick: function() {
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_alert class=\"alert alert-danger alert-dismissible fade in\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_alert]");
              }
            }
            ]
          },
          {
            text: luxicar_toolkit.i18n.list_order,
            icon: '',
            menu: [
            {
              text: luxicar_toolkit.i18n.plus_lo,
              onclick: function() {
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_ul style=\"kopa-ul kopa-ul-s1\"][luxicar_li url=\"url\" title=\"Title\"][/luxicar_ul]");
              }
            },
            {
              text: luxicar_toolkit.i18n.dot_lo,
              onclick: function() {
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_ul style=\"kopa-ul kopa-ul-s2\"][luxicar_li url=\"url\" title=\"Title\"][/luxicar_ul]");
              }
            }
            ]
          },
          {
            text: luxicar_toolkit.i18n.social_media,
            icon: '',
            onclick: function() {
              return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_social icon=\"fa fa-facebook\" url=\"url\" title=\"Title\"]");
            }
          }
          ]
        },
        {
          text: luxicar_toolkit.i18n.counter,
          icon: '',
          menu: [
          {
            text: luxicar_toolkit.i18n.counter_1,
            onclick: function() {
              return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[counter_style style=\"1\"][counter icon=\"fa-rocket\" number=\"15\"]" + tinyMCE.activeEditor.selection.getContent() + "[/counter][/counter_style]");
            }
          },
          {
            text: luxicar_toolkit.i18n.counter_2,
            onclick: function() {
              return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[counter_style style=\"2\"][counter icon=\"fa-rocket\" number=\"15\"]" + tinyMCE.activeEditor.selection.getContent() + "[/counter][/counter_style]");
            }
          }
          ]
        },
        {
          text: luxicar_toolkit.i18n.accordion,
          icon: '',
          menu: [
          {
            text: luxicar_toolkit.i18n.normal_acc,
            onclick: function() {
              var shortcode;
              shortcode = "[luxicar_accordions style=\"s1\"]<br/>";
              shortcode += "[luxicar_accordion title=\"Accordion title 1\"]Accordion content 1[/luxicar_accordion]<br/>";
              shortcode += "[luxicar_accordion title=\"Accordion title 2\"]Accordion content 2[/luxicar_accordion]<br/>";
              shortcode += "[luxicar_accordion title=\"Accordion title 3\"]Accordion content 3[/luxicar_accordion]<br/>";
              shortcode += "[/luxicar_accordions]<br/>";
              return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
            }
          },
          {
            text: luxicar_toolkit.i18n.image_acc,
            onclick: function() {
              var shortcode;
              shortcode = "[luxicar_accordions style=\"s2\"]<br/>";
              shortcode += "[luxicar_accordion title=\"Accordion title 1\" image=\"http://placehold.it/160x120\"]Accordion content 1[/luxicar_accordion]<br/>";
              shortcode += "[luxicar_accordion title=\"Accordion title 2\" image=\"http://placehold.it/160x120\"]Accordion content 2[/luxicar_accordion]<br/>";
              shortcode += "[luxicar_accordion title=\"Accordion title 3\" image=\"http://placehold.it/160x120\"]Accordion content 3[/luxicar_accordion]<br/>";
              shortcode += "[/luxicar_accordions]<br/>";
              return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
            }
          },
          {
            text: luxicar_toolkit.i18n.icon_acc,
            onclick: function() {
              var shortcode;
              shortcode = "[luxicar_accordions style=\"s3\"]<br/>";
              shortcode += "[luxicar_accordion title=\"Accordion title 1\" icon=\"fa fa-hdd-o\"]Accordion content 1[/luxicar_accordion]<br/>";
              shortcode += "[luxicar_accordion title=\"Accordion title 2\" icon=\"fa fa-hdd-o\"]Accordion content 2[/luxicar_accordion]<br/>";
              shortcode += "[luxicar_accordion title=\"Accordion title 3\" icon=\"fa fa-hdd-o\"]Accordion content 3[/luxicar_accordion]<br/>";
              shortcode += "[/luxicar_accordions]<br/>";
              return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
            }
          },
          ]
        },
        {
          text: luxicar_toolkit.i18n.map,
          icon: '',
          onclick: function() {
              return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_map place=\"Ha Noi\" latitude=\"21.029532\" longitude=\"105.852345\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_map]");
            }
        },
        {
          text: luxicar_toolkit.i18n.pricing_table,
          icon: '',
          menu: [
            {
              text: luxicar_toolkit.i18n.pricing_table_1,
              icon: "",
              onclick: function() {
                var html;
                html = "[luxicar_pricing_table_style style=\"1\"]<br/>";
                html += "[luxicar_pricing_table style=\"1\"]<br/>";
                html += "[pt_caption]TITLE[/pt_caption]<br/>";
                html += "[pt_price prefix=\"PREFIX\"]PRICE[/pt_price]<br/>";
                html += "[pt_featured]YOUR_FEATURED_1[/pt_featured]<br/>";
                html += "[pt_featured]YOUR_FEATURED_2[/pt_featured]<br/>";
                html += "[pt_featured]YOUR_FEATURED_3[/pt_featured]<br/>";
                html += "[pt_featured]YOUR_FEATURED_4[/pt_featured]<br/>";
                html += "[pt_button url=\"YOUR_BUTTON_URL\" target=\"\"]BUTTON_TEXT[/pt_button]<br/>";
                html += "[/luxicar_pricing_table]<br/>";
                html += "[/luxicar_pricing_table_style]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, html);
              }
            }, {
              text: luxicar_toolkit.i18n.pricing_table_2,
              icon: '',
              onclick: function() {
                var html;
                html = "[luxicar_pricing_table_style style=\"2\"]<br/>";
                html += "[luxicar_pricing_table style=\"3\"]<br/>";
                html += "[pt_caption]TITLE[/pt_caption]<br/>";
                html += "[pt_price prefix=\"MONTH\" small_left=\"$\" small_right=\".99\"]09[/pt_price]<br/>";
                html += "[pt_featured]YOUR_FEATURED_1[/pt_featured]<br/>";
                html += "[pt_featured]YOUR_FEATURED_2[/pt_featured]<br/>";
                html += "[pt_featured]YOUR_FEATURED_3[/pt_featured]<br/>";
                html += "[pt_featured]YOUR_FEATURED_4[/pt_featured]<br/>";
                html += "[pt_button url=\"YOUR_BUTTON_URL\" target=\"\"]BUTTON_TEXT[/pt_button]<br/>";
                html += "[/luxicar_pricing_table]<br/>";
                html += "[/luxicar_pricing_table_style]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, html);
              }
            }
          ]
        },







        ]
      },

      // Infographic & Media
      {
        text: luxicar_toolkit.i18n.infor_media,
        icon: '',
        menu: [
          {
            text: luxicar_toolkit.i18n.progress,
            icon: '',
            menu: [
              {
                text: luxicar_toolkit.i18n.progress_small,
                icon: '',
                  onclick: function() {
                    return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_progressbar class=\"kopa-progress-bar s1\" value=\"10\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_progressbar]");
                  }
              },
              {
                text: luxicar_toolkit.i18n.progress_medium,
                icon: '',
                  onclick: function() {
                    return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_progressbar class=\"kopa-progress-bar s2\" value=\"10\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_progressbar]");
                  }
              },
              {
                text: luxicar_toolkit.i18n.progress_chart,
                icon: '',
                  onclick: function() {
                    return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_chart color=\"#0bbff2\" value=\"10\" title=\"Title\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_chart]");
                  }
              }
            ]
          },
          {
            text: luxicar_toolkit.i18n.sticky_note,
            icon: '',
            menu: [
              {
                text: luxicar_toolkit.i18n.sticky_note_color_1,
                icon: '',
                  onclick: function() {
                    return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_stickynote class=\"sticky-note s1\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_stickynote]");
                  }
              },
              {
                text: luxicar_toolkit.i18n.sticky_note_color_2,
                icon: '',
                  onclick: function() {
                    return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_stickynote class=\"sticky-note s2\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_stickynote]");
                  }
              },
              {
                text: luxicar_toolkit.i18n.sticky_note_color_3,
                icon: '',
                  onclick: function() {
                    return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_stickynote class=\"sticky-note s3\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_stickynote]");
                  }
              },
              {
                text: luxicar_toolkit.i18n.sticky_note_color_4,
                icon: '',
                  onclick: function() {
                    return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_stickynote class=\"sticky-note s4\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_stickynote]");
                  }
              },
              {
                text: luxicar_toolkit.i18n.sticky_note_color_5,
                icon: '',
                  onclick: function() {
                    return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_stickynote class=\"sticky-note s5\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_stickynote]");
                  }
              },
              {
                text: luxicar_toolkit.i18n.sticky_note_color_6,
                icon: '',
                  onclick: function() {
                    return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_stickynote class=\"sticky-note s6\"]" + tinyMCE.activeEditor.selection.getContent() + "[/luxicar_stickynote]");
                  }
              },
            ]
          },
          {
            text: luxicar_toolkit.i18n.tab,
            icon: '',
            menu: [
              {
                text: luxicar_toolkit.i18n.tab_top_image,
                icon: '',
                onclick: function() {
                  var shortcode;
                  shortcode = "[luxicar_tabs style=\"kopa-tab s1\"]<br/>";
                  shortcode += "[luxicar_tab title=\"Tab title 1\" image=\"http://placehold.it/150x120\"]Tab content 1[/luxicar_tab]<br/>";
                  shortcode += "[luxicar_tab title=\"Tab title 2\" image=\"http://placehold.it/150x120\"]Tab content 2[/luxicar_tab]<br/>";
                  shortcode += "[luxicar_tab title=\"Tab title 3\" image=\"http://placehold.it/150x120\"]Tab content 3[/luxicar_tab]<br/>";
                  shortcode += "[/luxicar_tabs]<br/>";
                  return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
                }
              },
              {
                text: luxicar_toolkit.i18n.tab_top,
                icon: '',
                onclick: function() {
                  var shortcode;
                  shortcode = "[luxicar_tabs style=\"kopa-tab s2\"]<br/>";
                  shortcode += "[luxicar_tab title=\"Tab title 1\"]Tab content 1[/luxicar_tab]<br/>";
                  shortcode += "[luxicar_tab title=\"Tab title 2\"]Tab content 2[/luxicar_tab]<br/>";
                  shortcode += "[luxicar_tab title=\"Tab title 3\"]Tab content 3[/luxicar_tab]<br/>";
                  shortcode += "[/luxicar_tabs]<br/>";
                  return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
                }
              },
              {
                text: luxicar_toolkit.i18n.tab_right,
                onclick: function() {
                  var shortcode;
                  shortcode = "[luxicar_tabs style=\"kopa-tab s3\"]<br/>";
                  shortcode += "[luxicar_tab title=\"Tab title 1\"]Tab content 1[/luxicar_tab]<br/>";
                  shortcode += "[luxicar_tab title=\"Tab title 2\"]Tab content 2[/luxicar_tab]<br/>";
                  shortcode += "[luxicar_tab title=\"Tab title 3\"]Tab content 3[/luxicar_tab]<br/>";
                  shortcode += "[/luxicar_tabs]<br/>";
                  return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
                }
              }
            ]
          },
          {
            text: luxicar_toolkit.i18n.service_list,
            icon: '',
            menu: [
              {
                text: luxicar_toolkit.i18n.service_list_normal,
                icon: '',
                onclick: function() {
                  return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_service  excerpt=\"20\" style=\"normal\" posts_per_page=\"3\"]");
                }
              },
              {
                text: luxicar_toolkit.i18n.service_list_adv,
                icon: '',
                onclick: function() {
                  return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_service excerpt=\"20\" style=\"adv\" posts_per_page=\"3\"]");
                }
              }
            ]
          },
          {
            text: luxicar_toolkit.i18n.portfolio,
            icon: '',
            onclick: function() {
              return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[luxicar_portfolio posts_per_page=\"3\"]");
            }
          }
        ]
      },
      // Service
        {
        text: luxicar_toolkit.i18n.single_service,
        icon: '',
        onclick: function() {
          return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[single_service title=\"Title\" image=\"http://placehold.it/620x330\"]Content[single_service_include title=\"Include\"]include[/single_service_include][single_service_price title=\"As low as\" price=\"$30.00\"][/single_service]");
        }
      }
      ]
    });








  });
})();
