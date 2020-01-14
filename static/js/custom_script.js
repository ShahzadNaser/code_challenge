const    spinner = '<i class="fa fa-circle-o-notch fa-spin mt-4" style="font-size:48px"></i>';
$(document).ready(function(){
    $('#searchFilters').on('submit',function(e){
        e.preventDefault();
        $.ajax({
          url:base_url+"apply_filters",
          type:"Post",
          data: $(this).serialize(),
          dataType:"html",
          beforeSend:function(){
              $('#tbl-holder').html(spinner);
          },
          success:function(response){
            $('#tbl-holder').html(response);
          }
        });
        return false;
    });
    function bs_input_file() {
        $(".input-file").before(
            function() {
                if ( ! $(this).prev().hasClass('input-ghost') ) {
                    var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0' accept='.json,application/json' onChange='validateFile(this.value)'>");
                    element.attr("name",$(this).attr("name"));
                    element.change(function(){
                        element.next(element).find('input').val((element.val()).split('\\').pop());
                    });
                    $(this).find("button.btn-choose").click(function(){
                        element.click();
                    });
                    $(this).find("button.btn-reset").click(function(){
                        element.val(null);
                        $(this).parents(".input-file").find('input').val('');
                    });
                    $(this).find('input').css("cursor","pointer");
                    $(this).find('input').mousedown(function() {
                        $(this).parents('.input-file').prev().click();
                        return false;
                    });
                    return element;
                }
            }
        );
    }
    $(function() {
        bs_input_file();
    });

    $('#importForm').submit( function(e){
        e.preventDefault();
        $.ajax({
            url: base_url+'import_sales',
            type: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(data){
                if(data && data.error == true){
                    $('#msgBox').html(data.msg);
                    $('#msgBox').addClass("alert-danger").removeClass("invisible");
                }else{
                    $('#msgBox').html(data.msg);
                    $('#msgBox').addClass("alert-success").removeClass("invisible");
                    $('#resetBtn').click();
                }
                setTimeout(function(){
                    $('#msgBox').html('');
                    $('#msgBox').removeClass("alert-success").removeClass("alert-danger").addClass("invisible");

                },5000)
            }
        });
        return false;
    });

    $('#product_name').typeahead({
            source: function (query, process) {
                return $.ajax({
                    url: base_url+"get_data",
                    type: 'post',
                    data: {query: query,name:"product"},
                    dataType: 'json',
                    success: function (result) {
                        var resultList = result.map(function (item) {
                            return JSON.stringify(item);
                        });
                        return process(resultList);
                    }
                });
            },
        matcher: function (obj) {
                $("input[name='product_id']").val("");
                var item = JSON.parse(obj);
                return ~item.name.toLowerCase().indexOf(this.query.toLowerCase())
            },
            sorter: function (items) {          
               var beginswith = [], caseSensitive = [], caseInsensitive = [], item;
                while (aItem = items.shift()) {
                    var item = JSON.parse(aItem);
                    if (!item.name.toLowerCase().indexOf(this.query.toLowerCase())) beginswith.push(JSON.stringify(item));
                    else if (~item.name.indexOf(this.query)) caseSensitive.push(JSON.stringify(item));
                    else caseInsensitive.push(JSON.stringify(item));
                }
                return beginswith.concat(caseSensitive, caseInsensitive)
            },
            highlighter: function (obj) {
                var item = JSON.parse(obj);
                var query = this.query.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, '\\$&')
                return item.name.replace(new RegExp('(' + query + ')', 'ig'), function ($1, match) {
                    return '<strong>' + match + '</strong>'
                })
            },
            updater: function (obj) {
                var item = JSON.parse(obj);
                $("input[name='product_id']").val(item.id);
                return item.name;
            }
        }).on('change',function(event){
            if($("input[name='product_id']").val() == ""){
                $('#product_name').val("");
            }
        });
    $('#customer_name').typeahead({
        source: function (query, process) {
            return $.ajax({
                url: base_url+"get_data",
                type: 'post',
                data: { query: query,name:"customer" },
                dataType: 'json',
                success: function (result) {
                    var resultList = result.map(function (item) {
                        return JSON.stringify(item);
                    });
                    return process(resultList);
                }
            });
        },
    matcher: function (obj) {
            $("input[name='customer_id']").val("");
            var item = JSON.parse(obj);
            return ~item.name.toLowerCase().indexOf(this.query.toLowerCase())
        },
        sorter: function (items) {          
            var beginswith = [], caseSensitive = [], caseInsensitive = [], item;
            while (aItem = items.shift()) {
                var item = JSON.parse(aItem);
                if (!item.name.toLowerCase().indexOf(this.query.toLowerCase())) beginswith.push(JSON.stringify(item));
                else if (~item.name.indexOf(this.query)) caseSensitive.push(JSON.stringify(item));
                else caseInsensitive.push(JSON.stringify(item));
            }
            return beginswith.concat(caseSensitive, caseInsensitive)
        },
        highlighter: function (obj) {
            var item = JSON.parse(obj);
            var query = this.query.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, '\\$&')
            return item.name.replace(new RegExp('(' + query + ')', 'ig'), function ($1, match) {
                return '<strong>' + match + '</strong>'
            })
        },
        updater: function (obj) {
            console.log("updater",obj);
            var item = JSON.parse(obj);
            $("input[name='customer_id']").val(item.id);
            return item.name;
        }
    }).on('change',function(event){
        if($("input[name='customer_id']").val() == ""){
            $('#product_name').val("");
        }
    });
});

$('#resetBtn').click(function(){
    $('#frmSubmitBtn').prop('disabled', true);
});

function validateFile(file){
    if(file)
        $('#frmSubmitBtn').prop('disabled', false);
    else
        $('#frmSubmitBtn').prop('disabled', true);
}