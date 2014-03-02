  $("span.cat-quick-edit").live("click", function(e){
                       $(this).parent().parent().children().css("display","none"); 
                       $(this).parent().parent().prepend(\'<td colspan="3" class="form-edit" ><div class="row-fluid"><h4>Quick Edit</h4><form method="POST" class="form-cat" action="' . Yii::app()->createUrl('admin/category/quikupdate', array('id' => '')) . '/\'+ $(this).attr("id") +\'"> <div class="control-group"><div class="controls"><input type="text" name="Term[name]" value="\'+  $(this).attr("name") +\'" class="span12" placeholder="Name" required></div></div><div class="control-group"><div class="controls"><input type="text" name="Term[slug]" value="\'+ $(this).attr("slug") +\'" class="span12" placeholder="Slug" required><input type="hidden" name="Term[parent]" value="\'+ $(this).attr("parent") +\'" ><input type="hidden" name="Term[status]" value="\'+ $(this).attr("status") +\'"></div></div><button type="button" class="cancel btn btn-small pull-left">Cencel</button> <button type="submit" class="update btn btn-small pull-right">Update Category</button></form></div></td>\'); 
                    });                   
                    $("button.cancel").live("click", function() {
                        $(this).parent().parent().parent().parent().children().css("display", "");
                        $(this).parent().parent().parent().remove();
                    });
                    $(".form-cat").live("submit", function() {                   
                        $.ajax({url: $(this).attr("action"), data: $(this).serialize(), dataType: "JSON", type: "POST"}).done(function(response) {
                            if (response.data === true) {
                                $.msgGrowl({type: response.type, title: response.title, text: response.text});
                                $.fn.yiiGridView.update("category-grid");
                            } else {
                                $.msgGrowl({type: response.type, title: response.title, text: response.text});
                            }

                        });
                        return false;
                    });     