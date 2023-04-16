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

function validateInputElement(
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

function dateFormater(date) {
  const dateTimeStamp = Date.parse(date);
  const dateTime = new Date(dateTimeStamp);
  const day = String(dateTime.getDate()).padStart(2, 0);
  const month = String(dateTime.getMonth() + 1).padStart(2, 0);
  const year = dateTime.getFullYear();

  const hour = String(dateTime.getHours()).padStart(2, 0);
  const minutes = String(dateTime.getMinutes()).padStart(2, 0);
  const seconds = String(dateTime.getSeconds()).padStart(2, 0);

  const newDateTimeFormat =
    day + "/" + month + "/" + year + " " + hour + ":" + minutes + ":" + seconds;
  return newDateTimeFormat;
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

function printPaginationLinks(pages, limit, whereToPlace, links) {
  let content = "";
  for (let i = 0; i < pages; i++) {
    let activeClass = i == limit ? "active" : "";
    content += `
    <li class="page-item  ${activeClass}"><a class="page-link" href="${links}&limit=${i}">${
      i + 1
    }</a></li>
    `;
  }
  document.contains(document.querySelector(`#${whereToPlace}`))
    ? (document.querySelector(`#${whereToPlace}`).innerHTML = content)
    : "";
}

function createResponseMessages(color, message, whereToPlace) {
  let content = `<div class="alert alert-${color} alert-dismissible fade show text-center" role="alert">
 ${message}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>`;
  document.querySelector(`#${whereToPlace}`).innerHTML = content;
}

function validateInputFileElement(
  elemenet,
  errorArray,
  errorElementId,
  errorMessage
) {
  if (elemenet.length == 0) {
    errorArray.push(errorMessage);
    createValidationErrorMessage(errorElementId, errorMessage);
  } else {
    removeValidationErrorMessage(errorElementId);
  }
}

function validateRadioInput(radioElement, errorArray, elementId, errorMessage) {
  if (radioElement == null) {
    createValidationErrorMessage(elementId, errorMessage);
    errorArray.push(errorMessage);
  } else {
    removeValidationErrorMessage(elementId);
  }
}
