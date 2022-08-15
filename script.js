$(document).ready(function () {
    $('.navbar-sec').hide();
    $(window).on('load', function () {
        $('.loading-sec').hide();
        $('.navbar-sec').show();
    });
    for (i = 1; i < 11; i++) {
        //create element in html
        var ele = document.getElementById("row");
        var mov_list = document.createElement('div');
        ele.appendChild(mov_list);
        mov_list.classList.add('col-6', 'col-sm-6', 'col-md-4', 'col-lg-2');
        mov_list.id = 'columns' + i;

        var ele = document.getElementById("columns" + i);
        var mov_list = document.createElement('div');
        ele.appendChild(mov_list);
        mov_list.classList.add('card-img');
        mov_list.id = 'card-img'+i;

        var ele = document.getElementById("card-img"+i);
        var mov_list = document.createElement('a');
        ele.appendChild(mov_list);
        mov_list.href = "./stream.html";
        mov_list.id = 'mov-link'+i;

        var ele = document.getElementById("mov-link"+i);
        var mov_list = document.createElement('img');
        ele.appendChild(mov_list);
        mov_list.src = "./img/card-img.jpg";
        mov_list.id = 'mov-img'+i;


    }
})
