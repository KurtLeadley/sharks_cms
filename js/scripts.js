$(document).ready(function () {
	$('#commentForm').validate({ // initialize the plugin
		rules: {
			title: {
					required: true,
			}
		}
	});
});

tinymce.init({
		selector: "textarea",
		theme: "modern",
		width: '100%',
		height: 50,
		plugins: [
				 "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
				 "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
				 "save table contextmenu directionality emoticons template paste textcolor",
				 "autoresize"
		],
		menubar:false,
		toolbar: " bold italic | bullist numlis | link image | media fullpage | emoticons", 
});
 
function postComment(event) {
	
  var title = document.getElementById("title").value;
  var pageID = document.getElementById("pageID").value;
	var userID = document.getElementById("userID").value;
	var comment = tinyMCE.get('comment').getContent()
	var userName = document.getElementById("userName").value;
	var time = document.getElementById("time").value;
  
	if(comment) {
    $.ajax
    ({
      type: 'POST',
      url: 'post_comment.php',
      data: 
      {
       user_title:title,
	     page_id:pageID,
			 user_id:userID,
			 user_comment:comment
      },
      success: function (response)
      {
			var tinymce_editor_id = 'comment'; 
      tinymce.get(tinymce_editor_id).setContent('');
      document.getElementById("title").value="";
      $('#allComments').append('<div class="comments"><table class="commentsTable"><tr class="trTitle"><td colspan="2">' + title + '</td></tr><tr><td colspan="2">' + 
			  comment + '</td></tr><tr><td class="trUser">Posted by ' + userName +' ' + time + '</td></tr></table></div>');
      }
    });
  }
  event.preventDefault();
  return false;
}
function recComment(event, commentID) {
  console.log(commentID);
	
	$.ajax
    ({
      type: 'POST',
      url: 'like_comment.php',
      data: 
      {
       comment_id:commentID,
      },
      success: function (response)
      {
				
      }
    });
	
	event.preventDefault();
  return false;
}
