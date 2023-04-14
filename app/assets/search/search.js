$("#searchMovie").keyup(() => {
  const url = "https://yts.mx/api/v2/list_movies.json";
  var movie = $("#searchMovie").val();
  const queryParams = {
    query_term: movie,
  };
  const queryString = new URLSearchParams(queryParams).toString();
  fetch(`${url}?${queryString}`)
    .then((response) => response.json())
    .then((data) => {
      const mov_details = data.data.movies;
      console.log(mov_details);
      if (mov_details == null) {
        $("#moviesContainer").empty();
        $("#moviesContainer").append("<h5 style='text-align: center;'>Movie Not Found</h5>");
      } else {
        $("#moviesContainer").empty();
        mov_details.forEach((element) => {
          $("#moviesContainer").append(
            "<div class='col-6 col-sm-4 col-md-3 col-lg-2'><a href='/movie/" +
              element.imdb_code +
              "'><div class='card'> <img src='" +
              element.large_cover_image +
              "' class='card-img-top' alt='...'> <div class='card-body'> <p class='card-text'>" +
              element.title.substring(0, 30) +
              " (" +
              element.year +
              ")</p> </div> </div></a> </div>"
          );
        });
      }
    })
    .catch((error) => console.error(error));
});
