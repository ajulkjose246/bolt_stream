function displaydata(collection, db, getDocs) {
    const colRef = collection(db, 'movies/')
    getDocs(colRef).then((snapshot) => {
        snapshot.docs.forEach((doc) => {
            var mov_name = doc.data().Name;
            mov_name = mov_name.replace(/ /g,"_");
            $('#row').append("<div class='col-6 col-sm-6 col-md-4 col-lg-2 selmovie "+doc.data().Genre+"'  id='" + doc.id + "'><div class='card-img' id='card-img'><a href='stream.html?"+mov_name +"'><img src='" + doc.data().ImageUrl + "'></a></div></div>");
            $("#" + doc.id).click(function () {
                localStorage.setItem("movie_id", doc.id);
            })
            console.log("ddd");
        })
    }).catch(err => {
        console.log(err.message)
    })
}

