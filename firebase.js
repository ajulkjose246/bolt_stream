// import { initializeApp } from "https://www.gstatic.com/firebasejs/9.9.2/firebase-app.js";
// import { getFirestore,collection, getDocs } from "https://www.gstatic.com/firebasejs/9.4.0/firebase-firestore.js"; 
import { initializeApp } from "https://www.gstatic.com/firebasejs/9.9.2/firebase-app.js";
import { getFirestore, collection, getDocs } from "https://www.gstatic.com/firebasejs/9.9.2/firebase-firestore.js";

const firebaseConfig = {
  piKey: "AIzaSyA3TKMBpNk0afNfDbJs3TJzs0hwu7KgBkA",
  authDomain: "akj-movie-stream.firebaseapp.com",
  databaseURL: "https://akj-movie-stream-default-rtdb.firebaseio.com",
  projectId: "akj-movie-stream",
  storageBucket: "akj-movie-stream.appspot.com",
  messagingSenderId: "775429916532",
  appId: "1:775429916532:web:1325237c87b1a982c14e21",
  measurementId: "G-NJ1R2MPXCZ"
};
// let getSelectedMovie = ()=>{
//   return localStorage.getItem(mid) || 0;
// }
$(document).ready(function () {
  initializeApp(firebaseConfig);
  const db = getFirestore()
  const colRef = collection(db, 'movies/')
  getDocs(colRef).then((snapshot) => {
      snapshot.docs.forEach((doc) => {
        displaydata(doc)
        $("#"+doc.id).click(function(){
          localStorage.setItem("movie_id", doc.id);
        })
        var movies_id = localStorage.getItem("movie_id");
        if(movies_id==doc.id){
          $("#image-1").attr("src", doc.data().ImageUrl);
        }
      })
    }).catch(err => {
      console.log(err.message)
    })
  function displaydata(doc) {
    $('#row').append("<div class='col-6 col-sm-6 col-md-4 col-lg-2 selmovie' id='"+doc.id+"'><div class='card-img' id='card-img1'><a ><img src='"+doc.data().ImageUrl+"'></a></div></div>"); 
  }
  
})