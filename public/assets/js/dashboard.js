function nextStep(action) {
    var inviteYes = document.getElementById('invite-yes').checked;
    var step1 = document.getElementById('step1');
    var step2 = document.getElementById('step2');
    var step3 = document.getElementById('step3');
    var slipGenerate = document.getElementById('slip_container')

    if (action === 'next') {
        if (inviteYes) {
            step1.classList.remove('active');
            step2.classList.add('active');
        } else {
            step1.classList.remove('active');
            step3.classList.add('active');
        }
    } else if (action === 'back') {
        step2.classList.remove('active');
        step3.classList.remove('active');
        step1.classList.add('active');
        slipGenerate.classList.remove('active');
    } else if (action === 'submit') {
        step2.classList.remove('active');
        step3.classList.add('active');
    } else if (action == 'generate') {
        slipGenerate.classList.toggle('active');
    }
}

// Download Functionialty

window.onload = function() {
    download = document.getElementById("download_button");
    download.addEventListener('click', () => {
        const FeeSlipDownload = this.document.getElementById("fee_slip_download");
        console.log(FeeSlipDownload);
        var opt = {
            // margin: 1,
            filename: "feeslip.pdf",
            image: {type: "jpeg", quality: 0.98},
            // html2canvas: {scale: 2},
            jsPDF: {unit: 'in', format: "letter", orientation: 'landscape'}
        }
        html2pdf().from(FeeSlipDownload).set(opt).save();
    })
}

function submitSlip() {
    // Submit the slip
    alert('Slip submitted successfully!');
}