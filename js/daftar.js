// document.addEventListener('DOMContentLoaded', function() {
//     const form = document.querySelector('form');

//     if (form) {
//         form.addEventListener('submit', function(e) {
//             const nik = document.getElementById('nik');
//             if (nik && nik.value.length !== 16) {
//                 alert('NIK harus 16 digit!');
//                 e.preventDefault();
//                 return false;
//             }

//             const nisn = document.getElementById('nisn');
//             if (nisn && nisn.value.length !== 10) {
//                 alert('NISN harus 10 digit!');
//                 e.preventDefault();
//                 return false;
//             }

//             const tahun = document.getElementById('tahun_lulus');
//             if (tahun && tahun.value.length !== 4) {
//                 alert('Tahun lulus harus 4 digit!');
//                 e.preventDefault();
//                 return false;
//             }

//             const kodePos = document.getElementById('kode_pos');
//             if (kodePos && kodePos.value.length !== 5) {
//                 alert('Kode Pos harus 5 digit!');
//                 e.preventDefault();
//                 return false;
//             }

//             return true;
//         });
//     }
// });

// setTimeout(function() {
//     const alerts = document.querySelectorAll('.alert');
//     alerts.forEach(function(alert) {
//         alert.style.transition = 'opacity 0.5s ease';
//         alert.style.opacity = '0';
//         setTimeout(function() {
//             alert.style.display = 'none';
//         }, 500);
//     });
// }, 5000);

document.addEventListener('DOMContentLoaded', function () {
    // ===== MULTI-STEP FORM =====
    let currentStep = 1;
    const totalSteps = 4;

    const formSteps = document.querySelectorAll('.form-step');
    const progressBar = document.getElementById('progressBar');
    const progressContainer = document.querySelector('.progress-container');
    const steps = document.querySelectorAll('.step');
    const stepTitle = document.getElementById('stepTitle');
    const stepCounter = document.getElementById('stepCounter');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const submitBtn = document.getElementById('submitBtn');
    const form = document.getElementById('registrationForm');

    const stepTitles = {
        1: 'Data Pribadi',
        2: 'Kontak & Alamat',
        3: 'Asal Sekolah & Pilihan Prodi',
        4: 'Data Orang Tua / Wali'
    };

    function updateUI() {
        // Show/hide steps
        formSteps.forEach(step => {
            if (parseInt(step.dataset.step) === currentStep) {
                step.style.display = 'block';
                // Add animation
                step.style.animation = 'fadeIn 0.5s ease';
            } else {
                step.style.display = 'none';
            }
        });

        // Update progress bar
        const progress = ((currentStep - 1) / (totalSteps - 1)) * 100;
        progressBar.style.width = progress + '%';

        // Update step indicators
        steps.forEach(step => {
            const stepNum = parseInt(step.dataset.step);
            step.classList.remove('active', 'completed');
            if (stepNum === currentStep) {
                step.classList.add('active');
            } else if (stepNum < currentStep) {
                step.classList.add('completed');
            }
        });

        // Update title and counter
        stepTitle.textContent = stepTitles[currentStep];
        stepCounter.textContent = currentStep + ' / ' + totalSteps;

        // Show/hide buttons
        prevBtn.style.display = currentStep === 1 ? 'none' : 'inline-block';

        if (currentStep === totalSteps) {
            nextBtn.style.display = 'none';
            submitBtn.style.display = 'inline-block';
        } else {
            nextBtn.style.display = 'inline-block';
            submitBtn.style.display = 'none';
        }
    }

    function validateStep(step) {
        const currentStepElement = document.querySelector(`.form-step[data-step="${step}"]`);
        const requiredFields = currentStepElement.querySelectorAll('[required]');
        let isValid = true;
        let firstInvalid = null;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.style.borderColor = '#dc3545';
                field.style.boxShadow = '0 0 0 4px rgba(220, 53, 69, 0.1)';

                if (!firstInvalid) {
                    firstInvalid = field;
                }
            } else {
                field.style.borderColor = '';
                field.style.boxShadow = '';
            }
        });

        // Additional validation for specific fields
        if (step === 1) {
            const nik = document.getElementById('nik');
            const nisn = document.getElementById('nisn');

            if (nik.value.trim() && nik.value.length !== 16) {
                isValid = false;
                alert('NIK harus 16 digit!');
                nik.focus();
                nik.style.borderColor = '#dc3545';
                nik.style.boxShadow = '0 0 0 4px rgba(220, 53, 69, 0.1)';
                return false;
            }

            if (nisn.value.trim() && nisn.value.length !== 10) {
                isValid = false;
                alert('NISN harus 10 digit!');
                nisn.focus();
                nisn.style.borderColor = '#dc3545';
                nisn.style.boxShadow = '0 0 0 4px rgba(220, 53, 69, 0.1)';
                return false;
            }
        }

        if (step === 2) {
            const kodePos = document.getElementById('kode_pos');
            if (kodePos.value.trim() && kodePos.value.length !== 5) {
                isValid = false;
                alert('Kode Pos harus 5 digit!');
                kodePos.focus();
                kodePos.style.borderColor = '#dc3545';
                kodePos.style.boxShadow = '0 0 0 4px rgba(220, 53, 69, 0.1)';
                return false;
            }
        }

        if (step === 3) {
            const tahun = document.getElementById('tahun_lulus');
            if (tahun.value.trim() && tahun.value.length !== 4) {
                isValid = false;
                alert('Tahun lulus harus 4 digit!');
                tahun.focus();
                tahun.style.borderColor = '#dc3545';
                tahun.style.boxShadow = '0 0 0 4px rgba(220, 53, 69, 0.1)';
                return false;
            }
        }

        if (!isValid) {
            alert('Mohon lengkapi semua field yang bertanda * sebelum melanjutkan!');
            if (firstInvalid) {
                firstInvalid.focus();
            }
            return false;
        }

        return true;
    }

    function nextStep() {
        if (validateStep(currentStep)) {
            if (currentStep < totalSteps) {
                currentStep++;
                updateUI();
            }
        }
    }

    function prevStep() {
        if (currentStep > 1) {
            currentStep--;
            updateUI();
        }
    }

    // ===== FORM SUBMISSION VALIDATION =====
    function validateForm() {
        // Validasi NIK
        const nik = document.getElementById('nik');
        if (nik && nik.value.length !== 16) {
            alert('NIK harus 16 digit!');
            nik.focus();
            nik.style.borderColor = '#dc3545';
            nik.style.boxShadow = '0 0 0 4px rgba(220, 53, 69, 0.1)';
            return false;
        }

        // Validasi NISN
        const nisn = document.getElementById('nisn');
        if (nisn && nisn.value.length !== 10) {
            alert('NISN harus 10 digit!');
            nisn.focus();
            nisn.style.borderColor = '#dc3545';
            nisn.style.boxShadow = '0 0 0 4px rgba(220, 53, 69, 0.1)';
            return false;
        }

        // Validasi Tahun Lulus
        const tahun = document.getElementById('tahun_lulus');
        if (tahun && tahun.value.length !== 4) {
            alert('Tahun lulus harus 4 digit!');
            tahun.focus();
            tahun.style.borderColor = '#dc3545';
            tahun.style.boxShadow = '0 0 0 4px rgba(220, 53, 69, 0.1)';
            return false;
        }

        // Validasi Kode Pos
        const kodePos = document.getElementById('kode_pos');
        if (kodePos && kodePos.value.length !== 5) {
            alert('Kode Pos harus 5 digit!');
            kodePos.focus();
            kodePos.style.borderColor = '#dc3545';
            kodePos.style.boxShadow = '0 0 0 4px rgba(220, 53, 69, 0.1)';
            return false;
        }

        return true;
    }

    // ===== EVENT LISTENERS =====
    prevBtn.addEventListener('click', prevStep);
    nextBtn.addEventListener('click', nextStep);

    // Form submission
    if (form) {
        form.addEventListener('submit', function (e) {
            if (!validateForm()) {
                e.preventDefault();
                return false;
            }
            return true;
        });
    }

    // Keyboard navigation (Enter untuk next)
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            // Only if not submitting and not in textarea
            if (e.target.tagName !== 'TEXTAREA') {
                if (!submitBtn.style.display || submitBtn.style.display === 'none') {
                    e.preventDefault();
                    nextStep();
                }
            }
        }
    });

    // Click on step indicators to navigate (only to completed steps)
    steps.forEach(step => {
        step.addEventListener('click', function () {
            const stepNum = parseInt(this.dataset.step);
            if (stepNum < currentStep) {
                currentStep = stepNum;
                updateUI();
            } else if (stepNum === currentStep) {
                // Do nothing
            } else {
                alert('Silakan lengkapi step sebelumnya terlebih dahulu!');
            }
        });
    });

    // Clear error styling on input
    document.querySelectorAll('input, select, textarea').forEach(field => {
        field.addEventListener('input', function () {
            this.style.borderColor = '';
            this.style.boxShadow = '';
        });
        field.addEventListener('change', function () {
            this.style.borderColor = '';
            this.style.boxShadow = '';
        });
    });

    // ===== AUTO-HIDE ALERTS =====
    setTimeout(function () {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function (alert) {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(function () {
                alert.style.display = 'none';
            }, 500);
        });
    }, 5000);

    // ===== INITIALIZE =====
    updateUI();
});

// Add CSS animation for step transitions
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateX(20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
`;
document.head.appendChild(style);