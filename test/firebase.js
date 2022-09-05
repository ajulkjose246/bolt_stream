import { initializeApp } from "https://www.gstatic.com/firebasejs/9.9.2/firebase-app.js";
import { getFirestore, collection, getDocs, getDoc, doc ,addDoc} from "https://www.gstatic.com/firebasejs/9.9.2/firebase-firestore.js";

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
initializeApp(firebaseConfig);
const db = getFirestore()


//load index page content
displaydata(collection, db, getDocs,doc,getDoc);

