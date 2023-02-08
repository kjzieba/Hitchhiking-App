const search = document.querySelector('input[placeholder="search"]');
const rideContainer = document.querySelector('.search-results');

search.addEventListener("keyup", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();

        const data = {search: this.value};

        fetch("/searchUserRides", {
            method: "POST",
            credentials: 'include',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function (response) {
            return response.json();
        }).then(function (rides) {
            rideContainer.innerHTML = "";
            loadUserRides(rides)
        });
    }
});

function loadUserRides(rides){
    rides.forEach(ride =>{
        console.log(ride);
        createRide(ride);
    })
}

function createRide(ride){
    const template = document.querySelector("#ride-template")
    const clone = template.content.cloneNode(true);

    const time1 = clone.querySelector("#time1");
    time1.innerHTML = ride.time;
    const time2 = clone.querySelector("#time2");
    time2.innerHTML = ride.time;
    const start = clone.querySelector("#start");
    start.innerHTML = ride.start;
    const destination = clone.querySelector("#destination");
    destination.innerHTML = ride.destination;
    const availableSeats = clone.querySelector("#availableSeats");
    availableSeats.innerHTML = ride.number_of_seats;

    rideContainer.appendChild(clone);
}