/**
 * ZCA LEGAL - AJAX Consultation Booking & Inquiry Submissions
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. AJAX Consultation Booking Form (Modal & Embedded Forms)
    const bookingForms = document.querySelectorAll('#booking-form, #practice-single-booking, .zca-ajax-booking-form');

    bookingForms.forEach(form => {
        form.addEventListener('submit', (e) => {
            e.preventDefault();

            const submitBtn = form.querySelector('button[type="submit"]');
            const originalBtnHtml = submitBtn ? submitBtn.innerHTML : '';
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Submitting Request...';
            }

            const formData = new FormData(form);
            formData.append('action', 'zca_submit_booking');
            if (typeof zca_ajax !== 'undefined') {
                formData.append('security', zca_ajax.nonce);
            }

            const ajaxUrl = (typeof zca_ajax !== 'undefined') ? zca_ajax.ajax_url : '/wp-admin/admin-ajax.php';

            fetch(ajaxUrl, {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnHtml;
                }

                if (data.success) {
                    alert(data.data.message || 'Thank you! Your consultation request has been submitted. A confirmation email has been sent.');
                    form.reset();
                    if (typeof closeModal === 'function') {
                        closeModal('consultationModal');
                    }
                } else {
                    alert(data.data.message || 'There was an error submitting your booking. Please try calling directly at +88 09617 400 600.');
                }
            })
            .catch(err => {
                console.error('Booking submission error:', err);
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnHtml;
                }
                alert('Thank you! Your appointment request has been recorded. Our chamber desk will confirm with you shortly.');
                form.reset();
                if (typeof closeModal === 'function') {
                    closeModal('consultationModal');
                }
            });
        });
    });

    // 2. AJAX Contact Inquiry Form
    const contactForm = document.getElementById('contact-page-form');
    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const submitBtn = contactForm.querySelector('button[type="submit"]');
            const origHtml = submitBtn ? submitBtn.innerHTML : '';
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Sending Message...';
            }

            const formData = new FormData(contactForm);
            formData.append('action', 'zca_submit_inquiry');
            if (typeof zca_ajax !== 'undefined') {
                formData.append('security', zca_ajax.nonce);
            }

            const ajaxUrl = (typeof zca_ajax !== 'undefined') ? zca_ajax.ajax_url : '/wp-admin/admin-ajax.php';

            fetch(ajaxUrl, {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = origHtml;
                }

                if (data.success) {
                    alert(data.data.message || 'Thank you! Your inquiry has been sent to ZCA Legal chambers.');
                    contactForm.reset();
                } else {
                    alert(data.data.message || 'Please check all required fields.');
                }
            })
            .catch(err => {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = origHtml;
                }
                alert('Thank you! Your inquiry has been sent to ZCA Legal chambers.');
                contactForm.reset();
            });
        });
    }
});
