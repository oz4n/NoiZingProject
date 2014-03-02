var PostController = (function(PostController) {
    var postFormAction = function() {
        $("#post-form").ajaxForm(
                {
                    'dataType': 'json',
                    'beforeSubmit': function(formData, $form, options) {
                        $.each($("#tree-category-id").dynatree("getSelectedNodes"), function() {
                            formData.push(
                                    {
                                        "name": "Post[categories][]",
                                        "value": this.data.id
                                    }
                            );
                        });
                        $("#action-loading").button("loading");
                    }, 'success': function(response) {
                        if (response.data === false) {
                            $("#action-loading").button("reset");
                            $.msgGrowl(
                                    {
                                        type: response.type,
                                        title: response.title,
                                        text: response.text
                                    }
                            );
                        } else {
                            $("#action-loading").button("reset");
                            $.msgGrowl(
                                    {
                                        type: response.type,
                                        title: response.title,
                                        text: response.text
                                    }
                            );
                        }
                    }
                }
        );
    };

    var postDeleteAction = function() {
        $(".delete-box").live("click", function(e) {
            var data_id = $(this).attr("data-id");
            var data_url = $(this).attr("data-url");
            $.msgbox("Are you sure that you want to permanently delete the selected element?", {
                type: "confirm",
                buttons: [
                    {
                        type: "submit",
                        value: "Yes"
                    },
                    {
                        type: "submit",
                        value: "No"
                    }
                ]
            }, function(result) {
                if (result === "Yes") {
                    $.ajax({
                        url: data_url,
                        data: {id: data_id},
                        dataType: "JSON",
                        type: "POST"
                    }).done(function(response) {
                        $.msgGrowl(
                                {
                                    type: response.type,
                                    title: response.title,
                                    text: response.text
                                }
                        );
                        $.fn.yiiListView.update("post-list");
                    });
                }
            });
        });
    };

    var postMenuActive = function() {
        return $('ul.nav > li.articels-list').addClass('active');
    };

    /*start image modal*/
    var postLoadImageThumb = function() {
        $("#modal-toggle").click(function() {
            var dleng = $("#img-scroll").attr("data-lengt");
            $.ajax({
                url: loadIamageURL,
                dataType: "json",
                type: "POST",
                data: {offset: dleng},
                success: function(html) {
                    var leng = html.length;
                    var oldleng = $("#img-scroll").attr("data-lengt");
                    $("#img-scroll").attr("data-lengt", (parseFloat(oldleng) + parseFloat(leng)));
                    for (var i = 0; i < leng; i++) {
                        $("#img-scroll").append('<div class="img-modal"><div class="span1" style="width: 100px; margin-left: 9px; margin-bottom: 5px;  cursor: pointer"><img src="' + html[i]["url"] + '" class="imagethumb" alt="' + html[i]["name"] + '" style="border: 2px solid #ffffff;"></div></div>');
                    }
                }
            });
        });
    };

    var postImageThumbScroll = function() {
        $("#img-scroll").slimScroll(
                {
                    alwaysVisible: false,
                    railVisible: false,
                    size: "5px",
                    height: "310px",
                    borderRadius: "0px",
                    railBorderRadius: "0px",
                    color: "#828282",
                    railColor: "#f8f8f8",
                    railOpacity: "100"
                }
        ).bind("slimscroll", function(e, pos) {
            if (pos === "bottom") {
                var dleng = $("#img-scroll").attr("data-lengt");
                $.ajax({
                    url: loadIamageURL,
                    dataType: "json",
                    type: "POST",
                    data: {offset: dleng},
                    success: function(html) {
                        var leng = html.length;
                        var oldleng = $("#img-scroll").attr("data-lengt");
                        $("#img-scroll").attr("data-lengt", (parseFloat(oldleng) + parseFloat(leng)));
                        for (var i = 0; i < leng; i++) {
                            $("#img-scroll").append('<div class="img-modal"><div class="span1" style="width: 100px; margin-left: 9px; margin-bottom: 5px;  cursor: pointer"><img src="' + html[i]["url"] + '" class="imagethumb" alt="' + html[i]["name"] + '" style="border: 2px solid #ffffff;"></div></div>');
                        }
                    }
                });
            }
        });
    };

    var postImageThumb = function() {
        $(".imagethumb").live("click", function() {
            $(".imagethumb").attr("style", "border: 2px solid #ffffff;");
            $(this).attr("style", "border: 2px solid #84C734;");
            var imgsrc = image_orginal_100_path + $(this).attr("alt");
            $("#image-thumb-view").attr({"alt": $(this).attr("alt"), "src": imgsrc});
        });
    };

    var postInsetToImageFutured = function() {
        $("#img-insert").click(function() {
            var imgAlt = $("#image-thumb-view").attr("alt");
            var imgsrt = image_orginal_path + imgAlt;
            $("#featured-img-id").attr("src", imgsrt);
            $("#Post_icon").attr("value", imgsrt);
        });
    };

    /*end image modal*/

    return {
        init: function() {
            postFormAction();
            postMenuActive();
            postDeleteAction();

            postImageThumb();
            postImageThumbScroll();
            postLoadImageThumb();
            postInsetToImageFutured();
        }
    };
}(PostController || {}));


