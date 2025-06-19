let donutData = [];

async function fetchAndRenderDonuts() {
  const res = await fetch('/api/retrieve-donuts');
  const data = await res.json();
  donutData = data;
  renderDonuts(donutData);
}

function renderDonuts(data) {
  const list = document.getElementById('donut-list');
  list.innerHTML = '';
  data.forEach(donut => {
    const card = document.createElement('div');
    card.className = 'donut-card';
    card.innerHTML = `
      <h3>${donut.name}</h3>
      <p>Seal of Approval: ${donut.seal_of_approval}</p>
      <p>Price: $${donut.price.toFixed(2)}</p>
      <button onclick="deleteDonut(${donut.id})">Delete</button>
    `;
    list.appendChild(card);
  });
}

function sortByName() {
  const sorted = [...donutData].sort((a, b) => a.name.localeCompare(b.name));
  renderDonuts(sorted);
}

function sortByApproval() {
  const sorted = [...donutData].sort((a, b) => b.seal_of_approval - a.seal_of_approval);
  renderDonuts(sorted);
}

async function deleteDonut(id) {
  if (!confirm('Delete this donut?')) return;
  await fetch(`/api/delete-donut/${id}`, { method: 'DELETE' });
  fetchAndRenderDonuts();
}

async function submitDonut() {
  const name = document.getElementById('donut-name').value.trim();
  const seal = parseInt(document.getElementById('donut-seal').value);
  const price = parseFloat(document.getElementById('donut-price').value);
  if (!name || isNaN(seal) || isNaN(price)) return alert('Fill all fields');

  await fetch('/api/create-donut', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ name, seal_of_approval: seal, price })
  });

  cancelAddDonut();
  fetchAndRenderDonuts();
}

function cancelAddDonut() {
  document.getElementById('donut-name').value = '';
  document.getElementById('donut-seal').value = '';
  document.getElementById('donut-price').value = '';
}

window.onload = fetchAndRenderDonuts;
