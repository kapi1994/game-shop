const classes = ["text-danger"];

function createValidationErrorMessage(elementId, elementMessage) {
  let element = document.querySelector(`#${elementId}`);
  element.classList.add(...classes);
  element.textContent = elementMessage;
}

function removeValidationErrorMessage(elementId) {
  let elemenet = document.querySelector(`#${elementId}`);
  elemenet.classList.remove(classes);
  elemenet.textContent = "";
}

function validainteInputElement(
  elementId,
  reElement,
  arrayErrors,
  errorElementId,
  errorMessage
) {
  if (!reElement.test(elementId)) {
    arrayErrors.push(errorMessage);
    createValidationErrorMessage(errorElementId, errorMessage);
  } else {
    removeValidationErrorMessage(errorElementId);
  }
}

function validateSelectElement(
  element,
  errorArray,
  elementErrorId,
  errorMessage
) {
  if (element == 0 || element == "default") {
    errorArray.push(errorMessage);
    createValidationErrorMessage(elementErrorId, errorMessage);
  } else {
    removeValidationErrorMessage(elementErrorId);
  }
}

function validateCheckBoxes(
  checkBoxes,
  errorArray,
  errorElementId,
  errorMessage
) {
  if (checkBoxes.length == 0) {
    errorArray.push(errorMessage);
    createValidationErrorMessage(errorElementId, errorMessage);
  } else {
    removeValidationErrorMessage(errorElementId);
  }
}

function getSelectedCheckboxeValues(checkBoxArray, array) {
  checkBoxArray.forEach((checkBox) => {
    array.push(checkBox.value);
  });
  return array;
}

// ! dodati funkciju za ispisivanje datuma i vremena
function dateFormater(date) {
  console.log(date);
}

function printPagination(pages, limit, whereToPlace, cls = "") {
  let content = "";
  for (let i = 0; i < pages; i++) {
    let activeClass = i == limit ? "active" : "";
    content += `
    <li data-limit='${i}' class="page-item ${cls} ${activeClass}"><a class="page-link" href="#">${
      i + 1
    }</a></li>
    `;
  }
  document.querySelector(`#${whereToPlace}`).innerHTML = content;
}
