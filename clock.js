let clock = document.getElementById('clock-widget');
let date_widget = document.getElementById('date-widget');

setInterval(()=> {
    let d = new Date();
    let hour = d.getHours();
    let minutes = d.getMinutes();
    let seconds = d.getSeconds();

    let months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    let time_string = hour.toString() + ":" + minutes.toString() + ":" + seconds.toString().padStart('0', 2);
    let date_string = months[d.getMonth()] + " " + d.getDate().toString() + ", " + d.getFullYear().toString();

    date_widget.innerText = date_string;
    clock.innerText = time_string;
}, 1000);