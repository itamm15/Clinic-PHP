/*
  Event to ensure correct time of wizyta is selected.
  Time is valid when is between 8:00 and 16:00 and minutes % 15 == 0, example:
    8:00, 8:15, 8:30, 8:45, 9:00 and so on.
*/
document.addEventListener("DOMContentLoaded", () => {
  const dataWizyty = document.querySelector('input[name="data_wizyty"]');
  
  dataWizyty.addEventListener('blur', (event) => {
    const input = event.target;
    const value = new Date(input.value);
    const hour = value.getHours();
    const minutes = value.getMinutes();
    console.log(hour);
    if (minutes % 15 !== 0) {
      alert("Godzina musi być co 15 minut, tzn: 8:00, 8:15, 8:30, 8:45!");
    }

    if (hour < 8 || hour > 16) {
      alert("Godzina musi być w godzinach otwarcia przychodni, tj. 8:00-16:00");
    }
  });
});