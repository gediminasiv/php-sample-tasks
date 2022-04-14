const movieTypeSelect = document.getElementById("exampleFormControlSelect1");

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

movieTypeSelect.onchange = () => {
  hideUnneededFields();
};

hideUnneededFields();
