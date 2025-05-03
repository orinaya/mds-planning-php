
//  TOGGLE SIDEBAR
function toggleAccordion(id) {
  const submenu = document.getElementById(id);
  if (!submenu) return;

  submenu.classList.toggle('hidden');

  const button = submenu.previousElementSibling;
  if (button) {
    button.classList.toggle('active');
  }
}

function toggleSidebar() {
  const sidebar = document.getElementById('sidebar');
  const mainContent = document.getElementById('main-content');
  if (!sidebar || !mainContent) return;

  sidebar.classList.toggle('collapsed');
  mainContent.classList.toggle('sidebar-collapsed');
  
  if (sidebar.classList.contains('collapsed')) {
    document.querySelectorAll('.submenu').forEach(menu => menu.classList.add('hidden'));
    document.querySelectorAll('.accordion-btn').forEach(btn => btn.classList.remove('active'));
  }
}

document.addEventListener('DOMContentLoaded', () => {
  const toggleBtn = document.getElementById('toggle-sidebar');
  toggleBtn?.addEventListener('click', toggleSidebar);
});




// DRAG AND DROP
function allowDrop(ev) {
  ev.preventDefault();
}

function drag(ev) {
  ev.dataTransfer.setData("moduleId", ev.target.id);
}

function drop(ev) {
  ev.preventDefault();
  var moduleId = ev.dataTransfer.getData("moduleId");
  var moduleElement = document.getElementById(moduleId);
  
  var dropTarget = ev.target;
  
  if (dropTarget.classList.contains("calendar-half")) {
    var newModule = document.createElement("div");
    newModule.classList.add("dropped-module");
    newModule.innerText = moduleElement.innerText;

    newModule.setAttribute("data-module-id", moduleId);
    
    dropTarget.appendChild(newModule);
  }
}

document.querySelectorAll('.module').forEach(mod => {
  mod.addEventListener('dragstart', (e) => {
    e.dataTransfer.setData('module-id', mod.dataset.moduleId);
  });
});



document.querySelectorAll('.morning, .afternoon').forEach(zone => {
  zone.addEventListener('dragover', e => e.preventDefault());
  zone.addEventListener('drop', e => {
    e.preventDefault();
    const moduleId = e.dataTransfer.getData('module-id');
    alert(`Ajout module ID : ${moduleId}`);
  });
});


// Recherche
document.getElementById("searchInput").addEventListener("input", function () {
  const filter = this.value.toLowerCase();
  const rows = document.querySelectorAll("#teacherTableBody tr");

  rows.forEach(row => {
    const text = row.textContent.toLowerCase();
    row.style.display = text.includes(filter) ? "" : "none";
  });
});


document.addEventListener('DOMContentLoaded', function() {
  const modules = document.querySelectorAll('.module');
  const calendar = document.getElementById('calendar');
  const searchInput = document.getElementById('searchInput');
  const addModuleBtn = document.getElementById('addModuleBtn');
  const modal = document.getElementById('moduleModal');
  const closeBtn = document.querySelector('.close-btn');
  const cancelBtn = document.getElementById('cancelBtn');
  const moduleForm = document.getElementById('moduleForm');

  modules.forEach(module => {
    module.addEventListener('dragstart', handleDragStart);
  });

  function handleDragStart(e) {
    e.dataTransfer.setData('text/plain', e.target.dataset.id);
    e.target.classList.add('dragging');
    setTimeout(() => {
      e.target.classList.remove('dragging');
    }, 0);
  }

  calendar.addEventListener('dragover', e => {
    e.preventDefault();
    calendar.classList.add('drag-over');
  });

  calendar.addEventListener('dragleave', () => {
    calendar.classList.remove('drag-over');
  });

  calendar.addEventListener('drop', e => {
    e.preventDefault();
    calendar.classList.remove('drag-over');
    const moduleId = e.dataTransfer.getData('text/plain');
    const originalModule = document.querySelector(`.module[data-id="${moduleId}"]`);
    
    if (originalModule) {
      const clone = originalModule.cloneNode(true);
      clone.classList.add('calendar-module');
      
      const removeBtn = document.createElement('button');
      removeBtn.classList.add('remove-btn');
      removeBtn.innerHTML = '&times;';
      removeBtn.addEventListener('click', function() {
        clone.remove();
      });
      
      clone.appendChild(removeBtn);
      calendar.appendChild(clone);
    }
  });

  searchInput.addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    modules.forEach(module => {
      const title = module.querySelector('.module-title').textContent.toLowerCase();
      if (title.includes(searchTerm)) {
        module.style.display = 'block';
      } else {
        module.style.display = 'none';
      }
    });
  });

  addModuleBtn.addEventListener('click', function() {
    modal.style.display = 'flex';
  });

  closeBtn.addEventListener('click', function() {
    modal.style.display = 'none';
  });

  cancelBtn.addEventListener('click', function() {
    modal.style.display = 'none';
  });

  window.addEventListener('click', function(e) {
    if (e.target === modal) {
      modal.style.display = 'none';
    }
  });

  moduleForm.addEventListener('submit', function(e) {
    e.preventDefault();
    
    const name = document.getElementById('moduleName').value;
    const description = document.getElementById('moduleDescription').value;
    const duration = document.getElementById('moduleDuration').value;
    const color = document.getElementById('moduleColor').value;
    const isOption = document.getElementById('moduleOption').checked;
    
    const id = Date.now();
    
    const moduleHTML = `
      <li class="module" id="module-${id}" draggable="true" ondragstart="drag(event)" data-id="${id}">
        <div class="color-${color}">
          <div class="module-head">
            <span class="module-title">${name}</span>
            ${isOption ? '<span class="module-option">Option</span>' : ''}
            <span class="module-id">ID: ${id}</span>
          </div>
          <div class="module-body">
            <div class="module-duration">${id}h</div>
            <div>Delai: 2</div>
          </div>
        </div>
      </li>
    `;
    
    document.getElementById('modules').insertAdjacentHTML('beforeend', moduleHTML);
    
    const newModule = document.querySelector(`.module[data-id="${id}"]`);
    newModule.addEventListener('dragstart', handleDragStart);
    
    modal.style.display = 'none';
    moduleForm.reset();
  });
});