// import { initializeApp } from "https://www.gstatic.com/firebasejs/9.9.2/firebase-app.js";
// import { getFirestore,collection, getDocs } from "https://www.gstatic.com/firebasejs/9.4.0/firebase-firestore.js"; 
import { initializeApp } from "https://www.gstatic.com/firebasejs/9.9.2/firebase-app.js";
import { getFirestore, collection, getDocs,addDoc } from "https://www.gstatic.com/firebasejs/9.9.2/firebase-firestore.js";

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
  $(".log-reg-btn").show();
  //read data

  initializeApp(firebaseConfig);
  const db = getFirestore()
  const colRef = collection(db, 'movies/')
  getDocs(colRef).then((snapshot) => {
    snapshot.docs.forEach((doc) => {
      displaydata(doc)
      $("#" + doc.id).click(function () {
        localStorage.setItem("movie_id", doc.id);
      })
      var movies_id = localStorage.getItem("movie_id");
      if (movies_id == doc.id) {
        setData(doc)
      }
    })
  }).catch(err => {
    console.log(err.message)
  })

  function displaydata(doc) {
    $('#row').append("<div class='col-6 col-sm-6 col-md-4 col-lg-2 selmovie' id='" + doc.id + "'><div class='card-img' id='card-img1'><a ><img src='" + doc.data().ImageUrl + "'></a></div></div>");
  }

  function setData(doc) {
    $("#image-1").attr("src", doc.data().ImageUrl);
    $("#movie_names").text(doc.data().Name);
    $("#movie_bio").text(doc.data().Bio);
    $("#movie_url").attr("src", "https://2embed.org/embed/" + doc.data().Server_id);
    $("#btnradio1").click(function () {
      $("#movie_url").attr("src", "https://2embed.org/embed/" + doc.data().Server_id);
    })
    $("#btnradio2").click(function () {
      $("#movie_url").attr("src", "https://v2.vidsrc.me/embed/" + doc.data().Server_id);
    })
    $("#movie_trailer").attr("href", doc.data().Trailer);
    $(".imdb_rating").text("IMDB:" + doc.data().IMDB);
    $("#movie_director").text(doc.data().Director);
    $("#movie_Genre").text(doc.data().Genre);
    $("#movie_Release").text(doc.data().Release);
  }


//write data 
  async function add_user_data() {
    let usr_name = document.getElementById("inputname").value;
    let usr_email = document.getElementById("inputemail").value;
    let usr_pswd = document.getElementById("inputpassword").value;
    var ref = collection(db, "users");

    const docRef = await addDoc(
      ref, {
      Name: usr_name,
      Email: usr_email,
      Password: usr_pswd
    }
    )
      .then(() => {
        localStorage.setItem("user_email", usr_email);
        localStorage.setItem("user_pwd", usr_pswd);
      })
      .catch((error) => {
        alert("somthing wrong" + error)
      })
  }

  $("#reg_btn").click(function () {
    add_user_data()
  })

  //password checking

  const pwdCheck = collection(db, 'users/')
  getDocs(pwdCheck).then((snapshot) => {
    snapshot.docs.forEach((doc) => {
      if(localStorage.getItem("user_email")==doc.data().Email && localStorage.getItem("user_pwd")==doc.data().Password){
        $(".dropdown").show();
        $(".log-reg-btn").hide();
      }else{
        $(".dropdown").hide();
        $(".log-reg-btn").show();
      }
    })
  }).catch(err => {
    console.log(err.message)
  })

})