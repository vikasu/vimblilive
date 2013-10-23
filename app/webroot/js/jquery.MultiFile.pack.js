/*
 ### jQuery Multiple File Upload Plugin v1.47 - 2010-03-26 ###
 * Home: http://www.fyneworks.com/jquery/multiple-file-upload/
 * Code: http://code.google.com/p/jquery-multifile-plugin/
 *
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 ###
*/
;
if (window.jQuery)(function ($) {
    $.fn.MultiFile = function (h) {
        if (this.length == 0) return this;
        if (typeof arguments[0] == 'string') {
            if (this.length > 1) {
                var i = arguments;
                return this.each(function () {
                    $.fn.MultiFile.apply($(this), i)
                })
            };
            $.fn.MultiFile[arguments[0]].apply(this, $.makeArray(arguments).slice(1) || []);
            return this
        };
        var h = $.extend({}, $.fn.MultiFile.options, h || {});
        $('form').not('MultiFile-intercepted').addClass('MultiFile-intercepted').submit($.fn.MultiFile.disableEmpty);
        if ($.fn.MultiFile.options.autoIntercept) {
            $.fn.MultiFile.intercept($.fn.MultiFile.options.autoIntercept);
            $.fn.MultiFile.options.autoIntercept = null
        };
        this.not('.MultiFile-applied').addClass('MultiFile-applied').each(function () {
            window.MultiFile = (window.MultiFile || 0) + 1;
            var e = window.MultiFile;
            var g = {
                e: this,
                E: $(this),
                clone: $(this).clone()
            };
            if (typeof h == 'number') h = {
                max: h
            };
            var o = $.extend({}, $.fn.MultiFile.options, h || {}, ($.metadata ? g.E.metadata() : ($.meta ? g.E.data() : null)) || {}, {});
            if (!(o.max > 0)) {
                o.max = g.E.attr('maxlength');
                if (!(o.max > 0)) {
                    o.max = (String(g.e.className.match(/\b(max|limit)\-([0-9]+)\b/gi) || ['']).match(/[0-9]+/gi) || [''])[0];
                    if (!(o.max > 0)) o.max = -1;
                    else o.max = String(o.max).match(/[0-9]+/gi)[0]
                }
            };
            o.max = new Number(o.max);
            o.accept = o.accept || g.E.attr('accept') || '';
            if (!o.accept) {
                o.accept = (g.e.className.match(/\b(accept\-[\w\|]+)\b/gi)) || '';
                o.accept = new String(o.accept).replace(/^(accept|ext)\-/i, '')
            };
            $.extend(g, o || {});
            g.STRING = $.extend({}, $.fn.MultiFile.options.STRING, g.STRING);
            $.extend(g, {
                n: 0,
                slaves: [],
                files: [],
                instanceKey: g.e.id || 'MultiFile' + String(e),
                generateID: function (z) {
                    return g.instanceKey + (z > 0 ? '_F' + String(z) : '')
                },
                trigger: function (a, b) {
                    var c = g[a],
                        value = $(b).attr('value');
                    if (c) {
                        var d = c(b, value, g);
                        if (d != null) return d
                    }
                    return true
                }
            });
            if (String(g.accept).length > 1) {
                g.accept = g.accept.replace(/\W+/g, '|').replace(/^\W|\W$/g, '');
                g.rxAccept = new RegExp('\\.(' + (g.accept ? g.accept : '') + ')$', 'gi')
            };
            g.wrapID = g.instanceKey + '_wrap';
            g.E.wrap('<div class="MultiFile-wrap" id="' + g.wrapID + '"></div>');
            g.wrapper = $('#' + g.wrapID + '');
            g.e.name = g.e.name || 'file' + e + '[]';
            if (!g.list) {
                g.wrapper.append('<div class="MultiFile-list" id="' + g.wrapID + '_list"></div>');
                g.list = $('#' + g.wrapID + '_list')
            };
            g.list = $(g.list);
            g.addSlave = function (c, d) {
                g.n++;
                c.MultiFile = g;
                if (d > 0) c.id = c.name = '';
                if (d > 0) c.id = g.generateID(d);
                c.name = String(g.namePattern.replace(/\$name/gi, $(g.clone).attr('name')).replace(/\$id/gi, $(g.clone).attr('id')).replace(/\$g/gi, e).replace(/\$i/gi, d));
                if ((g.max > 0) && ((g.n - 1) > (g.max))) c.disabled = true;
                g.current = g.slaves[d] = c;
                c = $(c);
                c.val('').attr('value', '')[0].value = '';
                c.addClass('MultiFile-applied');
                c.change(function () {
                    $(this).blur();
                    if (!g.trigger('onFileSelect', this, g)) return false;
                    var a = '',
                        v = String(this.value || '');
                    if (g.accept && v && !v.match(g.rxAccept)) a = g.STRING.denied.replace('$ext', String(v.match(/\.\w{1,4}$/gi)));
                    for (var f in g.slaves) if (g.slaves[f] && g.slaves[f] != this) if (g.slaves[f].value == v) a = g.STRING.duplicate.replace('$file', v.match(/[^\/\\]+$/gi));
                    var b = $(g.clone).clone();
                    b.addClass('MultiFile');
                    if (a != '') {
                        g.error(a);
                        g.n--;
                        g.addSlave(b[0], d);
                        c.parent().prepend(b);
                        c.remove();
                        return false
                    };
                    $(this).css({
                        position: 'absolute',
                        top: '-3000px'
                    });
                    c.after(b);
                    g.addToList(this, d);
                    g.addSlave(b[0], d + 1);
                    if (!g.trigger('afterFileSelect', this, g)) return false
                });
                $(c).data('MultiFile', g)
            };
            g.addToList = function (c, d) { 
                if (!g.trigger('onFileAppend', c, g)) return false;
                var r = $('<div class="MultiFile-label"></div>'), 
                    v = String(c.value || ''), 
                    a = $('<span class="MultiFile-title" title="' + g.STRING.selected.replace('$file', v) + '">' + g.STRING.file.replace('$file', v.match(/[^\/\\]+$/gi)[0]) + '</span>'), 
                    b = $('<a class="MultiFile-remove" href="#' + g.wrapID + '">' + g.STRING.remove + '</a>'); //alert(/^.+\.([^.]+)$/.exec(v));
                    //var nonocrstring = $('non-ocr format');

/* CUSTOM 20111105 */                    
                   var ocrext = /^.+\.([^.]+)$/.exec(v);  
                   if(ocrext[1]=='jpg' || ocrext[1]=='jpeg' || ocrext[1]=='png' || ocrext[1]=='tif' || ocrext[1]=='tiff' || ocrext[1]=='gif' || ocrext[1]=='bmp')
                    {
                        g.list.append(r.append(b, ' ', a));
                    }else{
                            g.list.append(r.append(b, ' ', a,' <b>[OCR unreadable]</b> '));
                    }
/* */                       
                    
                //g.list.append(r.append(b, ' ', a));
                b.click(function () {
                    if (!g.trigger('onFileRemove', c, g)) return false;
                    g.n--;
                    g.current.disabled = false;
                    g.slaves[d] = null;
                    $(c).remove();
                    $(this).parent().remove();
                    $(g.current).css({
                        position: '',
                        top: ''
                    });
                    $(g.current).reset().val('').attr('value', '')[0].value = '';
                    if (!g.trigger('afterFileRemove', c, g)) return false;
                    return false
                });
                if (!g.trigger('afterFileAppend', c, g)) return false
            };
            if (!g.MultiFile) g.addSlave(g.e, 0);
            g.n++;
            g.E.data('MultiFile', g)
        })
    };
    $.extend($.fn.MultiFile, {
        reset: function () {
            var a = $(this).data('MultiFile');
            if (a) a.list.find('a.MultiFile-remove').click();
            return $(this)
        },
        disableEmpty: function (a) {
            a = (typeof (a) == 'string' ? a : '') || 'mfD';
            var o = [];
            $('input:file.MultiFile').each(function () {
                if ($(this).val() == '') o[o.length] = this
            });
            return $(o).each(function () {
                this.disabled = true
            }).addClass(a)
        },
        reEnableEmpty: function (a) {
            a = (typeof (a) == 'string' ? a : '') || 'mfD';
            return $('input:file.' + a).removeClass(a).each(function () {
                this.disabled = false
            })
        },
        intercepted: {},
        intercept: function (b, c, d) {
            var e, value;
            d = d || [];
            if (d.constructor.toString().indexOf("Array") < 0) d = [d];
            if (typeof (b) == 'function') {
                $.fn.MultiFile.disableEmpty();
                value = b.apply(c || window, d);
                setTimeout(function () {
                    $.fn.MultiFile.reEnableEmpty()
                }, 1000);
                return value
            };
            if (b.constructor.toString().indexOf("Array") < 0) b = [b];
            for (var i = 0; i < b.length; i++) {
                e = b[i] + '';
                if (e)(function (a) {
                    $.fn.MultiFile.intercepted[a] = $.fn[a] ||
                    function () {};
                    $.fn[a] = function () {
                        $.fn.MultiFile.disableEmpty();
                        value = $.fn.MultiFile.intercepted[a].apply(this, arguments);
                        setTimeout(function () {
                            $.fn.MultiFile.reEnableEmpty()
                        }, 1000);
                        return value
                    }
                })(e)
            }
        }
    });
    $.fn.MultiFile.options = {
        accept: '',
        max: -1,
        namePattern: '$name',
        STRING: {
            remove: 'x',
            denied: 'You cannot select a $ext file.\nTry again...',
            file: '$file',
            selected: 'File selected: $file',
            duplicate: 'This file has already been selected:\n$file'
        },
        autoIntercept: ['submit', 'ajaxSubmit', 'ajaxForm', 'validate', 'valid'],
        error: function (s) {
            alert(s)
        }
    };
    $.fn.reset = function () {
        return this.each(function () {
            try {
                this.reset()
            } catch (e) {}
        })
    };
    $(function () {
        $("input[type=file].multi").MultiFile()
    })
})(jQuery);