$(()=> {
    $(".apiForm").on("submit", function(e){
        e.preventDefault();
        var formAction = $(this).attr("action");
        var ondone = $(this).attr("ondone");
        var formValues ={}
        $(this).find('.apiField').each(function(){
            if(formValues[this.name]){
                formValues[this.name] = formValues[this.name] += ","+ this.value || "";
            }else{
                formValues[this.name] = this.value || "";
            }
        });
        $.post('/api', {
            method: formAction,
            data : formValues
        }, function (response) {
            console.log(response);
            eval(ondone + "("+response+")");

        }); 
    });
    
    $(document).on("change",".apiDropDown",function(e){
        e.preventDefault();
        var val = $(this).find(":selected").val();
        if(val){
            var destignation = $(this).attr("target");
            var selected = $(this).attr("target-select");
            var placeholder = $(this).attr("default");
            var method = $(this).attr("action");
            $.post('/api', {
                method: method,
                id : val
            }, function (response) {
                let resp = JSON.parse(response);
                $(destignation).empty();
                $(destignation).append("<option selected disabled value=''>"+placeholder+"</option>");
                console.log(selected)
                $.each(resp, function(i, item) {
                    if(selected == item.id){
                        $(destignation).append("<option value='"+item.id+"' selected>"+item.name+"</option>");
                    }else{
                        $(destignation).append("<option value='"+item.id+"'>"+item.name+"</option>");
                    }
                });
                $(destignation).trigger("change");
            }); 
        }
    })
    
    $(document).on("change",".apiDropDownToText",function(e){
        e.preventDefault();
        var val = $(this).find(":selected").val();
        if(val){
            var destignation = $(this).attr("target");
            var method = $(this).attr("action");
            console.log(method)
            $.post('/api', {
                method: method,
                id : val
            }, function (response) {
                let resp = JSON.parse(response);
                $(destignation).val(resp.value)
            }); 
        }
    })
    
    $('.apiDropDownInit').trigger('change');
});
