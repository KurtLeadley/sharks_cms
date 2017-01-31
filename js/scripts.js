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
		forced_root_block_attrs: { "style": "margin: 0;" },
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
	var comment = tinyMCE.get('comment').getContent();
	var userName = document.getElementById("userName").value;
	var time = document.getElementById("time").value;
  console.log(time);
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
			console.log(time);
			var tinymce_editor_id = 'comment'; 
      tinymce.get(tinymce_editor_id).setContent('');
      document.getElementById("title").value="";
      $('#allComments').append('<div class="comments"><table class="commentsTable"><tr class="trTitle"><td colspan="2">' + title + '</td></tr><tr><td colspan="2">' + 
			  comment + '</td></tr><tr><td class="trUser">Posted by: ' + userName + '&nbsp;&nbsp;' + time + '&nbsp;&nbsp;&nbsp;&nbsp; rec (0)</td></tr></table></div>');
      }
    });
  }
  event.preventDefault();
  return false;
}
function recComment(event, commentID) {	

	var title = document.getElementById("title-" + commentID).value;
  var pageID = document.getElementById("pageID").value;
	var userID = document.getElementById("userID").value;
	var comment = document.getElementById('comment-' + commentID).value;
	var userName = document.getElementById('userName-' + commentID).value;
	var time = document.getElementById("time-" + commentID).value;
	var count = document.getElementById("count-" + commentID).value;
	
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
				count++;
				if (count > 1) {
					$('#' + commentID).addClass('comments_liked');
					console.log(commentID);
				}		
				$('#' + commentID).html(
				'<div class="divTable" id="divTableID">' +
				'<div class="divTableBody">' + 
				'<div class="divTableRow">' +
				'<div class="trTitle">' + title + '</div>' +
				'</div>' +
				'<div class="divTableRow">' +
				'<div class="divTableCell">' + comment + '</div>' +
				'</div>' +
				'<div class="divTableRow">' +
				'<div class="trUser">Posted by: ' + userName + '&nbsp;&nbsp;' + time + '&nbsp;&nbsp;&nbsp;&nbsp;' + ' unrec ('+ count +')</div>' +
				'</div>' +
				'</div>' +
				'</div>');
			}
    });	
	event.preventDefault();
  return false;
}


