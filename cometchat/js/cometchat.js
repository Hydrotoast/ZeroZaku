/*
 * CometChat 
 * Copyright (c) 2010 Inscripts - support@cometchat.com | http://www.cometchat.com | http://www.inscripts.com
*/

(function ($) {
    $.cometchat = function () {
        var _1 = "<?php echo BASE_URL;?>";
        var _2 = [];
        var _3 = []; <?php echo $settings; ?>
        var _24 = 0;
        var _25 = {};
        var _26 = {};
        var _27 = {};
        var _28 = "";
        var _29 = 0;
        var _2a = 0;
        var _2b = true;
        var _2c = 0;
        var ie6 = false;
        var _2d;
        var _2e;
        var _2f = _8;
        var _30 = 1;
        var _31 = 0;
        var _32 = 0;
        var _33 = 0;
        var _34 = "";
        var _35 = document.title;
        var _36 = 0;
        var _37 = {};
        var _38 = {};
        var _39 = {};
        var _3a = {};
        var _3b = {};
        var _3c = {};
        var _3d = {};
        var _3e = {};
        var _3f = {};
        var _40 = new Date();
        var _41 = _40.getDate();
        var _42 = Math.floor(_40.getTime() / 1000);
        var _43 = /([^\x00-\x80]+)|([&][#])+/;
        var _44 = 0;
        var _45;
        var _46 = _42;
        var _47 = 0;
        var _48;
        var _49 = 0;
        var _4a;
        var _4b;
        var _4c = navigator.userAgent.match(/ipad|iphone|android|windows ce|blackberry|palm|symbian/i) != null;
        var _4d = 0;
        var _4e = 0;
        $.ajaxSetup({
            scriptCharset: "utf-8",
            cache: "false"
        });
        if (_6 == 1) {
            $("<div id=\"cometchat_flashcontent\"></div>").appendTo($("body"));
            var _4f = {};
            var _50 = {};
            var _51 = {
                id: "cometchatbeep",
                name: "cometchatbeep"
            };
            var so;
            so = new SWFObjectCC(_1 + "swf/sound.swf", "cometchatbeep", "1", "1", "8", "#000");
            so.write("cometchat_flashcontent");
        }
        function _52(_53) {
            var _54 = navigator.appName.indexOf("Microsoft") != -1;
            return (_54) ? window[_53] : document[_53];
        };

        function _55() {
            _52("cometchatbeep").cometchatbeep();
            try {
                _52("cometchatbeep").cometchatbeep();
            } catch (error) {
                _6 = 0;
            }
        };

        function _56(id, _57, _58) {
            $("#cometchat_tooltip").css("display", "none");
            $("#cometchat_tooltip").removeClass("cometchat_tooltip_left").css("left", "-100000px");
            $("#cometchat_tooltip .cometchat_tooltip_content").html(_57);
            var pos = $("#" + id).offset();
            var _59 = $("#" + id).width();
            var _5a = $("#cometchat_tooltip").width();
            if (_58 == 1) {
                $("#cometchat_tooltip").css("left", (pos.left + _59) - 16).addClass("cometchat_tooltip_left");
            } else {
                var _5b = (pos.left + _59) - _5a;
                _5b += 16;
                $("#cometchat_tooltip").removeClass("cometchat_tooltip_left").css("left", _5b);
            }
            $("#cometchat_tooltip").css("display", "block");
            if (ie6) {
                _5c();
            }
        };

        function _5d(_5e) {
            var _5f = $("#cometchat_optionsbutton_popup .cometchat_statustextarea").val();
            if (_5f != "") {
                $.post(_1 + "cometchat_send.php", {
                	aid: _aid,
                    statusmessage: _5f
                }, function (_60) {
                    $(_5e).blur();
                });
            }
        };

        function _61(_62, _63) {
            if (_62.keyCode == 13 && _62.shiftKey == 0) {
                _5d();
                return false;
            }
        };

        function _64(id) {
            if (_44 == id) {
                _44 = 0;
            }
        };

        function _65(_66, _67, id, _68) {
            if ((_66.keyCode == 13 && _66.shiftKey == 0) || _68 == 1) {
                var _69 = $(_67).val();
                _69 = _69.replace(/^\s+|\s+$/g, "");
                $(_67).val("");
                $(_67).css("height", "18px");
                $("#cometchat_user_" + id + "_popup .cometchat_tabcontenttext").css("height", "200px");
                $(_67).css("overflow-y", "hidden");
                $(_67).focus();
                if (_69 != "") {
                    $.post(_1 + "cometchat_send.php", {
                    	aid: _aid,
                        to: id,
                        message: _69
                    }, function (_6a) {
                        if (_6a) {
                            _e5(id, _69, "1", "1", _6a, 1, Math.floor(new Date().getTime() / 1000));
                            $("#cometchat_tabcontenttext_" + id).scrollTop(50000);
                            setTimeout(function () {
                                $("#cometchat_tabcontenttext_" + id).scrollTop(50000);
                            }, 100);
                        }
                        _64(id);
                        _30 = 1;
                        if (_2f > _8) {
                            _2f = _8;
                            clearTimeout(_2d);
                            _2d = setTimeout(function () {
                                _6b();
                            }, _8);
                        }
                    });
                }
                return false;
            }
        };

        function _6c(_6d, _6e, id) {
            if (_6d.keyCode == 13 && _6d.shiftKey == 0) {
                $(_6e).val("");
            }
            var _6f = _6e.clientHeight;
            var _70 = 94;
            clearTimeout(_45);
            _44 = id;
            _45 = setTimeout(function () {
                _64(id);
            }, _16);
            if (_70 > _6f) {
                _6f = Math.max(_6e.scrollHeight, _6f);
                if (_70) {
                    _6f = Math.min(_70, _6f);
                }
                if (_6f > _6e.clientHeight) {
                    $(_6e).css("height", _6f + 4 + "px");
                    $("#cometchat_user_" + id + "_popup .cometchat_tabcontenttext").css("height", 218 - (_6f + 4) + "px");
                }
            } else {
                $(_6e).css("overflow-y", "auto");
            }
            $("#cometchat_tabcontenttext_" + id).scrollTop(50000);
            setTimeout(function () {
                $("#cometchat_tabcontenttext_" + id).scrollTop(50000);
            }, 100);
        };

        function _71() {
            $("#cometchat_optionsbutton_popup .busy").css("text-decoration", "none");
            $("#cometchat_optionsbutton_popup .invisible").css("text-decoration", "none");
            $("#cometchat_optionsbutton_popup .available").css("text-decoration", "none");
            _72();
        };

        function _72() {
            $("#cometchat_userstab_icon").removeClass("cometchat_user_available2");
            $("#cometchat_userstab_icon").removeClass("cometchat_user_busy2");
            $("#cometchat_userstab_icon").removeClass("cometchat_user_invisible2");
            $("#cometchat_userstab_icon").removeClass("cometchat_user_away2");
        };

        function _73(_74) {
            $.post(_1 + "cometchat_send.php", {
            	aid: _aid,
                status: _74
            }, function (_75) {
                if (_74 != "away") {
                    _4a = _74;
                }
            });
        };

        function _76(_77) {
            _2a = 1;
            _71();
            $("#cometchat_userstab_icon").addClass("cometchat_user_invisible2");
            if (_77 != 1) {
                _73("offline");
            }
            $("#cometchat_userstab_popup").removeClass("cometchat_tabopen");
            $("#cometchat_userstab").removeClass("cometchat_userstabclick").removeClass("cometchat_tabclick");
            $("#cometchat_optionsbutton_popup").removeClass("cometchat_tabopen");
            $("#cometchat_optionsbutton").removeClass("cometchat_tabclick");
            _78("buddylist", "0");
            $("#cometchat_userstab_text").html(_2[17]);
            if (_28 != "") {
                $("#cometchat_user_" + _28 + " .cometchat_closebox_bottom").click();
                _28 = "";
                _78("openChatboxId", _28);
            }
            for (chatbox in _3c) {
                if (_3c.hasOwnProperty(chatbox)) {
                    if (_3c[chatbox] != null) {
                        $("#cometchat_user_" + chatbox + " .cometchat_closebox_bottom").click();
                    }
                }
            }
        };

        function _79() {
            $("#cometchat_optionsbutton_popup .cometchat_gooffline").click(function () {
                _76();
            });
            $("#cometchat_soundnotifications").click(function (_7a) {
                $.cookie(_a + "sound", $("#cometchat_soundnotifications").attr("checked"), {
                    path: "/",
                    expires: 365
                });
            });
            $("#cometchat_popupnotifications").click(function (_7b) {
                $.cookie(_a + "popup", $("#cometchat_popupnotifications").attr("checked"), {
                    path: "/",
                    expires: 365
                });
            });
            $("#cometchat_optionsbutton_popup .available").click(function (_7c) {
                _71();
                $("#cometchat_userstab_icon").addClass("cometchat_user_available2");
                $(this).css("text-decoration", "underline");
                _73("available");
            });
            $("#cometchat_optionsbutton_popup .cometchat_statusbutton").click(function (_7d) {
                _5d();
            });
            $("#cometchat_optionsbutton_popup .busy").click(function (_7e) {
                _71();
                $("#cometchat_userstab_icon").addClass("cometchat_user_busy2");
                $(this).css("text-decoration", "underline");
                _73("busy");
            });
            $("#cometchat_optionsbutton_popup .invisible").click(function (_7f) {
                _71();
                $("#cometchat_userstab_icon").addClass("cometchat_user_invisible2");
                $(this).css("text-decoration", "underline");
                _73("invisible");
            });
            $("#cometchat_optionsbutton_popup .cometchat_statustextarea").keydown(function (_80) {
                return _61(_80, this);
            });
            $("#cometchat_optionsbutton").mouseover(function () {
                if (!$("#cometchat_optionsbutton_popup").hasClass("cometchat_tabopen")) {
                    if (_29 == 0) {
                        if (_49 == 0) {
                            _56("cometchat_optionsbutton", _2[0]);
                        }
                    } else {
                        if (_49 == 0) {
                            _56("cometchat_optionsbutton", _2[8]);
                        }
                    }
                }
                $(this).addClass("cometchat_tabmouseover");
            });
            $("#cometchat_optionsbutton").mouseout(function () {
                $(this).removeClass("cometchat_tabmouseover");
                if (_49 == 0) {
                    $("#cometchat_tooltip").css("display", "none");
                }
            });
            $("#cometchat_optionsbutton").click(function () {
                if (_34 != "") {
                    $("#cometchat_trayicon_" + _34 + "_popup").removeClass("cometchat_tabopen");
                    $("#cometchat_trayicon_" + _34).removeClass("cometchat_trayclick");
                    _34 = "";
                    _78("trayOpen", _34);
                }
                if (_29 == 0) {
                    if (_2a == 1) {
                        _2a = 0;
                        $("#cometchat_userstab_text").html(_2[9] + " (" + _33 + ")");
                        _6b();
                        $("#cometchat_optionsbutton_popup .available").click();
                    }
                    $("#cometchat_tooltip").css("display", "none");
                    var _81 = $("#cometchat_base").position().left;
                    var _82 = $("#cometchat_base").width();
                    $("#cometchat_optionsbutton_popup").css("left", _81 + _82 - 223 - 32).css("bottom", "24px");
                    $(this).toggleClass("cometchat_tabclick");
                    $("#cometchat_optionsbutton_popup").toggleClass("cometchat_tabopen");
                    $("#cometchat_optionsbutton").toggleClass("cometchat_optionsimages_click");
                    $("#cometchat_userstab_popup").removeClass("cometchat_tabopen");
                    $("#cometchat_userstab").removeClass("cometchat_userstabclick").removeClass("cometchat_tabclick");
                    _78("buddylist", "0");
                    if ($.cookie(_a + "sound")) {
                        if ($.cookie(_a + "sound") == "true") {
                            $("#cometchat_soundnotifications").attr("checked", true);
                        } else {
                            $("#cometchat_soundnotifications").attr("checked", false);
                        }
                    }
                    if ($.cookie(_a + "popup")) {
                        if ($.cookie(_a + "popup") == "true") {
                            $("#cometchat_popupnotifications").attr("checked", true);
                        } else {
                            $("#cometchat_popupnotifications").attr("checked", false);
                        }
                    }
                } else {
                    if (_2[16] != "") {
                        location.href = _2[16];
                    }
                }
            });
            $("#cometchat_optionsbutton_popup .cometchat_userstabtitle").click(function () {
                $("#cometchat_optionsbutton").click();
            });
            $("#cometchat_optionsbutton_popup .cometchat_userstabtitle").mouseenter(function () {
                $("#cometchat_optionsbutton_popup .cometchat_userstabtitle .cometchat_minimizebox").addClass("cometchat_chatboxtraytitlemouseover");
            });
            $("#cometchat_optionsbutton_popup .cometchat_userstabtitle").mouseleave(function () {
                $("#cometchat_optionsbutton_popup .cometchat_userstabtitle .cometchat_minimizebox").removeClass("cometchat_chatboxtraytitlemouseover");
            });
        };

        function _83() {
            var _84 = "";
            var _85 = 0;
            for (chatbox in _3c) {
                if (_3c.hasOwnProperty(chatbox)) {
                    if (_3c[chatbox] != null) {
                        if (!Number(_3c[chatbox])) {
                            _3c[chatbox] = 0;
                        }
                        _84 += chatbox + "|" + _3c[chatbox] + ",";
                        if (_3c[chatbox] > 0) {
                            _85 = 1;
                        }
                    }
                }
            }
            _36 = _85;
            _84 = _84.slice(0, -1);
            _78("activeChatboxes", _84);
        };

        function _86(id, _87, _88, _89, _8a, _8b, _8c, _8d) {
            if (id == null || id == "") {
                return;
            }
            if (_37[id] == null || _37[id] == "") {
                if (_3e[id] != 1) {
                    _3e[id] = 1;
                    $.ajax({
                        url: _1 + "cometchat_getid.php",
                        data: {
                            userid: id
                        },
                        type: "post",
                        cache: false,
                        dataFilter: function (_8e) {
                            if (typeof(JSON) !== "undefined" && typeof(JSON.parse) === "function") {
                                return JSON.parse(_8e);
                            } else {
                                return eval("(" + _8e + ")");
                            }
                        },
                        success: function (_8f) {
                            if (_8f) {
                                _87 = _37[id] = _8f.n;
                                _88 = _39[id] = _8f.s;
                                _89 = _38[id] = _8f.m;
                                _8a = _3a[id] = _8f.a;
                                _8b = _3b[id] = _8f.l;
                                if (_3d[id] != null) {
                                    $("#cometchat_user_" + id + " .cometchat_closebox_bottom_status").removeClass("cometchat_available").removeClass("cometchat_busy").removeClass("cometchat_offline").removeClass("cometchat_away").addClass("cometchat_" + _88);
                                    if ($("#cometchat_user_" + id + "_popup").length > 0) {
                                        $("#cometchat_user_" + id + "_popup .cometchat_tabsubtitle .cometchat_message").html(_89);
                                    }
                                }
                                _3e[id] = 0;
                                _90(id, _87, _88, _89, _8a, _8b, _8c, _8d);
                            }
                        }
                    });
                } else {
                    setTimeout(function () {
                        _86(id, _37[id], _39[id], _38[id], _3a[id], _3b[id], _8c, _8d);
                    }, 500);
                }
            } else {
                _90(id, _37[id], _39[id], _38[id], _3a[id], _3b[id], _8c, _8d);
            }
        };

        function _90(id, _91, _92, _93, _94, _95, _96, _97) {
            if (_3d[id] != null) {
                if (!$("#cometchat_user_" + id).hasClass("cometchat_tabclick") && _96 != 1) {
                    if (_28 != "") {
                        $("#cometchat_user_" + _28 + "_popup").removeClass("cometchat_tabopen");
                        $("#cometchat_user_" + _28).removeClass("cometchat_tabclick").removeClass("cometchat_usertabclick");
                        _28 = "";
                        _78("openChatboxId", _28);
                    }
                    if (($("#cometchat_user_" + id).offset().left < ($("#cometchat_chatboxes").offset().left + $("#cometchat_chatboxes").width())) && ($("#cometchat_user_" + id).offset().left - $("#cometchat_chatboxes").offset().left) >= 0) {
                        $("#cometchat_user_" + id).click();
                    } else {
                        $("#cometchat_chatboxes_wide .cometchat_tabalert").css("display", "none");
                        var ms = _1e;
                        if (_98("initialize") == 1) {
                            ms = 0;
                        }
                        $("#cometchat_chatboxes").scrollToCC("#cometchat_user_" + id, ms, function () {
                            $("#cometchat_user_" + id).click();
                            _c7();
                            _b6();
                        });
                    }
                }
                _c7();
                return;
            }
            $("#cometchat_chatboxes_wide").width($("#cometchat_chatboxes_wide").width() + 152);
            _bd(1);
            if (_91.length > _13 && !_43.test(_91)) {
                shortname = _91.substr(0, _13) + "...";
            } else {
                shortname = _91;
            }
            if (_91.length > _12 && !_43.test(_91)) {
                longname = _91.substr(0, _12) + "...";
            } else {
                longname = _91;
            }
            $("<span/>").attr("id", "cometchat_user_" + id).addClass("cometchat_tab").html("<div class=\"cometchat_user_shortname\">" + shortname + "</div>").appendTo($("#cometchat_chatboxes_wide"));
            $("#cometchat_user_" + id).append("<div class=\"cometchat_closebox_bottom_status cometchat_" + _92 + "\"></div>");
            $("#cometchat_user_" + id).append("<div class=\"cometchat_closebox_bottom\"></div>");
            $("#cometchat_user_" + id + " .cometchat_closebox_bottom").mouseenter(function () {
                $(this).addClass("cometchat_closebox_bottomhover");
            });
            $("#cometchat_user_" + id + " .cometchat_closebox_bottom").mouseleave(function () {
                $(this).removeClass("cometchat_closebox_bottomhover");
            });
            $("#cometchat_user_" + id + " .cometchat_closebox_bottom").click(function () {
                $("#cometchat_user_" + id + "_popup").remove();
                $("#cometchat_user_" + id).remove();
                if (_28 == id) {
                    _28 = "";
                    _78("openChatboxId", _28);
                }
                $("#cometchat_chatboxes_wide").width($("#cometchat_chatboxes_wide").width() - 152);
                $("#cometchat_chatboxes").scrollToCC("-=152px");
                _bd();
                _3c[id] = null;
                _3d[id] = null;
                _3f[id] = 0;
                _83();
            });
            var _99 = "";
            if (_4.length > 0) {
                if (_4.length > 8) {
                    _99 += "<div style=\"clear:both;padding-bottom:4px\"></div>";
                }
                _99 += "<div class=\"cometchat_plugins\">";
                for (var i = 0; i < _4.length; i++) {
                    if (_4[i] == "divider") {
                        _99 += "<img src=\"" + _1 + "themes/" + _7 + "/images/divider.png\" class=\"cometchat_pluginsicon_divider\">";
                    } else {
                        var _91 = "cc" + _4[i];
                        _99 += "<img src=\"" + _1 + "plugins/" + _4[i] + "/icon.png\" class=\"cometchat_pluginsicon\" title=\"" + $[_91].getTitle() + "\" onclick=\"javascript:jqcc." + _91 + ".init(" + id + ");\">";
                    }
                }
                _99 += "</div>";
            }
            var _9a = "";
            var _9b = "";
            if (_95 != "") {
                _9a = "<a href=\"" + _95 + "\">";
                _9b = "</a>";
            }
            var _9c = "";
            if (_94 != "") {
                _9c = "<div class=\"cometchat_avatarbox\">" + _9a + "<img src=\"" + _94 + "\" class=\"cometchat_avatar\" />" + _9b + "</div>";
            }
            $("<div/>").attr("id", "cometchat_user_" + id + "_popup").addClass("cometchat_tabpopup").css("display", "none").html("<div class=\"cometchat_tabtitle\"><div class=\"cometchat_name\">" + _9a + longname + _9b + "<span id=\"cometchat_typing_" + id + "\" class=\"cometchat_typing\"></span></div></div><div class=\"cometchat_tabsubtitle\">" + _9c + "<div class=\"cometchat_message\">" + _93 + "</div>" + _99 + "<div style=\"clear:both\"></div>" + "</div><div class=\"cometchat_tabcontent\"><div class=\"cometchat_tabcontenttext\" id=\"cometchat_tabcontenttext_" + id + "\"></div><div class=\"cometchat_tabcontentinput\"><textarea class=\"cometchat_textarea\"></textarea><div class=\"cometchat_tabcontentsubmit\"></div></div><div style=\"clear:both\"></div></div>").appendTo($("#cometchat"));
            $("#cometchat_user_" + id + "_popup .cometchat_textarea").keydown(function (_9d) {
                return _65(_9d, this, id);
            });
            $("#cometchat_user_" + id + "_popup .cometchat_tabcontentsubmit").click(function (_9e) {
                return _65(_9e, $("#cometchat_user_" + id + "_popup .cometchat_textarea"), id, 1);
            });
            $("#cometchat_user_" + id + "_popup .cometchat_textarea").keyup(function (_9f) {
                return _6c(_9f, this, id);
            });
            $("#cometchat_user_" + id + "_popup .cometchat_tabtitle").append("<div class=\"cometchat_closebox\"></div><div class=\"cometchat_minimizebox\"></div><br clear=\"all\"/>");
            $("#cometchat_user_" + id + "_popup .cometchat_tabtitle .cometchat_closebox").mouseenter(function () {
                $(this).addClass("cometchat_chatboxmouseoverclose");
                $("#cometchat_user_" + id + "_popup .cometchat_tabtitle .cometchat_minimizebox").removeClass("cometchat_chatboxtraytitlemouseover");
            });
            $("#cometchat_user_" + id + "_popup .cometchat_tabtitle .cometchat_closebox").mouseleave(function () {
                $(this).removeClass("cometchat_chatboxmouseoverclose");
                $("#cometchat_user_" + id + "_popup .cometchat_tabtitle .cometchat_minimizebox").addClass("cometchat_chatboxtraytitlemouseover");
            });
            $("#cometchat_user_" + id + "_popup .cometchat_tabtitle .cometchat_closebox").click(function () {
                $("#cometchat_user_" + id + "_popup").remove();
                $("#cometchat_user_" + id).remove();
                if (_28 == id) {
                    _28 = "";
                    _78("openChatboxId", _28);
                }
                $("#cometchat_chatboxes_wide").width($("#cometchat_chatboxes_wide").width() - 152);
                $("#cometchat_chatboxes").scrollToCC("-=152px");
                _bd();
                _3d[id] = null;
                _3c[id] = null;
                _3f[id] = 0;
                _83();
            });
            $("#cometchat_user_" + id + "_popup .cometchat_tabtitle").click(function () {
                $("#cometchat_user_" + id).click();
            });
            $("#cometchat_user_" + id + "_popup .cometchat_tabtitle").mouseenter(function () {
                $("#cometchat_user_" + id + "_popup .cometchat_tabtitle .cometchat_minimizebox").addClass("cometchat_chatboxtraytitlemouseover");
            });
            $("#cometchat_user_" + id + "_popup .cometchat_tabtitle").mouseleave(function () {
                $("#cometchat_user_" + id + "_popup .cometchat_tabtitle .cometchat_minimizebox").removeClass("cometchat_chatboxtraytitlemouseover");
            });
            $("#cometchat_user_" + id).mouseenter(function () {
                $(this).addClass("cometchat_tabmouseover");
                $("#cometchat_user_" + id + " div").addClass("cometchat_tabmouseovertext");
            });
            $("#cometchat_user_" + id).mouseleave(function () {
                $(this).removeClass("cometchat_tabmouseover");
                $("#cometchat_user_" + id + " div").removeClass("cometchat_tabmouseovertext");
            });
            $("#cometchat_user_" + id).click(function () {
                if (_34 != "") {
                    $("#cometchat_trayicon_" + _34 + "_popup").removeClass("cometchat_tabopen");
                    $("#cometchat_trayicon_" + _34).removeClass("cometchat_trayclick");
                    _34 = "";
                    _78("trayOpen", _34);
                }
                if ($("#cometchat_user_" + id + " .cometchat_tabalert").length > 0) {
                    $("#cometchat_user_" + id + " .cometchat_tabalert").remove();
                    _3d[id] = 0;
                    _3c[id] = 0;
                    _83();
                }
                if ($(this).hasClass("cometchat_tabclick")) {
                    $(this).removeClass("cometchat_tabclick").removeClass("cometchat_usertabclick");
                    $("#cometchat_user_" + id + "_popup").removeClass("cometchat_tabopen");
                    $("#cometchat_user_" + id + " .cometchat_closebox_bottom").removeClass("cometchat_closebox_bottom_click");
                    _28 = "";
                    _78("openChatboxId", _28);
                } else {
                    var _a0 = $("#cometchat_base").position().left;
                    if (($("#cometchat_user_" + id).offset().left < ($("#cometchat_chatboxes").offset().left + $("#cometchat_chatboxes").width())) && ($("#cometchat_user_" + id).offset().left - $("#cometchat_chatboxes").offset().left) >= 0) {
                        if (_28 != "" && _28 != id) {
                            $("#cometchat_user_" + _28 + "_popup").removeClass("cometchat_tabopen");
                            $("#cometchat_user_" + _28).removeClass("cometchat_tabclick").removeClass("cometchat_usertabclick");
                            $("#cometchat_user_" + _28 + " .cometchat_closebox_bottom").removeClass("cometchat_closebox_bottom_click");
                            _28 = "";
                            _78("openChatboxId", _28);
                        }
                        $("#cometchat_user_" + id + "_popup").css("left", _a0 + $("#cometchat_user_" + id).position().left - 77).css("bottom", "24px");
                        $(this).addClass("cometchat_tabclick").addClass("cometchat_usertabclick");
                        $("#cometchat_user_" + id + "_popup").addClass("cometchat_tabopen");
                        $("#cometchat_user_" + id + " .cometchat_closebox_bottom").addClass("cometchat_closebox_bottom_click");
                        _28 = id;
                        _78("openChatboxId", _28);
                        if (_3f[id] != 1 && _98("initialize") != 1) {
                            _aa(id);
                            _3f[id] = 1;
                        }
                        if (ie6) {
                            _5c();
                        }
                    } else {
                        $("#cometchat_user_" + id + "_popup").removeClass("cometchat_tabopen");
                        $("#cometchat_user_" + id).removeClass("cometchat_tabclick").removeClass("cometchat_usertabclick");
                        var _a1 = (($("#cometchat_user_" + id).offset().left - $("#cometchat_chatboxes_wide").offset().left)) - ((Math.floor(($("#cometchat_chatboxes").width() / 152)) - 1) * 152);
                        $("#cometchat_chatboxes").scrollToCC(_a1, 0, function () {
                            _b6();
                            _c7();
                            $("#cometchat_user_" + id).click();
                        });
                    }
                    $("#cometchat_tabcontenttext_" + id).scrollTop(50000);
                    setTimeout(function () {
                        $("#cometchat_tabcontenttext_" + id).scrollTop(50000);
                    }, 100);
                }
                if (_a2("updatingsession") != 1) {
                    $("#cometchat_user_" + id + "_popup .cometchat_textarea").focus();
                }
            });
            if (_96 != 1) {
                $("#cometchat_user_" + id).click();
            }
            _3c[id] = 0;
            _3d[id] = 0;
            _83();
        };

        function _a3(ts) {
            var ap = "";
            var _a4 = ts.getHours();
            var _a5 = ts.getMinutes();
            var _a6 = ts.getDate();
            var _a7 = ts.getMonth();
            if (_1d != 1) {
                if (_a4 > 11) {
                    ap = "pm";
                } else {
                    ap = "am";
                }
                if (_a4 > 12) {
                    _a4 = _a4 - 12;
                }
                if (_a4 == 0) {
                    _a4 = 12;
                }
            } else {
                if (_a4 < 10) {
                    _a4 = "0" + _a4;
                }
            }
            if (_a5 < 10) {
                _a5 = "0" + _a5;
            }
            var _a8 = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            var _a9 = "th";
            if (_a6 == 1 || _a6 == 21 || _a6 == 31) {
                _a9 = "st";
            } else {
                if (_a6 == 2 || _a6 == 22) {
                    _a9 = "nd";
                } else {
                    if (_a6 == 3 || _a6 == 23) {
                        _a9 = "rd";
                    }
                }
            }
            if (_a6 != _41) {
                return "<span class=\"cometchat_ts\">(" + _a4 + ":" + _a5 + ap + " " + _a6 + _a9 + " " + _a8[_a7] + ")</span>";
            } else {
                return "<span class=\"cometchat_ts\">(" + _a4 + ":" + _a5 + ap + ")</span>";
            }
        };

        function _aa(id) {
            $.ajax({
                cache: false,
                url: _1 + "cometchat_receive.php",
                data: {
            		aid: _aid,
                    chatbox: id
                },
                type: "post",
                dataFilter: function (_ab) {
                    if (typeof(JSON) !== "undefined" && typeof(JSON.parse) === "function") {
                        return JSON.parse(_ab);
                    } else {
                        return eval("(" + _ab + ")");
                    }
                },
                success: function (_ac) {
                    if (_ac) {
                        var _ad = "";
                        var _ae = _37[id];
                        $.each(_ac, function (_af, _b0) {
                            if (_af == "messages") {
                                $.each(_b0, function (i, _b1) {
                                    var _b2 = "";
                                    if (_b1.self == 1) {
                                        fromname = _2[10];
                                        _b2 = " cometchat_self";
                                    } else {
                                        fromname = _ae;
                                    }
                                    var ts = new Date(_b1.sent * 1000);
                                    if (!_10 && fromname.indexOf(" ") != -1) {
                                        fromname = fromname.slice(0, fromname.indexOf(" "));
                                    }
                                    _ad += (_127("<div class=\"cometchat_chatboxmessage\" id=\"cometchat_message_" + _b1.id + "\"><span class=\"cometchat_chatboxmessagefrom" + _b2 + "\"><strong>" + fromname + "</strong>:&nbsp;&nbsp;</span><span class=\"cometchat_chatboxmessagecontent" + _b2 + "\">" + _b1.message + "</span>" + _a3(ts) + "</div>", _b2));
                                });
                            }
                        });
                        if ($("cometchat_tabcontenttext_" + id).length > 0) {
                            _133("cometchat_tabcontenttext_" + id, "<div>" + _ad + "</div>" + document.getElementById("cometchat_tabcontenttext_" + id).innerHTML);
                        } else {
                            document.getElementById("cometchat_tabcontenttext_" + id).innerHTML = "<div>" + _ad + "</div>";
                        }
                        $("#cometchat_tabcontenttext_" + id).scrollTop(50000);
                        setTimeout(function () {
                            $("#cometchat_tabcontenttext_" + id).scrollTop(50000);
                        }, 100);
                    }
                }
            });
        };

        function _b3(id, _b4, add) {
            if (_37[id] == null || _37[id] == "") {
                setTimeout(function () {
                    _b3(id, _b4, add);
                }, 500);
            } else {
                _b5(id);
                if (add == 1) {
                    if ($("#cometchat_user_" + id + " .cometchat_tabalert").length > 0) {
                        _b4 = parseInt($("#cometchat_user_" + id + " .cometchat_tabalert").html()) + parseInt(_b4);
                    }
                }
                if (_b4 == 0) {
                    $("#cometchat_user_" + id + " .cometchat_tabalert").remove();
                } else {
                    if ($("#cometchat_user_" + id + " .cometchat_tabalert").length > 0) {
                        $("#cometchat_user_" + id + " .cometchat_tabalert").html(_b4);
                    } else {
                        $("<div/>").css("top", "-5px").addClass("cometchat_tabalert").html(_b4).appendTo($("#cometchat_user_" + id + " .cometchat_closebox_bottom_status"));
                    }
                }
                _3c[id] = _b4;
                _83();
                _b6();
            }
        };

        function _b7() {
            $("#cometchat_search").click(function () {
                var _b8 = $(this).val();
                if (_b8 == _2[18]) {
                    $("#cometchat_search").val("");
                    $("#cometchat_search").addClass("cometchat_search_light");
                }
            });
            $("#cometchat_search").blur(function () {
                var _b9 = $(this).val();
                if (_b9 == "") {
                    $("#cometchat_search").addClass("cometchat_search_light");
                    $("#cometchat_search").val(_2[18]);
                }
            });
            $("#cometchat_search").keyup(function () {
                var _ba = $(this).val();
                if (_ba.length > 0 && _ba != _2[18]) {
                    $("#cometchat_userscontent .cometchat_userlist").hide();
                    $("#cometchat_userscontent .cometchat_userlist:icontains(" + _ba + ")").show();
                    $("#cometchat_search").removeClass("cometchat_search_light");
                } else {
                    $("#cometchat_userscontent .cometchat_userlist").show();
                }
            });
            $("#cometchat_userstab_popup .cometchat_userstabtitle").click(function () {
                $("#cometchat_userstab").click();
            });
            $("#cometchat_userstab_popup .cometchat_userstabtitle").mouseenter(function () {
                $("#cometchat_userstab_popup .cometchat_userstabtitle .cometchat_minimizebox").addClass("cometchat_chatboxtraytitlemouseover");
            });
            $("#cometchat_userstab_popup .cometchat_userstabtitle").mouseleave(function () {
                $("#cometchat_userstab_popup .cometchat_userstabtitle .cometchat_minimizebox").removeClass("cometchat_chatboxtraytitlemouseover");
            });
            $("#cometchat_userstab").mouseover(function () {
                $(this).addClass("cometchat_tabmouseover");
            });
            $("#cometchat_userstab").mouseout(function () {
                $(this).removeClass("cometchat_tabmouseover");
            });
            $("#cometchat_userstab").click(function () {
                if (_34 != "") {
                    $("#cometchat_trayicon_" + _34 + "_popup").removeClass("cometchat_tabopen");
                    $("#cometchat_trayicon_" + _34).removeClass("cometchat_trayclick");
                    _34 = "";
                    _78("trayOpen", _34);
                }
                if (_2a == 1) {
                    _2a = 0;
                    $("#cometchat_userstab_text").html(_2[9] + " (" + _33 + ")");
                    _6b();
                    $("#cometchat_optionsbutton_popup .available").click();
                }
                $("#cometchat_optionsbutton_popup").removeClass("cometchat_tabopen");
                $("#cometchat_optionsbutton").removeClass("cometchat_tabclick");
                if ($(this).hasClass("cometchat_tabclick")) {
                    _78("buddylist", "0");
                } else {
                    _78("buddylist", "1");
                    $("#cometchat_tooltip").css("display", "none");
                }
                var _bb = $("#cometchat_base").position().left;
                var _bc = jqcc("#cometchat_base").width();
                $("#cometchat_userstab_popup").css("left", _bb + _bc - 223 - 32).css("bottom", "24px");
                $(this).toggleClass("cometchat_tabclick").toggleClass("cometchat_userstabclick");
                $("#cometchat_userstab_popup").toggleClass("cometchat_tabopen");
            });
        };

        function _bd(_be) {
            var _bf = $(window).width();
            var _c0 = _24 + 32;
            if (_c0 < 80) {
                _c0 = 80;
            }
            if (_b == "fixed") {
                $("#cometchat_base").css("width", _c);
                if (_d == "center") {
                    var _c1 = (_bf - _c) / 2;
                    $("#cometchat_base").css("left", _c1);
                }
                if (_d == "right") {
                    var _c1 = (_bf - _c);
                    $("#cometchat_base").css("left", _c1 - _e);
                }
                if (_d == "left") {
                    $("#cometchat_base").css("left", _e);
                }
            } else {
                if (_bf < 400 + _c0 + _e + 20) {
                    _bf = 400 + _c0 + _e + 20;
                }
                $("#cometchat_base").css("left", _e);
                $("#cometchat_base").css("width", _bf - (_e * 2));
            }
            var _c2 = $("#cometchat_base").position().left;
            var _c3 = $("#cometchat_base").width();
            $("#cometchat_userstab_popup").css("left", _c2 + _c3 - 223 - 32).css("bottom", "24px");
            $("#cometchat_optionsbutton_popup").css("left", _c2 + _c3 - 223 - 32).css("bottom", "24px");
            if (_34 != "") {
                $("#cometchat_trayicon_" + _34 + "_popup").css("left", $("#cometchat_trayicon_" + _34).offset().left).css("bottom", "24px").css("width", _3[_34][4]);
            }
            if ($("#cometchat_chatboxes_wide").width() <= ($("#cometchat_base").width() - 26 - 178 - 44 - _c0)) {
                $("#cometchat_chatboxes").css("width", $("#cometchat_chatboxes_wide").width());
                $("#cometchat_chatboxes").scrollToCC("0px", 0);
            } else {
                var _c4 = $("#cometchat_chatboxes").width();
                $("#cometchat_chatboxes").css("width", Math.floor(($("#cometchat_base").width() - 26 - 178 - 44 - _c0) / 152) * 152);
                var _c5 = $("#cometchat_chatboxes").width();
                if (_c4 != _c5) {
                    $("#cometchat_chatboxes").scrollToCC("-=152px", 0);
                }
            }
            if (_28 != "" && _be != 1) {
                if (($("#cometchat_user_" + _28).offset().left < ($("#cometchat_chatboxes").offset().left + $("#cometchat_chatboxes").width())) && ($("#cometchat_user_" + _28).offset().left - $("#cometchat_chatboxes").offset().left) >= 0) {
                    $("#cometchat_user_" + _28 + "_popup").css("left", _c2 + $("#cometchat_user_" + _28).position().left - 77).css("bottom", "24px");
                } else {
                    $("#cometchat_user_" + _28 + "_popup").removeClass("cometchat_tabopen");
                    $("#cometchat_user_" + _28).removeClass("cometchat_tabclick").removeClass("cometchat_usertabclick");
                    var _c6 = (($("#cometchat_user_" + _28).offset().left - $("#cometchat_chatboxes_wide").offset().left)) - ((Math.floor(($("#cometchat_chatboxes").width() / 152)) - 1) * 152);
                    $("#cometchat_chatboxes").scrollToCC(_c6, 0, function () {
                        $("#cometchat_user_" + _28).click();
                    });
                }
            }
            _b6(_be);
            _c7(_be);
            if (ie6) {
                _5c();
            }
        };

        function _b6(_c8) {
            $("#cometchat_chatbox_left .cometchat_tabalertlr").html("0");
            $("#cometchat_chatbox_right .cometchat_tabalertlr").html("0");
            $("#cometchat_chatbox_left .cometchat_tabalertlr").css("display", "none");
            $("#cometchat_chatbox_right .cometchat_tabalertlr").css("display", "none");
            $("#cometchat_chatboxes_wide  .cometchat_tabalert").each(function () {
                if (($(this).parent().offset().left < ($("#cometchat_chatboxes").offset().left + $("#cometchat_chatboxes").width())) && ($(this).parent().offset().left - $("#cometchat_chatboxes").offset().left) >= 0) {
                    $(this).css("display", "block");
                } else {
                    $(this).css("display", "none");
                    if (($(this).parent().offset().left - $("#cometchat_chatboxes").offset().left) >= 0) {
                        $("#cometchat_chatbox_right .cometchat_tabalertlr").html(parseInt($("#cometchat_chatbox_right .cometchat_tabalertlr").html()) + parseInt($(this).html()));
                        $("#cometchat_chatbox_right .cometchat_tabalertlr").css("display", "block");
                    } else {
                        $("#cometchat_chatbox_left .cometchat_tabalertlr").html(parseInt($("#cometchat_chatbox_left .cometchat_tabalertlr").html()) + parseInt($(this).html()));
                        $("#cometchat_chatbox_left .cometchat_tabalertlr").css("display", "block");
                    }
                }
            });
        };

        function _c7(_c9) {
            var _ca = 0;
            var _cb = 0;
            var _cc = 0;
            if ($("#cometchat_chatbox_right").hasClass("cometchat_chatbox_right_last")) {
                _cb = 1;
            }
            if ($("#cometchat_chatbox_right").hasClass("cometchat_chatbox_lr")) {
                _cc = 1;
            }
            if ($("#cometchat_chatboxes").scrollLeft() == 0) {
                $("#cometchat_chatbox_left").unbind("click", _cd);
                $("#cometchat_chatbox_left .cometchat_tabtext").html("0");
                $("#cometchat_chatbox_left").addClass("cometchat_chatbox_left_last");
                _ca++;
            } else {
                var _ce = Math.floor($("#cometchat_chatboxes").scrollLeft() / 152);
                $("#cometchat_chatbox_left").unbind("click", _cd);
                $("#cometchat_chatbox_left").bind("click", _cd);
                $("#cometchat_chatbox_left .cometchat_tabtext").html(_ce);
                $("#cometchat_chatbox_left").removeClass("cometchat_chatbox_left_last");
            }
            if (($("#cometchat_chatboxes").scrollLeft() + $("#cometchat_chatboxes").width()) == $("#cometchat_chatboxes_wide").width()) {
                $("#cometchat_chatbox_right").unbind("click", _cf);
                $("#cometchat_chatbox_right .cometchat_tabtext").html("0");
                $("#cometchat_chatbox_right").addClass("cometchat_chatbox_right_last");
                _ca++;
            } else {
                var _ce = Math.floor(($("#cometchat_chatboxes_wide").width() - ($("#cometchat_chatboxes").scrollLeft() + $("#cometchat_chatboxes").width())) / 152);
                $("#cometchat_chatbox_right").unbind("click", _cf);
                $("#cometchat_chatbox_right").bind("click", _cf);
                $("#cometchat_chatbox_right .cometchat_tabtext").html(_ce);
                $("#cometchat_chatbox_right").removeClass("cometchat_chatbox_right_last");
            }
            if (_ca == 2) {
                $("#cometchat_chatbox_right").addClass("cometchat_chatbox_lr");
                $("#cometchat_chatbox_left").addClass("cometchat_chatbox_lr");
            } else {
                $("#cometchat_chatbox_right").removeClass("cometchat_chatbox_lr");
                $("#cometchat_chatbox_left").removeClass("cometchat_chatbox_lr");
            }
            if ((!$("#cometchat_chatbox_right").hasClass("cometchat_chatbox_right_last") && _cb == 1) || ($("#cometchat_chatbox_right").hasClass("cometchat_chatbox_right_last") && _cb == 0) || (!$("#cometchat_chatbox_right").hasClass("cometchat_chatbox_lr") && _cc == 1) || ($("#cometchat_chatbox_right").hasClass("cometchat_chatbox_lr") && _cc == 0)) {
                _bd(_c9);
            }
        };

        function _d0(_d1) {
            if (_28 != "") {
                $("#cometchat_user_" + _28 + "_popup").removeClass("cometchat_tabopen");
                $("#cometchat_user_" + _28).removeClass("cometchat_tabclick").removeClass("cometchat_usertabclick");
            }
            $("#cometchat_chatboxes_wide .cometchat_tabalert").css("display", "none");
            var _d2 = $("#cometchat_base").position().left;
            var ms = _1e;
            if (_98("initialize") == 1) {
                ms = 0;
            }
            $("#cometchat_chatboxes").scrollToCC(_d1, ms, function () {
                if (_28 != "") {
                    if (($("#cometchat_user_" + _28).offset().left < ($("#cometchat_chatboxes").offset().left + $("#cometchat_chatboxes").width())) && ($("#cometchat_user_" + _28).offset().left - $("#cometchat_chatboxes").offset().left) >= 0) {
                        $("#cometchat_user_" + _28).click();
                    } else {
                        _28 = "";
                    }
                    _78("openChatboxId", _28);
                }
                _b6();
                _c7();
            });
        };

        function _cd() {
            _d0("-=152px");
        };

        function _cf() {
            _d0("+=152px");
        };

        function _d3(_d4, _d5) {
            _25[_d4] = _d5;
        };

        function _98(_d6) {
            if (_25[_d6]) {
                return _25[_d6];
            } else {
                return "";
            }
        };

        function _d7(_d8, _d9) {
            _27[_d8] = _d9;
        };

        function _a2(_da) {
            if (_27[_da]) {
                return _27[_da];
            } else {
                return "";
            }
        };

        function _78(_db, _dc) {
            _26[_db] = _dc;
            if (_a2("updatingsession") != 1) {
                var _dd = "";
                if (_26["buddylist"]) {
                    _dd += _26["buddylist"];
                } else {
                    _dd += " ";
                }
                _dd += ":";
                if (_26["activeChatboxes"]) {
                    _dd += _26["activeChatboxes"];
                } else {
                    _dd += " ";
                }
                _dd += ":";
                if (_26["openChatboxId"]) {
                    _dd += _26["openChatboxId"];
                } else {
                    _dd += " ";
                }
                _dd += ":" + _33;
                _dd += ":" + _2a;
                _dd += ":" + _34;
                $.cookie(_a + "state", _dd, {
                    path: "/"
                });
            }
        };

        function _de(_df, _e0) {
            if (_26[_df]) {
                return _26[_df];
            } else {
                return "";
            }
        };

        function _e1(_e2) {
            var id = $(_e2).attr("id").substr(19);
            if (id == "") {
                id = $(_e2).parent().attr("id").substr(19);
            }
            _86(id, _37[id], _39[id], _38[id], _3a[id], _3b[id]);
        };

        function _e3(id) {
            _86(id, _37[id], _39[id], _38[id], _3a[id], _3b[id]);
        };

        function _b5(_e4) {
            var id = _e4;
            _86(id, _37[id], _39[id], _38[id], _3a[id], _3b[id], 1);
        };

        function _e5(id, _e6, _e7, old, _e8, _e9, _ea) {
            if (_3e[id] != 1) {
                _86(id, _37[id], _39[id], _38[id], _3a[id], _3b[id], 1, 1);
            }
            if (_37[id] == null || _37[id] == "") {
                setTimeout(function () {
                    _e5(id, _e6, _e7, old, _e8, _e9, _ea);
                }, 500);
            } else {
                var _eb = "";
                if (parseInt(_e7) == 1) {
                    fromname = _2[10];
                    _eb = " cometchat_self";
                } else {
                    fromname = _37[id];
                }
                if (parseInt(_e9) == 1) {
                    _e6 = _e6.replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/\n/g, "<br>").replace(/\"/g, "&quot;");
                }
                if (_e7 != 1 && _6 == 1) {
                    if ($.cookie(_a + "sound") && $.cookie(_a + "sound") == "true") {} else {
                        if (old != 1) {
                            _55();
                        }
                    }
                }
                separator = ":&nbsp;&nbsp;";
                if ($("#cometchat_message_" + _e8).length > 0) {
                    $("#cometchat_message_" + _e8 + " .cometchat_chatboxmessagecontent").html(_e6);
                } else {
                    sentdata = "";
                    if (_ea != null) {
                        var ts = new Date(_ea * 1000);
                        sentdata = _a3(ts);
                    }
                    if (!_10 && fromname.indexOf(" ") != -1) {
                        fromname = fromname.slice(0, fromname.indexOf(" "));
                    }
                    $("#cometchat_user_" + id + "_popup .cometchat_tabcontenttext").append(_127("<div class=\"cometchat_chatboxmessage\" id=\"cometchat_message_" + _e8 + "\"><span class=\"cometchat_chatboxmessagefrom" + _eb + "\"><strong>" + fromname + "</strong>" + separator + "</span><span class=\"cometchat_chatboxmessagecontent" + _eb + "\">" + _e6 + "</span>" + sentdata + "</div>", _eb));
                    $("#cometchat_typing_" + id).css("display", "none");
                    $("#cometchat_tabcontenttext_" + id).scrollTop(50000);
                    setTimeout(function () {
                        $("#cometchat_tabcontenttext_" + id).scrollTop(50000);
                    }, 100);
                    var _ec = new Date();
                    var _ed = Math.floor(_ec.getTime() / 1000) - _46;
                    if (_ed > 5) {
                        document.title = _2[15];
                    }
                }
                if (_28 != id && old != 1) {
                    _b3(id, 1, 1);
                }
            }
        };

        function _ee(id) {
            if (_37[id] == null || _37[id] == "") {
                setTimeout(function () {
                    _ee(id);
                }, 500);
            } else {
                if (_28 != id) {
                    $("#cometchat_user_" + id).click();
                }
            }
        };

        function _ef(id) {
            if (_37[id] == null || _37[id] == "") {
                setTimeout(function () {
                    _ef(id);
                }, 500);
            } else {
                $("#cometchat_user_" + id).click();
            }
        };

        function _f0(id, _f1, _f2) {
            if (_37[id] == null || _37[id] == "") {
                setTimeout(function () {
                    _f0(id, _f1, _f2);
                }, 500);
            } else {
                $("#cometchat_tabcontenttext_" + id).append("<div>" + _f1 + "</div>");
                $("#cometchat_tabcontenttext_" + id).scrollTop(50000);
                $("#cometchat_typing_" + id).css("display", "none");
                setTimeout(function () {
                    $("#cometchat_tabcontenttext_" + id).scrollTop(50000);
                }, 100);
                _3d[id] = 1;
                if (_f2 == 1) {
                    var _f3 = new Date();
                    var _f4 = Math.floor(_f3.getTime() / 1000) - _46;
                    if (_f4 > 5) {
                        document.title = _2[15];
                    }
                }
                if ($.cookie(_a + "sound") && $.cookie(_a + "sound") == "true") {} else {
                    if (_f == 1 && _f2 == 1) {
                        _55();
                    }
                }
            }
        };

        function _6b() {
        	_25["aid"] = _aid;
            _25["timestamp"] = _32;
            _25["typingto"] = _44;
            _25["blh"] = _4b;
            _25["status"] = "";
            var _f5 = "";
            var _f6 = {};
            var _f7 = {};
            _f6["available"] = "";
            _f6["busy"] = "";
            _f6["offline"] = "";
            _f6["away"] = "";
            _f7["available"] = "";
            _f7["busy"] = "";
            _f7["offline"] = "";
            _f7["away"] = "";
            var _f8 = 0;
            var _f9 = new Date();
            var _fa = Math.floor(_f9.getTime() / 1000) - _46;
            if (_fa > _17 && _47 == 0) {
                if (_4a == "available" || _4a == "busy") {
                    _47 = 1;
                    _25["status"] = "away";
                    _72();
                    $("#cometchat_userstab_icon").addClass("cometchat_user_away2");
                }
            }
            if (_fa < _17 && _47 == 1) {
                if (_4a == "available" || _4a == "busy") {
                    _47 = 0;
                    _25["status"] = _4a;
                    _72();
                    $("#cometchat_userstab_icon").addClass("cometchat_user_" + _4a + "2");
                }
            }
            $.ajax({
                url: _1 + "cometchat_receive.php",
                data: _25,
                type: "post",
                cache: false,
                dataFilter: function (_fb) {
                    if (typeof(JSON) !== "undefined" && typeof(JSON.parse) === "function") {
                        return JSON.parse(_fb);
                    } else {
                        return eval("(" + _fb + ")");
                    }
                },
                success: function (_fc) {
                    if (_fc) {
                        var _fd = 0;
                        var _fe = "";
                        $.each(_fc, function (_ff, item) {
                            if (_ff == "blh") {
                                _4b = item;
                            }
                            if (_ff == "an") {
                                if ($.cookie(_a + "popup") && $.cookie(_a + "popup") == "true") {} else {
                                    _49 = 100;
                                    _56("cometchat_userstab", "<div class=\"cometchat_announcement\">" + item.m + "</div>", 0);
                                    $.cookie(_a + "an", item.id, {
                                        path: "/",
                                        expires: 365
                                    });
                                    clearTimeout(_48);
                                    _48 = setTimeout(function () {
                                        $("#cometchat_tooltip").css("display", "none");
                                        _49 = 0;
                                    }, _1c);
                                }
                            }
                            if (_ff == "buddylist") {
                                var _100 = 0;
                                var _101 = 0;
                                $.each(item, function (i, _102) {
                                    if (_102.n.length > _12 && !_43.test(_102.n)) {
                                        longname = _102.n.substr(0, _12) + "...";
                                    } else {
                                        longname = _102.n;
                                    }
                                    if (_3d[_102.id] != null) {
                                        $("#cometchat_user_" + _102.id + " .cometchat_closebox_bottom_status").removeClass("cometchat_available").removeClass("cometchat_busy").removeClass("cometchat_offline").removeClass("cometchat_away").addClass("cometchat_" + _102.s);
                                        if ($("#cometchat_user_" + _102.id + "_popup").length > 0) {
                                            $("#cometchat_user_" + _102.id + "_popup .cometchat_tabsubtitle .cometchat_message").html(_102.m);
                                        }
                                    }
                                    if (_102.s == "available") {
                                        _100++;
                                    }
                                    _101++;
                                    _f6[_102.s] += "<div id=\"cometchat_userlist_" + _102.id + "\" class=\"cometchat_userlist\" onmouseover=\"jqcc(this).addClass('cometchat_userlist_hover');\" onmouseout=\"jqcc(this).removeClass('cometchat_userlist_hover');\"><span class=\"cometchat_userscontentname\">" + longname + "</span><span class=\"cometchat_userscontentdot cometchat_" + _102.s + "\"></span></div>";
                                    _f7[_102.s] += "<div id=\"cometchat_userlist_" + _102.id + "\" class=\"cometchat_userlist\" onmouseover=\"jqcc(this).addClass('cometchat_userlist_hover');\" onmouseout=\"jqcc(this).removeClass('cometchat_userlist_hover');\"><span class=\"cometchat_userscontentavatar\"><img class=\"cometchat_userscontentavatarimage\" src=\"" + _102.a + "\"></span><span class=\"cometchat_userscontentname\">" + longname + "</span><span class=\"cometchat_userscontentdot cometchat_" + _102.s + "\"></span></div>";
                                    var _103 = "";
                                    if (_19 == 1 && _98("initialize") != 1 && _39[_102.id] != "available" && _39[_102.id] != "busy" && _39[_102.id] != "away" && _102.s == "available") {
                                        _103 = _2[19];
                                    }
                                    if (_1a == 1 && _98("initialize") != 1 && _39[_102.id] != "available" && _39[_102.id] != "busy" && _39[_102.id] != "away" && _102.s == "busy") {
                                        _103 = _2[21];
                                    }
                                    if (_18 == 1 && _98("initialize") != 1 && _39[_102.id] != "offline" && _102.s == "offline") {
                                        _103 = _2[20];
                                    }
                                    if (_103 != "") {
                                        _fe += "<div class=\"cometchat_notification\" onclick=\"javascript:jqcc.cometchat.chatWith('" + _102.id + "')\"><div class=\"cometchat_notification_avatar\"><img class=\"cometchat_notification_avatar_image\" src=\"" + _102.a + "\"></div><div class=\"cometchat_notification_message\">" + _102.n + _103 + "<br/><span class=\"cometchat_notification_status\">" + _102.m + "</span></div><div style=\"clear:both\" /></div>";
                                    }
                                    _39[_102.id] = _102.s;
                                    _38[_102.id] = _102.m;
                                    _37[_102.id] = _102.n;
                                    _3a[_102.id] = _102.a;
                                    _3b[_102.id] = _102.l;
                                });
                                var _104 = _f7;
                                if (_101 > _15) {
                                    _104 = _f6;
                                }
                                for (buddystatus in _104) {
                                    if (_104.hasOwnProperty(buddystatus)) {
                                        if (_104[buddystatus] == "") {
                                            document.getElementById("cometchat_userslist_" + buddystatus).style.display = "none";
                                        } else {
                                            document.getElementById("cometchat_userslist_" + buddystatus).style.display = "block";
                                            _133("cometchat_userslist_" + buddystatus, "<div>" + _104[buddystatus] + "</div>");
                                        }
                                    }
                                }
                                $("#cometchat_search").keyup();
                                $(".cometchat_userlist").unbind("click");
                                $(".cometchat_userlist").bind("click", function (e) {
                                    _e1(e.target);
                                });
                                $("#cometchat_userstab_text").html(_2[9] + " (" + _100 + ")");
                                _33 = _100;
                                if (_101 == 0) {
                                    document.getElementById("cometchat_userslist_available").style.display = "block";
                                    $("#cometchat_userslist_available").html("<div class=\"cometchat_nofriends\">" + _2[14] + "</div>");
                                }
                                if (_101 > _14) {
                                    $("#cometchat_searchbar").css("display", "block");
                                } else {
                                    $("#cometchat_searchbar").css("display", "none");
                                }
                                if (_fe != "" && !$("#cometchat_userstab_popup").hasClass("cometchat_tabopen") && !$("#cometchat_optionsbutton_popup").hasClass("cometchat_tabopen")) {
                                    if (_49 < 10) {
                                        if ($.cookie(_a + "popup") && $.cookie(_a + "popup") == "true") {} else {
                                            _49 = 10;
                                            _56("cometchat_userstab", _fe, 0);
                                            clearTimeout(_48);
                                            _48 = setTimeout(function () {
                                                $("#cometchat_tooltip").css("display", "none");
                                                _49 = 0;
                                            }, _1b);
                                        }
                                    }
                                }
                            }
                            if (_ff == "loggedout") {
                                $.cookie(_a + "loggedin", "0", {
                                    path: "/"
                                });
                                $("#cometchat_optionsbutton").addClass("cometchat_optionsimages_exclamation");
                                $("#cometchat_userstab").hide();
                                $("#cometchat_chatboxes").hide();
                                $("#cometchat_chatbox_left").hide();
                                $("#cometchat_chatbox_right").hide();
                                $("#cometchat_optionsbutton_popup").removeClass("cometchat_tabopen");
                                $("#cometchat_userstab_popup").removeClass("cometchat_tabopen");
                                $("#cometchat_optionsbutton").removeClass("cometchat_tabclick");
                                $("#cometchat_userstab").removeClass("cometchat_tabclick");
                                if (_28 != "") {
                                    $("#cometchat_user_" + _28 + "_popup").removeClass("cometchat_tabopen");
                                    _28 = "";
                                    _78("openChatboxId", _28);
                                }
                                _29 = 1;
                            }
                            if (_ff == "userstatus") {
                                $.each(item, function (name, _105) {
                                    if (name == "message") {
                                        $("#cometchat_optionsbutton_popup .cometchat_statustextarea").val(_105);
                                    }
                                    if (name == "status") {
                                        _4a = _105;
                                        if (_105 == "offline") {
                                            _76(1);
                                        } else {
                                            _71();
                                            $("#cometchat_userstab_icon").addClass("cometchat_user_" + _105 + "2");
                                            $("#cometchat_optionsbutton_popup ." + _105).css("text-decoration", "underline");
                                        }
                                    }
                                });
                            }
                            if (_ff == "cometid") {
                                _4e = item.td;
                                COMET.subscribe({
                                    channel: item.id
                                }, function (_106) {
                                    var ts = Math.round(new Date().getTime() / 1000) + "" + Math.floor(Math.random() * 1000000);
                                    _e5(_106.from, _106.message, _106.self, 0, ts, 0, _106.sent + _4e);
                                });
                            }
                            if (_ff == "initialize") {
                                _32 = item;
                                _117();
                            }
                            if (_ff == "tt") {
                                $(".cometchat_typing").css("display", "none");
                                var _107 = item.split(",");
                                var t = _107.length;
                                while (t > -1) {
                                    $("#cometchat_typing_" + _107[t]).css("display", "block");
                                    t--;
                                }
                            }
                            if (_ff == "messages") {
                                $.each(item, function (i, _108) {
                                    _32 = _108.id;
                                    if ((_28) == (_108.from) && _37[_108.from] != "" && _37[_108.from] != null) {
                                        ++_fd;
                                        var name = _37[_108.from];
                                        var _109 = "";
                                        if (_108.self == 1) {
                                            fromname = _2[10];
                                            _109 = " cometchat_self";
                                        } else {
                                            fromname = name;
                                        }
                                        if ($("#cometchat_message_" + _108.id).length > 0) {
                                            $("#cometchat_message_" + _108.id + " .cometchat_chatboxmessagecontent").html(_108.message);
                                        } else {
                                            var ts = new Date(_108.sent * 1000);
                                            if (!_10 && fromname.indexOf(" ") != -1) {
                                                fromname = fromname.slice(0, fromname.indexOf(" "));
                                            }
                                            _f5 += (_127("<div class=\"cometchat_chatboxmessage\" id=\"cometchat_message_" + _108.id + "\"><span class=\"cometchat_chatboxmessagefrom" + _109 + "\"><strong>" + fromname + "</strong>:&nbsp;&nbsp;</span><span class=\"cometchat_chatboxmessagecontent" + _109 + "\">" + _108.message + "</span>" + _a3(ts) + "</div>", _109));
                                            if (_108.old == 0 && _108.self == 0) {
                                                _f8 = 1;
                                            }
                                        }
                                    } else {
                                        var _10a = 0;
                                        if ($("#cometchat_user_" + _108.from).length > 0) {} else {
                                            _10a = 1;
                                        }
                                        _e5(_108.from, _108.message, _108.self, _108.old, _108.id, 0, _108.sent);
                                        if (_28 == "" && _5 == 1 && _10a == 1) {
                                            _ee(_108.from);
                                        }
                                    }
                                });
                                _30 = 1;
                                _2f = _8;
                            }
                        });
                        if (_28 != "" && _fd > 0) {
                            _f0(_28, _f5, _f8);
                        }
                    }
                    _d3("initialize", "0");
                    _d3("currenttime", "0");
                    if (_29 != 1 && _2a != 1) {
                        _30++;
                        if (_30 > 4) {
                            _2f *= 2;
                            _30 = 1;
                        }
                        if (_2f > _9) {
                            _2f = _9;
                        }
                        clearTimeout(_2d);
                        _2d = setTimeout(function () {
                            _6b();
                        }, _2f);
                    }
                }
            });
        };

        function _10b() {
            _2[1] = "Powered By <a href=\"http://www.cometchat.com\">CometChat</a>";
        };

        function _10c() {
            $("body").append("<div id=\"cometchat\"></div><div id=\"cometchat_hidden\"><div id=\"cometchat_hidden_content\"></div></div><div id=\"cometchat_tooltip\"><div class=\"cometchat_tooltip_content\"></div></div>");
            var _10d = "";
            var _10e = "";
            for (x in _3) {
                if (_3.hasOwnProperty(x)) {
                    var icon = _3[x];
                    _10d += ("<div id=\"cometchat_trayicon_" + x + "\" class=\"cometchat_trayicon\"><img src=\"" + _1 + "modules/" + icon[0] + "/icon.png\"></div>");
                    if (icon[3] == "_popup") {
                        _10e += "<div id=\"cometchat_trayicon_" + x + "_popup\" class=\"cometchat_traypopup\" style=\"display:none\"><div class=\"cometchat_traytitle\"><div class=\"cometchat_name\">" + icon[1] + "</div><div class=\"cometchat_minimizebox\"></div><br clear=\"all\"/></div><div class=\"cometchat_traycontent\"><div class=\"cometchat_traycontenttext\"><iframe  allowtransparency=\"true\" frameborder=0 width=\"" + icon[4] + "\" height=\"" + icon[5] + "\" id=\"cometchat_trayicon_" + x + "_iframe\"></iframe></div></div></div>";
                    }
                    if (!isNaN(icon[6]) && Number(icon[6]) > 0) {
                        _24 += Number(icon[6]);
                    } else {
                        _24 += 16;
                    }
                    _24 += 18;
                }
            }
            var _10f = $.cookie(_a + "state");
            var _110 = 0;
            if (_10f != null) {
                var _111 = _10f.split(/:/);
                _110 = _111[3];
            }
            var _112 = "<div id=\"cometchat_trayicons\">" + _10e + "</div><div id=\"cometchat_base\"><div id=\"cometchat_hide\" onclick=\"jqcc.cometchat.hideBar();\"></div><span id=\"cometchat_optionsbutton\" class=\"cometchat_tab cometchat_optionsimages\"></span><div id=\"cometchat_trayicons\">" + _10d + "</div><span id=\"cometchat_userstab\" class=\"cometchat_tab\"><span id=\"cometchat_userstab_icon\"></span><span id=\"cometchat_userstab_text\">" + _2[9] + " (" + _110 + ")</span></span><div id=\"cometchat_chatbox_right\"><span class=\"cometchat_tabtext\"></span><span style=\"top:-5px;display:none\" class=\"cometchat_tabalertlr\"></span></div><div id=\"cometchat_chatboxes\"><div id=\"cometchat_chatboxes_wide\"></div></div><div id=\"cometchat_chatbox_left\"><span class=\"cometchat_tabtext\"></span><span class=\"cometchat_tabalertlr\" style=\"top:-5px;display:none;\"></span></div></div><div id=\"cometchat_optionsbutton_popup\" class=\"cometchat_tabpopup\" style=\"display:none\"><div class=\"cometchat_userstabtitle\"><div class=\"cometchat_userstabtitletext\">" + _2[0] + "</div><div class=\"cometchat_minimizebox\"></div><br clear=\"all\"/></div><div class=\"cometchat_tabsubtitle\">" + _2[1] + "</div><div class=\"cometchat_tabcontent cometchat_optionstyle\"><strong>" + _2[2] + "</strong><br/><textarea class=\"cometchat_statustextarea\"></textarea><br/><input type=\"button\" class=\"cometchat_statusbutton\" value=\"" + _2[22] + "\"><br/><div class=\"cometchat_statusinputs\"><strong>" + _2[23] + "</strong><br/><span class=\"cometchat_user_available\"></span><span class=\"cometchat_optionsstatus available\">" + _2[3] + "</span><span class=\"cometchat_optionsstatus2 cometchat_user_invisible\" ></span><span class=\"cometchat_optionsstatus invisible\">" + _2[5] + "</span><div style=\"clear:both\"></div><span class=\"cometchat_optionsstatus2 cometchat_user_busy\"></span><span class=\"cometchat_optionsstatus busy\">" + _2[4] + "</span><span class=\"cometchat_optionsstatus2 cometchat_user_invisible\"></span><span class=\"cometchat_optionsstatus cometchat_gooffline\">" + _2[11] + "</span><br clear=\"all\"/></div><div style=\"border-top:1px solid #eeeeee;margin-top:10px;padding-top:4px;\"><div><input type=\"checkbox\" id=\"cometchat_soundnotifications\" style=\"vertical-align: -2px;\">" + _2[13] + "</div><div><input type=\"checkbox\" id=\"cometchat_popupnotifications\" style=\"vertical-align: -2px;\">" + _2[24] + "</div></div><div class=\"cometchat_hidebartext\"><div><a href=\"javascript:void(0);\" id=\"cometchat_hidebar\">" + _2[25] + "</a></div></div></div></div><div id=\"cometchat_userstab_popup\" class=\"cometchat_tabpopup\" style=\"display:none\"><div class=\"cometchat_userstabtitle\"><div class=\"cometchat_userstabtitletext\">" + _2[9] + "</div><div class=\"cometchat_minimizebox\"></div><br clear=\"all\"/></div><div class=\"cometchat_tabsubtitle\" id=\"cometchat_searchbar\"><input type=\"text\" name=\"cometchat_search\" class=\"cometchat_search cometchat_search_light\" id=\"cometchat_search\" value=\"" + _2[18] + "\"></div><div class=\"cometchat_tabcontent cometchat_tabstyle\"><div id=\"cometchat_userscontent\"><div id=\"cometchat_userslist_available\"></div><div id=\"cometchat_userslist_busy\"></div><div id=\"cometchat_userslist_away\"></div><div id=\"cometchat_userslist_offline\"></div></div></div></div>";
            document.getElementById("cometchat").innerHTML = _112;
            _79();
            _b7();
            $("#cometchat_chatboxes").attr("unselectable", "on").css("MozUserSelect", "none").bind("selectstart.ui", function () {
                return false;
            });
            $("#cometchat_userscontent").attr("unselectable", "on").css("MozUserSelect", "none").bind("selectstart.ui", function () {
                return false;
            });
            $("#cometchat_hidebar").click(function () {
                _76();
                $("#cometchat").css("display", "none");
                $("#cometchat_hidden").css("display", "block");
                $.cookie(_a + "hidebar", "1", {
                    path: "/",
                    expires: 365
                });
            });
            $("#cometchat_hidden").click(function () {
                $("#cometchat").css("display", "block");
                $("#cometchat_hidden").css("display", "none");
                $.cookie(_a + "hidebar", "0", {
                    path: "/",
                    expires: 365
                });
                if (_29 == 0) {
                    clearTimeout(_2d);
                    _6b();
                }
            });
            $("#cometchat_hidden").mouseover(function () {
                if (_49 == 0) {
                    _56("cometchat_hidden_content", _2[26], 0);
                }
                $(this).addClass("cometchat_tabmouseover");
            });
            $("#cometchat_hidden").mouseout(function () {
                $(this).removeClass("cometchat_tabmouseover");
                if (_49 == 0) {
                    $("#cometchat_tooltip").css("display", "none");
                }
            });
            $("#cometchat_hide").mouseover(function () {
                if (_49 == 0) {
                    _56("cometchat_hide", _2[27], 0);
                }
                $(this).addClass("cometchat_tabmouseover");
            });
            $("#cometchat_hide").mouseout(function () {
                $(this).removeClass("cometchat_tabmouseover");
                if (_49 == 0) {
                    $("#cometchat_tooltip").css("display", "none");
                }
            });
            $("#cometchat .cometchat_trayicon").mouseover(function () {
                var id = $(this).attr("id").substr(19);
                if (_49 == 0) {
                    _56("cometchat_trayicon_" + id, _3[id][1], 1);
                }
                $(this).addClass("cometchat_tabmouseover");
            });
            $("#cometchat .cometchat_trayicon").mouseout(function () {
                $(this).removeClass("cometchat_tabmouseover");
                if (_49 == 0) {
                    $("#cometchat_tooltip").css("display", "none");
                }
            });
            $("#cometchat .cometchat_traytitle").mouseenter(function () {
                var id = $(this).parent().attr("id");
                id = id.substring(19, id.length - 6);
                $("#cometchat_trayicon_" + id + "_popup .cometchat_traytitle .cometchat_minimizebox").addClass("cometchat_chatboxtraytitlemouseover");
            });
            $("#cometchat .cometchat_traytitle").mouseleave(function () {
                var id = $(this).parent().attr("id");
                id = id.substring(19, id.length - 6);
                $("#cometchat_trayicon_" + id + "_popup .cometchat_traytitle .cometchat_minimizebox").removeClass("cometchat_chatboxtraytitlemouseover");
            });
            $("#cometchat .cometchat_traytitle").click(function () {
                var id = $(this).parent().attr("id");
                id = id.substring(19, id.length - 6);
                $("#cometchat_trayicon_" + id).click();
            });
            $("#cometchat .cometchat_trayicon").click(function () {
                var id = $(this).attr("id").substr(19);
                _125(id, 0);
                if (_28 != "") {
                    $("#cometchat_user_" + _28 + "_popup").removeClass("cometchat_tabopen");
                    $("#cometchat_user_" + _28).removeClass("cometchat_tabclick").removeClass("cometchat_usertabclick");
                    $("#cometchat_user_" + _28 + " .cometchat_closebox_bottom").removeClass("cometchat_closebox_bottom_click");
                    _28 = "";
                    _78("openChatboxId", _28);
                }
                $("#cometchat_userstab_popup").removeClass("cometchat_tabopen");
                $("#cometchat_userstab").removeClass("cometchat_userstabclick").removeClass("cometchat_tabclick");
                $("#cometchat_optionsbutton_popup").removeClass("cometchat_tabopen");
                $("#cometchat_optionsbutton").removeClass("cometchat_tabclick");
                _78("buddylist", "0");
                var _113 = "_self";
                if (_3[id][3]) {
                    _113 = _3[id][3];
                }
                if (_113 == "_popup") {
                    if (_34 != id) {
                        $("#cometchat_trayicon_" + _34 + "_popup").removeClass("cometchat_tabopen");
                        $("#cometchat_trayicon_" + _34).removeClass("cometchat_trayclick");
                        _34 = "";
                        _78("trayOpen", _34);
                    }
                    if (_34 == "") {
                        $("#cometchat_trayicon_" + id + "_popup").css("left", $("#cometchat_trayicon_" + id).offset().left - 1).css("bottom", "24px").css("width", _3[id][4]);
                        if (ie6) {
                            $("#cometchat_trayicon_" + id + "_popup .cometchat_traytitle").css("width", parseInt(_3[id][4]) - 5);
                        }
                        $("#cometchat_trayicon_" + id + "_popup").addClass("cometchat_tabopen");
                        $("#cometchat_trayicon_" + id).addClass("cometchat_trayclick");
                        if ($("#cometchat_trayicon_" + id + "_iframe").attr("src") === undefined || $("#cometchat_trayicon_" + id + "_iframe").attr("src") == "blank.html" || $("#cometchat_trayicon_" + id + "_iframe").attr("src") == "") {
                            $("#cometchat_trayicon_" + id + "_iframe").attr("src", _3[id][2]);
                        }
                        _34 = id;
                        _78("trayOpen", _34);
                    } else {
                        $("#cometchat_trayicon_" + _34 + "_popup").removeClass("cometchat_tabopen");
                        $("#cometchat_trayicon_" + _34).removeClass("cometchat_trayclick");
                        _34 = "";
                        _78("trayOpen", _34);
                    }
                    if (ie6) {
                        _5c();
                    }
                } else {
                    window.open(_3[id][2], _113);
                }
            });
            $("#cometchat_chatbox_right").bind("click", _cf);
            $("#cometchat_chatbox_left").bind("click", _cd);
            _bd();
            _c7();
            $("#cometchat_chatbox_right").mouseover(function () {
                $(this).addClass("cometchat_chatbox_lr_mouseover");
            });
            $("#cometchat_chatbox_right").mouseout(function () {
                $(this).removeClass("cometchat_chatbox_lr_mouseover");
            });
            $("#cometchat_chatbox_left").mouseover(function () {
                $(this).addClass("cometchat_chatbox_lr_mouseover");
            });
            $("#cometchat_chatbox_left").mouseout(function () {
                $(this).removeClass("cometchat_chatbox_lr_mouseover");
            });
            $(window).bind("resize", _bd);
            _d3("buddylist", "1");
            _d3("initialize", "1");
            _d3("currenttime", _42);
            var _114 = 1;
            if (typeof document.body.style.maxHeight === "undefined") {
                if (_1f) {
                    $("#cometchat").css("display", "none");
                    _114 = 0;
                } else {
                    ie6 = true;
                    _5c();
                    $(window).bind("scroll", function () {
                        _5c();
                    });
                }
            } else {
                if (_4c) {
                    if (_20) {
                        $("#cometchat").css("display", "none");
                        _114 = 0;
                    } else {
                        ie6 = true;
                        _5c();
                        $(window).bind("scroll", function () {
                            _5c();
                        });
                    }
                }
            }
            document.onmousemove = function (e) {
                var _115 = new Date();
                _46 = Math.floor(_115.getTime() / 1000);
            };
            if (_23 == 1) {
                _116();
            }
            if ($.cookie(_a + "hidebar") == "1") {
                $("#cometchat").css("display", "none");
                $("#cometchat_hidden").css("display", "block");
                _114 = 0;
            }
            if (_114) {
                _6b();
            }
        };

        function _117() {
            if (_29 == 0) {
                var _118 = $.cookie(_a + "state");
                _d7("updatingsession", "1");
                if (_118 != null) {
                    var _119 = _118.split(/:/);
                    if (_2a == 0) {
                        var _11a = 0;
                        if (_119[0] != " " && _119[0] != "") {
                            _11a = _119[0];
                        }
                        if ((_11a == 0 && $("#cometchat_userstab").hasClass("cometchat_tabclick")) || (_11a == 1 && !($("#cometchat_userstab").hasClass("cometchat_tabclick")))) {
                            $("#cometchat_userstab").click();
                        }
                        _11a = "";
                        if (_119[1] != " " && _119[1] != "") {
                            _11a = _119[1];
                        }
                        if (_11a != _de("activeChatboxes")) {
                            var _11b = {};
                            var _11c = {};
                            if (_11a != "") {
                                var _11d = _11a.split(/,/);
                                for (i = 0; i < _11d.length; i++) {
                                    var _11e = _11d[i].split(/\|/);
                                    _11b[_11e[0]] = _11e[1];
                                }
                            }
                            if (_de("activeChatboxes") != "") {
                                var _11d = _de("activeChatboxes").split(/,/);
                                for (i = 0; i < _11d.length; i++) {
                                    var _11e = _11d[i].split(/\|/);
                                    _11c[_11e[0]] = _11e[1];
                                }
                            }
                            for (r in _11b) {
                                if (_11b.hasOwnProperty(r)) {
                                    _b3(r, parseInt(_11b[r]), 0);
                                    if (parseInt(_11b[r]) > 0) {
                                        _36 = 1;
                                    }
                                }
                            }
                            for (y in _11c) {
                                if (_11c.hasOwnProperty(y)) {
                                    if (_11b[y] == null) {
                                        $("#cometchat_user_" + y + "_popup .cometchat_tabtitle .cometchat_closebox").click();
                                    }
                                }
                            }
                        }
                        if (_36 > 0) {
                            if (document.title == _2[15]) {
                                document.title = _35;
                            } else {
                                document.title = _2[15];
                            }
                        } else {
                            var _11f = new Date();
                            var _120 = Math.floor(_11f.getTime() / 1000) - _46;
                            if (_120 < 5) {
                                document.title = _35;
                            }
                        }
                        _11a = 0;
                        if (_119[2] != " " && _119[2] != "") {
                            _11a = _119[2];
                        }
                        if (_11a != _28) {
                            if (_28 != "") {
                                _ef(_28);
                            }
                            if (_11a != "") {
                                _ef(_11a);
                            }
                        }
                        if (_119[4] == 1) {
                            _76(1);
                        }
                    }
                    if (_119[4] == 0 && _2a == 1) {
                        _2a = 0;
                        $("#cometchat_userstab_text").html(_2[9] + " (" + _33 + ")");
                        _6b();
                        _71();
                        $("#cometchat_userstab_icon").addClass("cometchat_user_available2");
                        $("#cometchat_optionsbutton_popup .available").css("text-decoration", "underline");
                    }
                    if (_119[5] != " " && _119[5] != "" && _119[5] != _34 && _11 == 1) {
                        $("#cometchat_trayicon_" + _119[5]).click();
                    }
                }
                _d7("updatingsession", "0");
                clearTimeout(_2e);
                _2e = setTimeout(function () {
                    _117();
                }, 4000);
            }
        };
        var _121 = {};

        function _5c() {
            var _122 = ["cometchat_base", "cometchat_userstab_popup", "cometchat_optionsbutton_popup", "cometchat_tooltip", "cometchat_hidden"];
            if (_28 != "") {
                _122.push("cometchat_user_" + _28 + "_popup");
            }
            if (_34 != "" && _34 != 0) {
                _122.push("cometchat_trayicon_" + _34 + "_popup");
            }
            for (x in _122) {
                $("#" + _122[x]).css("position", "absolute");
                var _123 = parseInt($("#" + _122[x]).css("bottom"));
                if (x == 0) {
                    _123 = 0;
                }
                var _124 = parseInt($("#" + _122[x]).height());
                if (_121[_122[x]] && x != 3) {
                    _124 = _121[_122[x]];
                } else {
                    _121[_122[x]] = _124;
                }
                if (x == 3) {
                    _123 = 30;
                }
                $("#" + _122[x]).css("top", (parseInt($(window).height()) - _123 - _124 + parseInt($(window).scrollTop())) + "px");
            }
        };

        function _125(id, _126) {
            if (!$("#cometchat_trayicon_" + id + "_popup").hasClass("cometchat_tabopen")) {
                $("#cometchat_trayicon_" + id + " .cometchat_tabalert").remove();
                if (_126 != 0) {
                    $("<div/>").css("top", "-30px").css("left", "10px").css("position", "relative").addClass("cometchat_tabalert").html(_126).appendTo($("#cometchat_trayicon_" + id));
                }
            }
        };

        function _127(_128, self) {
            if (_21) {
                if (self == null || self == "") {
                    return "<table class=\"cometchat_iphone\" cellpadding=0 cellspacing=0 style=\"float:right\"><tr><td class=\"cometchat_tl\"></td><td class=\"cometchat_tc\"></td><td class=\"cometchat_tr\"></td></tr><tr><td class=\"cometchat_cl\"></td><td class=\"cometchat_cc\">" + _128 + "</td><td class=\"cometchat_cr\"></td></tr><tr><td class=\"cometchat_bl\"></td><td class=\"cometchat_bc\"></td><td class=\"cometchat_br\"></td></tr></table><div style=\"clear:both\"></div>";
                } else {
                    return "<table class=\"cometchat_iphone\" cellpadding=0 cellspacing=0><tr><td class=\"cometchat_xtl\"></td><td class=\"cometchat_xtc\"></td><td class=\"cometchat_xtr\"></td></tr><tr><td class=\"cometchat_xcl\"></td><td class=\"cometchat_xcc\">" + _128 + "</td><td class=\"cometchat_xcr\"></td></tr><tr><td class=\"cometchat_xbl\"></td><td class=\"cometchat_xbc\"></td><td class=\"cometchat_xbr\"></td></tr></table><div style=\"clear:both\"></div>";
                }
            }
            return _128;
        };

        function _129() {
            if (_22 == 1 && $.cookie(_a + "loggedin") != 1) {
                $.post(_1 + "cometchat_check.php", {}, function (data) {
                    if (data == 1) {
                        $.cookie(_a + "loggedin", "1", {
                            path: "/"
                        });
                        _10c();
                    }
                });
            } else {
                _10c();
            }
        };

        function _116() {
            $("embed").each(function (i) {
                if ($(this).attr("id") != "cometchatbeep") {
                    var _12a = this.cloneNode(true);
                    _12a.setAttribute("WMode", "Transparent");
                    $(this).before(_12a);
                    $(this).remove();
                }
            });
            $("object").each(function (i, v) {
                if ($(this).attr("id") != "cometchatbeep") {
                    var _12b = $(this).children("embed");
                    if (typeof(_12b.get(0)) != "undefined") {
                        if (typeof(_12b.get(0).outerHTML) != "undefined") {
                            _12b.attr("wmode", "transparent");
                            $(this.outerHTML).insertAfter(this);
                            $(this).remove();
                        }
                        return true;
                    }
                    var algo = this.attributes;
                    var _12c = "<OBJECT ";
                    for (var i = 0; i < algo.length; i++) {
                        _12c += algo[i].name + "=\"" + algo[i].value + "\" ";
                    }
                    _12c += ">";
                    var flag = false;
                    $(this).children().each(function (elem) {
                        if (this.nodeName == "PARAM") {
                            if (this.name == "wmode") {
                                flag = true;
                                _12c += "<PARAM NAME=\"" + this.name + "\" VALUE=\"transparent\">";
                            } else {
                                _12c += "<PARAM NAME=\"" + this.name + "\" VALUE=\"" + this.value + "\">";
                            }
                        }
                    });
                    if (!flag) {
                        _12c += "<PARAM NAME=\"wmode\" VALUE=\"transparent\">";
                    }
                    _12c += "</OBJECT>";
                    $(_12c).insertAfter(this);
                    $(this).remove();
                }
            });
        };
        arguments.callee.c5 = function () {
            _10b();
            _129();
            return;
        };
        arguments.callee.c6 = function () {
            _129();
            return;
        };
        arguments.callee.getActiveId = function () {
            return _28;
        };
        arguments.callee.getUser = function (id, _12d) {
            $.ajax({
                url: _1 + "cometchat_getid.php",
                data: {
                    userid: id
                },
                type: "post",
                cache: false,
                dataFilter: function (data) {
                    if (typeof(JSON) !== "undefined" && typeof(JSON.parse) === "function") {
                        return JSON.parse(data);
                    } else {
                        return eval("(" + data + ")");
                    }
                },
                success: function (data) {
                    if (data) {
                        window[_12d](data);
                    } else {
                        window[_12d](0);
                    }
                }
            });
        };
        arguments.callee.ping = function () {
            return 1;
        };
        arguments.callee.chatWith = function (id) {
            if (_29 == 0) {
                if (_2a == 1) {
                    _2a = 0;
                    $("#cometchat_userstab_text").html(_2[9] + " (" + _33 + ")");
                    _6b();
                    $("#cometchat_optionsbutton_popup .available").click();
                }
                _86(id, _37[id], _39[id], _38[id], _3a[id], _3b[id]);
            }
        };
        arguments.callee.launchModule = function (id) {
            if (!$("#cometchat_trayicon_" + id + "_popup").hasClass("cometchat_tabopen")) {
                $("#cometchat_trayicon_" + id).click();
            }
        };
        arguments.callee.toggleModule = function (id) {
            $("#cometchat_trayicon_" + id).click();
        };
        arguments.callee.closeModule = function (id) {
            if ($("#cometchat_trayicon_" + id + "_popup").hasClass("cometchat_tabopen")) {
                $("#cometchat_trayicon_" + id).click();
            }
        };
        arguments.callee.joinChatroom = function (_12e, _12f, _130) {
            $("#cometchat_trayicon_chatrooms_iframe").attr("src", _1 + "modules/chatrooms/index.php?roomid=" + _12e + "&inviteid=" + _12f + "&roomname=" + _130);
            $("#cometchat_trayicon_chatrooms").click();
        };
        arguments.callee.sendMessage = function (id, _131) {
            if (_131 != "") {
                $.post(_1 + "cometchat_send.php", {
                	aid: _aid,
                    to: id,
                    message: _131
                }, function (data) {
                    if (data) {
                        _e5(id, _131, 1, 1, data, 1, 1);
                        $("#cometchat_tabcontenttext_" + id).scrollTop(50000);
                        setTimeout(function () {
                            $("#cometchat_tabcontenttext_" + id).scrollTop(50000);
                        }, 100);
                    }
                    _30 = 1;
                    if (_2f > _8) {
                        _2f = _8;
                        clearTimeout(_2d);
                        _2d = setTimeout(function () {
                            _6b();
                        }, _8);
                    }
                });
            }
        };
        arguments.callee.hideBar = function () {
            $("#cometchat_hidebar").click();
        };
        arguments.callee.getBaseUrl = function () {
            return _1;
        };
        arguments.callee.setAlert = function (id, _132) {
            _125(id, _132);
        };
        arguments.callee.closeTooltip = function () {
            $("#cometchat_tooltip").css("display", "none");
        };
        arguments.callee.scrollToTop = function () {
            $("html,body").animate({
                scrollTop: 0
            }, {
                "duration": "slow"
            });
        };
        arguments.callee.reinitialize = function () {
            if (_29 == 1) {
                $("#cometchat_optionsbutton").removeClass("cometchat_optionsimages_exclamation");
                $("#cometchat_userstab").show();
                $("#cometchat_chatboxes").show();
                $("#cometchat_chatbox_left").show();
                $("#cometchat_chatbox_right").show();
                _29 = 0;
                _d3("initialize", "1");
                _6b();
            }
        };
    };
    $.expr[":"].icontains = function (a, i, m) {
        return (a.textContent || a.innerText || "").toLowerCase().indexOf(m[3].toLowerCase()) >= 0;
    };

    function _133(el, html) {
        var _134 = typeof el === "string" ? document.getElementById(el) : el;
        var _135 = _134.cloneNode(false);
        _135.innerHTML = html;
        _134.parentNode.replaceChild(_135, _134);
        return _135;
    };
})(jqcc);
jqcc(document).ready(function () {
    jqcc.cometchat();
    jqcc.cometchat. <?php echo $jsfn; ?> ();
});