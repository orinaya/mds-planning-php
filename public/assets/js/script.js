// SIDEBAR + ACCORDION
function toggleAccordion(id) {
  const submenu = document.getElementById(id);
  if (!submenu) return;

  submenu.classList.toggle("hidden");

  const button = submenu.previousElementSibling;
  if (button) button.classList.toggle("active");
}

function toggleSidebar() {
  const sidebar = document.getElementById("sidebar");
  const mainContent = document.getElementById("main-content");
  if (!sidebar || !mainContent) return;

  sidebar.classList.toggle("collapsed");
  mainContent.classList.toggle("sidebar-collapsed");

  if (sidebar.classList.contains("collapsed")) {
    document.querySelectorAll(".submenu").forEach((menu) => menu.classList.add("hidden"));
    document.querySelectorAll(".accordion-btn").forEach((btn) => btn.classList.remove("active"));
  }
}

// DRAG & DROP
function allowDrop(ev) {
  ev.preventDefault();
}

function drag(ev) {
  ev.dataTransfer.setData("moduleId", ev.target.id);
}

function drop(ev) {
  ev.preventDefault();
  const moduleId = ev.dataTransfer.getData("moduleId");
  const moduleElement = document.getElementById(moduleId);
  const dropTarget = ev.target;

  if (dropTarget.classList.contains("calendar-half")) {
    const newModule = document.createElement("div");
    newModule.classList.add("dropped-module");
    newModule.innerText = moduleElement.innerText;
    newModule.setAttribute("data-module-id", moduleId);
    dropTarget.appendChild(newModule);
  }
}

document.addEventListener("DOMContentLoaded", () => {
  // Toggle sidebar
  const toggleBtn = document.getElementById("toggle-sidebar");
  toggleBtn?.addEventListener("click", toggleSidebar);

  // Accordion toggle
  document.querySelectorAll(".accordion-toggle").forEach((toggle) => {
    toggle.addEventListener("click", () => {
      toggle.nextElementSibling.classList.toggle("show");
    });
  });

  // Drag modules depuis la liste
  document.querySelectorAll(".module").forEach((mod) => {
    mod.addEventListener("dragstart", (e) => {
      e.dataTransfer.setData("module-id", mod.dataset.moduleId || mod.dataset.id);
    });
  });

  // Drop zones calendrier
  document.querySelectorAll(".morning, .afternoon").forEach((zone) => {
    zone.addEventListener("dragover", (e) => e.preventDefault());
    zone.addEventListener("drop", (e) => {
      e.preventDefault();
      const moduleId = e.dataTransfer.getData("module-id");
      alert(`Ajout module ID : ${moduleId}`);
    });
  });

  // DRAG depuis liste vers calendrier
  const modules = document.querySelectorAll(".module");
  const calendar = document.getElementById("calendar");

  modules.forEach((module) => {
    module.addEventListener("dragstart", handleDragStart);
  });

  function handleDragStart(e) {
    e.dataTransfer.setData("text/plain", e.target.dataset.id);
    e.target.classList.add("dragging");
    setTimeout(() => e.target.classList.remove("dragging"), 0);
  }

  calendar?.addEventListener("dragover", (e) => {
    e.preventDefault();
    calendar.classList.add("drag-over");
  });

  calendar?.addEventListener("dragleave", () => {
    calendar.classList.remove("drag-over");
  });

  // Recherche modules
  const searchInput = document.getElementById("searchInput");
  searchInput?.addEventListener("input", function () {
    const searchTerm = this.value.toLowerCase();
    modules.forEach((module) => {
      const title = module.querySelector(".module-title").textContent.toLowerCase();
      module.style.display = title.includes(searchTerm) ? "block" : "none";
    });
  });

  // MODAL MODULE
  const addModuleBtn = document.getElementById("addModuleBtn");
  const modal = document.getElementById("moduleModal");
  const closeBtn = document.querySelector(".close-btn");
  const cancelBtn = document.getElementById("cancelBtn");
  const moduleForm = document.getElementById("moduleForm");

  addModuleBtn?.addEventListener("click", () => (modal.style.display = "flex"));
  closeBtn?.addEventListener("click", () => (modal.style.display = "none"));
  cancelBtn?.addEventListener("click", () => (modal.style.display = "none"));

  window.addEventListener("click", (e) => {
    if (e.target === modal) modal.style.display = "none";
  });

  moduleForm?.addEventListener("submit", function (e) {
    e.preventDefault();
    const name = document.getElementById("moduleName").value;
    const color = document.getElementById("moduleColor").value;
    const isOption = document.getElementById("moduleOption").checked;
    const id = Date.now();

    const moduleHTML = `<li class="module" style="border: 2px solid ${color}" draggable="true" data-id="${id}">
      <div style="background-color: ${color}; filter: brightness(1.3); padding: 10px; border-radius: 8px;">
        <div class="module-head">
          <span class="module-title">${name}</span>
          ${isOption ? '<span class="module-option">Option</span>' : ""}
          <span class="module-id">ID: ${id}</span>
        </div>
        <div class="module-body">
          <div class="module-duration"><span class="icon-clock"></span>${id}h</div>
          <div>Delta: 2</div>
        </div>
      </div></li>`;

    document.getElementById("modules").insertAdjacentHTML("beforeend", moduleHTML);
    document.querySelector(`.module[data-id="${id}"]`).addEventListener("dragstart", handleDragStart);

    modal.style.display = "none";
    moduleForm.reset();
  });
});

// MULTISELECT CLASSES
const input = document.getElementById("classInput");
const suggestions = document.getElementById("suggestions");
const multiSelect = document.getElementById("multiSelect");
const selectedValues = new Set();
const hiddenInput = document.getElementById("selectedClasses");

input?.addEventListener("input", () => {
  const value = input.value.toLowerCase();
  suggestions.innerHTML = "";
  const filtered = classes.filter((c) => c.toLowerCase().includes(value) && !selectedValues.has(c));
  if (filtered.length > 0 && value.length > 0) {
    suggestions.style.display = "block";
    filtered.forEach((item) => {
      const li = document.createElement("li");
      li.textContent = item;
      li.onclick = () => selectItem(item);
      suggestions.appendChild(li);
    });
  } else {
    suggestions.style.display = "none";
  }
});

function selectItem(value) {
  selectedValues.add(value);
  const tag = document.createElement("span");
  tag.className = "multi-tag";
  tag.innerHTML = `${value} <button onclick="removeTag(this, '${value}')">&times;</button>`;
  multiSelect.appendChild(tag);
  updateHiddenInput();
  input.value = "";
  suggestions.style.display = "none";
}

function removeTag(btn, value) {
  selectedValues.delete(value);
  btn.parentElement.remove();
  updateHiddenInput();
}

function updateHiddenInput() {
  hiddenInput.value = Array.from(selectedValues).join(",");
}

document.addEventListener("click", (e) => {
  if (!document.getElementById("classSelector").contains(e.target)) {
    suggestions.style.display = "none";
  }
});

// MODAL
document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById("genericModal");
  const modalTitle = document.getElementById("genericModalTitle");
  const modalIcon = document.getElementById("genericModalIcon");
  const modalBody = document.getElementById("genericModalBody");
  const closeBtn = document.getElementById("genericModalClose");
  const cancelBtn = document.getElementById("genericModalCancel");
  const form = document.getElementById("genericModalForm");

  let onSubmitCallback = null;

  window.openGenericModal = function ({ title, icon, bodyHtml, onSubmit }) {
    modalTitle.textContent = title;
    modalIcon.className = `icon ${icon}`;
    modalBody.innerHTML = bodyHtml;
    onSubmitCallback = onSubmit;
    modal.style.display = "flex";
  };

  function closeModal() {
    modal.style.display = "none";
    modalBody.innerHTML = "";
    form.reset();
    onSubmitCallback = null;
  }

  closeBtn?.addEventListener("click", closeModal);
  cancelBtn?.addEventListener("click", (e) => {
    e.preventDefault();
    closeModal();
  });

  window.addEventListener("click", (e) => {
    if (e.target === modal) closeModal();
  });

  form?.addEventListener("submit", (e) => {
    e.preventDefault();
    if (onSubmitCallback && typeof onSubmitCallback === "function") {
      onSubmitCallback(new FormData(form));
    }
    closeModal();
  });
});

//
document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".session-accordion-toggle").forEach((toggle) => {
    toggle.addEventListener("click", () => {
      toggle.nextElementSibling.classList.toggle("show");
    });
  });
});
