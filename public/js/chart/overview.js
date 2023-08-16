document.addEventListener("DOMContentLoaded", function(){
     const ctx = document.getElementById('overview').getContext('2d');

     const data = {
          labels: @json($data['labels']),
          datasets: [
               {
                    label: "Quantities",
                    backgroundColor: 'rgba(75, 192, 192, 0.2',
                    borderColor: 'rgba(75, 192, 192, 1',
                    borderWidth: 1,
                    data: @json($data['quantities']),
               },
          ],
     };
});