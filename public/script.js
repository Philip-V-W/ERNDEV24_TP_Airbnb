// This file contains the JavaScript code for the client side of the application.
var scrollContainer = document.getElementById('scroll-container');
var prevButton = document.getElementById('prev');
var nextButton = document.getElementById('next');

// Add event listeners to the prev and next buttons
prevButton.addEventListener('click', function () {
    scrollContainer.scrollLeft -= 200;
});

// Add event listeners to the prev and next buttons
nextButton.addEventListener('click', function () {
    scrollContainer.scrollLeft += 200;
});



document.addEventListener('DOMContentLoaded', (event) => {
    const today = new Date().toISOString().split('T')[0];
    const dateStartInput = document.getElementById('date_start');
    const dateEndInput = document.getElementById('date_end');

    dateStartInput.setAttribute('min', today);
    dateEndInput.setAttribute('min', today);

    dateStartInput.addEventListener('change', function() {
        const dateStart = this.value;
        dateEndInput.setAttribute('min', dateStart);
        calculateTotalPrice();
    });

    dateEndInput.addEventListener('change', calculateTotalPrice);
});

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
        .catch((error) => {
            console.error('Error:', error);
        });
}

