const movieTypeSelect = document.getElementById("exampleFormControlSelect1");

const userFilterSelect = document.getElementById("user-filter");
const filterButton = document.getElementById("filter-button");

function hideUnneededFields() {
  const movieType = movieTypeSelect.value;
  const inputsToHide = document.getElementsByClassName(
    movieType === "cinema" ? "rental" : "cinema"
  );

  for (const input of inputsToHide) {
    input.style = "display: none;";
  }

  const inputsToShow = document.getElementsByClassName(movieType);
  for (const input of inputsToShow) {
    input.style = "display: block;";
  }
}

function filterMoviesByUser() {
  const userId = userFilterSelect.value;

  if (userId.length < 1) {
    return (window.location.href = "?page=movies");
  }

  return (window.location.href = "?page=movies&userFilter=" + userId);
}

movieTypeSelect.onchange = () => {
  hideUnneededFields();
};
filterButton.onclick = () => {
  filterMoviesByUser();
};

hideUnneededFields();
