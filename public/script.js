// This file contains the JavaScript code for the client side of the application.

// Scroll functionality for a container
const scrollContainer = document.getElementById('scroll-container');
const prevButton = document.getElementById('prev');
const nextButton = document.getElementById('next');

// Add event listeners to the prev and next buttons
prevButton.addEventListener('click', () => {
    scrollContainer.scrollLeft -= 200;
});

nextButton.addEventListener('click', () => {
    scrollContainer.scrollLeft += 200;
});

// Initialize date input fields and set their minimum values
document.addEventListener('DOMContentLoaded', () => {
    const today = new Date().toISOString().split('T')[0];
    const dateStartInput = document.getElementById('date_start');
    const dateEndInput = document.getElementById('date_end');

    dateStartInput.setAttribute('min', today);
    dateEndInput.setAttribute('min', today);

    // Update the end date minimum value when the start date changes
    dateStartInput.addEventListener('change', () => {
        const dateStart = dateStartInput.value;
        dateEndInput.setAttribute('min', dateStart);
        calculateTotalPrice();
    });

    // Recalculate total price when the end date changes
    dateEndInput.addEventListener('change', calculateTotalPrice);
});

// Calculate the total price based on the selected start and end dates
function calculateTotalPrice() {
    const pricePerNight = parseFloat(document.getElementById('price_per_night').dataset.price);
    const dateStart = new Date(document.getElementById('date_start').value);
    const dateEnd = new Date(document.getElementById('date_end').value);

    if (dateStart && dateEnd && dateEnd > dateStart) {
        const timeDiff = dateEnd.getTime() - dateStart.getTime();
        const nights = timeDiff / (1000 * 3600 * 24);
        const totalPrice = nights * pricePerNight;

        document.getElementById('price_total').value = totalPrice;
        document.getElementById('total_price_display').innerText = totalPrice.toFixed(2) + ' €';
    } else {
        document.getElementById('price_total').value = 0;
        document.getElementById('total_price_display').innerText = '0 €';
    }
}

// Submit a reservation using the form data
function submitReservation() {
    const dateStart = document.getElementById('date_start').value;
    const dateEnd = document.getElementById('date_end').value;
    const nbAdults = document.getElementById('nb_adults').value;
    const nbChildren = document.getElementById('nb_children').value;
    const priceTotal = document.getElementById('price_total').value;
    const residenceId = document.getElementById('residence_id').value;

    const data = {
        date_start: dateStart,
        date_end: dateEnd,
        nb_adults: nbAdults,
        nb_children: nbChildren,
        price_total: priceTotal,
        residence_id: residenceId
    };

    fetch('/submit-reservation', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Reservation created successfully');
            } else {
                alert('Error: ' + data.error);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}
