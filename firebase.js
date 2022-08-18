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

$(document).ready(function () {

  initializeApp(firebaseConfig);

  const db = getFirestore()
  const colRef = collection(db, 'movies')

  getDocs(colRef)
    .then((snapshot) => {
      let movies = []
      snapshot.docs.forEach((doc) => {
        // movies.push({ ...doc.data(),id: doc.id})
        displaydata(doc)
      })
      console.log(movies)
    })
    .catch(err => {
      console.log(err.message)
    })

  let i = 0;
  let j = 0;
  let k = 0;

  function displaydata(doc) {
    // alert(doc.data().name)
    var ele = document.getElementById("row");
    var mov_list = document.createElement('div');
    ele.appendChild(mov_list);
    mov_list.classList.add('col-6', 'col-sm-6', 'col-md-4', 'col-lg-2');
    i = i + 1;
    mov_list.id = 'columns' + i;

    var ele = document.getElementById("columns" + i);
    var mov_list = document.createElement('div');
    ele.appendChild(mov_list);
    mov_list.classList.add('card-img');
    j = j + 1;
    mov_list.id = 'card-img' + j;

    var ele = document.getElementById("card-img" + j);
    var mov_list = document.createElement('a');
    ele.appendChild(mov_list);
    mov_list.href = "./stream.html";
    k = k + 1;
    mov_list.id = 'mov-link' + k;

    var ele = document.getElementById("mov-link" + k);
    var mov_list = document.createElement('img');
    ele.appendChild(mov_list);
    mov_list.src = doc.data().ImageUrl;
    mov_list.id = doc.id;
    $("#image-1").attr("src", "htt");
    
  }

})