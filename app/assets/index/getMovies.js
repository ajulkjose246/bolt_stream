function getMovie(url, sort_by, limit, div) {
  // Set the API endpoint URL
  // const url = "https://yts.mx/api/v2/list_movies.json";

  // Set the query parameters for popular movies
  const queryParams = {
    sort_by: sort_by, // Sort by download count
    limit: limit, // Limit to 6 movies
  };

  // Encode the query parameters into a URL string
  const queryString = Object.entries(queryParams)
    .map(
      ([key, value]) =>
        `${encodeURIComponent(key)}=${encodeURIComponent(value)}`
    )
    .join("&");

  // Make a GET request to the API endpoint using fetch
  fetch(`${url}?${queryString}`)
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
       
      }
      return response.json();
    })
    .then((data) => {
      // Log the titles of the popular movies
      // console.log("Popular movies:");
      data.data.movies.forEach((movie) => {
       
        // console.log(movie);
        // console.log(movie);
        $(div).append(
          "<div class='col-6 col-sm-4 col-md-3 col-lg-2'><a href='/movie/" +
            movie.imdb_code +
            "'><div class='card'> <img src='" +
            movie.large_cover_image +
            "' class='card-img-top' alt='...'> <div class='card-body'> <p class='card-text'>" +
            movie.title.substring(0, 30) +
            " (" +
            movie.year +
            ")</p> </div> </div></a> </div>"
        );
        
      });
    })
    .catch((error) => {
      // Handle any errors here
      console.error(error);
    });
}
