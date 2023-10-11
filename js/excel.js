/********** excel 파일 생성 **********/
function createAndFillExcelWorkbook(labels, dataAmount, dataGroups) {
  const workbook = new ExcelJS.Workbook();
  const sheet = workbook.addWorksheet("tab_1");
  const cell = function (row, column) {
    return sheet.getCell(row, column);
  };

  sheet.mergeCells("A1:C1");
  cell("A1").value = startDateFromDB + " ~ " + endDateFromDB;
  cell("A1").font = { bold: true };
  cell("A1").alignment = { vertical: "middle", horizontal: "center" };

  // B1~Z1, B2~Z2 볼드, 가로 세로 중앙 정렬 처리
  for (let col = 2; col <= 26; col++) {
    // B1~Z1셀 볼드, 가로 세로 중앙 정렬 처리
    const headerCell = cell(String.fromCharCode(64 + col) + "3");
    headerCell.font = { bold: true };
    headerCell.alignment = { vertical: "middle", horizontal: "center" };

    // B2~Z2셀 볼드, 가로 세로 중앙 정렬 처리
    const dataCell = cell(String.fromCharCode(64 + col) + "4");
    dataCell.alignment = { vertical: "middle", horizontal: "center" };
    dataCell.numFmt = "#,##0";
  }

  // 총 지출
  const totalAmount = dataAmount.reduce((acc, cur) => acc + cur);
  cell(3, Object.keys(dataGroups).length + 3).value = "총 지출";
  cell(4, Object.keys(dataGroups).length + 3).value = totalAmount;

  // 합계, 내역 Cell
  cell("A4").value = "합계";
  cell("A6").value = "내역";
  for (let i = 4; i <= 6; i += 2) {
    cell(`A${i}`).alignment = { vertical: "middle", horizontal: "center" };
  }

  let column = 2;
  for (let key in dataGroups) {
    // 열 너비
    if (key.length == 4) {
      sheet.getColumn(column).width = 10;
    } else if (key.length >= 5) {
      sheet.getColumn(column).width = 12;
    }

    let index = column - 2;
    // 항목
    cell(3, `${column}`).value = key;
    // 항목 별 합계
    cell(4, `${column}`).value = dataAmount[index];

    // 각 항목
    $.each(dataGroups[key], function (row, item) {
      cell(`${row + 6}`, `${column}`).value = item;
      cell(`${row + 6}`, `${column}`).alignment = {
        vertical: "middle",
        horizontal: "center",
      };

      // 콤마 처리
      cell(`${row + 6}`, `${column}`).numFmt = "#,##0";

      // 열 너비
      if (item.toString().length >= 8) {
        sheet.getColumn(column).width = 10;
      }
    });
    column++;
  }

  return workbook;
}

/********** excel 파일 다운로드 **********/
const download = async (workbook, fileName) => {
  const buffer = await workbook.xlsx.writeBuffer();
  const blob = new Blob([buffer], {
    type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
  });
  const url = window.URL.createObjectURL(blob);
  const anchor = document.createElement("a");
  anchor.href = url;
  anchor.download = fileName + ".xlsx";
  anchor.click();
  window.URL.revokeObjectURL(url);
};

export default {
  createAndFillExcelWorkbook,
  download,
};
