document.addEventListener('DOMContentLoaded', () => {
    const txnInputs = document.querySelectorAll('.transaction-number-input');

    const updateConfirmBtn = () => {
        const filled = Array.from(txnInputs).every(i => i.value !== '');
        const btn = document.getElementById('confirm-btn');
        if (btn) btn.disabled = !filled;
        // Always keep hidden field in sync
        const transacNo = Array.from(txnInputs).map(i => i.value).join('');
        document.getElementById('hidden-transac_no').value = transacNo;
    };

    txnInputs.forEach((input, i) => {
        // ── Paste handler
        input.addEventListener('paste', (e) => {
            e.preventDefault();
            const digits = (e.clipboardData || window.clipboardData)
                .getData('text')
                .replace(/\D/g, '')          // strip non-digits
                .slice(0, txnInputs.length); // cap at 8

            // Always fill from the very first box
            txnInputs.forEach((box, idx) => {
                box.value = digits[idx] ?? '';
            });

            // Focus the last filled box (or first empty one)
            const focusIdx = Math.min(digits.length, txnInputs.length - 1);
            txnInputs[focusIdx].focus();

            updateConfirmBtn();
        });

        // ── Normal single-digit input
        input.addEventListener('input', () => {
            input.value = input.value.replace(/\D/g, '').slice(0, 1);
            if (input.value && i < txnInputs.length - 1) {
                txnInputs[i + 1].focus();
            }
            updateConfirmBtn();
        });

        // ── Backspace moves to previous box
        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && !input.value && i > 0) {
                txnInputs[i - 1].focus();
                txnInputs[i - 1].value = '';
                updateConfirmBtn();
            }
        });

        input.addEventListener('focus', () => input.select());
    });

    updateConfirmBtn(); // disable button initially
});