$(document).ready(function () {
  let page = window.location.href.split("?");
  if ((page[1] == "page=home" && page.length >= 2) || page.length == 1) {
    getStats();
  }

  // ! dodati prikaz greske za error block

  $(document).on("click", ".btn-edit-publisher", function (e) {
    e.preventDefault();
    let id = $(this).data("id");
    let index = $(this).data("index");

    $.ajax({
      url: "models/publishers/edit.php",
      type: "get",
      data: { id },
      dataType: "json",
      success: function (response) {
        fillPublisherForm(response, index);
      },
      error: function (jqXHR, statusTxt, xhr) {
        console.log(jqXHR);
      },
    });
  });

  // ! dodati error block za error response

  $(document).on("click", ".btn-delete-publisher", function (e) {
    e.preventDefault();
    let id = $(this).data("id");
    let index = $(this).data("index");
    let status = $(this).data("status");

    const whereToPlace = `publisher_${index}`;

    $.ajax({
      type: "post",
      url: "models/publishers/delete.php",
      data: { id, status },
      dataType: "json",
      success: function (response) {
        printPlatforms(response, index, whereToPlace);
      },
      error: function (jqXHR, statusTxt, xhr) {
        console.error(jqXHR);
      },
    });
  });

  // ! dodati response message
  // ! popuniti error block

  $(document).on("click", "#btnSavePublisher", function (e) {
    e.preventDefault();

    let id = $("#publisher_id").val();
    let index = $("#publisher_index").val();
    let name = $("#name").val();

    if (id == "") {
      if (publisherFormValidation().length == 0) {
        $.ajax({
          type: "post",
          url: "models/publishers/store.php",
          data: { name },
          dataType: "json",
          success: function (response) {
            $("#name").val("");
            printAllPublishers(response.platforms);
          },
          error: function (jqXHR, statusTxt, xhr) {
            console.error(jqXHR);
          },
        });
      }
    } else {
      const whereToPlace = `publisher_${index}`;
      if (publisherFormValidation().length == 0) {
        $.ajax({
          type: "post",
          url: "models/publishers/update.php",
          data: { id, name },
          dataType: "json",
          success: function (response) {
            $("#publisher_id").val("");
            $("#publisher_index").val("");
            $("#name").val("");
            printPublisher(response, index, whereToPlace);
          },
          error: function (jqXHR, statusTxt, xhr) {
            console.log(jqXHR);
          },
        });
      }
    }
  });

  $(document).on("click", ".publisher_pagination_link", function (e) {
    e.preventDefault();
    let limit_page = $(this).data("limit");
    $.ajax({
      url: "models/publishers/filter.php",
      method: "get",
      data: { limit_page },
      dataType: "json",
      success: function (response) {
        printAllPublishers(response.publishers, limit_page);
        printPagination(
          response.pagination,
          limit_page,
          "publisher_pagination_links",
          "publisher_pagination_link"
        );
      },
      error: function (jqXHR, statusTxt, xhr) {
        console.log(jqXHR);
      },
    });
  });

  // ! dodati error block
  $(document).on("click", ".btn-edit-platform", function (e) {
    e.preventDefault();
    let id = $(this).data("id");
    let index = $(this).data("index");

    $.ajax({
      type: "get",
      url: "models/platforms/edit.php",
      data: { id },
      dataType: "json",
      success: function (response) {
        fillPlatformForm(response, index);
      },
      error: function (jqXHR, statusTxt, xhr) {
        console.log(jqXHR);
      },
    });
  });
  // ! dodati error block
  $(document).on("click", ".btn-delete-platform", function (e) {
    e.preventDefault();
    let id = $(this).data("id");
    let index = $(this).data("index");
    let status = $(this).data("status");

    const whereToPlace = `platform_${index}`;

    $.ajax({
      type: "post",
      url: "models/platforms/delete.php",
      data: { id, status },
      dataType: "json",
      success: function (response) {
        printPlatform(response, index, whereToPlace);
      },
      error: function (jqXHR, statusTxt, xhr) {
        console.error(jqXHR);
      },
    });
  });
  // ! dodati error block
  // ! dodati response message

  $(document).on("click", "#btnSavePlatform", function (e) {
    e.preventDefault();

    let id = $("#platform_id").val();
    let index = $("#platform_index").val();
    let name = $("#name").val();

    if (id == "") {
      if (platformFormValidation().length == 0) {
        $.ajax({
          type: "post",
          url: "models/platforms/store.php",
          data: { name },
          dataType: "json",
          success: function (response) {
            $("#name").val("");
            printPlatforms(response.platforms);
          },
          error: function (jqXHR, statusTxt, xhr) {
            console.log(jqXHR);
          },
        });
      }
    } else {
      if (platformFormValidation().length == 0) {
        const whereToPlace = `platform_${index}`;
        $.ajax({
          type: "post",
          url: "models/platforms/update.php",
          data: { id, name },
          dataType: "json",
          success: function (response) {
            printPlatform(response, index, whereToPlace);
            $("#name").val("");
            $("#platform_index").val("");
            $("#platform_id").val("");
          },
          error: function (jqXHR, statusTxt, xhr) {
            console.log(jqXHR);
          },
        });
      }
    }
  });

  // ! dodati error block
  $(document).on("click", ".btn-delete-game", function (e) {
    e.preventDefault();
    let id = $(this).data("id");
    let status = $(this).data("status");
    let index = $(this).data("index");
    const whereToPlace = `game_${index}`;
    $.ajax({
      type: "post",
      url: "models/games/delete.php",
      data: { id, status },
      dataType: "json",
      success: function (response) {
        printGame(response, index, whereToPlace);
      },
      error: function (jqXHR, statusTxt, xhr) {
        console.log(jqXHR);
      },
    });
  });

  // ! dodati error block
  $(document).on("click", ".btn-edit-game", function (e) {
    e.preventDefault();
    let id = $(this).data("id");
    let index = $(this).data("index");

    $.ajax({
      type: "get",
      url: "models/games/edit.php",
      data: { id },
      dataType: "json",
      success: function (response) {
        fillGameForm(response, index);
      },
      error: function (jqXHR, statusTxt, xhr) {
        console.log(jqXHR);
      },
    });
  });

  // ! dodati error block
  $(document).on("click", "#btnSaveGame", function (e) {
    e.preventDefault();
    let id = $("#game_id").val();
    let index = $("#game_index").val();
    let name = $("#name").val();
    let description = $("#description").val();
    let publisher = $("#publishers").val();
    let genres = document.querySelectorAll('input[name="genres"]:checked');

    let selectedGenres = [];
    getSelectedCheckboxeValues(genres, selectedGenres);

    if (id == "") {
      if (gameFormValidation().length == 0) {
        $.ajax({
          type: "post",
          url: "models/games/store.php",
          data: { name, description, publisher, selectedGenres },
          dataType: "json",
          success: function (response) {
            $("#name").val("");
            $("#description").val("");
            $("#publishers").val(0);
            let genres = document.querySelectorAll('input[name="genres"]');
            genres.forEach((genre) => {
              let genre_id = genre.id;
              document.querySelector(`#${genre_id}`).checked = false;
            });
            printGames(response.games);
          },
          error: function (jqXHR, statusTxt, xhr) {
            console.log(jqXHR);
          },
        });
      }
    } else {
      let whereToPlace = `game_${index}`;
      if (gameFormValidation().length == 0) {
        $.ajax({
          type: "post",
          url: "models/games/update.php",
          data: { id, name, description, publisher, selectedGenres },
          dataType: "json",
          success: function (response) {
            printGame(response, index, whereToPlace);
          },
          error: function (jqXHR, statusTxt, xhr) {
            console.log(jqXHR);
          },
        });
      }
    }
  });

  function fillPublisherForm(publisher, index) {
    const { id, name } = publisher;
    $("#publisher_index").val(index);
    $("#publisher_id").val(id);
    $("#name").val(name);
  }

  function printAllPublishers(publishers, limit = 0) {
    let content = "",
      index = 1;
    if (limit > 0) {
      index = 5 * limit + 1;
    }
    publishers.forEach((publisher) => {
      content += printPublisher(publisher, index);
      index++;
    });

    document.querySelector("#publishers").innerHTML = content;
  }

  function printPublisher(publisher, index, whereToPlace = "") {
    const { id, name, created_at, updated_at, is_deleted } = publisher;
    let content = `
        <tr id='publisher_${index}'>
            <th scope='row'> ${index}</th>
            <td>${name}</td>
            <td>${dateFormater(created_at)}</td>
            <td>${updated_at != null ? dateFormater(updated_at) : "-"}</td>
            <td><button type='button' class='btn btn-sm btn-success btn-edit-publisher' data-id=${id}'' data-index='${index}'>Edit</button></td>
            <td><button type='button' class='btn btn-sm btn-danger btn-delete-publisher'
                data-id='${id}' data-index = '${index}' data-status = '${is_deleted}'
            >${is_deleted == 0 ? "Delete" : "Activate"}</button></td>
        </tr>
    `;
    if (whereToPlace != "") {
      document.querySelector(`#${whereToPlace}`).innerHTML = content;
    }
    return content;
  }

  function publisherFormValidation() {
    let name = $("#name").val();
    const reName = /^([A-Z\d]{2,}|[A-Z][a-z]{1,})(\s[\w]{1,})*$/;
    let errors = [];

    validainteInputElement(
      name,
      reName,
      errors,
      "name_error",
      "Name isn't ok!"
    );
    return errors;
  }

  function fillPlatformForm(platform, index) {
    const { id, name } = platform;
    $("#platform_id").val(id);
    $("#platform_index").val(index);
    $("#name").val(name);
  }

  function printPlatforms(platforms) {
    let content = "",
      index = 1;
    platforms.forEach((platform) => {
      content += printPlatform(platform, index);
      index++;
    });
    document.querySelector("#platforms").innerHTML = content;
  }

  function printPlatform(platform, index, whereToPlace = "") {
    const { id, name, created_at, updated_at, is_deleted } = platform;
    let content = `
        <tr id='platform_${index}'>
            <th scope='row'>${index}</th>
            <td>${name}</td>
            <td>${dateFormater(created_at)}</td>
            <td>${updated_at != null ? dateFormater(updated_at) : "-"}</td>
            <td><button type='button' class='btn btn-sm btn-edit-platform btn-success' data-id='${id}' data-index='${index}'>Edit</button></td>
            <td><button type='button' class='btn btn-sm btn-danger btn-delete-platform' data-id='${id}' data-index='${index}'
                data-status ='${is_deleted}'
            >${is_deleted == 0 ? "Delete" : "Activate"}</button></td>
        </tr>
    `;
    if (whereToPlace != "") {
      document.querySelector(`#${whereToPlace}`).innerHTML = content;
    }
    return content;
  }

  function platformFormValidation() {
    let name = $("#name").val();
    const reName = /^([A-Z\d]{2,}|[A-Z][a-z]{1,})(\s[\w]{1,})*$/;
    let errors = [];

    validainteInputElement(
      name,
      reName,
      errors,
      "name_error",
      "Name isn't ok!"
    );

    return errors;
  }

  function printGames(games) {
    let content = "",
      index = 1;
    games.forEach((game) => {
      content += printGame(game, index);
      index++;
    });
    document.querySelector(`#games`).innerHTML = content;
  }

  function printGame(game, index, whereToPlace = "") {
    const { id, name, publisherName, created_at, updated_at, is_deleted } =
      game;
    let content = `
        <tr id='game_${index}'>
            <th scope='row'>${index}</th>
            <td>${name}</td>
            <td>${publisherName}</td>
            <td>${dateFormater(created_at)}</td>
            <td>${updated_at != null ? dateFormater(updated_at) : "-"}</td>
            <td><button type='button' class='btn btn-sm btn-edit-game btn-success' data-id='${id}' data-index='${index}'>Edit</button></td>
            <td><button type='button' class='btn btn-sm btn-danger btn-delete-game' data-id='${id}' data-index='${index}' data-status='${is_deleted}'>
                ${is_deleted == 0 ? "Delete" : "Activate"}
            </button></td>
        </tr>
    `;
    if (whereToPlace != "") {
      document.querySelector(`#${whereToPlace}`).innerHTML = content;
    }
    return content;
  }

  function fillGameForm(game, index) {
    const { id, name, description, publisher_id, genres } = game;
    $("#game_id").val(id);
    $("#game_index").val(index);
    $("#name").val(name);
    $("#description").val(description);
    $("#publishers").val(publisher_id);

    let genresArray = document.querySelectorAll("input[name='genres']");
    genresArray.forEach((genreEl) => {
      let genre_id = genreEl.id;
      let genre_val = genreEl.value;

      document.querySelector(`#${genre_id}`).checked = false;
      genres.forEach((genre) => {
        if (genre == genre_val) {
          document.querySelector(`#${genre_id}`).checked = true;
        }
      });
    });
  }

  // ! dodati regex za name, description i validaciju sa njima
  function gameFormValidation() {
    let name = $("#name").val();
    let description = $("#description").val();
    let publisher = $("#publishers").val();
    let genres = document.querySelectorAll('input[name="genres"]:checked');

    let reText = /^[A-Z][a-z]{1,}$/;
    let errors = [];

    validainteInputElement(
      name,
      reText,
      errors,
      "name_error",
      "Name isn't ok!"
    );
    validainteInputElement(
      description,
      reText,
      errors,
      "description_error",
      "Description isn't ok!"
    );

    validateSelectElement(
      publisher,
      errors,
      "publisher_error",
      "Please choose publisher"
    );

    validateCheckBoxes(
      genres,
      errors,
      "genres_error",
      "Choose at least one genre!"
    );

    return errors;
  }
  // dodati error block
  function getStats() {
    $.ajax({
      type: "get",
      url: "models/other/getStats.php",
      dataType: "json",
      success: function (response) {
        document.contains(document.querySelector("#orderCount"))
          ? (document.querySelector("#orderCount").textContent =
              response.orders.numberOfOrders)
          : "";

        document.contains(document.querySelector("#usersCount"))
          ? (document.querySelector("#usersCount").textContent =
              response.users.numberOfUsers)
          : "";

        document.contains(document.querySelector("#productsCount"))
          ? (document.querySelector("#productsCount").textContent =
              response.games.numberOfGames)
          : "";
        createChart(response.platformVotes);
      },
      error: function (jqXHR, statusTxt, xhr) {
        console.log(jqXHR);
      },
    });
  }

  function createChart(votes) {
    const labels = Object.keys(votes);
    const data = Object.values(votes);

    let sum = data.reduce(function (a, b) {
      return a + b;
    }, 0);

    $("#voteTable").html(tableBody(votes, sum));

    document.contains(document.querySelector("#votesChart"))
      ? new Chart(document.querySelector("#votesChart"), {
          type: "pie",
          data: {
            labels: labels,
            datasets: [
              {
                data: data,
                borderWidth: 1,
              },
            ],
          },
          options: {
            scales: {
              y: {
                beginAtZero: true,
              },
            },
          },
        })
      : "";
  }

  function tableBody(votes, sum) {
    let content = "";
    let votesArray = Object.entries(votes);
    votesArray.forEach((vote) => {
      content += `
        <tr class='border-bottom fw-bold'><td class='text-start '>${vote[0]}</td>
      `;
      if (sum != 0) {
        content += `<td class="text-end ">${vote[1]} (${(
          (vote[1] * 100) /
          sum
        ).toFixed(2)}%)</td>`;
      }
      content += `</tr>`;
    });
    return content;
  }
});
