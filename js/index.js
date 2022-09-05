function displaydata(collection, db, getDocs) {
    const colRef = collection(db, 'movies/')
    let val = 1;
    getDocs(colRef).then((snapshot) => {
        snapshot.docs.forEach((doc) => {
            var mov_name = doc.data().Name;

            mov_name = mov_name.replace(/ /g, "_")
            $('#row').append("<div class='col-6 col-sm-6 col-md-4 col-lg-2 selmovie hide" + doc.data().Genre + " " + doc.data().Language + "'  id='" + doc.id + "'><div class='card-img' id='card-img'><a href='stream.html?" + mov_name + "'><img src='" + doc.data().ImageUrl + "'></a></div><div class='container'><h5 class='movie_name'>" + doc.data().Name.toUpperCase() + "</h5></div></div>");
            $("#" + doc.id).click(function () {
                localStorage.setItem("movie_id", doc.id);
            })
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
    let elements = document.querySelectorAll(".selmovie");
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
document.getElementById("search-input").addEventListener("keyup", () => {
    //initializations
    let searchInput = document.getElementById("search-input").value;
    let elements = document.querySelectorAll(".movie_name");
    let cards = document.querySelectorAll(".selmovie");
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