

// the functions to retrieve user input

function getUserInput() {
  let energy = document.getElementById("energy").value;
  let genre = document.getElementsByName("genre").value;

  let userInput = [energy, genre];

  processFormInfo(userInput);
}

function processPlaylist() {

  document.writeln('<p> Your playlist is made with music from the genre: ' + formArray[1] + 'and music with the energy level of ' + formArray[0] + '<p>');

}



