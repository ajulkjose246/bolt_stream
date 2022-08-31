function displaydata(collection, db, getDocs) {
    const colRef = collection(db, 'movies/')
    let val = 1;
    getDocs(colRef).then((snapshot) => {
        snapshot.docs.forEach((doc) => {
            var mov_name = doc.data().Name;

            mov_name = mov_name.replace(/ /g, "_");
            $('#row').append("<div class='col-6 col-sm-6 col-md-4 col-lg-2 selmovie " + doc.data().Genre + " " + doc.data().Language + "'  id='" + doc.id + "'><div class='card-img' id='card-img'><a href='stream.html?" + mov_name + "'><img src='" + doc.data().ImageUrl + "'></a></div></div>");
            $("#" + doc.id).click(function () {
                localStorage.setItem("movie_id", doc.id);
            })
            console.log("ddd");
        })
    }).catch(err => {
        console.log(err.message)
    })
}

// $(".btn_filter").click(function () {
//     var Genre_val = $("input[name='Genre']:checked").val();
//     var Language_val = $("input[name='Language']:checked").val();
//     var Year_val = $("input[name='Year']:checked").val();
//     filterSelection(Genre_val);
// })


//movie filter
function filterSelection(c) {
    var x, i;
    x = document.getElementsByClassName("selmovie");
    if (c == "all") c = "";
    for (i = 0; i < x.length; i++) {
        RemoveClass(x[i], "show");
        if (x[i].className.indexOf(c) > -1) AddClass(x[i], "show");
    }
}


function AddClass(element, name) {
    var i, arr1, arr2;
    arr1 = element.className.split(" ");
    arr2 = name.split(" ");
    for (i = 0; i < arr2.length; i++) {
        if (arr1.indexOf(arr2[i]) == -1) { element.className += " " + arr2[i]; }
    }
}

function RemoveClass(element, name) {
    var i, arr1, arr2;
    arr1 = element.className.split(" ");
    arr2 = name.split(" ");
    for (i = 0; i < arr2.length; i++) {
        while (arr1.indexOf(arr2[i]) > -1) {
            arr1.splice(arr1.indexOf(arr2[i]), 1);
        }
    }
    element.className = arr1.join(" ");
}