//write data 
async function add_user_data(collection,db,addDoc) {
    var ref = collection(db, "movies");
  
    const docRef = await addDoc(
      ref, {
        Name: document.getElementById("mov_name").value,
        Director: document.getElementById("mov_dir").value,
        Release: document.getElementById("mov_date").value,
        Server_id: document.getElementById("mov_ser_id").value,
        Genre: document.getElementById("mov_genre").value,
        IMDB: document.getElementById("mov_imdb").value,
        Bio: document.getElementById("mov_bio").value,
        ImageUrl: document.getElementById("mov_img").value,
        Trailer: document.getElementById("mov_trailer").value
    }
    )
      .then(() => {
        alert("success")
      })
      .catch((error) => {
        alert("somthing wrong" + error)
      })
  }