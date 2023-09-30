const labels = [];
const dataAmount = [];
const databaseRow = $(".table.db tr");
const dataGroups = {};

databaseRow.each((index, item) => {
  const dbRowItem = $(item).children(".db_item").html().trim();
  const dbRowAmount = $(item).children(".db_amount").html().replace(/,/g, "");

  if (!dataGroups[dbRowItem]) {
    dataGroups[dbRowItem] = [];
  }

  dataGroups[dbRowItem].push(Number(dbRowAmount));
});

for (let key in dataGroups) {
  labels.push(key);
  let sum = dataGroups[key].reduce((acc, cur) => acc + cur);
  dataAmount.push(sum);
}

//
const data = {
  labels: labels,
  datasets: [
    {
      label: "My First Dataset",
      data: dataAmount,
      backgroundColor: "rgba(255, 99, 132, 0.7)",

      borderWidth: 1,
    },
  ],
};

//
const config = {
  type: "bar",
  data: data,
  options: {
    maintainAspectRatio: false,
    plugins: {
      legend: {
        display: true,
        labels: {
          color: "black",
        },
      },
    },
  },
};

//
let ctx = document.getElementById("bar-chart");
const stackedBar = new Chart(ctx, config);
