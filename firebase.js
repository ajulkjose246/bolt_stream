import { initializeApp } from "https://www.gstatic.com/firebasejs/9.9.0/firebase-app.js";
import { getDatabase, ref, onValue } from "https://www.gstatic.com/firebasejs/9.9.0/firebase-database.js";


const firebaseConfig = {
  apiKey: "AIzaSyA3TKMBpNk0afNfDbJs3TJzs0hwu7KgBkA",
  authDomain: "akj-movie-stream.firebaseapp.com",
  databaseURL: "https://akj-movie-stream-default-rtdb.firebaseio.com",
  projectId: "akj-movie-stream",
  storageBucket: "akj-movie-stream.appspot.com",
  messagingSenderId: "775429916532",
  appId: "1:775429916532:web:1325237c87b1a982c14e21",
  measurementId: "G-NJ1R2MPXCZ"
};
const app = initializeApp(firebaseConfig);
const db = getDatabase();
$(document).ready(function () {
  // poster images
  for (let i = 1; i < 10; i++) {
    onValue(ref(db, 'bolt_stream/' + "movies/" + 'mov' + i), (snapshot) => {
      $("#mov-img" + i).attr("src", snapshot.val().ImageUrl);
      $("#image-1").attr("src", snapshot.val().ImageUrl);

      // $("#movie_name").text(snapshot.val().Name);
      // $("#movie_Country").text(snapshot.val().Country);
      // $("#movie_Genre").text(snapshot.val().Genre);
      // $("#movie_Release").text(snapshot.val().Release);
      // $("#movie_Director").text(snapshot.val().Director);
      // $("#movie_Production").text(snapshot.val().Production);
      // $("#movie_trailer").attr("href", snapshot.val().Trailer);

      updateStarCount(postElement, data);
    });
  }
  $("#mov-link" + 1).click(function () {
      onValue(ref(db, 'bolt_stream/' + "movies/" + 'mov' + 1), (snapshot) => {
        $("#image-1").attr("src", snapshot.val().ImageUrl);
        updateStarCount(postElement, data);
      });
  })

})
