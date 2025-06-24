<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Royal Donut Menu Manager</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col items-center p-6">

    <div class="w-full max-w-4xl bg-white rounded-lg shadow-md p-8">

        <h1 class="text-4xl font-extrabold text-center text-indigo-600 mb-8">Royal Donut Menu Manager</h1>

        <!-- Sort Buttons -->
        <div class="flex justify-center gap-4 mb-6">
            <button onclick="sortByName()"
                class="px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700 transition">
                Sort by Name
            </button>
            <button onclick="sortByApproval()"
                class="px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700 transition">
                Sort by Seal of Approval
            </button>
        </div>

        <!-- Donut List -->
        <div id="donut-list" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-10"></div>

        <!-- Add Donut Form -->
        <div id="add-donut-form" class="bg-indigo-50 rounded-lg p-6 shadow-inner max-w-md mx-auto">
            <h2 class="text-2xl font-semibold mb-4 text-indigo-700">Add a New Donut</h2>

            <input type="text" id="donut-name" placeholder="Donut Name" required
                class="w-full mb-3 px-4 py-2 rounded border border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-500" />

            <input type="number" id="donut-seal" placeholder="Seal of Approval (1–5)" min="1" max="5"
                required
                class="w-full mb-3 px-4 py-2 rounded border border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-500" />

            <input type="number" id="donut-price" placeholder="Price" step="0.1" required
                class="w-full mb-5 px-4 py-2 rounded border border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-500" />

            <!-- Image Upload Field -->
            <input type="file" id="donut-image" accept="image/*" class="input" />

            <div class="flex justify-between">
                <button onclick="submitDonut()"
                    class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 transition">
                    Save
                </button>
                <button onclick="cancelAddDonut()"
                    class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400 transition">
                    Cancel
                </button>
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
                card.className = 'donut-card p-4 border rounded-lg shadow bg-white space-y-2';

                const imageUrl = donut.image ? `/storage/${donut.image}` : null;

                card.innerHTML = `
      ${imageUrl ? `<img src="${imageUrl}" alt="${donut.name}" class="w-full h-48 object-cover rounded" />` : ''}
      <h3 class="text-xl font-semibold">${donut.name}</h3>
      <p>Seal of Approval: ${donut.seal_of_approval}</p>
      <p>Price: $${parseFloat(donut.price).toFixed(2)}</p>
      <button onclick="deleteDonut(${donut.id})" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">Delete</button>
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
            await fetch(`/api/delete-donut/${id}`, {
                method: 'DELETE'
            });
            fetchAndRenderDonuts();
        }

        async function submitDonut() {
            const name = document.getElementById('donut-name').value.trim();
            const seal = parseInt(document.getElementById('donut-seal').value);
            const price = parseFloat(document.getElementById('donut-price').value);
            const imageFile = document.getElementById('donut-image').files[0];

            if (!name || isNaN(seal) || isNaN(price)) {
                return alert('Please fill all fields correctly.');
            }

            if (price <= 0) {
                return alert('Price must be greater than 0.');
            }

            const formData = new FormData();
            formData.append('name', name);
            formData.append('seal_of_approval', seal);
            formData.append('price', price);
            if (imageFile) {
                formData.append('image', imageFile);
            }

            await fetch('/api/create-donut', {
                method: 'POST',
                body: formData,
            });

            cancelAddDonut();
            fetchAndRenderDonuts();
        }

        function cancelAddDonut() {
            document.getElementById('donut-name').value = '';
            document.getElementById('donut-seal').value = '';
            document.getElementById('donut-price').value = '';
            document.getElementById('donut-image').value = '';
        }

        window.onload = fetchAndRenderDonuts;
    </script>
</body>

</html>
