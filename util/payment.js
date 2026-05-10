document.addEventListener('DOMContentLoaded', () => {
    const txnInputs = document.querySelectorAll('.transaction-number-input');

    const updateConfirmBtn = () => {
        const filled = Array.from(txnInputs).every(i => i.value !== '');
        const btn = document.getElementById('confirm-btn');
        if (btn) btn.disabled = !filled;
        if (filled) {
            const transacNo = Array.from(txnInputs).map(i => i.value).join('');
            document.getElementById('hidden-transac_no').value = transacNo;
        }
    };

    txnInputs.forEach((input, i) => {
        input.addEventListener('input', () => {
            input.value = input.value.replace(/\D/g, '').slice(0, 1);
            if (input.value && i < txnInputs.length - 1) {
                txnInputs[i + 1].focus();
            }
            updateConfirmBtn();
        });

        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && !input.value && i > 0) {
                txnInputs[i - 1].focus();
                txnInputs[i - 1].value = '';
                updateConfirmBtn();
            }
        });

        input.addEventListener('focus', () => input.select());
    });

    updateConfirmBtn(); // run once on load to disable button initially
});