function displaydata(collection, db, getDocs) {
    const colRef = collection(db, 'movies/')
    let val=1;
    getDocs(colRef).then((snapshot) => {
        snapshot.docs.forEach((doc) => {
            var mov_name = doc.data().Name;
            
            mov_name = mov_name.replace(/ /g,"_");
            $('#row').append("<div class='col-6 col-sm-6 col-md-4 col-lg-2 selmovie "+doc.data().Genre+ ""+doc.data().Language+"'  id='" + doc.id + "'><div class='card-img' id='card-img'><a href='stream.html?"+mov_name +"'><img src='" + doc.data().ImageUrl + "'></a></div></div>");
            $("#" + doc.id).click(function () {
                localStorage.setItem("movie_id", doc.id);
            })
            if(val<4){
                $("#mov_banner_"+val).attr("src", doc.data().mov_banner);
                $("#banner_head_"+val).text(doc.data().Name);
                val=val+1;
            }
            console.log("ddd");
        })
    }).catch(err => {
        console.log(err.message)
    })
}

//movie banner

// async function movie_banner(db, doc, getDoc) {
//     const docRef = doc(db, "movie_banner", "jpE4qMfkG3TReTRN7x3x");
//     const docSnap = await getDoc(docRef);

//     if (docSnap.exists()) {
//         $("#mov_banner_1").attr("src", docSnap.data().Image_1);
//         $("#mov_banner_2").attr("src", docSnap.data().Image_2);
//         $("#mov_banner_3").attr("src", docSnap.data().Image_3);
//     }
// }
