
    <style>

.calculator-container {
    display: flex;
    justify-content: center;  /* Center the calculator horizontally */
    align-items: flex-start;
    gap: 30px;
    margin-top: 30px;  /* Optional: Add space from the top */
}


    .calculator {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        width: 1000px;
    }

    .calculator .display {
        grid-column: span 4;
        background-color: #e9e9e9;
        border-radius: 5px;
        padding: 10px;
        font-size: 24px;
        text-align: right;
        overflow: hidden;
        white-space: nowrap;
    }

    .calculator button {
        font-size: 18px;
        padding: 20px;
        border: none;
        border-radius: 5px;
        background-color: #e9e9e9;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    .calculator button:active {
        background-color: #ccc;
    }

    .calculator button.special {
        background-color: #cce5ff;
    }

    .calculator button.special:active {
        background-color: #a0c9e1;
    }

    .calculator button.equal {
        grid-column: span 1;
        background-color: #007bff;
        color: white;
    }

    .calculator button.equal:active {
        background-color: #0056b3;
    }

    .history {
        width: 200px;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        height: 560px;
        overflow-y: auto;
    }

    .history .entry {
        font-size: 16px;
        margin: 10px 0;
        padding: 5px;
        background-color: #f5f5f5;
        border-radius: 5px;
    }

    .history .entry .expression {
        font-weight: bold;
    }

    .history .entry .result {
        color: #007bff;
    }

    .button.wide {
            grid-column: span 2;
        }
</style>

</head>
<body>
    <div class="calculator-container">
        <div class="calculator">
            <div class="display" id="display">0</div>
            <button class="special">%</button>
            <button class="special">C</button>
            <button class="backspace button wide special">&larr;</button>

            <button>1/x</button>
            <button>x²</button>
            <button>√x</button>
            <button>&divide;</button>

            <button>7</button>
            <button>8</button>
            <button>9</button>
            <button>&times;</button>

            <button>4</button>
            <button>5</button>
            <button>6</button>
            <button>&minus;</button>

            <button>1</button>
            <button>2</button>
            <button>3</button>
            <button>+</button>

            <button>+/-</button>
            <button>0</button>
            <button>,</button>
            <button class="equal">=</button>
        </div>

        <div class="history" id="history">
    <h3>
        History
        <button id="delete-history" style="border: none; background: none; cursor: pointer; font-size: 20px;">
        🗑
        </button>
    </h3>
    <?php if (!empty($elly)): ?>
    <?php foreach ($elly as $entry): ?>
        <?php if ($entry['operation_type'] === 'standard'): ?>
            <div class="entry" data-entry-id="<?= $entry['id']; ?>" data-created-by="<?= $entry['created_by']; ?>">
                <span class="expression"><?= $entry['input_data']; ?></span> =
                <span class="result"><?= $entry['result']; ?></span>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
<?php else: ?>
    <p>No history available.</p>
<?php endif; ?>

</div>


    </div>

    <script>
        const display = document.getElementById('display');
        const historyContainer = document.getElementById('history');
        const buttons = document.querySelectorAll('.calculator button');
        let currentExpression = '';

        buttons.forEach(button => {
            button.addEventListener('click', () => {
    const value = button.textContent;

    if (value === 'C') {
        display.textContent = '0';
        currentExpression = '';
    } else if  (value === '=') {
    try {
        const sanitizedExpression = currentExpression
            .replace(/×/g, '*')
            .replace(/÷/g, '/')
            .replace(/−/g, '-');
        const result = Function(`'use strict'; return (${sanitizedExpression})`)();
        display.textContent = Number.isFinite(result) ? result : 'Error';
        addHistory(currentExpression, result); // Add to history

        // Send the calculation history to the server
        saveCalculationHistory(currentExpression, result);

        currentExpression = result.toString();
    } catch {
        display.textContent = 'Error';
    }

        } else if (value === 'CE') {
            currentExpression = currentExpression.slice(0, -1);
            display.textContent = currentExpression || '0';
        } else if (button.classList.contains('backspace')) {
            currentExpression = currentExpression.slice(0, -1);
            display.textContent = currentExpression || '0';
        } else if (value === '1/x') {
    const inputValue = parseFloat(currentExpression);
    
    // Mengecek jika nilai inputnya adalah 0 untuk menghindari pembagian dengan 0
    if (inputValue === 0) {
        display.textContent = 'Error';
        return;
    }
    
    const inverseValue = (1 / inputValue).toString();
    display.textContent = inverseValue;

    // Menyimpan ekspresi "1/x" dan hasilnya
    const formattedExpression = `1/${currentExpression}`; // Ekspresi seperti "1/2"
    const result = inverseValue; // Hasil perhitungan, misalnya 0.5

    // Menambahkan ke history
    addHistory(formattedExpression, result); // Menambahkan ekspresi "1/2" ke history
    saveCalculationHistory(formattedExpression, result); // Menyimpan history ke server
} else if (value === 'x²') {
    const inputValue = parseFloat(currentExpression);
    
    const squareValue = Math.pow(inputValue, 2).toString();
    display.textContent = squareValue;

    // Menyimpan ekspresi "x²" dan hasilnya
    const formattedExpression = `${currentExpression}²`; // Ekspresi seperti "3²"
    const result = squareValue; // Hasil perhitungan, misalnya 9

    // Menambahkan ke history
    addHistory(formattedExpression, result); // Menambahkan ekspresi "3²" ke history
    saveCalculationHistory(formattedExpression, result); // Menyimpan history ke server
} else if (value === '√x') {
    const inputValue = parseFloat(currentExpression);
    
    // Mengecek jika nilai inputnya negatif, karena akar kuadrat dari bilangan negatif tidak didefinisikan dalam angka real
    if (inputValue < 0) {
        display.textContent = 'Error';
        return;
    }

    const sqrtValue = Math.sqrt(inputValue).toString();
    display.textContent = sqrtValue;

    // Menyimpan ekspresi "√x" dan hasilnya
    const formattedExpression = `√${currentExpression}`; // Ekspresi seperti "√4"
    const result = sqrtValue; // Hasil perhitungan akar kuadrat, misalnya 2

    // Menambahkan ke history
    addHistory(formattedExpression, result); // Menambahkan ekspresi "√4" ke history
    saveCalculationHistory(formattedExpression, result); // Menyimpan history ke server
} else if (value === '%') {
    const percentValue = (parseFloat(currentExpression) / 100).toString();
    display.textContent = percentValue;

    // Menyimpan ekspresi dan hasil dengan format yang diinginkan
    const formattedExpression = currentExpression + '%'; // Tambahkan simbol persen ke ekspresi
    const result = percentValue; // Hasil perhitungan dalam desimal (misalnya 0.5)

    // Menambahkan ke history
    addHistory(formattedExpression, result); // Menambahkan ekspresi "50%" ke history
    saveCalculationHistory(formattedExpression, result); // Menyimpan history ke server
} else if (value === '+/-') {
            currentExpression = (parseFloat(currentExpression) * -1).toString();
            display.textContent = currentExpression;
        } else if (value === ',') { // Update this to handle the decimal point
            if (!currentExpression.includes('.')) {
                currentExpression += '.';
                display.textContent = currentExpression;
            }
        } else {
            currentExpression = currentExpression === '0' ? value : currentExpression + value;
            display.textContent = currentExpression;
        }
    });
});

function saveCalculationHistory(expression, result) {
    console.log('Menyimpan perhitungan:', { expression, result }); // Ini untuk debugging

    // Ambil CSRF token dari meta tag yang ada di layout Blade (misalnya, dalam <head>)
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('/home/history_kalkulator', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': csrfToken // Menambahkan CSRF token ke header
        },
        body: JSON.stringify({ expression: expression, result: result })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Sukses:', data);
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}



        function addHistory(expression, result) {
            const entry = document.createElement('div');
            entry.classList.add('entry');
            entry.innerHTML = `
                <span class="expression">${expression}</span> = 
                <span class="result">${result}</span>
            `;
            historyContainer.appendChild(entry);
        }

        // Delete history for logged-in user
document.getElementById('delete-history').addEventListener('click', () => {
    const confirmDelete = confirm("Are you sure you want to delete your history?");
    if (confirmDelete) {
        deleteHistory();
    }
});

// Fungsi untuk menghapus history
function clearHistory() {
        history = [];
        const historyContainer = document.getElementById('history');
        historyContainer.innerHTML = '<h3>History <button id="delete-history" style="border: none; background: none; cursor: pointer; font-size: 20px;">🗑</button></h3><p>No history available.</p>';
    }

    function deleteHistory() {
    console.log('Menghapus riwayat kalkulator'); // Debugging

    // Ambil CSRF token dari meta tag yang ada di layout Blade
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('/home/delete_kalkulator', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': csrfToken // Menambahkan CSRF token ke header
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Hapus entry riwayat dari UI
            const entries = document.querySelectorAll('.history .entry');
            entries.forEach(entry => {
                const createdBy = entry.getAttribute('data-created-by');
                const userId = <?= session()->get('id'); ?>; // Mendapatkan ID pengguna yang sedang login
                if (createdBy == userId) {
                    entry.remove();
                }
            });
        } else {
            alert('Gagal menghapus riwayat');
        }
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}


 // Event listener untuk menghapus history
    document.getElementById('delete-history').addEventListener('click', clearHistory);

    </script>
</body>

