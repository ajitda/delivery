$(window).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        // beforeSend: function(xhr, settings) {
        // 	if ( settings.url.match(/^https:\/\/(beta.|dev.)*peopletail.com/ig) ) {
        // 		xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
        // 	}
        // 	if ( $(settings.context).hasClass('ajax-on-el') ) {
        // 		settings.cancel = true;
        // 		return false;
        // 	}
        // 	$(settings.context).addClass('ajax-on-el');
        // }
    });
    $(document).ajaxStart(function() {
        $('body').addClass('ajax-on');
    }).ajaxStop(function() {
        $('body').removeClass('ajax-on');
    }).ajaxSuccess(function(e, request, settings, data) {
        console.log(data);
        // if ( ! settings.url.match(/^https:\/\/(beta.|dev.)*peopletail.com/ig) ) {
        // 	// do nothing
        // } else
        if ( data.redirect ) {
            window.location = data.redirect;
        } else {
            var target = $(settings.context);
//			var supportedOps = [ 'replaceWith', 'append', 'prepend', 'fadeOut' ];
            $.each(data,function(i,d){
//				if ( ! supportedOps.includes(i) ) return;
                if ( ! Object.keys($.fn).includes(i) ) return;
                $.each(d,function(j,k) { $(j)[i](k); });
            });
//			$.each(data.replaceWith,function(i,d) { $(i).replaceWith(d); });
//			$.each(data.append,function(i,d){
//				$.each(d,function(j,l) { $(i).append(l); });
//			});
            if ( target.attr('data-ajax-event') ) {
                $(document).trigger(target.attr('data-ajax-event'),data);
            } else {
                target.trigger('done',data);
            }
            $.each(data.notify,function(i,d) { $.notify({ message: d },{ type: i }); });
            $(settings.context).removeClass('ajax-on-el');
            if( data.reload) {
                window.location.reload();
            }
        }
    }).ajaxError(function(e, jqXHR, settings, thrownError) {
        if ( settings.cancel ) return true;  // canceled by beforeSend

        var data;
        try {
            data = JSON.parse(jqXHR.responseText);
            console.log(data);
        } catch(e) {
            // do nothing
            data = false;
        }
        if ( data && data.errors ) { // && jqXHR.status == 422 ) {
            $.each(data.errors,function(i,d) { $.notify({ message: d},{ type: 'danger' }) });
        } else {
            $.notify({ message: 'System error encountered.  Please try again later' }, { type: 'danger' });
        }
        $(settings.context).removeClass('ajax-on-el');
    });

    // infinite scroll
//	if ( typeof jQuery.fn.infiniteScroll != 'undefined' ) {
//		$('.scroll-pagination > .container-wide').infiniteScroll({
//			path: '.pagination > a',
//			append: '.section-recommendations .scroll-item',
//			history: false,
//			scrollThreshold: 100
//		}).on('request.infiniteScroll',function() {
//			$('body').addClass('ajax-on');
//		}).on('load.infiniteScroll',function() {
//			$('body').removeClass('ajax-on');
//		});
//	}
//
    // mobile menu
//        $('#close-mobile-menu').on('click', function(){
//		$('body').removeClass('sidebar-on');
//        });
//        $('#open-mobile-menu').on('click', function(){
//		$('body').addClass('sidebar-on');
//	});
    // searchbar
//	$('.search-navbar').each(function() {
//                $('.home-navbar__search').focusin(function() {
//                        $('.home-navbar__tags_search').addClass('home-navbar__tags_search--expanded');
//                });
//                $('.home-navbar__search').focusout(function() {
//                        if ( $('#header_search_element').val() == '' )
//                                $('.home-navbar__tags_search').removeClass('home-navbar__tags_search--expanded');
//                });
//	});

    // overlay click event
    $(document).on('click','[data-redirect!=""][data-redirect]',function(e) {
        e.stopPropagation();
        var url = $(e.currentTarget).attr('data-redirect');
        window.location.href = url;
    });
    // share click event
    $(document).on('click','[role="share"]',function(e) {
        e.stopPropagation();
        var el = $(e.currentTarget);
        $('.addthis_sharing-toolbox')
            .attr('data-url',el.attr('data-url'))
            .attr('data-title',el.attr('data-title'));
        $('#share-modal').modal();
    });
    // click class
    $(document).on('click','[data-toggle-class!=""][data-toggle-class]',function(e) {
        e.stopPropagation();
        var target = $(e.currentTarget);
        var cl = target.attr('data-toggle-class');
        if ( target.hasClass('disabled') ) {
            return ;
        }
        if ( target.attr('data-toggle-target') ) {
            target = $(target.attr('data-toggle-target'));
        }
        target.toggleClass(cl);
    });

    // ajax get supports
    $(document).on('click','[data-ajax-url!=""][data-ajax-url]',function(e) {
        e.stopPropagation();
        if ($(e.currentTarget).attr('data-replace-empty')) {
            var emptyId = $(e.currentTarget).attr('data-replace-empty');
            $(emptyId).empty().html("<h2 style='text-align:center;padding:20px;'>Loading</h2>");
        }
        var url = $(e.currentTarget).attr('data-ajax-url');
        var method = $(e.currentTarget).attr('data-ajax-method') || 'GET' ;
        $.ajax({
            url: url,
            context: this,
            method: method
        });
    });
    // general form handler
    $(document).on('submit',function(e) {
        var that = $(e.target);

        // missing validation

        // disable form submission
        if ( that.attr('data-no-submit') !== undefined ) {
            e.stopPropagation();
            e.preventDefault();
            return false;
        } else if ( that.attr('data-no-ajax') !== undefined ) {
            return true;
        }
        e.stopPropagation();
        e.preventDefault();

        var method = that.attr('method') || 'GET';
        var action = that.attr('action');
        var dataSend = null;
        if ( method == 'GET' ) {
            action += '?' + that.serialize();
        } else {
            dataSend = new FormData(e.target);
        }
        $.ajax({
            url: action,
            method: method,
            dataType: 'JSON',
            data: dataSend, //new FormData(e.target),
            contentType: false,
            cache: false,
            processData: false,
            context: e.target,
        });
        return false;
    });

    $(document).on('click','[data-videojs]',function(e) {
        var container = $(this).closest('.video');
        container.addClass('video-on');
        var player = videojs(container.find('video').get(0));
        player.play();
    });

// Don't close if opened profile dropdown
    $(document).on('click','.dropdown-menu',function (e) {
        e.stopPropagation();
    });
// Notification close button mobile
    $('.close_notification_mobile_feed').click(function(){
        $('.profile_notification_block .dropdown-menu').removeClass("show");
    });
//	$('.slider').slick({
//		dots: true,
//		arrows:false
//	});
    $('.notification_block a[data-toggle="tab"], #tabs-nav a[data-toggle="tab"]').on('shown.bs.tab',function(e) {
        var that = $(e.target);
        var ids = $.map($(that.attr('data-target') + ' .unread[data-id]'), function(val, i) {
            return $(val).attr('data-id');
        });
        that.removeClass('marked');
        if ( ids.length ) {
            $.ajax({
                url: that.attr('data-url'),
                context: this,
                method: 'POST',
                data: { 'id': ids }
            });
        }
    });
});


/* global functions */

//function logout(event) {
//	event.preventDefault();
//	document.getElementById('logout-form').submit();
//}

// Copy to clickboard
function copyClick(that) {
    var p = $(that).parents('.control-copy');
    p.find('input').get(0).select();
    document.execCommand("copy");
    p.addClass('copied');
    return false;
}
function copyOut(that) {
    $(that).parent().removeClass('copied');
}
//
//
function formValidate(form) {
    var valid = true;
    $('input',form).each(function(idx,el) {
        valid = valid && el.reportValidity();
    });
    $('[data-validate-required]').each(function(idx,el) {
        var stat = $($(el).attr('data-validate-required'),form).length > 0 ;
        if ( !stat ) {
            $(el).addClass('error');
        } else {
            $(el).removeClass('error');
        }
        valid = valid && stat;
    });
    return valid;
}

$.progress = function(percent) {
    percent = Math.max(5,percent);
    if ( percent == 100 ) {
        $('#progressbar-recommendation .loading-progress').removeAttr('style');
    } else {
        $('#progressbar-recommendation .loading-progress').css('width',percent+'%');
    }
};
//$.fn.extend( {
//	uniqueId: ( function() {
//		var uuid = 0;
//
//		return function() {
//			return this.each( function() {
//				if ( !this.id ) {
//					this.id = "ui-id-" + ( ++uuid );
//				}
//			} );
//		};
//	} )(),
//
//	removeUniqueId: function() {
//		return this.each( function() {
//			if ( /^ui-id-\d+$/.test( this.id ) ) {
//				$( this ).removeAttr( "id" );
//			}
//		} );
//	}
//} );


function onclickTextChange(id, value)
{
    $("#"+id).text(value);
}

// function onclickHide(id, option=''){
// 	if (option == 'toggle') {
// 		$("#"+id).toggle();
// 	} else{
// 		$("#"+id).hide();
// 	}
// }



