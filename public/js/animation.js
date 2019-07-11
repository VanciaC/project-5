//smooth scrolling
$(function(){
	$("a").on('click', function(event) {
    if (this.hash !== "") {
      	event.preventDefault();
     	var hash = this.hash;
      	$('html, body').animate({
        	scrollTop: $(hash).offset().top
      	}, 500, function(){
        window.location.hash = hash;
      });
    }
  });
});

//Ajax request
$(document).ready(function(){
		$('.btn-delete-post').on('click', function(e){
				e.preventDefault();
				var $a = $(this);
				var url = $a.attr('href');
				ajaxGet(url, function(){
					$a.parents('.border_post').fadeOut();
				});
		});
});

$(document).ready(function(){
	$('.btn-delete-event').on('click', function(e){
			e.preventDefault();
			var $a = $(this);
			var url = $a.attr('href');
			ajaxGet(url, function(){
				$a.parents('.border_post').fadeOut();
			});
	});
});

$(document).ready(function(){
	$('.btn-comment-delete').on('click', function(e){
			e.preventDefault();
			var $a = $(this);
			var url = $a.attr('href');
			ajaxGet(url, function(){
				$a.parents('.border_comment').fadeOut();
			});
	});
});

$(document).ready(function(){
	$('.btn-comment-cancel').on('click', function(e){
			e.preventDefault();
			var $a = $(this);
			var url = $a.attr('href');
			ajaxGet(url, function(){
				$a.parents('.border_comment').fadeOut();
			});
	});
});

$(document).ready(function(){
	$('.btn-delete-comment-post').on('click', function(e){
			e.preventDefault();
			var $a = $(this);
			var url = $a.attr('href');
			ajaxGet(url, function(){
				$a.parents('.comment-bloc').fadeOut();
			});
	});
});

