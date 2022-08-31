async function streamdata(db, doc, getDoc) {
  var mov_id = localStorage.getItem("movie_id");
  const docRef = doc(db, "movies", mov_id);
  const docSnap = await getDoc(docRef);

  if (docSnap.exists()) {
    setstreamData(docSnap);
  }
}

function setstreamData(docSnap) {
  $("#image-1").attr("src", docSnap.data().ImageUrl);
  $("#movie_names").text(docSnap.data().Name);
  $("#movie_bio").text(docSnap.data().Bio);
  $("#movie_trailer").attr("href", docSnap.data().Trailer);
  $(".imdb_rating").text("IMDB:" + docSnap.data().IMDB);
  $("#movie_director").text(docSnap.data().Director);
  $("#movie_Genre").text(docSnap.data().Genre);
  $("#movie_Release").text(docSnap.data().Release);

  $("#movie_url").attr("src", "https://2embed.org/embed/" + docSnap.data().Server_id_1);

  $("#btnradio1").click(function () {
    if (docSnap.data().Server_id_1 == "")
    alert("Server Error")
    else
      $("#movie_url").attr("src", "https://2embed.org/embed/" + docSnap.data().Server_id_1);
  })

  $("#btnradio2").click(function () {
    if (docSnap.data().Server_id_2 == "")
    alert("Server Error")
    else
      $("#movie_url").attr("src", "https://v2.vidsrc.me/embed/" + docSnap.data().Server_id_2);
  })

  $("#btnradio3").click(function () {
    if (docSnap.data().Server_id_3 == "")
    alert("Server Error")
    else
      $("#movie_url").attr("src","https://fembed.ro/embed/"+ docSnap.data().Server_id_3);
  })

  $("#btnradio4").click(function () {
    if (docSnap.data().Server_id_4 == "")
      alert("Server Error")
    else
      $("#movie_url").attr("src", docSnap.data().Server_id_4);
  })

  $("#btnradio5").click(function () {
    if (docSnap.data().Server_id_5 == "")
    alert("Server Error")
    else
      $("#movie_url").attr("src", docSnap.data().Server_id_5);
  })
}