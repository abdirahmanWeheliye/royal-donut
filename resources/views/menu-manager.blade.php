<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Royal Menu Manager</title>
  <link rel="stylesheet" href="/css/style.css" />
</head>
<body>
  <div class="container">
    <h1>Royal Donut Menu Manager</h1>

    <!-- Sort Buttons -->
    <div class="sort-buttons">
      <button onclick="sortByName()">Sort by Name</button>
      <button onclick="sortByApproval()">Sort by Seal of Approval</button>
    </div>

    <!-- Donut List -->
    <div id="donut-list"></div>

    <!-- Add Donut Form -->
    <div id="add-donut-form" class="add-donut-container">
      <h2>Add a New Donut</h2>
      <input type="text" id="donut-name" placeholder="Donut Name" required />
      <input type="number" id="donut-seal" placeholder="Seal of Approval (1–5)" min="1" max="5" required />
      <input type="number" id="donut-price" placeholder="Price" step="0.1" required />
      <div class="button-group">
        <button onclick="submitDonut()">Save</button>
        <button onclick="cancelAddDonut()">Cancel</button>
      </div>
    </div>
  </div>

  <script>
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
  </script>
</body>
</html>
