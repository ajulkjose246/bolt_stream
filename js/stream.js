async function streamdata(db, doc, getDoc) {
    var mov_id = localStorage.getItem("movie_id");
    const docRef = doc(db, "movies", mov_id);
    const docSnap = await getDoc(docRef);

    if (docSnap.exists()) {
        setstreamData(docSnap);
    }
}

function setstreamData(docSnap){
    $("#image-1").attr("src", docSnap.data().ImageUrl);
    $("#movie_names").text(docSnap.data().Name);
    $("#movie_bio").text(docSnap.data().Bio);
    $("#movie_url").attr("src", "https://2embed.org/embed/" + docSnap.data().Server_id);
    $("#btnradio1").click(function () {
      $("#movie_url").attr("src", "https://2embed.org/embed/" + docSnap.data().Server_id);
    })
    $("#btnradio2").click(function () {
      $("#movie_url").attr("src", "https://v2.vidsrc.me/embed/" + docSnap.data().Server_id);
    })
    $("#movie_trailer").attr("href", docSnap.data().Trailer);
    $(".imdb_rating").text("IMDB:" + docSnap.data().IMDB);
    $("#movie_director").text(docSnap.data().Director);
    $("#movie_Genre").text(docSnap.data().Genre);
    $("#movie_Release").text(docSnap.data().Release);
}