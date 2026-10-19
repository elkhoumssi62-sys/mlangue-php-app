/* ==========================================================================
   Mlangue.medelkhoumssi — JavaScript de la plateforme (vanilla, sans dépendance)
   Thème clair/sombre · Menu · Filtres instantanés · Onglets · Transcription
   synchronisée · Carnet de vocabulaire · 4 modules d'exercices corrigés
   ========================================================================== */
(function () {
  "use strict";

  var PLAYER_ID = "mlangue-player";
  var CARNET_KEY = "mlangue-carnet";
  var NORMALIZE_RE = /[\u0300-\u036f]/g;

  function $(sel, root) { return (root || document).querySelector(sel); }
  function $$(sel, root) { return Array.prototype.slice.call((root || document).querySelectorAll(sel)); }
  function norm(value) {
    return String(value == null ? "" : value)
      .toLowerCase()
      .normalize("NFD")
      .replace(NORMALIZE_RE, "")
      .replace(/[\u2019\u2018`]/g, "'")
      .replace(/[.,!?;:\u00AB\u00BB"]/g, "")
      .replace(/\s+/g, " ")
      .trim();
  }
  function el(tag, className, text) {
    var node = document.createElement(tag);
    if (className) node.className = className;
    if (text != null) node.textContent = text;
    return node;
  }
  function clock(seconds) {
    var s = Math.max(0, Math.floor(seconds || 0));
    var m = Math.floor(s / 60);
    var r = s % 60;
    function pad(n) { return n < 10 ? "0" + n : String(n); }
    return pad(m) + ":" + pad(r);
  }
  function shuffle(list, seed) {
    var out = list.slice();
    var state = seed || 1;
    function rnd() { state = (state * 1664525 + 1013904223) % 4294967296; return state / 4294967296; }
    for (var i = out.length - 1; i > 0; i -= 1) {
      var j = Math.floor(rnd() * (i + 1));
      var tmp = out[i]; out[i] = out[j]; out[j] = tmp;
    }
    return out;
  }

  /* ------------------------------------------------------- thème clair/sombre */

  var themeBtn = $("[data-theme-toggle]");
  function paintTheme() {
    var dark = document.documentElement.classList.contains("dark");
    if (themeBtn) {
      themeBtn.textContent = dark ? "\u2600\uFE0F" : "\uD83C\uDF19";
      themeBtn.setAttribute("aria-label", dark ? "Activer le mode clair" : "Activer le mode sombre");
    }
  }
  if (themeBtn) {
    themeBtn.addEventListener("click", function () {
      var dark = !document.documentElement.classList.contains("dark");
      document.documentElement.classList.toggle("dark", dark);
      try { localStorage.setItem("mlangue-theme", dark ? "dark" : "light"); } catch (e) {}
      paintTheme();
    });
  }
  paintTheme();

  /* ------------------------------------------------------------------- menu */

  var menuBtn = $("[data-menu-toggle]");
  var menu = $("#menu-mobile");
  if (menuBtn && menu) {
    menuBtn.addEventListener("click", function () {
      var open = menu.hidden;
      menu.hidden = !open;
      menuBtn.setAttribute("aria-expanded", open ? "true" : "false");
      menuBtn.textContent = open ? "\u2715" : "\u2630";
    });
  }

  /* ------------------------------------------------------ lecteur multimédia */

  function player() { return document.getElementById(PLAYER_ID); }

  function seek(seconds) {
    var media = player();
    if (!media) return;
    var target = Number(seconds) || 0;
    try {
      if (media.readyState >= 1) { media.currentTime = target; }
      else { media.addEventListener("loadedmetadata", function once() { media.currentTime = target; media.removeEventListener("loadedmetadata", once); }); }
    } catch (e) {}
    var p = media.play();
    if (p && typeof p.catch === "function") { p.catch(function () {}); }
  }

  $$("[data-seek]").forEach(function (btn) {
    btn.addEventListener("click", function () { seek(btn.getAttribute("data-seek")); });
  });

  var media = player();
  if (media) {
    var speed = $("#player-speed");
    var loop = $("#player-loop");
    if (speed) speed.addEventListener("change", function () { media.playbackRate = Number(speed.value) || 1; });
    if (loop) loop.addEventListener("change", function () { media.loop = loop.checked; });

    var transcriptButtons = $$(".transcript button[data-start]");
    if (transcriptButtons.length) {
      var marks = transcriptButtons.map(function (btn) { return Number(btn.getAttribute("data-start")) || 0; });
      media.addEventListener("timeupdate", function () {
        var current = media.currentTime + 0.2;
        var index = 0;
        for (var i = 0; i < marks.length; i += 1) { if (current >= marks[i]) index = i; }
        transcriptButtons.forEach(function (btn, i) {
          btn.classList.toggle("is-active", i === index);
        });
      });
    }
    var printBtn = $("[data-print]");
    if (printBtn) printBtn.addEventListener("click", function () { window.print(); });
  }

  /* ------------------------------------------------------------ carnet de mots */

  function readCarnet() {
    try { return JSON.parse(localStorage.getItem(CARNET_KEY) || "[]"); } catch (e) { return []; }
  }
  function writeCarnet(list) {
    try { localStorage.setItem(CARNET_KEY, JSON.stringify(list)); } catch (e) {}
  }
  function paintCarnet() {
    var list = readCarnet();
    $$("[data-carnet-count]").forEach(function (node) { node.textContent = String(list.length); });
    $$(".vocab-item").forEach(function (item) {
      var term = item.getAttribute("data-term");
      var btn = $(".carnet-toggle", item);
      if (!btn) return;
      var saved = list.indexOf(term) !== -1;
      btn.setAttribute("aria-pressed", saved ? "true" : "false");
      btn.textContent = saved ? "\u2605" : "\u2606";
    });
  }
  $$(".carnet-toggle").forEach(function (btn) {
    btn.addEventListener("click", function () {
      var item = btn.closest(".vocab-item");
      var term = item ? item.getAttribute("data-term") : "";
      var list = readCarnet();
      var index = list.indexOf(term);
      if (index === -1) { list.push(term); } else { list.splice(index, 1); }
      writeCarnet(list);
      paintCarnet();
    });
  });
  $$(".vocab-more").forEach(function (btn) {
    btn.addEventListener("click", function () {
      var example = btn.parentNode.querySelector(".vocab-example");
      if (!example) return;
      var open = example.classList.toggle("is-open");
      btn.setAttribute("aria-expanded", open ? "true" : "false");
      btn.textContent = open ? "Masquer l'exemple" : "Voir un exemple";
    });
  });
  paintCarnet();

  /* --------------------------------------------------------------- onglets */

  $$("[data-tabs]").forEach(function (widget) {
    var tabs = $$("[role=tab]", widget);
    var initial = new URLSearchParams(window.location.search).get("onglet");
    if (initial) {
      tabs.forEach(function (tab) {
        if (tab.getAttribute("id") === "tab-" + initial) { activate(tab); }
      });
    }
    function activate(tab) {
      tabs.forEach(function (other) {
        var selected = other === tab;
        other.setAttribute("aria-selected", selected ? "true" : "false");
        other.tabIndex = selected ? 0 : -1;
        var panel = document.getElementById(other.getAttribute("aria-controls"));
        if (panel) panel.hidden = !selected;
      });
    }
    tabs.forEach(function (tab, index) {
      tab.addEventListener("click", function () { activate(tab); });
      tab.addEventListener("keydown", function (event) {
        var next = null;
        if (event.key === "ArrowRight") next = (index + 1) % tabs.length;
        else if (event.key === "ArrowLeft") next = (index - 1 + tabs.length) % tabs.length;
        else if (event.key === "Home") next = 0;
        else if (event.key === "End") next = tabs.length - 1;
        if (next === null) return;
        event.preventDefault();
        activate(tabs[next]);
        tabs[next].focus();
      });
    });
  });

  /* ------------------------------------------- filtres instantanés (accueil) */

  var levelButtons = $$("[data-level][aria-pressed]");
  var themeButtons = $$("[data-theme][aria-pressed]");
  var textInput = $("[data-filter-text]");
  var listNode = $("[data-filter-list]");
  var countNode = $("[data-filter-count]");
  var noneNode = $("[data-filter-none]");
  var resetNode = $("[data-filter-reset]");

  if (listNode && (levelButtons.length || themeButtons.length || textInput)) {
    var state = { level: null, theme: null, text: "" };

    function applyFilters() {
      var visible = 0;
      $$("li", listNode).forEach(function (item) {
        var okLevel = !state.level || item.getAttribute("data-level") === state.level;
        var okTheme = !state.theme || item.getAttribute("data-theme") === state.theme;
        var hay = item.getAttribute("data-search") || "";
        var okText = !state.text || hay.indexOf(state.text) !== -1;
        var show = okLevel && okTheme && okText;
        item.hidden = !show;
        if (show) visible += 1;
      });
      if (countNode) countNode.textContent = String(visible);
      if (noneNode) noneNode.hidden = visible !== 0;
      if (resetNode) resetNode.hidden = !(state.level || state.theme || state.text);
      levelButtons.forEach(function (btn) {
        btn.setAttribute("aria-pressed", btn.getAttribute("data-level") === state.level ? "true" : "false");
      });
      themeButtons.forEach(function (btn) {
        btn.setAttribute("aria-pressed", btn.getAttribute("data-theme") === state.theme ? "true" : "false");
      });
    }

    levelButtons.forEach(function (btn) {
      btn.addEventListener("click", function () {
        state.level = state.level === btn.getAttribute("data-level") ? null : btn.getAttribute("data-level");
        applyFilters();
      });
    });
    themeButtons.forEach(function (btn) {
      btn.addEventListener("click", function () {
        state.theme = state.theme === btn.getAttribute("data-theme") ? null : btn.getAttribute("data-theme");
        applyFilters();
      });
    });
    if (textInput) {
      textInput.addEventListener("input", function () {
        state.text = norm(textInput.value);
        applyFilters();
      });
    }
    if (resetNode) {
      resetNode.addEventListener("click", function () {
        state.level = null; state.theme = null; state.text = "";
        if (textInput) textInput.value = "";
        applyFilters();
      });
    }
  }

  /* ------------------------------------------------------------- newsletter */

  $$("[data-newsletter]").forEach(function (form) {
    var status = $(".newsletter-status", form);
    form.addEventListener("submit", function (event) {
      event.preventDefault();
      var email = $("input[type=email]", form);
      if (!email || !email.value) {
        if (status) status.textContent = "Merci d'indiquer une adresse e-mail.";
        return;
      }
      if (status) status.textContent = "Envoi\u2026";
      fetch(form.getAttribute("action"), {
        method: "POST",
        headers: { "Content-Type": "application/json", "X-CSRF-Token": $("input[name=csrf]", form).value },
        body: JSON.stringify({
          email: email.value,
          profile: ($("select[name=profile]", form) || {}).value || "apprenant",
          level: ($("select[name=level]", form) || {}).value || "B1"
        })
      }).then(function (res) { return res.json(); }).then(function (data) {
        if (!status) return;
        if (!data.ok) { status.textContent = data.error || "Une erreur est survenue."; return; }
        status.textContent = data.already
          ? "Cette adresse est d\u00E9j\u00E0 abonn\u00E9e \u00E0 la lettre du dimanche."
          : "Merci ! Votre premi\u00E8re lettre arrive dimanche.";
        email.value = "";
      }).catch(function () {
        if (status) status.textContent = "Impossible de contacter le serveur.";
      });
    });
  });

  /* ============================== MODULES D'EXERCICES ====================== */

  var dataNode = document.getElementById("mlangue-exercises");
  var slugNode = document.querySelector("[data-exercise-list]");

  function score(exercise, correct, total) {
    var pct = total > 0 ? Math.round((correct / total) * 100) : 0;
    var badge = $("[data-exercise-score]", exercise);
    if (badge) {
      badge.hidden = false;
      badge.textContent = correct + "/" + total + " \u00B7 " + pct + " %";
      badge.classList.toggle("is-partial", correct !== total);
    }
    refreshProgress();
    var slug = window.MLANGUE_SLUG || (document.body.getAttribute("data-slug") || "");
    if (slug) {
      fetch("/api/attempt", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          resourceSlug: slug,
          exerciseId: Number(exercise.getAttribute("data-exercise")),
          exerciseType: exercise.getAttribute("data-type"),
          correct: correct,
          total: total
        })
      }).catch(function () {});
    }
  }

  function refreshProgress() {
    var list = $$("[data-exercise]", document);
    var total = 0, correct = 0, done = 0;
    list.forEach(function (exercise) {
      var store = exercise.__score;
      if (!store) return;
      done += 1;
      total += store.total;
      correct += store.correct;
    });
    var pct = total > 0 ? Math.round((correct / total) * 100) : 0;
    var track = $("[data-progress]");
    var bar = $("[data-progress-bar]");
    var label = $("[data-progress-label]");
    if (bar) bar.style.width = pct + "%";
    if (track) track.setAttribute("aria-valuenow", String(pct));
    if (label) label.textContent = done + "/" + list.length + " exercices \u00B7 " + correct + "/" + total + " points";
    if (done > 0 && done === list.length) {
      var card = $(".result-card");
      if (!card) {
        card = el("div", "card result-card");
        card.appendChild(el("p", "", pct + " % de r\u00E9ussite")).style.fontFamily = "var(--font-display)";
        card.appendChild(el("p", "muted", pct >= 80
          ? "Excellent ! Vous pouvez passer au niveau sup\u00E9rieur."
          : "R\u00E9\u00E9coutez le document en lisant la transcription, puis recommencez."));
        if (label) label.closest(".tabpanel").appendChild(card);
      } else {
        card.firstChild.textContent = pct + " % de r\u00E9ussite";
      }
    }
  }

  function storeScore(exercise, correct, total) {
    exercise.__score = { correct: correct, total: total };
    score(exercise, correct, total);
  }

  function clearMarks(root) {
    $$(".is-correct, .is-wrong", root).forEach(function (node) {
      node.classList.remove("is-correct", "is-wrong");
    });
    $$(".feedback", root).forEach(function (node) { node.remove(); });
    $$(".blank-list li", root).forEach(function (node) { node.remove(); });
    var solution = $(".order-solution", root);
    if (solution) solution.remove();
  }

  /* ------------------------------------------------------------------- QCM */

  function buildQcm(exercise, payload) {
    var root = el("div");
    var picked = payload.questions.map(function () { return -1; });

    payload.questions.forEach(function (question, qi) {
      var box = el("div", "question");
      var title = el("p", "q-title", (qi + 1) + ". " + question.text);
      box.appendChild(title);
      var groupId = "qcm-" + exercise.getAttribute("data-exercise") + "-" + qi;

      question.options.forEach(function (option, oi) {
        var label = el("label", "option");
        var input = document.createElement("input");
        input.type = "radio";
        input.name = groupId;
        input.value = String(oi);
        input.addEventListener("change", function () {
          picked[qi] = oi;
          clearMarks(root);
          $$(".option", root).forEach(function (node) { node.classList.remove("is-picked"); });
          label.classList.add("is-picked");
        });
        label.appendChild(input);
        label.appendChild(el("span", "", option.text));
        box.appendChild(label);
      });
      root.appendChild(box);
    });

    return {
      root: root,
      check: function () {
        clearMarks(root);
        var correct = 0;
        payload.questions.forEach(function (question, qi) {
          var labels = $$(".option", root.children[qi]);
          var choice = picked[qi];
          labels.forEach(function (label, oi) {
            label.classList.remove("is-correct", "is-wrong");
            if (question.options[oi].correct && choice !== -1) {
              label.classList.add("is-correct");
            }
            if (oi === choice && choice !== -1) {
              var mark = el("span", "option-mark " + (question.options[oi].correct ? "ok" : "ko"),
                question.options[oi].correct ? "\u2713" : "\u2715");
              label.appendChild(mark);
              if (!question.options[oi].correct) label.classList.add("is-wrong");
              var feedback = el("p", "feedback " + (question.options[oi].correct ? "ok" : "ko"),
                (question.options[oi].correct ? "Bien jou\u00E9 ! " : "Pas tout \u00E0 fait. ") + question.options[oi].feedback);
              root.children[qi].appendChild(feedback);
            }
          });
          if (choice !== -1 && question.options[choice].correct) correct += 1;
        });
        return { correct: correct, total: payload.questions.length };
      },
      reset: function () {
        clearMarks(root);
        picked = payload.questions.map(function () { return -1; });
        $$("input[type=radio]", root).forEach(function (input) { input.checked = false; });
        $$(".option", root).forEach(function (node) { node.classList.remove("is-picked"); });
      }
    };
  }

  /* --------------------------------------------------------- texte à trous */

  function buildCloze(exercise, payload) {
    var root = el("div");
    var values = payload.blanks.map(function () { return ""; });
    var inputs = [];

    if (payload.wordBank && payload.wordBank.length) {
      var bank = el("div", "wordbank");
      bank.appendChild(el("p", "wordbank-title", "Banque de mots"));
      var bankList = el("ul");
      payload.wordBank.forEach(function (word) { bankList.appendChild(el("li", "", word)); });
      bank.appendChild(bankList);
      root.appendChild(bank);
    }

    var cloze = el("div", "cloze");
    payload.text.split("\n").forEach(function (line) {
      var p = el("p");
      var parts = line.split("___");
      var cursor = 0;
      parts.forEach(function (part, pi) {
        p.appendChild(document.createTextNode(part));
        if (pi === parts.length - 1) return;
        var index = cursor;
        cursor += 1;
        var wrap = el("span", "blank");
        var input = document.createElement("input");
        input.type = "text";
        input.setAttribute("aria-label", "Trou " + (index + 1));
        input.addEventListener("input", function () {
          values[index] = input.value;
          input.classList.remove("is-correct", "is-wrong");
        });
        wrap.appendChild(input);
        wrap.appendChild(el("span", "blank-hint", "\uD83D\uDCA1 " + payload.blanks[index].hint));
        inputs[index] = input;
        p.appendChild(wrap);
      });
      cloze.appendChild(p);
    });
    root.appendChild(cloze);

    var list = el("ul", "blank-list");
    root.appendChild(list);

    return {
      root: root,
      check: function () {
        clearMarks(root);
        var correct = 0;
        payload.blanks.forEach(function (blank, i) {
          var ok = blank.answers.some(function (answer) { return norm(answer) === norm(values[i]); });
          if (ok) correct += 1;
          if (inputs[i]) inputs[i].classList.add(ok ? "is-correct" : "is-wrong");
          var text = "Trou " + (i + 1) + " \u2014 " + (ok ? "correct." : "\u00E0 revoir.") + " " + blank.explanation;
          if (!ok) text += " R\u00E9ponse(s) : " + blank.answers.join(" / ") + ".";
          list.appendChild(el("li", ok ? "ok" : "ko", text));
        });
        return { correct: correct, total: payload.blanks.length };
      },
      reset: function () {
        clearMarks(root);
        values = payload.blanks.map(function () { return ""; });
        inputs.forEach(function (input) { if (input) input.value = ""; });
      }
    };
  }

  /* ------------------------------------------------------- glisser-déposer */

  function buildDragDrop(exercise, payload) {
    var root = el("div");
    var placed = {};
    payload.items.forEach(function (item) { placed[item.id] = null; });
    var picked = null;

    var pool = el("div", "drag-pool");
    var poolTitle = el("p", "drag-pool-title", "");
    pool.appendChild(poolTitle);
    var poolList = el("ul");
    pool.appendChild(poolList);
    pool.appendChild(el("p", "drag-help", "Glissez une \u00E9tiquette dans une colonne, ou cliquez dessus puis sur la colonne choisie."));
    root.appendChild(pool);

    var grid = el("div", "drop-grid");
    var zones = {};
    payload.categories.forEach(function (category) {
      var zone = el("div", "drop-zone");
      zone.setAttribute("data-zone", category.id);
      zone.appendChild(el("h4", "", category.label));
      zone.appendChild(el("p", "drop-hint", category.hint));
      var items = el("ul", "drop-items");
      zone.appendChild(items);
      zones[category.id] = items;

      zone.addEventListener("dragover", function (event) {
        event.preventDefault();
        zone.classList.add("is-over");
      });
      zone.addEventListener("dragleave", function () { zone.classList.remove("is-over"); });
      zone.addEventListener("drop", function (event) {
        event.preventDefault();
        zone.classList.remove("is-over");
        var id = event.dataTransfer.getData("text/plain");
        if (id) { placed[id] = category.id; picked = null; paint(); }
      });
      zone.addEventListener("click", function () {
        if (picked) { placed[picked] = category.id; picked = null; paint(); }
      });
      grid.appendChild(zone);
    });
    root.appendChild(grid);

    function paint() {
      poolList.textContent = "";
      var remaining = payload.items.filter(function (item) { return !placed[item.id]; });
      poolTitle.textContent = "\u00C0 classer (" + remaining.length + ")";
      if (!remaining.length) {
        poolList.appendChild(el("li", "muted", "Tous les \u00E9l\u00E9ments sont plac\u00E9s. Cliquez sur \u00AB V\u00E9rifier \u00BB."));
      }
      remaining.forEach(function (item) {
        var li = el("li");
        var btn = el("button", "drag-item" + (picked === item.id ? " is-picked" : ""), item.text);
        btn.type = "button";
        btn.draggable = true;
        btn.setAttribute("aria-pressed", picked === item.id ? "true" : "false");
        btn.addEventListener("dragstart", function (event) { event.dataTransfer.setData("text/plain", item.id); });
        btn.addEventListener("click", function () { picked = picked === item.id ? null : item.id; paint(); });
        li.appendChild(btn);
        poolList.appendChild(li);
      });

      Object.keys(zones).forEach(function (categoryId) {
        zones[categoryId].textContent = "";
        var inside = payload.items.filter(function (item) { return placed[item.id] === categoryId; });
        if (!inside.length) {
          zones[categoryId].appendChild(el("li", "drop-empty", "D\u00E9posez ici"));
        }
        inside.forEach(function (item) {
          var li = el("li");
          var row = el("span", "placed", item.text);
          var remove = el("button", "", "\u2715");
          remove.type = "button";
          remove.setAttribute("aria-label", "Retirer " + item.text);
          remove.addEventListener("click", function (event) {
            event.stopPropagation();
            placed[item.id] = null;
            root.classList.remove("checked");
            paint();
          });
          row.appendChild(remove);
          if (root.classList.contains("checked")) {
            row.classList.add(item.categoryId === categoryId ? "is-correct" : "is-wrong");
          }
          li.appendChild(row);
          zones[categoryId].appendChild(li);
        });
      });
    }
    paint();

    return {
      root: root,
      check: function () {
        root.classList.add("checked");
        paint();
        var correct = payload.items.filter(function (item) { return placed[item.id] === item.categoryId; }).length;
        return { correct: correct, total: payload.items.length };
      },
      reset: function () {
        payload.items.forEach(function (item) { placed[item.id] = null; });
        picked = null;
        root.classList.remove("checked");
        paint();
      }
    };
  }

  /* ------------------------------------------------------------ réordonner */

  function buildOrdering(exercise, payload, seed) {
    var root = el("div");
    var grid = el("div", "order-grid");
    var source = el("div", "order-source");
    source.appendChild(el("p", "drop-title", "\u00C9l\u00E9ments propos\u00E9s"));
    var sourceList = el("ul");
    source.appendChild(sourceList);
    var target = el("div");
    target.appendChild(el("p", "drop-title", "Votre ordre"));
    var seq = el("ol", "order-seq");
    target.appendChild(seq);
    grid.appendChild(source);
    grid.appendChild(target);
    root.appendChild(grid);

    var order = [];
    var pool = shuffle(payload.items.map(function (item) { return item.id; }), seed);

    function paint() {
      sourceList.textContent = "";
      var remaining = pool.filter(function (id) { return order.indexOf(id) === -1; });
      if (!remaining.length) {
        sourceList.appendChild(el("li", "muted", "Tous les \u00E9l\u00E9ments sont utilis\u00E9s."));
      }
      remaining.forEach(function (id) {
        var item = payload.items.filter(function (x) { return x.id === id; })[0];
        var li = el("li");
        var btn = el("button", "", item.text);
        btn.type = "button";
        btn.addEventListener("click", function () { order.push(id); paint(); });
        li.appendChild(btn);
        sourceList.appendChild(li);
      });

      seq.textContent = "";
      if (!order.length) {
        var empty = el("li", "drop-empty", "Cliquez les \u00E9l\u00E9ments pour construire la s\u00E9quence");
        seq.appendChild(empty);
      }
      order.forEach(function (id, i) {
        var item = payload.items.filter(function (x) { return x.id === id; })[0];
        var li = el("li");
        var indexNode = el("span", "order-index", String(i + 1));
        var textNode = el("span", "order-text", item.text);
        var tools = el("span", "order-tools");
        var up = el("button", "", "\u25B2");
        up.type = "button";
        up.setAttribute("aria-label", "Monter \u00AB " + item.text + " \u00BB");
        up.addEventListener("click", function () {
          if (i === 0) return;
          var tmp = order[i - 1]; order[i - 1] = order[i]; order[i] = tmp;
          paint();
        });
        var remove = el("button", "", "\u2715");
        remove.type = "button";
        remove.setAttribute("aria-label", "Supprimer \u00AB " + item.text + " \u00BB");
        remove.addEventListener("click", function () {
          order = order.filter(function (x) { return x !== id; });
          paint();
        });
        tools.appendChild(up);
        tools.appendChild(remove);
        li.appendChild(indexNode);
        li.appendChild(textNode);
        li.appendChild(tools);
        seq.appendChild(li);
      });
    }
    paint();

    return {
      root: root,
      check: function () {
        var correct = 0;
        $$(".order-index", seq).forEach(function (node, i) {
          var ok = payload.items[i] && payload.items[i].id === order[i];
          node.classList.add(ok ? "ok" : "ko");
          if (ok) correct += 1;
        });
        $$(".order-text", seq).forEach(function (node, i) {
          var ok = payload.items[i] && payload.items[i].id === order[i];
          node.classList.add(ok ? "is-correct" : "is-wrong");
        });
        var solution = el("p", "order-solution", "Ordre attendu : " +
          payload.items.map(function (item) { return item.text; }).join(" "));
        root.appendChild(solution);
        return { correct: correct, total: payload.items.length };
      },
      reset: function () {
        order = [];
        root.classList.remove("checked");
        paint();
      }
    };
  }

  /* ------------------------------------------------------------- assemblage */

  if (dataNode && slugNode) {
    var exercises = [];
    try { exercises = JSON.parse(dataNode.textContent || "[]"); } catch (e) { exercises = []; }

    exercises.forEach(function (data, index) {
      var exercise = $('[data-exercise="' + data.id + '"]');
      if (!exercise) return;
      var body = $("[data-exercise-body]", exercise);
      if (!body) return;

      var module = null;
      if (data.type === "qcm") module = buildQcm(exercise, data.payload);
      else if (data.type === "texte-trous") module = buildCloze(exercise, data.payload);
      else if (data.type === "glisser-deposer") module = buildDragDrop(exercise, data.payload);
      else if (data.type === "reordonner") module = buildOrdering(exercise, data.payload, data.id * 977 + 13);

      if (!module) return;
      body.appendChild(module.root);

      var checkBtn = $("[data-check]", exercise);
      var resetBtn = $("[data-reset]", exercise);
      if (checkBtn) {
        checkBtn.addEventListener("click", function () {
          var result = module.check();
          storeScore(exercise, result.correct, result.total);
        });
      }
      if (resetBtn) {
        resetBtn.addEventListener("click", function () {
          delete exercise.__score;
          var badge = $("[data-exercise-score]", exercise);
          if (badge) { badge.hidden = true; badge.textContent = ""; }
          module.reset();
          refreshProgress();
        });
      }
      void index;
    });

    var checkAll = $("[data-check-all]");
    if (checkAll) {
      checkAll.addEventListener("click", function () {
        exercises.forEach(function (data) {
          var exercise = $('[data-exercise="' + data.id + '"]');
          if (!exercise || exercise.__score) return;
          var btn = $("[data-check]", exercise);
          if (btn) btn.click();
        });
      });
    }
    var resetAll = $("[data-reset-all]");
    if (resetAll) {
      resetAll.addEventListener("click", function () {
        exercises.forEach(function (data) {
          var exercise = $('[data-exercise="' + data.id + '"]');
          if (!exercise) return;
          var btn = $("[data-reset]", exercise);
          if (btn) btn.click();
        });
      });
    }
  }
})();
