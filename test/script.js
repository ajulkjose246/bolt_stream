function displaydata(collection, db, getDocs) {
  const colRef = collection(db, 'movies/')
  let val = 1;
  getDocs(colRef).then((snapshot) => {
    snapshot.docs.forEach((doc) => {
      //Create Card
      let card = document.createElement("div");
      //Card should have category and should stay hidden initially
      card.classList.add("card", doc.data().Language, "hide");
      //image div
      let imgContainer = document.createElement("div");
      imgContainer.classList.add("image-container");
      //img tag
      let image = document.createElement("img");
      image.setAttribute("src", doc.data().ImageUrl);
      imgContainer.appendChild(image);
      card.appendChild(imgContainer);
      //container
      let container = document.createElement("div");
      container.classList.add("container");
      //product name
      let name = document.createElement("h5");
      name.classList.add("product-name");
      name.innerText = doc.data().Name.toUpperCase();
      container.appendChild(name);
      //price
      let price = document.createElement("h6");
      price.innerText = "$" + doc.data().Release;
      container.appendChild(price);

      card.appendChild(container);
      document.getElementById("products").appendChild(card);
      console.log("ddd");
    })
  }).catch(err => {
    console.log(err.message)
  })

  
  //Initially display all products
  window.onload = () => {
    filterProduct("all");
  };
}

//parameter passed from button (Parameter same as category)
function filterProduct(value) {
  //Button class code
  let buttons = document.querySelectorAll(".button-value");
  buttons.forEach((button) => {
    //check if value equals innerText
    if (value.toUpperCase() == button.innerText.toUpperCase()) {
      button.classList.add("active");
    } else {
      button.classList.remove("active");
    }
  });
  //select all cards
  let elements = document.querySelectorAll(".card");
  //loop through all cards
  elements.forEach((element) => {
    //display all cards on 'all' button click
    if (value == "all") {
      element.classList.remove("hide");
    } else {
      //Check if element contains category class
      if (element.classList.contains(value)) {
        //display element based on category
        element.classList.remove("hide");
      } else {
        //hide other elements
        element.classList.add("hide");
      }
    }
  });
}
//Search button click
document.getElementById("search").addEventListener("click", () => {
  //initializations
  let searchInput = document.getElementById("search-input").value;
  let elements = document.querySelectorAll(".product-name");
  let cards = document.querySelectorAll(".card");
  //loop through all elements
  elements.forEach((element, index) => {
    //check if text includes the search value
    if (element.innerText.includes(searchInput.toUpperCase())) {
      //display matching card
      cards[index].classList.remove("hide");
    } else {
      //hide others
      cards[index].classList.add("hide");
    }
  });
});