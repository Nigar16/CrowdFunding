const graphView=(invested ,requested)=>{
    let xValues = ["Total amount raised", "Expected amount"];
    let expected=requested-invested;
    let yValues = [invested, expected];
    let barColors = [
        "#1e7145",
        "#b91d47"
    ];

   document.getElementById("#modal-graph-body").innerHTML= new Chart("myChart", {
        type: "doughnut",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            title: {
                display: true,
                text: "Graphical form of project"
            }
        }
    });
    document.getElementById('#graph').modal('show');
}
