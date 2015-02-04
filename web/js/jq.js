$(document).ready(function(){
    
                $('.like_button').click(function(e){
                    e.preventDefault();
                    
                    if ($(this).data('action') == 'likeon')
                        url = '/likes/create';
                    else
                        url = '/likes/delete';
                    
                    $.ajax({
                        type:'POST',
                        url: url,
                        data: {id: $(this).data('id'), type: $(this).data('type')},
                        dataType: "json",
                        success: function(response){
                            if (response.status == 'created'){
                                $('#'+response.modelid).data('action', 'likeoff');
                                $('#likes_view'+response.modelid).removeClass('glyphicon glyphicon-heart-empty');
                                $('#likes_view'+response.modelid).addClass('glyphicon glyphicon-heart').text('-'+response.likesCount);
                            }
                            if (response.status == 'deleted'){
                                $('#'+response.modelid).data('action', 'likeon');
                                $('#likes_view'+response.modelid).removeClass('glyphicon glyphicon-heart');
                                $('#likes_view'+response.modelid).addClass('glyphicon glyphicon-heart-empty').text('-'+response.likesCount);
                            }
                        }
                    });
                });
    
		$('.follow-button').click(function(e){
                    
                    e.preventDefault();
                    
                    if ($(this).data('action') == 'follow')
                        url = '/follower/create';
                    else
                        url = '/follower/delete';
                    
                    $.ajax({
                        type:'POST',
                        url: url,
                        data: {id: $('#user-info').data('id')},
                        dataType: "json",
                        success: function(response){
                            if (response.status == 'created')
                                $('.follow-button').data('action', 'unfollow').text('Відписатись');    
                            if (response.status == 'deleted')
                                $('.follow-button').data('action', 'follow').text('Підписатись');    
                        }
                    });
                });

		$('#zberezheno').click(function(){
			$('#zberezhenoq').hide(1000);
		});

		$('#contactView').click(function(){
			$('#shadow').show(1000);
			$('#contact').show(1000);
		});

		$('#shadow').click(function(){
			$('#shadow').hide(1000);
			$('#contact').hide(1000);
		});
		
		$('#zberezheno').click(function(){
			$('#zberezheno').hide(1000);
		});
		
		$("a[rel*='prettyPhoto']").prettyPhoto();
				
		$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:13000, autoplay_slideshow: true});
				//$(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});
		
				$("#custom_content a[rel^='prettyPhoto']:first").prettyPhoto({
					custom_markup: '<div id="map_canvas" style="width:260px; height:265px"></div>',
					changepicturecallback: function(){ initialize(); }
				});

				$("#custom_content a[rel^='prettyPhoto']:last").prettyPhoto({
					custom_markup: '<div id="bsap_1259344" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div><div id="bsap_1237859" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6" style="height:260px"></div><div id="bsap_1251710" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div>',
					changepicturecallback: function(){ _bsap.exec(); }
				}); 
		
		
		$('#disp').click(function(){
				if($('#disp').text() == "Відкрити"){
					$("#infoTwo").slideDown(500);
					$('#disp').text("Закрити");
				}else{
					$("#infoTwo").slideUp(500);
					$('#disp').text("Відкрити");
				}
			//
		});
              
        $('#newComment').focus(function(){
            $(this).attr('rows','3');
        });
        
        $('#newComment').focusout(function(){
            if( $(this).val() == "" ){
                $(this).attr('rows','1');
            }
            
        });
        
        $('#post-title').focus(function(){
                $('#newPostContent').show(1000);
                //$('#newPostContent').css('display','block');
		});

    $('#post-title').focus(function(){
        $('#newPostContent').show(1000);
        //$('#newPostContent').css('display','block');
    });

/*
    $('#CommentNew').on('beforeValidate', function (event, messages, deferreds, attribute) {
        if (attribute === undefined) {
            return submitComment($(this));
            // the event is triggered when submitting the form
        } else if (attribute.id === 'something') {
            // the event is triggered before validating "something"
        }
    }); */
/*
    $('#PostNew').on('beforeValidate', function (event, messages, deferreds, attribute) {
        if (attribute === undefined) {
            // the event is triggered when submitting the form
        } else if (attribute.id === 'something') {
            // the event is triggered before validating "something"
        }
    });
*/
    $('#PostNew').on('beforeSubmit', function () {
        return submitPost($(this));
       // return false;
    });
    $('#CommentNew').on('beforeSubmit', function () {
        return submitComment($(this));
        // return false;
    });
    // $('#CommentNew').on('beforeSubmit', 'submitComment');

    $('form.upload_image').on('submit', function (){
        console.log('onsubmit');
        DoUpload($(this).find('.file_input'));
    });

    $('form.upload_image .file_input').on('change', function (){
        console.log('onchange');
        DoUpload(this);
    });

    $('.btn-submit').on('click', function(){
        $('#PostNew').data('submit_btn', $(this).attr('name'));
    });

});
/*
 $(document).click( function(event){
      if( $(event.target).closest("#qw").length ) 
        return;
      $('#newPostContent').hide(1000);
      event.stopPropagation();
    });
*/

var CommentModel = Backbone.Model.extend({});

var CommentView = Backbone.View.extend({
   // initialize:function(){
   //     this.render();
   // },
    render: function(){
        this.$el.html( _.template($('#template-comment-element').html(), this.model.toJSON()));
    }
});

var PostModel = Backbone.Model.extend({});

var PostView = Backbone.View.extend({
   // initialize:function(){
   //     this.render();
   // },
    render: function(){
        var s;
        this.collection.each(function(image) {
            console.log(image);
            //var imageView = new ImageView({ model: person });
            s += _.template($('#template-image-element').html(), image.toJSON());
        });
        this.model.set({images: s});
        this.$el.html( _.template($('#template-post-element').html(), this.model.toJSON()));
    }
});

var ImageModel = Backbone.Model.extend({});

var ImagesCollection = Backbone.Collection.extend({
//    model: ImageModel
});

function submitPost($form) {
    var m_method=$form.attr('method');
    var m_action=$form.attr('action');
    var m_data=$form.serialize()+'&'+$form.data('submit_btn')+'=1';

    $.ajax({
        type: m_method,
        url: m_action,
        data: m_data,
        dataType: "json",
        success: function(response){
            if (response.status != 'ok') {
                $('#my-form-alert').text('Some error')
            } else

            if (response.data.status == 'publish') {
                document.getElementById("PostNew").reset();
                var postModel = new PostModel(response.data);

                var imagesCollection = new ImagesCollection();
                imagesCollection.add(response.data_childs);

                var postView = new PostView({model: postModel, collection: imagesCollection});
                postView.render();
                $('#postsl').prepend(postView.el);
                $('#createdpost').slideDown().removeAttr('id');

                $('#post_images').empty();
                $('#PostNew').attr('action', $('#PostNew').data('new'));
            } else {
                $('#my-form-alert').text('Saved')
                $('#PostNew').attr('action', $('#PostNew').data('edit')+'?id='+response.data.id);
            }
        },
        error: function(response) {
            return false;
        }
    });
    return false;
}

function submitComment($form) {
    //e.preventDefault();
    //var m_method=$(this).attr('method');
    //var m_action=$(this).attr('action');
    //var m_data=$(this).serialize();
    var m_method=$form.attr('method');
    var m_action=$form.attr('action');
    var m_data=$form.serialize();

    $.ajax({
        type: m_method,
        url: m_action,
        data: m_data,
        dataType: "json",
        success: function(response){
            if (response.status == 'ok'){
                document.getElementById("CommentNew").reset();
                var commentModel = new CommentModel(response.data);
                var commentView = new CommentView({model: commentModel});
                commentView.render();
                $('#commetslist').append(commentView.el);
                $('#createdcomment').slideDown().removeAttr('id');
            }    
            return false;
        },
        error: function(response) {
            return false;
        }
    });
    return false;
}

function DoUpload(file_element) {
        //$(form).find('.file_input')
        //var file = upload_input.files[0];
        var file = file_element.files[0];
        console.log(file);

        if (file) {
            var xhr = new XMLHttpRequest();
            xhr.onload = xhr.onerror = function() {

                if (this.status == 200) {
                    respObj = eval('('+this.responseText+')');
                    if ((typeof respObj === 'object') && (respObj.status != "")) {
                        if (respObj.status == 'ok') {
                            //alert(respObj.img);
                            if (respObj.type == 'user')
                                afterLoadImageAvatar(respObj.img);
                            if (respObj.type == 'post')
                                afterLoadImagePost(respObj.img, respObj.id, respObj.parent_id);
                        } else {
                            console.log('Error: '+respObj.code)
                        }
                    } else console.log('Error: -2');
                } else console.log('Error: -1');
            };

            xhr.upload.onprogress = function(event) {
                //onProgress(event.loaded, event.total);
            }

            form = $(file_element).parents('form')[0];
            console.log(form);
            console.log(form.action);
            //return false;

            if (form.action != undefined) {

                xhr.open("POST", form.action, true);

                xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

                var formData = new FormData(form);

                /*

                 var formData = new FormData();
                 formData.append("_csrf", upload_form.elements._csrf.value);
                 formData.append("Image[parent_id]", document.getElementById("image-parent_id").value);
                 formData.append("Image[parent_type]", document.getElementById("image-parent_type").value);
                 formData.append("Image[file_name]", file);
                 alert(1);*/
                xhr.send(formData);

                //xhr.send(file);
            }
        }
}

function afterLoadImageAvatar(url) {
        console.log(url);
        var forimage = document.getElementById("forimage");
        forimage.innerHTML = '<img style="border-radius: 4px; width:260px; box-shadow:0px 0px 5px #9d9d9d;" src="'+url+'" />';
}

function afterLoadImagePost(url, id, post_id) {
        console.log(url, id, post_id);
        $('#post_images').append('<div id="divimage'+id+'"><img src="'+url+'"><span class="delete_button" onClick="deleteImage('+id+');"><span class="delete"></span></span></div>');
        $('#PostNew').attr('action', $('#PostNew').data('edit')+'?id='+post_id);
        $('#form_upload_post_image #image-parent_id').val(post_id);
}

function deleteImage(id) {
//    alert(url); return;
    url = $('#post_images').attr('data-delurl')+'?id='+id;
    Backbone.ajax  ({
        url: url,
        method: 'get',
        dataType: "json",
        success: function(result){
            if (result.id != 0)
                $('#divimage'+result.id).remove();
        }
    });
}