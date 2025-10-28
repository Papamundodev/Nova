
    <dialog id="favDialog">
        <form method="dialog">
            <p>
                <label for="selectEl">Favorite animal:</label>
                <select id="selectEl">
                    <option value="default">Select an animal</option>   
                    <option value="dog">Dog</option>
                    <option value="cat">Cat</option>
                    <option value="bird">Bird</option>
                    <option value="fish">Fish</option>
                </select>
            </p>
            <button id="confirmBtn">Confirm</button>
        </form>
    </dialog>
    <output></output>  
    <button id="showDialog">Show dialog</button>

    <script>
const showButton = document.getElementById("showDialog");
  const favDialog = document.getElementById("favDialog");
  const outputBox = document.querySelector("output");
  const selectEl = favDialog.querySelector("select");
  const confirmBtn = favDialog.querySelector("#confirmBtn");

  //the conditions has to go.
  if (showButton && favDialog && outputBox && selectEl && confirmBtn) {
    
  showButton.addEventListener("click", () => {
    favDialog.showModal();
  });
  // "Favorite animal" input sets the value of the submit button
  selectEl.addEventListener("change", (e) => {
    confirmBtn.value = selectEl.value;
  });
  // "Confirm" button of form triggers "close" on dialog because of [method="dialog"]
  favDialog.addEventListener("close", () => {
    outputBox.value = `ReturnValue: ${favDialog.returnValue}.`;
  });
  }


    </script>