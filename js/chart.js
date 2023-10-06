import excelFunctions from "./excel.js";

/********** chart **********/
const labels = [];
const dataAmount = [];
const databaseRow = $(".table.db tr");
const dataGroups = {};

databaseRow.each((_, item) => {
  const dbRowItem = $(item).children(".db_item").find("input").val();
  const dbRowAmount = $(item)
    .children(".db_amount")
    .find("input")
    .val()
    .replace(/,/g, "");

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
      label: "지출 내역",
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

/********** excel 파일 생성 및 다운로드 로직 **********/
$(".excel").on("click", function () {
  const workbook = excelFunctions.createAndFillExcelWorkbook(
    labels,
    dataAmount
  );
  excelFunctions.download(workbook, "file_name").then((r) => {});
});
