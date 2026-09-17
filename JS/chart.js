function afficherGraphique(temps, hauteurs){
    document.getElementById('section').innerHTML = "<canvas id='graphiqueHauteur'></canvas>";
    new Chart(document.getElementById('graphiqueHauteur'), {
        type: 'line',
        data: {
            labels: temps,
            datasets: [{
                label: 'Hauteur du drone',
                data: hauteurs,
                borderColor: "blue",
                borderWidth: 2,
                fill: false
            }],
        },
        options: { 
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Temps (s)'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Hauteur'
                    }
                }
            }
        }
    });
}