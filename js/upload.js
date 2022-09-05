//write data 
async function add_user_data(collection,db,addDoc) {
    var ref = collection(db, "movies");
  
    const docRef = await addDoc(
      ref, {
        Name: document.getElementById("mov_name").value,
        Director: document.getElementById("mov_dir").value,
        Release: document.getElementById("mov_date").value,
        Server_id_1: document.getElementById("mov_ser_id_1").value,
        Server_id_2: document.getElementById("mov_ser_id_2").value,
        Server_id_3: document.getElementById("mov_ser_id_3").value,
        Server_id_4: document.getElementById("mov_ser_id_4").value,
        Server_id_5: document.getElementById("mov_ser_id_5").value,
        Genre: document.getElementById("mov_genre").value,
        IMDB: document.getElementById("mov_imdb").value,
        Bio: document.getElementById("mov_bio").value,
        ImageUrl: document.getElementById("mov_img").value,
        Trailer: document.getElementById("mov_trailer").value,
        Language: document.getElementById("mov_language").value
    }
    )
      .then(() => {
        alert("success")
        window.location.href = "upload.html";
      })
      .catch((error) => {
        alert("somthing wrong" + error)
      })
  }