$(document).on("click", ".btn-logout", function (e) {
  e.preventDefault();

  $.confirm({
    title: '<i class="text-warning fa fa-info-circle"></i> Logout from Admin!',
    content: "Yakin ingin keluar?",
    buttons: {
      Ya: {
        text: "OK",
        keys: ["enter"],
        btnClass: "btn-blue btn-xs",
        action: function () {
          window.location = base_url + "backend/auth/logout";
        },
      },
      Batal: {},
    },
  });
});

// KONFIGURASI MEMUAT HALAMAN

function isValidHttpUrl(string) {
  let url;
  try {
    url = new URL(string);
  } catch (_) {
    return false;
  }
  return url.protocol === "http:" || url.protocol === "https:";
}
$(document).on("click", ".histori", function (event) {
  event.preventDefault();
  loadPage(histori, true);
});

$(document).on("click", ".route-link", function (event) {
  event.preventDefault();
  histori = "";
  $(".nav-item .nav-link").removeClass("active");
  $(".nav-item .nav-link .icon")
    .removeClass("text-white")
    .addClass("text-gray");
  $(".nav-item .nav-link").attr("aria-expanded", "false");
  $(".nav-item .collapse").removeClass("show");
  $(".route-link").removeClass("active");
  $(".route-link .icon").removeClass("text-white").addClass("text-gray");
  $(this)
    .closest(".collapse")
    .parent()
    .children(":first")
    .attr("aria-expanded", "true");
  $(this).closest(".collapse").addClass("show");
  $(this).closest(".collapse").parent().children(":first").addClass("active");
  $(this)
    .closest(".collapse")
    .parent()
    .children(":first")
    .children(":first")
    .removeClass("text-gray")
    .addClass("text-white");
  $(this).addClass("active");
  $(this).children(":first").removeClass("text-gray").addClass("text-white");
  // console.log($(this).closest(".nav-item .nav-link"));
  // $(".sidebar-menu li").removeClass("active");
  // var li = $(this).closest("li");
  // li.addClass("active");

  // if (!li.hasClass("treeview")) {
  loadPage($(this).attr("href"));
  // }
});

$(document).on("click", ".a-spa, #btn_create", function (event) {
  event.preventDefault();
  loadPage($(this).attr("href"), true);
});
$(document).on("click", ".breadcrumb-spa, #btn_create", function (event) {
  event.preventDefault();
  loadPage($(this).attr("href"), true);
});

function loadPage(lnk, noSidebar, data, histori_link) {
  if (histori_link) histori = window.location.href;
  $.ajax({
    url: lnk,
    type: "GET",
    data: data,
    success: function (e) {
      if (e.status) {
        if (e.isLogin == true) {
          location.reload();
        } else {
          $("#konten").html(e.html);
          breadcrumb(e.breadcrumb);
          history.pushState({ urlPath: lnk }, "", lnk);
        }
      } else {
        handleToast("error", data.message);
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert("Halaman tidak ditemukan");
    },
  });
  return false;
}

function parseURLParams(url) {
  var queryStart = url.indexOf("?") + 1,
    queryEnd = url.indexOf("#") + 1 || url.length + 1,
    query = url.slice(queryStart, queryEnd - 1),
    pairs = query.replace(/\+/g, " ").split("&"),
    parms = {},
    i,
    n,
    v,
    nv;

  if (query === url || query === "") return;

  for (i = 0; i < pairs.length; i++) {
    nv = pairs[i].split("=", 2);
    n = decodeURIComponent(nv[0]);
    v = decodeURIComponent(nv[1]);

    if (!parms.hasOwnProperty(n)) parms[n] = [];
    parms[n].push(nv.length === 2 ? v : null);
  }
  return parms;
}

window.onpopstate = function (event) {
  event.preventDefault();
  loadPage(document.location, true);
};

function backPrevious() {
  window.history.go(-1);
  return false;
}

function saveData(url, btnId = "btnSave", formId = "form") {
  $(`#${btnId}`).text("Saving...");
  $(`#${btnId}`).attr("disabled", true);
  $.ajax({
    url: url,
    type: "POST",
    data: $(`#${formId}`).serialize(),
    dataType: "json",
    success: function (data) {
      if (data.status) {
        backPrevious();
        handleToast("success", data.message);
      } else {
        handleError(data);
      }
      $(`#${btnId}`).text("Save");
      $(`#${btnId}`).attr("disabled", false);
    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert("Error adding  data");
      $(`#${btnId}`).text("Save");
      $(`#${btnId}`).attr("disabled", false);
    },
  });

  $("#form input, #form textarea").on("keyup", function () {
    $(this).removeClass("is-valid is-invalid");
  });
  $("#form select").on("change", function () {
    $(this).removeClass("is-valid is-invalid");
  });
}     
